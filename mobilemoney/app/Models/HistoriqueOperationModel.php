<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriqueOperationModel extends Model
{
    protected $table         = 'historique_operation';
    protected $primaryKey    = 'id_operation';
    protected $returnType    = 'array';
    protected $allowedFields = ['type_operation_id', 'montant', 'frais', 'frais_commission', 'client_id', 'numero_destinataire'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'date';
    protected $updatedField  = '';

    public function getHistoriqueParClient(int $idClient): array
    {
        return $this->select('historique_operation.*, type_operation.libelle AS type_libelle')
            ->join('type_operation', 'type_operation.id_type_operation = historique_operation.type_operation_id')
            ->where('historique_operation.client_id', $idClient)
            ->orderBy('historique_operation.date', 'DESC')
            ->findAll();
    }

    // ---------------------------------------------------------------
    // Côté opérateur : gains barème (notre revenu propre)
    // ---------------------------------------------------------------

    public function getTotalGains(): float
    {
        $result = $this->db->query("
            SELECT SUM(frais) as total
            FROM historique_operation
            WHERE type_operation_id IN (
                SELECT id_type_operation FROM type_operation WHERE libelle IN ('retrait', 'transfert')
            )
        ")->getRow();

        return (float) ($result->total ?? 0);
    }

    public function getTotalCommissions(): float
    {
        $result = $this->db->query("
            SELECT SUM(frais_commission) as total
            FROM historique_operation
        ")->getRow();

        return (float) ($result->total ?? 0);
    }

    public function getGainsParType(): array
    {
        return $this->db->query("
            SELECT t.libelle,
                   COUNT(*) as nb_operations,
                   SUM(h.frais) as total_frais,
                   SUM(h.frais_commission) as total_commission
            FROM historique_operation h
            JOIN type_operation t ON h.type_operation_id = t.id_type_operation
            WHERE t.libelle IN ('retrait', 'transfert')
            GROUP BY h.type_operation_id, t.libelle
        ")->getResultArray();
    }

    public function getHistoriqueGains(): array
    {
        return $this->db->query("
            SELECT h.id_operation, h.montant, h.frais, h.frais_commission, h.date,
                   h.numero_destinataire, t.libelle, c.numero
            FROM historique_operation h
            JOIN type_operation t ON h.type_operation_id = t.id_type_operation
            JOIN client c ON h.client_id = c.id_client
            WHERE t.libelle IN ('retrait', 'transfert')
            ORDER BY h.date DESC
        ")->getResultArray();
    }

    // ---------------------------------------------------------------
    // Côté opérateur : montants à envoyer aux autres opérateurs
    // ---------------------------------------------------------------

    public function getMontantsParOperateur(): array
    {
        return $this->db->query("
            SELECT p.valeur,
                   p.pourcentage_commission,
                   COUNT(*) as nb_transferts,
                   SUM(h.montant) as total_montant,
                   SUM(h.frais_commission) as total_commission,
                   SUM(h.montant + h.frais_commission) as total_a_envoyer
            FROM historique_operation h
            JOIN prefixe p ON substr(h.numero_destinataire, 1, 3) = p.valeur
            WHERE p.est_externe = 1
            GROUP BY p.id_prefixe, p.valeur, p.pourcentage_commission
            ORDER BY total_a_envoyer DESC
        ")->getResultArray();
    }

    // ---------------------------------------------------------------
    // Côté opérateur : comptes clients
    // ---------------------------------------------------------------

    public function getOperationsClient(int $clientId): array
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
