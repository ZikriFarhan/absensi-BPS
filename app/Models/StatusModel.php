<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'status';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_status'];

    // Validation
    protected $validationRules      = [
        'nama_status' => 'required',
    ];
    protected $validationMessages   = [
        'nama_status' => [
            'required' => 'Nama Status harus diisi'
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
}
