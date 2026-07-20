<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBaremefraisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bareme_frais'   => ['type' => 'INTEGER', 'auto_increment' => true],
            'type_operation_id' => ['type' => 'INTEGER'],
            'montant_min'       => ['type' => 'REAL'],
            'montant_max'       => ['type' => 'REAL'],
            'frais'             => ['type' => 'REAL'],
        ]);
        $this->forge->addPrimaryKey('id_bareme_frais');
        $this->forge->addForeignKey('type_operation_id', 'type_operation', 'id_type_operation');
        $this->forge->createTable('bareme_frais');
    }

    public function down()
    {
        $this->forge->dropTable('bareme_frais');
    }
}
