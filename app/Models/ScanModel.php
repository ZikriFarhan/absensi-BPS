<?php

namespace App\Models;

use CodeIgniter\Model;

class ScanModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function cek_peserta($nim)
    {
        $query = $this->db->query("SELECT * FROM pesertamagang WHERE nim = '$nim'");
        if ($query->getNumRows() > 0) {
            return $query->getRow();
        } else {
            return false;
        }
    }

    public function cek_kehadiran($nim, $tgl)
    {
        $query = $this->db->query("SELECT * FROM presensi WHERE nim = '$nim' AND tanggal = '$tgl'");
        if ($query->getNumRows() > 0) {
            return $query->getRow();
        } else {
            return false;
        }
    }

    public function absen_masuk($data)
    {
        $query = $this->db->table('presensi')->insert($data);
        return $query;
    }

    public function absen_pulang($nim, $data)
    {
        $query = $this->db->table('presensi')->update($data, array('nim' => $nim));
        return $query;
    }
}
