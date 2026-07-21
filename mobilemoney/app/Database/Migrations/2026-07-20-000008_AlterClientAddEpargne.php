<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterClientAddEpargne extends Migration
{
    public function up()
    {
        // Ignoré si les colonnes existent déjà (DB créée depuis la migration 003 mise à jour)
        try {
            $this->forge->addColumn('client', [
                'pourcentage_epargne' => ['type' => 'INTEGER', 'default' => 0],
                'solde_epargne'       => ['type' => 'REAL',    'default' => 0],
            ]);
        } catch (\Throwable $e) {
            // Colonnes déjà présentes
        }
    }

    public function down()
    {
        try {
            $this->forge->dropColumn('client', 'pourcentage_epargne');
            $this->forge->dropColumn('client', 'solde_epargne');
        } catch (\Throwable $e) {
            // Colonnes inexistantes
        }
    }
}
