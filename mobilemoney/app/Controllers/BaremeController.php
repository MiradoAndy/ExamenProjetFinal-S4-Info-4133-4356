<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TypeOperationModel;

class BaremeController extends BaseController
{
    protected BaremeFraisModel $baremeModel;
    protected TypeOperationModel $typeOperationModel;

    public function __construct()
    {
        $this->baremeModel        = new BaremeFraisModel();
        $this->typeOperationModel = new TypeOperationModel();
    }

    public function index(): string
    {
        return view('operateur/bareme/index', [
            'baremes'         => $this->baremeModel->getAllAvecType(),
            'types_operation' => $this->typeOperationModel->findAll(),
        ]);
    }

    public function create(): string
    {
        return view('operateur/bareme/form', [
            'bareme'          => null,
            'types_operation' => $this->typeOperationModel->findAll(),
        ]);
    }

    public function store()
    {
        $montantMin = (float) $this->request->getPost('montant_min');
        $montantMax = (float) $this->request->getPost('montant_max');

        if ($montantMin >= $montantMax) {
            return redirect()->back()->with('error', 'Le montant minimum doit être inférieur au montant maximum.');
        }

        $this->baremeModel->insert([
            'type_operation_id' => (int) $this->request->getPost('type_operation_id'),
            'montant_min'       => $montantMin,
            'montant_max'       => $montantMax,
            'frais'             => (float) $this->request->getPost('frais'),
        ]);

        return redirect()->to('/operateur/baremes')->with('success', 'Barème ajouté avec succès.');
    }

    public function edit(int $id): string
    {
        return view('operateur/bareme/form', [
            'bareme'          => $this->baremeModel->find($id),
            'types_operation' => $this->typeOperationModel->findAll(),
        ]);
    }

    public function update(int $id)
    {
        $montantMin = (float) $this->request->getPost('montant_min');
        $montantMax = (float) $this->request->getPost('montant_max');

        if ($montantMin >= $montantMax) {
            return redirect()->back()->with('error', 'Le montant minimum doit être inférieur au montant maximum.');
        }

        $this->baremeModel->update($id, [
            'type_operation_id' => (int) $this->request->getPost('type_operation_id'),
            'montant_min'       => $montantMin,
            'montant_max'       => $montantMax,
            'frais'             => (float) $this->request->getPost('frais'),
        ]);

        return redirect()->to('/operateur/baremes')->with('success', 'Barème modifié avec succès.');
    }

    public function delete(int $id)
    {
        $this->baremeModel->delete($id);

        return redirect()->to('/operateur/baremes')->with('success', 'Barème supprimé.');
    }
}
