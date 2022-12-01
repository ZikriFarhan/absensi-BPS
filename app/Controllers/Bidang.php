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
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Data Bidang',
            'data' => $this->bidangModel->findAll(),
            'isi' => 'bidang/index'
        ];

        echo view('layout_admin/v_wrapper', $data);
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
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Tambah Data Bidang',
            'isi' => 'bidang/new'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function create()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
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
    }

    public function edit($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
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
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
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
    }

    public function delete($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->bidangModel->id_exists($id)) {
            try {
                session()->setFlashdata('konfirmasi', 'Anda yakin menghapus bidang ini?');
                $delete = $this->bidangModel->delete($id);
                if ($delete) {
                    $data = [
                        'status' => 200,
                        'message' => 'Data berhasil dihapus'
                    ];
                    return redirect()->to('/bidang')->with('success', $data['message']);
                } else {
                    throw new \Exception();
                }
            } catch (\Exception $e) {
                $data = [
                    'status' => 500,
                    'message' => 'Data tidak dapat dihapus karena sedang digunakan'
                ];
                return redirect()->to('/bidang')->with('error', $data['message']);
            }
        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }
}
