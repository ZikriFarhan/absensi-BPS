<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UniversitasModel;

class Universitas extends BaseController
{
    protected $univModel;

    public function __construct()
    {
        $this->univModel = new UniversitasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Universitas',
            'universitas' => $this->univModel->findAll(),
            'isi' => 'universitas/index'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function show($id)
    {
        if ($this->univModel->id_exists($id)) {
            $data = [
                'title' => 'Data Universitas',
                'data' => $this->univModel->find($id),
                'isi' => 'universitas/show'
            ];
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Universitas',
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }

    public function new()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Form Tambah Universitas',
            'isi' => 'universitas/new'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function create()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'nama_universitas' => $this->request->getPost('nama_universitas')
        ];

        $validate = $this->univModel->insert($data);

        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan'
            ];
            return redirect()->to('/universitas')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->univModel->errors()
            ];
            return redirect()->to('/universitas/new')->with('error', $data['message']);
        }
    }

    public function edit($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->univModel->id_exists($id)) {
            $data = [
                'title' => 'Form Edit Universitas',
                'data' => $this->univModel->find($id),
                'isi' => 'universitas/edit'
            ];
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Universitas',
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }

    public function update($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'nama_universitas' => $this->request->getPost('nama_universitas')
        ];

        $validate = $this->univModel->update($id, $data);

        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil diubah'
            ];
            return redirect()->to('/universitas')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->univModel->errors()
            ];
            return redirect()->to('/universitas/edit/' . $id)->with('error', $data['message']);
        }
    }

    public function delete($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->univModel->id_exists($id)) {
            $this->univModel->delete($id);
            $data = [
                'status' => 200,
                'message' => 'Data berhasil dihapus'
            ];
            return redirect()->to('/universitas')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }
}
