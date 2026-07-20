<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modèle de la table `historique_operation`.
 *
 * Chaque ligne représente une opération (dépôt, retrait ou transfert)
 * effectuée par un client.
 */
class HistoriqueOperationModel extends Model
{
    protected $table         = 'historique_operation';
    protected $primaryKey    = 'id_operation';
    protected $returnType    = 'array';
    protected $allowedFields = ['type_operation_id', 'montant', 'frais', 'client_id', 'numero_destinataire'];

    // La colonne `date` n'a pas de valeur par défaut en base : on demande
    // donc au modèle de la remplir automatiquement à chaque insertion.
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'date';
    protected $updatedField  = '';

    /**
     * Retourne l'historique des opérations d'un client, du plus récent au plus ancien,
     * avec le libellé du type d'opération (depot, retrait, transfert).
     *
     * @return list<array<string, mixed>>
     */
    public function getHistoriqueParClient(int $idClient): array
    {
        return $this->select('historique_operation.*, type_operation.libelle AS type_libelle')
            ->join('type_operation', 'type_operation.id_type_operation = historique_operation.type_operation_id')
            ->where('historique_operation.client_id', $idClient)
            ->orderBy('historique_operation.date', 'DESC')
            ->findAll();
    }
}
