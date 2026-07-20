<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPrefixeAddExterne extends Migration
{
    public function up()
    {
        $this->forge->addColumn('prefixe', [
            'est_externe' => [
                'type'    => 'INTEGER',
                'default' => 0,
            ],
            'pourcentage_commission' => [
                'type'    => 'REAL',
                'default' => 0,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('prefixe', 'est_externe');
        $this->forge->dropColumn('prefixe', 'pourcentage_commission');
    }
}
