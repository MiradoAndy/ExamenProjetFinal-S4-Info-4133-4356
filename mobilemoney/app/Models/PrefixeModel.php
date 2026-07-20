<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model
{
    protected $table      = 'prefixe';
    protected $primaryKey = 'id_prefixe';
    protected $allowedFields = ['valeur'];
    protected $useTimestamps = false;
}
