<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'presensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_kehadiran', 'id_status', 'nim', 'tanggal', 'jam_masuk', 'jam_keluar', 'keterangan'];

    // Validation
    protected $validationRules      = [
        'id_kehadiran'  => 'required|is_not_unique[kehadiran.id]',
        'id_status'     => 'required|is_not_unique[status.id]',
        'nim'           => 'required|is_not_unique[pesertamagang.nim]',
        'tanggal'       => 'required',
        'jam_masuk'     => 'required',
    ];

    protected $validationMessages   = [
        'id_kehadiran'  => [
            'required' => 'id_kehadiran harus diisi',
            'is_not_unique' => 'Kehadiran harus diisi'
        ],
        'id_status'     => [
            'required' => 'id_status harus diisi',
            'is_not_unique' => 'Status harus diisi'
        ],
        'nim'           => [
            'required' => 'NIM harus diisi',
            'is_not_unique' => 'Nama harus diisi'
        ],
        'tanggal'       => [
            'required' => 'Tanggal harus diisi'
        ],
        'jam_masuk'     => [
            'required' => 'Jam masuk harus diisi'
        ],
    ];

    function id_exists($id)
    {
        $query = $this->where('id', $id)->first();
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function getAll()
    {
        $builder = $this->table('presensi');
        $builder->select('presensi.*, kehadiran.nama_kehadiran, status.nama_status, pesertamagang.nama');
        $builder->join('kehadiran', 'kehadiran.id = presensi.id_kehadiran', 'inner');
        $builder->join('status', 'status.id = presensi.id_status', 'inner');
        $builder->join('pesertamagang', 'pesertamagang.nim = presensi.nim', 'inner');
        $builder->orderBy('tanggal', 'ASC');
        $builder->orderBy('jam_masuk', 'ASC');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    function getID($id)
    {
        $builder = $this->table('presensi');
        $builder->select('presensi.*, kehadiran.nama_kehadiran, status.nama_status, pesertamagang.nama');
        $builder->join('kehadiran', 'kehadiran.id = presensi.id_kehadiran', 'inner');
        $builder->join('status', 'status.id = presensi.id_status', 'inner');
        $builder->join('pesertamagang', 'pesertamagang.nim = presensi.nim', 'inner');
        $builder->where('presensi.id', $id);
        $query = $builder->get()->getRowArray();
        return $query;
    }
}
