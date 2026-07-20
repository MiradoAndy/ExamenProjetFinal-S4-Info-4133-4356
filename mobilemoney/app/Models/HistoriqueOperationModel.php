<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriqueOperationModel extends Model
{
    protected $table      = 'historique_operation';
    protected $primaryKey = 'id_operation';
    protected $allowedFields = ['type_operation_id', 'montant', 'frais', 'client_id', 'date', 'numero_destinataire'];
    protected $useTimestamps = false;

    public function getTotalGains()
    {
        $result = $this->db->query("
            SELECT SUM(frais) as total
            FROM historique_operation
            WHERE type_operation_id IN (
                SELECT id_type_operation FROM type_operation WHERE libelle IN ('retrait', 'transfert')
            )
        ")->getRow();

        return $result->total ?? 0;
    }

    public function getGainsParType()
    {
        return $this->db->query("
            SELECT t.libelle, COUNT(*) as nb_operations, SUM(h.frais) as total_frais
            FROM historique_operation h
            JOIN type_operation t ON h.type_operation_id = t.id_type_operation
            WHERE t.libelle IN ('retrait', 'transfert')
            GROUP BY h.type_operation_id, t.libelle
        ")->getResultArray();
    }

    public function getHistoriqueGains()
    {
        return $this->db->query("
            SELECT h.id_operation, h.montant, h.frais, h.date, h.numero_destinataire,
                   t.libelle, c.numero
            FROM historique_operation h
            JOIN type_operation t ON h.type_operation_id = t.id_type_operation
            JOIN client c ON h.client_id = c.id_client
            WHERE t.libelle IN ('retrait', 'transfert')
            ORDER BY h.date DESC
        ")->getResultArray();
    }

    public function getOperationsClient($clientId)
    {
        return $this->db->query("
            SELECT h.*, t.libelle
            FROM historique_operation h
            JOIN type_operation t ON h.type_operation_id = t.id_type_operation
            WHERE h.client_id = ?
            ORDER BY h.date DESC
        ", [$clientId])->getResultArray();
    }
}
