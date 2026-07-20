<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['valeur' => '033'],
            ['valeur' => '037'],
        ];

        $this->db->table('prefixe')->insertBatch($data);
    }
}
