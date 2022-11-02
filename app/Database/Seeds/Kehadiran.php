<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kehadiran extends Seeder
{
    public function run()
    {
        $kehadiran_data = [
            [
                'nama_kehadiran' => 'Hadir',
            ],
            [
                'nama_kehadiran' => 'Sakit',
            ],
            [
                'nama_kehadiran' => 'Ijin',
            ],
            [
                'nama_kehadiran' => 'Absen',
            ],
        ];

        foreach ($kehadiran_data as $data) {
            $this->db->table('Kehadiran')->insert($data);
        }
    }
}
