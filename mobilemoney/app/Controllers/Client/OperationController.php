<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\OperationService;
use App\Libraries\PrefixeValidator;
use CodeIgniter\HTTP\RedirectResponse;

class OperationController extends BaseController
{
    private const TYPES_AUTORISES = ['depot', 'retrait', 'transfert'];

    public function form(string $type): string|RedirectResponse
    {
        if (! in_array($type, self::TYPES_AUTORISES, true)) {
            return redirect()->to('/client/dashboard')->with('erreur', "Type d'opération inconnu.");
        }

        return view('client/operation', ['type' => $type]);
    }

    public function process(string $type): RedirectResponse
    {
        if (! in_array($type, self::TYPES_AUTORISES, true)) {
            return redirect()->to('/client/dashboard')->with('erreur', "Type d'opération inconnu.");
        }

        $montant = (float) $this->request->getPost('montant');

        $numerosDestinataires = [];
        $inclusFraisRetrait   = false;

        if ($type === 'transfert') {
            $raw = $this->request->getPost('numero_destinataire');
            $numerosDestinataires = array_values(array_filter(
                array_map('trim', is_array($raw) ? $raw : [$raw ?? ''])
            ));
            $inclusFraisRetrait = (bool) $this->request->getPost('inclure_frais_retrait');
        }

        $resultat = (new OperationService())->effectuer(
            session()->get('client_id'),
            $type,
            $montant,
            $numerosDestinataires,
            $inclusFraisRetrait
        );

        if (! $resultat['success']) {
            return redirect()->to('/client/operation/' . $type)
                ->withInput()
                ->with('erreur', $resultat['message']);
        }

        return redirect()->to('/client/dashboard')->with('succes', $resultat['message']);
    }
}
