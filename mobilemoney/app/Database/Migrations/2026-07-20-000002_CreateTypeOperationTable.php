<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTypeOperationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_type_operation' => ['type' => 'INTEGER', 'auto_increment' => true],
            'libelle'           => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
        ]);
        $this->forge->addPrimaryKey('id_type_operation');
        $this->forge->createTable('type_operation');
    }

    public function down()
    {
        $this->forge->dropTable('type_operation');
    }
}
