<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['numero' => '0331234567', 'solde' => 50000],
            ['numero' => '0337654321', 'solde' => 120000],
            ['numero' => '0371111111', 'solde' => 200000],
        ];

        $this->db->table('client')->insertBatch($data);
    }
}
