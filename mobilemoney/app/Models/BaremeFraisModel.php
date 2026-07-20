<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modèle de la table `bareme_frais`.
 *
 * Contient les tranches de montant et le frais correspondant pour
 * chaque type d'opération (retrait, transfert).
 */
class BaremeFraisModel extends Model
{
    protected $table         = 'bareme_frais';
    protected $primaryKey    = 'id_bareme_frais';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['type_operation_id', 'montant_min', 'montant_max', 'frais'];

    /**
     * Retourne le frais correspondant à un montant, pour un type d'opération donné,
     * en se basant sur les tranches définies dans le barème.
     *
     * Retourne null si aucune tranche ne correspond au montant (montant hors barème).
     */
    public function getFrais(int $typeOperationId, float $montant): ?float
    {
        $bareme = $this->where('type_operation_id', $typeOperationId)
            ->where('montant_min <=', $montant)
            ->where('montant_max >=', $montant)
            ->first();

        return $bareme !== null ? (float) $bareme['frais'] : null;
    }

    public function getAllAvecType(): array
    {
        return $this->db->query("
            SELECT b.*, t.libelle
            FROM bareme_frais b
            JOIN type_operation t ON b.type_operation_id = t.id_type_operation
            ORDER BY t.libelle, b.montant_min ASC
        ")->getResultArray();
    }
}
