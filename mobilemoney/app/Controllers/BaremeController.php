<?php

namespace App\Controllers;

use App\Models\BaremefraisModel;
use App\Models\TypeOperationModel;

class BaremeController extends BaseController
{
    protected $baremeModel;
    protected $typeOperationModel;

    public function __construct()
    {
        $this->baremeModel        = new BaremefraisModel();
        $this->typeOperationModel = new TypeOperationModel();
    }

    public function index()
    {
        $data['baremes']         = $this->baremeModel->getAllAvecType();
        $data['types_operation'] = $this->typeOperationModel->findAll();
        return view('operateur/bareme/index', $data);
    }

    public function create()
    {
        $data['types_operation'] = $this->typeOperationModel->findAll();
        $data['bareme']          = null;
        return view('operateur/bareme/form', $data);
    }

    public function store()
    {
        $data = [
            'type_operation_id' => $this->request->getPost('type_operation_id'),
            'montant_min'       => $this->request->getPost('montant_min'),
            'montant_max'       => $this->request->getPost('montant_max'),
            'frais'             => $this->request->getPost('frais'),
        ];

        if ($data['montant_min'] >= $data['montant_max']) {
            return redirect()->back()->with('error', 'Le montant minimum doit être inférieur au montant maximum.');
        }

        $this->baremeModel->insert($data);
        return redirect()->to('/operateur/baremes')->with('success', 'Barème ajouté avec succès.');
    }

    public function edit($id)
    {
        $data['bareme']          = $this->baremeModel->find($id);
        $data['types_operation'] = $this->typeOperationModel->findAll();

        if (!$data['bareme']) {
            return redirect()->to('/operateur/baremes')->with('error', 'Barème introuvable.');
        }

        return view('operateur/bareme/form', $data);
    }

    public function update($id)
    {
        $data = [
            'type_operation_id' => $this->request->getPost('type_operation_id'),
            'montant_min'       => $this->request->getPost('montant_min'),
            'montant_max'       => $this->request->getPost('montant_max'),
            'frais'             => $this->request->getPost('frais'),
        ];

        if ($data['montant_min'] >= $data['montant_max']) {
            return redirect()->back()->with('error', 'Le montant minimum doit être inférieur au montant maximum.');
        }

        $this->baremeModel->update($id, $data);
        return redirect()->to('/operateur/baremes')->with('success', 'Barème modifié avec succès.');
    }

    public function delete($id)
    {
        $this->baremeModel->delete($id);
        return redirect()->to('/operateur/baremes')->with('success', 'Barème supprimé.');
    }
}
