<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modèle de la table `type_operation` (depot, retrait, transfert).
 */
class TypeOperationModel extends Model
{
    protected $table         = 'type_operation';
    protected $primaryKey    = 'id_type_operation';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['libelle'];

    /**
     * Recherche un type d'opération à partir de son libellé (depot, retrait, transfert).
     *
     * @return array<string, mixed>|null
     */
    public function findByLibelle(string $libelle): ?array
    {
        return $this->where('libelle', $libelle)->first();
    }
}
