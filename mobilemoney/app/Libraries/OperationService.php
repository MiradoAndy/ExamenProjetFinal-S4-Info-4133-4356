<?php

namespace App\Libraries;

use App\Models\BaremeFraisModel;
use App\Models\ClientModel;
use App\Models\HistoriqueOperationModel;
use App\Models\TypeOperationModel;

/**
 * Contient la logique métier des opérations du client : dépôt, retrait et transfert.
 *
 * Chaque opération :
 *  1. vérifie que les données fournies sont correctes,
 *  2. calcule les frais éventuels à partir du barème,
 *  3. met à jour le(s) solde(s) concerné(s),
 *  4. enregistre l'opération dans l'historique.
 */
class OperationService
{
    /** Types d'opération pour lesquels un frais est appliqué (le dépôt est gratuit). */
    private const TYPES_AVEC_FRAIS = ['retrait', 'transfert'];

    protected ClientModel $clientModel;
    protected TypeOperationModel $typeOperationModel;
    protected BaremeFraisModel $baremeFraisModel;
    protected HistoriqueOperationModel $historiqueModel;

    public function __construct(
        ?ClientModel $clientModel = null,
        ?TypeOperationModel $typeOperationModel = null,
        ?BaremeFraisModel $baremeFraisModel = null,
        ?HistoriqueOperationModel $historiqueModel = null
    ) {
        $this->clientModel        = $clientModel ?? new ClientModel();
        $this->typeOperationModel = $typeOperationModel ?? new TypeOperationModel();
        $this->baremeFraisModel   = $baremeFraisModel ?? new BaremeFraisModel();
        $this->historiqueModel    = $historiqueModel ?? new HistoriqueOperationModel();
    }

    /**
     * Effectue une opération pour le client donné et retourne le résultat.
     *
     * @param int         $idClient            Identifiant du client qui effectue l'opération.
     * @param string      $libelleOperation    'depot', 'retrait' ou 'transfert'.
     * @param float       $montant             Montant de l'opération.
     * @param string|null $numeroDestinataire  Requis uniquement pour un transfert.
     *
     * @return array{success: bool, message: string}
     */
    public function effectuer(int $idClient, string $libelleOperation, float $montant, ?string $numeroDestinataire = null): array
    {
        if ($montant <= 0) {
            return $this->echec('Le montant doit être supérieur à 0.');
        }

        $typeOperation = $this->typeOperationModel->findByLibelle($libelleOperation);
        if ($typeOperation === null) {
            return $this->echec("Type d'opération inconnu.");
        }

        $client = $this->clientModel->find($idClient);
        if ($client === null) {
            return $this->echec('Client introuvable.');
        }

        $frais = 0.0;
        if (in_array($libelleOperation, self::TYPES_AVEC_FRAIS, true)) {
            $frais = $this->baremeFraisModel->getFrais((int) $typeOperation['id_type_operation'], $montant);

            if ($frais === null) {
                return $this->echec('Aucun barème de frais ne correspond à ce montant.');
            }
        }

        return match ($libelleOperation) {
            'depot'     => $this->depot($client, $typeOperation, $montant),
            'retrait'   => $this->retrait($client, $typeOperation, $montant, $frais),
            'transfert' => $this->transfert($client, $typeOperation, $montant, $frais, $numeroDestinataire),
            default     => $this->echec("Type d'opération non supporté."),
        };
    }

    /**
     * @param array<string, mixed> $client
     * @param array<string, mixed> $typeOperation
     */
    private function depot(array $client, array $typeOperation, float $montant): array
    {
        $this->clientModel->update($client['id_client'], [
            'solde' => $client['solde'] + $montant,
        ]);

        $this->enregistrerHistorique((int) $typeOperation['id_type_operation'], $montant, 0, (int) $client['id_client']);

        return $this->succes('Dépôt effectué avec succès.');
    }

    /**
     * @param array<string, mixed> $client
     * @param array<string, mixed> $typeOperation
     */
    private function retrait(array $client, array $typeOperation, float $montant, float $frais): array
    {
        $montantTotal = $montant + $frais;

        if ($client['solde'] < $montantTotal) {
            return $this->echec('Solde insuffisant pour effectuer ce retrait.');
        }

        $this->clientModel->update($client['id_client'], [
            'solde' => $client['solde'] - $montantTotal,
        ]);

        $this->enregistrerHistorique((int) $typeOperation['id_type_operation'], $montant, $frais, (int) $client['id_client']);

        return $this->succes('Retrait effectué avec succès.');
    }

    /**
     * @param array<string, mixed> $client
     * @param array<string, mixed> $typeOperation
     */
    private function transfert(array $client, array $typeOperation, float $montant, float $frais, ?string $numeroDestinataire): array
    {
        $numeroDestinataire = trim((string) $numeroDestinataire);

        if ($numeroDestinataire === '') {
            return $this->echec('Le numéro du destinataire est obligatoire.');
        }

        if ($numeroDestinataire === $client['numero']) {
            return $this->echec('Vous ne pouvez pas effectuer un transfert vers votre propre numéro.');
        }

        $montantTotal = $montant + $frais;

        if ($client['solde'] < $montantTotal) {
            return $this->echec('Solde insuffisant pour effectuer ce transfert.');
        }

        // Pas d'inscription préalable : si le destinataire n'existe pas encore,
        // vérifier au moins que son préfixe est valable avant de créer son compte.
        $destinataire = $this->clientModel->findByNumero($numeroDestinataire);
        if ($destinataire === null) {
            if (! (new PrefixeValidator())->estValide($numeroDestinataire)) {
                return $this->echec('Le numéro du destinataire est invalide.');
            }

            $idDestinataire = $this->clientModel->insert(['numero' => $numeroDestinataire, 'solde' => 0], true);
            $destinataire   = $this->clientModel->find($idDestinataire);
        }

        $this->clientModel->update($client['id_client'], ['solde' => $client['solde'] - $montantTotal]);
        $this->clientModel->update($destinataire['id_client'], ['solde' => $destinataire['solde'] + $montant]);

        $this->enregistrerHistorique(
            (int) $typeOperation['id_type_operation'],
            $montant,
            $frais,
            (int) $client['id_client'],
            $numeroDestinataire
        );

        return $this->succes('Transfert effectué avec succès.');
    }

    private function enregistrerHistorique(
        int $idTypeOperation,
        float $montant,
        float $frais,
        int $idClient,
        ?string $numeroDestinataire = null
    ): void {
        $this->historiqueModel->insert([
            'type_operation_id'   => $idTypeOperation,
            'montant'             => $montant,
            'frais'               => $frais,
            'client_id'           => $idClient,
            'numero_destinataire' => $numeroDestinataire,
        ]);
    }

    /** @return array{success: bool, message: string} */
    private function succes(string $message): array
    {
        return ['success' => true, 'message' => $message];
    }

    /** @return array{success: bool, message: string} */
    private function echec(string $message): array
    {
        return ['success' => false, 'message' => $message];
    }
}
