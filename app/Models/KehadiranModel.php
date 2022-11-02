<?php

namespace App\Models;

use CodeIgniter\Model;

class KehadiranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kehadiran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_kehadiran'];

    // Validation
    protected $validationRules      = [
        'nama_kehadiran' => 'required',
    ];
    protected $validationMessages   = [
        'nama_kehadiran' => [
            'required' => 'Nama Kehadiran harus diisi'
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
