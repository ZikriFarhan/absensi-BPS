<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KehadiranModel;

class Kehadiran extends BaseController
{
    protected $kehadiranModel;

    public function __construct()
    {
        $this->kehadiranModel = new KehadiranModel();
    }

    public function index()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Data Kehadiran',
            'data' => $this->kehadiranModel->findAll(),
            'isi' => 'kehadiran/index'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function show($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->kehadiranModel->id_exists($id)) {
            $data = [
                'title' => 'Data Kehadiran',
                'data' => $this->kehadiranModel->find($id)
            ];
            echo view('kehadiran/show', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Kehadiran',
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
            'title' => 'Form Tambah Kehadiran'
        ];
        echo view('kehadiran/new', $data);
    }

    public function create()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'nama_kehadiran' => $this->request->getPost('nama_kehadiran')
        ];
        $validate = $this->kehadiranModel->insert($data);
        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan'
            ];
            return redirect()->to('/kehadiran')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->kehadiranModel->errors()
            ];
            return redirect()->to('/kehadiran/new')->with('error', $data['message']);
        }
    }

    public function edit($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->kehadiranModel->id_exists($id)) {
            $data = [
                'title' => 'Form Edit Kehadiran',
                'data' => $this->kehadiranModel->find($id)
            ];
            echo view('kehadiran/edit', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Kehadiran',
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
            'nama_kehadiran' => $this->request->getPost('nama_kehadiran')
        ];
        $validate = $this->kehadiranModel->update($id, $data);
        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil diubah'
            ];
            return redirect()->to('/kehadiran')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->kehadiranModel->errors()
            ];
            return redirect()->to('/kehadiran/edit/' . $id)->with('error', $data['message']);
        }
    }

    public function delete($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->kehadiranModel->id_exists($id)) {
            $this->kehadiranModel->delete($id);
            $data = [
                'status' => 200,
                'message' => 'Data berhasil dihapus'
            ];
            return redirect()->to('/kehadiran')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
        echo json_encode($data);
    }
}
