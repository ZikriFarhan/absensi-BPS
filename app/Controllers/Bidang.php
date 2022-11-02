<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BidangModel;

class Bidang extends BaseController
{
    protected $bidangModel;

    public function __construct()
    {
        $this->bidangModel = new BidangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Bidang',
            'data' => $this->bidangModel->findAll(),
            'isi' => 'bidang/data_bidang'

        ];

        echo view('layout_admin/v_wrapper',$data);

    }

    public function show($id)
    {
        if ($this->bidangModel->id_exists($id)) {
            $data = [
                'title' => 'Data Bidang',
                'data' => $this->bidangModel->find($id),
                'isi' => 'bidang/show'
            ];
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Bidang',
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah Data Bidang',
            'isi' => 'bidang/new'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function create()
    {
        $data = [
            'nama_bidang' => $this->request->getPost('nama_bidang')
        ];

        $validate = $this->bidangModel->insert($data);

        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan'
            ];

            return redirect()->to('/bidang')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->bidangModel->errors()
            ];

            return redirect()->to('/bidang/new')->withInput()->with('error', $data['message']);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        if ($this->bidangModel->id_exists($id)) {
            $data = [
                'title' => 'Edit Data Bidang',
                'data' => $this->bidangModel->find($id),
                'isi' => 'bidang/edit'
            ];
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Bidang',
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }

    public function update($id)
    {
        $data = [
            'nama_bidang' => $this->request->getPost('nama_bidang')
        ];

        $validate = $this->bidangModel->update($id, $data);

        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil diubah'
            ];

            return redirect()->to('/bidang')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->bidangModel->errors()
            ];

            return redirect()->to('/bidang/edit/' . $id)->withInput()->with('error', $data['message']);
        }
        echo json_encode($data);
    }

    public function edit_form()
    {
        $this->update($id);
        $data = [
            'title' => 'Edit Bidang',
            'bidang' => 'bidang/edit_form/edit_form'
        ];
        // echo json_encode($data);
        echo view('bidang/edit_form/index',$data);
    }

    public function delete($id)
    {
        if ($this->bidangModel->id_exists($id)) {
            $this->bidangModel->delete($id);
            $data = [
                'status' => 200,
                'message' => 'Data berhasil dihapus'
            ];

            return redirect()->to('/bidang')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];

            echo view('errors/html/error_404', $data);
        }
    }

    // Tombol Opsi Pada Tabel
    private function _action_admin($id_bidang)
    {
        $link = "
                <a data-toggle='tooltip' data-placement='top' class='btnEdit' title='Edit' value='" . $id_bidang . "'>
	      		    <button type='button' class='btn btn-primary btn-sm data-toggle='modal' data-target='#modalPenarikan'><i class='fa fa-edit'></i></button>
	      	    </a>
                ";
        return $link;
    }
}
