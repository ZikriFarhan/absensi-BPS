<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Status extends Seeder
{
    public function run()
    {
        $status_data = [
            [
                'nama_status' => 'Masuk',
            ],
            [
                'nama_status' => 'Pulang',
            ],
            [
                'nama_status' => 'Tidak Hadir',
            ],
        ];

        foreach ($status_data as $data) {
            $this->db->table('Status')->insert($data);
        }
    }
}
