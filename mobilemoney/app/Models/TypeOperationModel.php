<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeOperationModel extends Model
{
    protected $table         = 'type_operation';
    protected $primaryKey    = 'id_type_operation';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['libelle'];

    public function findByLibelle(string $libelle): ?array
    {
        return $this->where('libelle', $libelle)->first();
    }
}
