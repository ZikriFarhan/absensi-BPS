<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Universitas extends Seeder
{
    public function run()
    {
        $univ_data = [
            [
                'nama_universitas' => 'Universitas Diponegoro',
            ],
            [
                'nama_universitas' => 'Politeknik Statistika STIS',
            ],
            [
                'nama_universitas' => 'Universitas Negeri Semarang',
            ],
        ];

        foreach ($univ_data as $data) {
            $this->db->table('Universitas')->insert($data);
        }
    }
}
