<?php

namespace App\Models;

use CodeIgniter\Model;

class UniversitasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'universitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_universitas'];

    // Validation
    protected $validationRules  = [
        'nama_universitas' => 'required',
    ];
    protected $validationMessages = [
        'nama_universitas' => [
            'required' => 'Nama Universitas harus diisi'
        ]
    ];

    function id_exists($id)
    {
        $query = $this->where('id', $id)->first();
        if (empty($query)) {
            return false;
        } else {
            return true;
        }
    }
}
