<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model
{
    protected $table         = 'prefixe';
    protected $primaryKey    = 'id_prefixe';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['valeur', 'est_externe', 'pourcentage_commission'];

    public function getPrefixesInternes(): array
    {
        return $this->where('est_externe', 0)->findAll();
    }

    public function getPrefixesExternes(): array
    {
        return $this->where('est_externe', 1)->orderBy('valeur', 'ASC')->findAll();
    }

    public function estExterne(string $numero): bool
    {
        $prefixe = substr(trim($numero), 0, 3);
        return $this->where('valeur', $prefixe)->where('est_externe', 1)->first() !== null;
    }

    public function getCommissionPourNumero(string $numero): float
    {
        $prefixe = substr(trim($numero), 0, 3);
        $row = $this->where('valeur', $prefixe)->where('est_externe', 1)->first();
        return $row !== null ? (float) $row['pourcentage_commission'] : 0.0;
    }
}
