<?php

namespace App\Controllers;

use App\Models\PrefixeModel;

class PrefixeController extends BaseController
{
    protected $prefixeModel;

    public function __construct()
    {
        $this->prefixeModel = new PrefixeModel();
    }

    public function index()
    {
        $data['prefixes'] = $this->prefixeModel->findAll();
        return view('operateur/prefixe/index', $data);
    }

    public function create()
    {
        return view('operateur/prefixe/form', ['prefixe' => null]);
    }

    public function store()
    {
        $valeur = trim($this->request->getPost('valeur'));

        if (empty($valeur)) {
            return redirect()->back()->with('error', 'Le préfixe ne peut pas être vide.');
        }

        $existe = $this->prefixeModel->where('valeur', $valeur)->first();
        if ($existe) {
            return redirect()->back()->with('error', 'Ce préfixe existe déjà.');
        }

        $this->prefixeModel->insert(['valeur' => $valeur]);
        return redirect()->to('/operateur/prefixes')->with('success', 'Préfixe ajouté avec succès.');
    }

    public function edit($id)
    {
        $data['prefixe'] = $this->prefixeModel->find($id);
        if (!$data['prefixe']) {
            return redirect()->to('/operateur/prefixes')->with('error', 'Préfixe introuvable.');
        }
        return view('operateur/prefixe/form', $data);
    }

    public function update($id)
    {
        $valeur = trim($this->request->getPost('valeur'));

        if (empty($valeur)) {
            return redirect()->back()->with('error', 'Le préfixe ne peut pas être vide.');
        }

        $this->prefixeModel->update($id, ['valeur' => $valeur]);
        return redirect()->to('/operateur/prefixes')->with('success', 'Préfixe modifié avec succès.');
    }

    public function delete($id)
    {
        $this->prefixeModel->delete($id);
        return redirect()->to('/operateur/prefixes')->with('success', 'Préfixe supprimé.');
    }
}
