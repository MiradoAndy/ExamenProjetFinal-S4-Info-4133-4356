<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterHistoriqueAddFraisCommission extends Migration
{
    public function up()
    {
        $this->forge->addColumn('historique_operation', [
            'frais_commission' => [
                'type'    => 'REAL',
                'default' => 0,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('historique_operation', 'frais_commission');
    }
}
