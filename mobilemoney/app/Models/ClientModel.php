<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table         = 'client';
    protected $primaryKey    = 'id_client';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['numero', 'solde'];

    public function getByNumero(string $numero): ?array
    {
        return $this->where('numero', $numero)->first();
    }

    // Alias utilisé côté client
    public function findByNumero(string $numero): ?array
    {
        return $this->getByNumero($numero);
    }

    public function getSolde(int $idClient): ?float
    {
        $client = $this->find($idClient);
        return $client !== null ? (float) $client['solde'] : null;
    }
}
