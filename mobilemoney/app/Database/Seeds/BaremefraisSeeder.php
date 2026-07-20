<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaremefraisSeeder extends Seeder
{
    public function run()
    {
        // id_type_operation: 2 = retrait, 3 = transfert
        $tranches = [
            ['montant_min' => 100,     'montant_max' => 1000,    'frais' => 50],
            ['montant_min' => 1001,    'montant_max' => 5000,    'frais' => 50],
            ['montant_min' => 5001,    'montant_max' => 10000,   'frais' => 100],
            ['montant_min' => 10001,   'montant_max' => 25000,   'frais' => 200],
            ['montant_min' => 25001,   'montant_max' => 50000,   'frais' => 400],
            ['montant_min' => 50001,   'montant_max' => 100000,  'frais' => 800],
            ['montant_min' => 100001,  'montant_max' => 250000,  'frais' => 1500],
            ['montant_min' => 250001,  'montant_max' => 500000,  'frais' => 1500],
            ['montant_min' => 500001,  'montant_max' => 1000000, 'frais' => 2500],
            ['montant_min' => 1000001, 'montant_max' => 2000000, 'frais' => 3000],
        ];

        $data = [];
        foreach ([2, 3] as $typeId) {
            foreach ($tranches as $tranche) {
                $data[] = array_merge(['type_operation_id' => $typeId], $tranche);
            }
        }

        $this->db->table('bareme_frais')->insertBatch($data);
    }
}
