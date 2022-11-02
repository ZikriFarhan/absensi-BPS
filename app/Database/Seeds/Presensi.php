<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Presensi extends Seeder
{
    public function run()
    {
        $presensi_data = [
            [
                'id_kehadiran' => 1,
                'id_status' => 1,
                'nim' => '21120119130102',
                'tanggal' => '2021-10-14',
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '16:00:00',
                'keterangan' => 'Hadir',
            ],
            [
                'id_kehadiran' => 1,
                'id_status' => 1,
                'nim' => '21120119140134',
                'tanggal' => '2021-10-14',
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '16:00:00',
                'keterangan' => 'Hadir',
            ],
            [
                'id_kehadiran' => 1,
                'id_status' => 1,
                'nim' => '21120119130109',
                'tanggal' => '2021-10-14',
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '16:00:00',
                'keterangan' => 'Hadir',
            ],
            [
                'id_kehadiran' => 1,
                'id_status' => 1,
                'nim' => '21120119130104',
                'tanggal' => '2021-10-14',
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '16:00:00',
                'keterangan' => 'Hadir',
            ],
        ];
        foreach ($presensi_data as $data) {
            $this->db->table('presensi')->insert($data);
        }
    }
}
