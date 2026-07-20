<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\HistoriqueOperationModel;

/**
 * Affiche l'historique des opérations du client connecté.
 */
class HistoriqueController extends BaseController
{
    public function index(): string
    {
        $historiqueModel = new HistoriqueOperationModel();
        $historique       = $historiqueModel->getHistoriqueParClient(session()->get('client_id'));

        return view('client/historique', ['historique' => $historique]);
    }
}
