<?php

namespace App\Controllers;

use App\Models\HistoriqueOperationModel;
use App\Models\ClientModel;

class SituationController extends BaseController
{
    protected $historiqueModel;
    protected $clientModel;

    public function __construct()
    {
        $this->historiqueModel = new HistoriqueOperationModel();
        $this->clientModel     = new ClientModel();
    }

    public function gain()
    {
        $data['total_gains']      = $this->historiqueModel->getTotalGains();
        $data['gains_par_type']   = $this->historiqueModel->getGainsParType();
        $data['historique_gains'] = $this->historiqueModel->getHistoriqueGains();
        return view('operateur/situation/gain', $data);
    }

    public function comptes()
    {
        $clients = $this->clientModel->findAll();

        foreach ($clients as &$client) {
            $client['operations'] = $this->historiqueModel->getOperationsClient($client['id_client']);
        }

        $data['clients'] = $clients;
        return view('operateur/situation/comptes', $data);
    }
}
