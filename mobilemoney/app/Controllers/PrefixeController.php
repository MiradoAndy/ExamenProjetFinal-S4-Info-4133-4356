<?php

namespace App\Controllers;

use App\Models\PrefixeModel;

class PrefixeController extends BaseController
{
    protected PrefixeModel $prefixeModel;

    public function __construct()
    {
        $this->prefixeModel = new PrefixeModel();
    }

    public function index(): string
    {
        return view('operateur/prefixe/index', [
            'prefixes_internes' => $this->prefixeModel->getPrefixesInternes(),
            'prefixes_externes' => $this->prefixeModel->getPrefixesExternes(),
        ]);
    }

    public function create(): string
    {
        return view('operateur/prefixe/form', ['prefixe' => null]);
    }

    public function store()
    {
        $valeur     = trim((string) $this->request->getPost('valeur'));
        $estExterne = (int) $this->request->getPost('est_externe');
        $commission = $estExterne ? (float) $this->request->getPost('pourcentage_commission') : 0.0;

        if ($valeur === '') {
            return redirect()->back()->with('error', 'Le préfixe ne peut pas être vide.');
        }

        if ($this->prefixeModel->where('valeur', $valeur)->first() !== null) {
            return redirect()->back()->with('error', 'Ce préfixe existe déjà.');
        }

        $this->prefixeModel->insert([
            'valeur'                 => $valeur,
            'est_externe'            => $estExterne,
            'pourcentage_commission' => $commission,
        ]);

        return redirect()->to('/operateur/prefixes')->with('success', 'Préfixe ajouté avec succès.');
    }

    public function edit(int $id): string
    {
        return view('operateur/prefixe/form', [
            'prefixe' => $this->prefixeModel->find($id),
        ]);
    }

    public function update(int $id)
    {
        $valeur     = trim((string) $this->request->getPost('valeur'));
        $estExterne = (int) $this->request->getPost('est_externe');
        $commission = $estExterne ? (float) $this->request->getPost('pourcentage_commission') : 0.0;

        if ($valeur === '') {
            return redirect()->back()->with('error', 'Le préfixe ne peut pas être vide.');
        }

        $this->prefixeModel->update($id, [
            'valeur'                 => $valeur,
            'est_externe'            => $estExterne,
            'pourcentage_commission' => $commission,
        ]);

        return redirect()->to('/operateur/prefixes')->with('success', 'Préfixe modifié avec succès.');
    }

    public function delete(int $id)
    {
        $this->prefixeModel->delete($id);

        return redirect()->to('/operateur/prefixes')->with('success', 'Préfixe supprimé.');
    }
}
