<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrefixeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_prefixe' => ['type' => 'INTEGER', 'auto_increment' => true],
            'valeur'     => ['type' => 'VARCHAR', 'constraint' => 10, 'unique' => true],
        ]);
        $this->forge->addPrimaryKey('id_prefixe');
        $this->forge->createTable('prefixe');
    }

    public function down()
    {
        $this->forge->dropTable('prefixe');
    }
}
