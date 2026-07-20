<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modèle de la table `client`.
 */
class ClientModel extends Model
{
    protected $table         = 'client';
    protected $primaryKey    = 'id_client';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['numero', 'solde'];

    /**
     * Recherche un client à partir de son numéro de téléphone.
     *
     * @return array<string, mixed>|null
     */
    public function findByNumero(string $numero): ?array
    {
        return $this->where('numero', $numero)->first();
    }

    /**
     * Retourne le solde actuel d'un client.
     */
    public function getSolde(int $idClient): ?float
    {
        $client = $this->find($idClient);

        return $client !== null ? (float) $client['solde'] : null;
    }
}
