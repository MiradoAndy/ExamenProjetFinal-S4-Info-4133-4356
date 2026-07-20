<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modèle de la table `prefixe` (préfixes valables de l'opérateur, ex: 033, 037).
 */
class PrefixeModel extends Model
{
    protected $table         = 'prefixe';
    protected $primaryKey    = 'id_prefixe';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['valeur'];
}
