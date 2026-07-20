<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Tableau de bord du client : affiche son solde et ses informations.
 */
class DashboardController extends BaseController
{
    public function index(): string|RedirectResponse
    {
        $clientModel = new ClientModel();
        $client      = $clientModel->find(session()->get('client_id'));

        // Le client a été supprimé, ou la session est invalide : on le déconnecte.
        if ($client === null) {
            session()->destroy();

            return redirect()->to('/login');
        }

        return view('client/dashboard', ['client' => $client]);
    }
}
