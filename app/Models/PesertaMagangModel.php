<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaMagangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pesertamagang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_bidang', 'id_universitas', 'nama', 'nim'];

    // Validation
    protected $validationRules      = [
        'id_bidang'     => 'required|numeric',
        'id_universitas' => 'required|numeric',
        'nama'          => 'required',
        'nim'           => 'required|is_unique[pesertamagang.nim,id,{id}]',
    ];
    protected $validationMessages   = [
        'id_bidang'     => [
            'required' => 'Bidang harus diisi',
            'numeric' => 'Bidang harus diisi'
        ],
        'id_universitas' => [
            'required' => 'Universitas harus diisi',
            'numeric' => 'Universitas harus diisi'
        ],
        'nama'          => [
            'required' => 'Nama harus diisi',
            'is_unique' => 'Nama sudah terdaftar'
        ],
        'nim'           => [
            'required' => 'NIM harus diisi',
            'is_unique' => 'NIM sudah terdaftar'
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
        $builder = $this->table('pesertamagang');
        $builder->select('pesertamagang.*, bidang.nama_bidang, universitas.nama_universitas');
        $builder->join('bidang', 'bidang.id = pesertamagang.id_bidang', 'inner');
        $builder->join('universitas', 'universitas.id = pesertamagang.id_universitas', 'inner');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    function getKeyword($keyword)
    {
        $builder = $this->table('pesertamagang');
        $builder->select('pesertamagang.*, bidang.nama_bidang, universitas.nama_universitas, nim');
        $builder->join('bidang', 'bidang.id = pesertamagang.id_bidang', 'inner');
        $builder->join('universitas', 'universitas.id = pesertamagang.id_universitas', 'inner');
        $builder->like('nim', $keyword);
        $builder->orLike('nama', $keyword);
        $builder->orLike('bidang.nama_bidang', $keyword);
        $builder->orLike('universitas.nama_universitas', $keyword);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    function getID($id)
    {
        $builder = $this->table('pesertamagang');
        $builder->select('pesertamagang.*, bidang.nama_bidang, universitas.nama_universitas');
        $builder->where('pesertamagang.id', $id);
        $builder->join('bidang', 'bidang.id = pesertamagang.id_bidang', 'inner');
        $builder->join('universitas', 'universitas.id = pesertamagang.id_universitas', 'inner');
        $query = $builder->get()->getRowArray();
        return $query;
    }
}
