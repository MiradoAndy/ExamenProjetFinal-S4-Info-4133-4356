<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class EpargneController extends BaseController
{
    public function index(): string
    {
        $clientModel = new ClientModel();
        $client      = $clientModel->find(session()->get('client_id'));

        return view('client/epargne', ['client' => $client]);
    }

    public function valider()
    {
        $pct = (int) $this->request->getPost('pourcentage_epargne');
        $pct = max(0, min(100, $pct));

        $clientModel = new ClientModel();
        $clientModel->update(session()->get('client_id'), [
            'pourcentage_epargne' => $pct,
        ]);

        return redirect()->to('/client/epargne')->with('succes', "Taux d'épargne mis à jour : $pct %.");
    }
}
