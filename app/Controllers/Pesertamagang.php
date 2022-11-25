<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaMagangModel;
use App\Models\UniversitasModel;
use App\Models\BidangModel;

class Pesertamagang extends BaseController
{
    protected $magangModel;

    public function __construct()
    {
        $this->magangModel = new PesertaMagangModel();
        $this->universitasModel = new UniversitasModel();
        $this->bidangModel = new BidangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Peserta Magang',
            'isi' => 'peserta/index',
            'data' => $this->magangModel->getAll()
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function show($id)
    {
        if ($this->magangModel->id_exists($id)) {
            $data = [
                'title' => 'Data Peserta Magang',
                'isi' => 'peserta/show',
                'data' => $this->magangModel->getID($id)

            ];
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Peserta Magang',
                'message' => 'Data tidak ditemukan'
            ];
            return redirect()->to('/pesertamagang')->with('error', 'Data tidak ditemukan');
        }
    }

    public function new()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Form Tambah Peserta Magang',
            'univ' => $this->universitasModel->findAll(),
            'bidang' => $this->bidangModel->findAll(),
            'isi'    => 'peserta/new'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function create()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'id_bidang' => $this->request->getPost('id_bidang'),
            'id_universitas' => $this->request->getPost('id_universitas')
        ];
        $validate = $this->magangModel->insert($data);
        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan'
            ];
            return redirect()->to('/pesertamagang')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->magangModel->errors()
            ];
            return redirect()->to('/pesertamagang/new')->withInput()->with('error', $data['message']);
        }
    }

    public function edit($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->magangModel->id_exists($id)) {
            $data = [
                'title' => 'Form Edit Peserta',
                'peserta' => $this->magangModel->getID($id),
                'univ' => $this->universitasModel->findAll(),
                'bidang' => $this->bidangModel->findAll(),
                'isi' => 'peserta/edit'
            ];
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Peserta Magang',
                'message' => 'Data tidak ditemukan'
            ];
            return redirect()->to('/pesertamagang')->with('error', $data['message']);
        }
    }

    public function update($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'id' => $id,
            'id_bidang' => $this->request->getPost('id_bidang'),
            'id_universitas' => $this->request->getPost('id_universitas'),
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim')
        ];
        $validate = $this->magangModel->update($id, $data);
        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil diubah'
            ];
            return redirect()->to('/pesertamagang')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->magangModel->errors()
            ];
            return redirect()->to('/pesertamagang/edit/' . $id)->with('error', $data['message']);
        }
    }

    public function delete($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->magangModel->id_exists($id)) {
            $this->magangModel->delete($id);
            $data = [
                'status' => 200,
                'message' => 'Data berhasil dihapus',
                'isi' => 'PKL/data_pkl'
            ];
            return redirect()->to('/pesertamagang')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }

    public function search()
    {
        $keyword = $this->request->getPost('keyword');
        $data = [
            'data' => $this->magangModel->getKeyword($keyword),
            'isi' => 'peserta/index',
            'title' => 'search',
        ];
        echo view('layout_admin/v_wrapper', $data);
    }
}
