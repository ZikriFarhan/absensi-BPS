<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bidang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_bidang'];

    // Validation
    protected $validationRules      = [
        'nama_bidang' => 'required',
    ];
    protected $validationMessages   = [
        'nama_bidang' => [
            'required' => 'Nama Bidang harus diisi'
        ]
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

    function getKeyword($keyword)
    {
        $builder = $this->table('bidang');
        $builder->select('*');
        $builder->Like('nama_bidang', $keyword);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
