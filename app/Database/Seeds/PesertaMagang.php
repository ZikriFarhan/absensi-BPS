<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PesertaMagang extends Seeder
{
    public function run()
    {
        $magang_data = [
            [
                'id_bidang'         => '1',
                'id_universitas'    => '1',
                'nama'              => 'Muhammad Firmansyah',
                'nim'               => '21120119130102',
            ],
            [
                'id_bidang'         => '1',
                'id_universitas'    => '1',
                'nama'              => 'Muhammad Dzikrullah Farhan',
                'nim'               => '21120119140134',
            ],
            [
                'id_bidang'         => '1',
                'id_universitas'    => '1',
                'nama'              => 'Akmal Irfan Maulana',
                'nim'               => '21120119130109',
            ],
            [
                'id_bidang'         => '1',
                'id_universitas'    => '1',
                'nama'              => 'Benediktus Gilang Widhiatmoko',
                'nim'               => '21120119130104',
            ],

        ];

        foreach ($magang_data as $data) {
            $this->db->table('pesertamagang')->insert($data);
        }
    }
}
