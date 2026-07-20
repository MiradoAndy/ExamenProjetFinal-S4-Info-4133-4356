<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\HistoriqueOperationModel;

class SituationController extends BaseController
{
    protected HistoriqueOperationModel $historiqueModel;
    protected ClientModel $clientModel;

    public function __construct()
    {
        $this->historiqueModel = new HistoriqueOperationModel();
        $this->clientModel     = new ClientModel();
    }

    public function gain(): string
    {
        return view('operateur/situation/gain', [
            'total_gains'       => $this->historiqueModel->getTotalGains(),
            'total_commissions' => $this->historiqueModel->getTotalCommissions(),
            'gains_par_type'    => $this->historiqueModel->getGainsParType(),
            'historique_gains'  => $this->historiqueModel->getHistoriqueGains(),
        ]);
    }

    public function comptes(): string
    {
        $clients = $this->clientModel->findAll();

        foreach ($clients as &$client) {
            $client['operations'] = $this->historiqueModel->getOperationsClient((int) $client['id_client']);
        }

        return view('operateur/situation/comptes', ['clients' => $clients]);
    }

    public function operateurs(): string
    {
        return view('operateur/situation/operateurs', [
            'montants_par_operateur' => $this->historiqueModel->getMontantsParOperateur(),
        ]);
    }
}
