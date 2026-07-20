<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\OperationService;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Formulaire et traitement des opérations du client : dépôt, retrait, transfert.
 */
class OperationController extends BaseController
{
    /** Types d'opération que le client peut effectuer lui-même. */
    private const TYPES_AUTORISES = ['depot', 'retrait', 'transfert'];

    /**
     * Affiche le formulaire de saisie pour le type d'opération demandé.
     */
    public function form(string $type): string|RedirectResponse
    {
        if (! in_array($type, self::TYPES_AUTORISES, true)) {
            return redirect()->to('/client/dashboard')->with('erreur', "Type d'opération inconnu.");
        }

        return view('client/operation', ['type' => $type]);
    }

    /**
     * Traite le formulaire d'opération : appelle le service métier
     * et affiche le résultat (succès ou échec) au client.
     */
    public function process(string $type): RedirectResponse
    {
        if (! in_array($type, self::TYPES_AUTORISES, true)) {
            return redirect()->to('/client/dashboard')->with('erreur', "Type d'opération inconnu.");
        }

        $montant             = (float) $this->request->getPost('montant');
        $numeroDestinataire  = $this->request->getPost('numero_destinataire');

        $resultat = (new OperationService())->effectuer(
            session()->get('client_id'),
            $type,
            $montant,
            $numeroDestinataire
        );

        if (! $resultat['success']) {
            return redirect()->to('/client/operation/' . $type)
                ->withInput()
                ->with('erreur', $resultat['message']);
        }

        return redirect()->to('/client/dashboard')->with('succes', $resultat['message']);
    }
}
