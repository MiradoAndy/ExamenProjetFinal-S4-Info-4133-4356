<?php

namespace App\Libraries;

use App\Models\BaremeFraisModel;
use App\Models\ClientModel;
use App\Models\HistoriqueOperationModel;
use App\Models\PrefixeModel;
use App\Models\TypeOperationModel;

class OperationService
{
    protected ClientModel $clientModel;
    protected TypeOperationModel $typeOperationModel;
    protected BaremeFraisModel $baremeFraisModel;
    protected HistoriqueOperationModel $historiqueModel;
    protected PrefixeModel $prefixeModel;

    public function __construct(
        ?ClientModel $clientModel = null,
        ?TypeOperationModel $typeOperationModel = null,
        ?BaremeFraisModel $baremeFraisModel = null,
        ?HistoriqueOperationModel $historiqueModel = null,
        ?PrefixeModel $prefixeModel = null
    ) {
        $this->clientModel        = $clientModel ?? new ClientModel();
        $this->typeOperationModel = $typeOperationModel ?? new TypeOperationModel();
        $this->baremeFraisModel   = $baremeFraisModel ?? new BaremeFraisModel();
        $this->historiqueModel    = $historiqueModel ?? new HistoriqueOperationModel();
        $this->prefixeModel       = $prefixeModel ?? new PrefixeModel();
    }

    /**
     * @param array<string> $numerosDestinataires
     * @return array{success: bool, message: string}
     */
    public function effectuer(
        int $idClient,
        string $libelleOperation,
        float $montant,
        array $numerosDestinataires = [],
        bool $inclusFraisRetrait = false
    ): array {
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

        if ($libelleOperation === 'depot') {
            return $this->depot($client, $typeOperation, $montant);
        }

        if ($libelleOperation === 'retrait') {
            $frais = $this->baremeFraisModel->getFrais((int) $typeOperation['id_type_operation'], $montant);
            if ($frais === null) {
                return $this->echec('Aucun barème de frais ne correspond à ce montant.');
            }
            return $this->retrait($client, $typeOperation, $montant, $frais);
        }

        if ($libelleOperation === 'transfert') {
            return $this->transfert($client, $typeOperation, $montant, $numerosDestinataires, $inclusFraisRetrait);
        }

        return $this->echec("Type d'opération non supporté.");
    }

    /** @param array<string, mixed> $client */
    private function depot(array $client, array $typeOperation, float $montant): array
    {
        $this->clientModel->update($client['id_client'], [
            'solde' => $client['solde'] + $montant,
        ]);

        $this->enregistrerHistorique((int) $typeOperation['id_type_operation'], $montant, 0, 0, (int) $client['id_client']);

        return $this->succes('Dépôt effectué avec succès.');
    }

    /** @param array<string, mixed> $client */
    private function retrait(array $client, array $typeOperation, float $montant, float $frais): array
    {
        $montantTotal = $montant + $frais;

        if ($client['solde'] < $montantTotal) {
            return $this->echec('Solde insuffisant pour effectuer ce retrait.');
        }

        $this->clientModel->update($client['id_client'], [
            'solde' => $client['solde'] - $montantTotal,
        ]);

        $this->enregistrerHistorique((int) $typeOperation['id_type_operation'], $montant, $frais, 0, (int) $client['id_client']);

        return $this->succes('Retrait effectué avec succès.');
    }

    /** @param array<string, mixed> $client */
    private function transfert(
        array $client,
        array $typeOperation,
        float $montant,
        array $numerosDestinataires,
        bool $inclusFraisRetrait
    ): array {
        $numerosDestinataires = array_values(array_filter(array_map('trim', $numerosDestinataires)));

        if (empty($numerosDestinataires)) {
            return $this->echec('Le numéro du destinataire est obligatoire.');
        }

        $nbDest         = count($numerosDestinataires);
        $montantParDest = $montant / $nbDest;
        $typeRetrait    = $this->typeOperationModel->findByLibelle('retrait');

        // 1. Pré-calcul et validation de chaque destinataire
        $operations = [];
        $totalDebit = 0.0;

        foreach ($numerosDestinataires as $numero) {
            if ($numero === $client['numero']) {
                return $this->echec('Vous ne pouvez pas effectuer un transfert vers votre propre numéro.');
            }

            $fraisTransfert = $this->baremeFraisModel->getFrais((int) $typeOperation['id_type_operation'], $montantParDest);
            if ($fraisTransfert === null) {
                return $this->echec('Aucun barème de frais ne correspond au montant de ' . number_format($montantParDest, 0, ',', ' ') . ' Ar.');
            }

            $estExterne      = $this->prefixeModel->estExterne($numero);
            $fraisCommission = 0.0;
            $destinataire    = null;

            if ($estExterne) {
                $pct             = $this->prefixeModel->getCommissionPourNumero($numero);
                $fraisCommission = $montantParDest * $pct / 100;
            } else {
                $destinataire = $this->clientModel->findByNumero($numero);
                if ($destinataire === null) {
                    return $this->echec("Le numéro $numero n'existe pas dans notre réseau.");
                }
            }

            $fraisRetrait = 0.0;
            if ($inclusFraisRetrait && $typeRetrait !== null) {
                $fr           = $this->baremeFraisModel->getFrais((int) $typeRetrait['id_type_operation'], $montantParDest);
                $fraisRetrait = $fr ?? 0.0;
            }

            $totalDebit += $montantParDest + $fraisTransfert + $fraisCommission + $fraisRetrait;

            $operations[] = [
                'numero'           => $numero,
                'montant'          => $montantParDest,
                'frais'            => $fraisTransfert,
                'frais_commission' => $fraisCommission,
                'frais_retrait'    => $fraisRetrait,
                'estExterne'       => $estExterne,
                'destinataire'     => $destinataire,
            ];
        }

        // 2. Vérification du solde global
        if ($client['solde'] < $totalDebit) {
            return $this->echec('Solde insuffisant pour effectuer ce transfert.');
        }

        // 3. Application des changements
        $this->clientModel->update($client['id_client'], [
            'solde' => $client['solde'] - $totalDebit,
        ]);

        foreach ($operations as $op) {
            if (!$op['estExterne'] && $op['destinataire'] !== null) {
                $montantRecu    = $op['montant'] + $op['frais_retrait'];
                $pctEpargne     = (float) ($op['destinataire']['pourcentage_epargne'] ?? 0);
                $partEpargne    = round($montantRecu * $pctEpargne / 100);
                $partSolde      = $montantRecu - $partEpargne;

                $this->clientModel->update($op['destinataire']['id_client'], [
                    'solde'         => (float) $op['destinataire']['solde'] + $partSolde,
                    'solde_epargne' => (float) ($op['destinataire']['solde_epargne'] ?? 0) + $partEpargne,
                ]);
            }

            $this->enregistrerHistorique(
                (int) $typeOperation['id_type_operation'],
                $op['montant'],
                $op['frais'],
                $op['frais_commission'],
                (int) $client['id_client'],
                $op['numero']
            );
        }

        $msg = $nbDest > 1
            ? "Transfert effectué vers $nbDest destinataires."
            : 'Transfert effectué avec succès.';

        return $this->succes($msg);
    }

    private function enregistrerHistorique(
        int $idTypeOperation,
        float $montant,
        float $frais,
        float $fraisCommission,
        int $idClient,
        ?string $numeroDestinataire = null
    ): void {
        $this->historiqueModel->insert([
            'type_operation_id'   => $idTypeOperation,
            'montant'             => $montant,
            'frais'               => $frais,
            'frais_commission'    => $fraisCommission,
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
