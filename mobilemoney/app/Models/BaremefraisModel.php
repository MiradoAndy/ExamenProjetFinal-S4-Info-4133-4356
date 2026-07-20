<?php

namespace App\Models;

use CodeIgniter\Model;

class BaremefraisModel extends Model
{
    protected $table      = 'bareme_frais';
    protected $primaryKey = 'id_bareme_frais';
    protected $allowedFields = ['type_operation_id', 'montant_min', 'montant_max', 'frais'];
    protected $useTimestamps = false;

    public function getAllAvecType()
    {
        return $this->db->query("
            SELECT b.*, t.libelle
            FROM bareme_frais b
            JOIN type_operation t ON b.type_operation_id = t.id_type_operation
            ORDER BY t.libelle, b.montant_min ASC
        ")->getResultArray();
    }

    public function getFraisPourMontant($typeOperationId, $montant)
    {
        return $this->where('type_operation_id', $typeOperationId)
                    ->where('montant_min <=', $montant)
                    ->where('montant_max >=', $montant)
                    ->first();
    }
}
