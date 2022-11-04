<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StatusModel;

class Status extends BaseController
{
    protected $statusModel;

    public function __construct()
    {
        $this->statusModel = new StatusModel();
    }

    public function index()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Data Status',
            'status' => $this->statusModel->findAll()
        ];
        echo view('status/index', $data);
    }

    public function show($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->statusModel->id_exists($id)) {
            $data = [
                'title' => 'Data Status',
                'data' => $this->statusModel->find($id)
            ];
            echo view('status/show', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Status',
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
            'title' => 'Form Tambah Status'
        ];
        echo view('status/new', $data);
    }

    public function create()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'nama_status' => $this->request->getPost('nama_status')
        ];
        $validate = $this->statusModel->insert($data);
        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan'
            ];
            return redirect()->to('/status')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->statusModel->errors()
            ];
            return redirect()->to('/status/new')->with('error', $data['message']);
        }
    }

    public function edit($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->statusModel->id_exists($id)) {
            $data = [
                'title' => 'Form Edit Status',
                'data' => $this->statusModel->find($id)
            ];
            echo view('status/edit', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Status',
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
            'nama_status' => $this->request->getPost('nama_status')
        ];
        $validate = $this->statusModel->update($id, $data);
        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil diubah'
            ];
            return redirect()->to('/status')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->statusModel->errors()
            ];
            return redirect()->to('/status/edit/' . $id)->with('error', $data['message']);
        }
    }

    public function delete($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->statusModel->id_exists($id)) {
            $this->statusModel->delete($id);
            $data = [
                'status' => 200,
                'message' => 'Data berhasil dihapus'
            ];
            return redirect()->to('/status')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }
}
