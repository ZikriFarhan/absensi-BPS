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
        'id_kehadiran'  => 'required',
        'id_status'     => 'required',
        'nim'           => 'required',
        'tanggal'       => 'required',
        'jam_masuk'     => 'required',
    ];

    protected $validationMessages   = [
        'id_kehadiran'  => [
            'required' => 'Kehadiran harus diisi'
        ],
        'id_status'     => [
            'required' => 'Status harus diisi'
        ],
        'nim'           => [
            'required' => 'Nama harus diisi'
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

    function getByNim($nim)
    {
        $builder = $this->table('presensi');
        $builder->select('presensi.*, kehadiran.nama_kehadiran, status.nama_status, pesertamagang.nama');
        $builder->join('kehadiran', 'kehadiran.id = presensi.id_kehadiran', 'inner');
        $builder->join('status', 'status.id = presensi.id_status', 'inner');
        $builder->join('pesertamagang', 'pesertamagang.nim = presensi.nim', 'inner');
        $builder->where('presensi.nim', $nim);
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

    function getKeyword($keyword)
    {
        $builder = $this->table('presensi');
        $builder->select('presensi.*, kehadiran.nama_kehadiran, status.nama_status, pesertamagang.nama');
        $builder->join('kehadiran', 'kehadiran.id = presensi.id_kehadiran', 'inner');
        $builder->join('status', 'status.id = presensi.id_status', 'inner');
        $builder->join('pesertamagang', 'pesertamagang.nim = presensi.nim', 'inner');
        $builder->like('nama', $keyword);
        $builder->orLike('tanggal', $keyword);
        $builder->orLike('jam_masuk', $keyword);
        $builder->orLike('jam_keluar', $keyword);
        $builder->orLike('keterangan', $keyword);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
