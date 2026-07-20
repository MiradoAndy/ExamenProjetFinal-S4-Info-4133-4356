<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table      = 'client';
    protected $primaryKey = 'id_client';
    protected $allowedFields = ['numero', 'solde'];
    protected $useTimestamps = false;

    public function getByNumero($numero)
    {
        return $this->where('numero', $numero)->first();
    }
}
