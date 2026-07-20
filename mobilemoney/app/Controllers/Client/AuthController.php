<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\PrefixeValidator;
use App\Models\ClientModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Gère le login "automatique" du client par son numéro de téléphone.
 *
 * Il n'y a pas d'inscription préalable : si le numéro a un préfixe valable
 * de l'opérateur, un compte est créé automatiquement lors de la première connexion.
 */
class AuthController extends BaseController
{
    /**
     * Affiche le formulaire de login.
     */
    public function showLogin(): string|RedirectResponse
    {
        if (session()->get('client_id') !== null) {
            return redirect()->to('/client/dashboard');
        }

        return view('client/login');
    }

    /**
     * Vérifie le numéro fourni et connecte (ou crée) le client correspondant.
     */
    public function login(): RedirectResponse
    {
        $numero = trim((string) $this->request->getPost('numero'));

        if (! (new PrefixeValidator())->estValide($numero)) {
            return redirect()->back()
                ->withInput()
                ->with('erreur', "Numéro invalide : le préfixe n'est pas reconnu par l'opérateur.");
        }

        $clientModel = new ClientModel();
        $client      = $clientModel->findByNumero($numero);

        // Pas d'inscription préalable : le compte est créé automatiquement
        // dès la première connexion avec un solde de départ à 0.
        if ($client === null) {
            $idClient = $clientModel->insert(['numero' => $numero, 'solde' => 0], true);
            $client   = $clientModel->find($idClient);
        }

        session()->set([
            'client_id'     => $client['id_client'],
            'client_numero' => $client['numero'],
        ]);

        return redirect()->to('/client/dashboard');
    }

    /**
     * Déconnecte le client et détruit sa session.
     */
    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
