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
            'prefixes' => $this->prefixeModel->findAll(),
        ]);
    }

    public function create(): string
    {
        return view('operateur/prefixe/form', ['prefixe' => null]);
    }

    public function store()
    {
        $valeur = trim((string) $this->request->getPost('valeur'));

        if ($valeur === '') {
            return redirect()->back()->with('error', 'Le préfixe ne peut pas être vide.');
        }

        if ($this->prefixeModel->where('valeur', $valeur)->first() !== null) {
            return redirect()->back()->with('error', 'Ce préfixe existe déjà.');
        }

        $this->prefixeModel->insert(['valeur' => $valeur]);

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
        $valeur = trim((string) $this->request->getPost('valeur'));

        if ($valeur === '') {
            return redirect()->back()->with('error', 'Le préfixe ne peut pas être vide.');
        }

        $this->prefixeModel->update($id, ['valeur' => $valeur]);

        return redirect()->to('/operateur/prefixes')->with('success', 'Préfixe modifié avec succès.');
    }

    public function delete(int $id)
    {
        $this->prefixeModel->delete($id);

        return redirect()->to('/operateur/prefixes')->with('success', 'Préfixe supprimé.');
    }
}
