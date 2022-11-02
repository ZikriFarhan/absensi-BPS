<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('Bidang');
        $this->call('Universitas');
        $this->call('PesertaMagang');
        $this->call('Status');
        $this->call('Kehadiran');
        $this->call('Presensi');
    }
}
