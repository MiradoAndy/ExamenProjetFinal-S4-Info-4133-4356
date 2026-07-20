<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_client' => ['type' => 'INTEGER', 'auto_increment' => true],
            'numero'    => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'solde'     => ['type' => 'REAL', 'default' => 0],
        ]);
        $this->forge->addPrimaryKey('id_client');
        $this->forge->createTable('client');
    }

    public function down()
    {
        $this->forge->dropTable('client');
    }
}
