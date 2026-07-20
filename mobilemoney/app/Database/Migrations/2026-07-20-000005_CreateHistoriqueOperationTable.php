<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoriqueOperationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_operation'       => ['type' => 'INTEGER', 'auto_increment' => true],
            'type_operation_id'  => ['type' => 'INTEGER'],
            'montant'            => ['type' => 'REAL'],
            'frais'              => ['type' => 'REAL', 'default' => 0],
            'client_id'          => ['type' => 'INTEGER'],
            'date'               => ['type' => 'DATETIME', 'null' => false],
            'numero_destinataire'=> ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id_operation');
        $this->forge->addForeignKey('type_operation_id', 'type_operation', 'id_type_operation');
        $this->forge->addForeignKey('client_id', 'client', 'id_client');
        $this->forge->createTable('historique_operation');
    }

    public function down()
    {
        $this->forge->dropTable('historique_operation');
    }
}
