<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Bidang extends Seeder
{
    public function run()
    {
        $bidang_data = [
            [
                'nama_bidang' => 'IPDS',
            ],
            [
                'nama_bidang' => 'Kepegawaian',
            ],
            [
                'nama_bidang' => 'Bagian Umum',
            ],
        ];

        foreach ($bidang_data as $data) {
            $this->db->table('Bidang')->insert($data);
        }
    }
}
