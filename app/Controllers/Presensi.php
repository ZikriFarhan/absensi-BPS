<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\PesertaMagangModel;
use App\Models\StatusModel;
use App\Models\KehadiranModel;

class Presensi extends BaseController
{
    protected $presensiModel;
    protected $pesertaModel;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->pesertaModel = new PesertaMagangModel();
        $this->statusModel = new StatusModel();
        $this->kehadiranModel = new KehadiranModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Presensi',
            'data' => $this->presensiModel->getAll(),
            'isi' => 'presensi/index'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function show($id)
    {
        if ($this->presensiModel->id_exists($id)) {
            $data = [
                'title' => 'Data Presensi',
                'data' => $this->presensiModel->getID($id),
                'isi' => 'presensi/show'
            ];
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Presensi',
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
            'title' => 'Form Tambah Presensi',
            'peserta' => $this->pesertaModel->findAll(),
            'status' => $this->statusModel->findAll(),
            'kehadiran' => $this->kehadiranModel->findAll(),
            'isi' => 'presensi/new'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function create()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'id_kehadiran' => $this->request->getPost('id_kehadiran'),
            'nim' => $this->request->getPost('nim'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam_keluar' => '00:00:00',
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        if ($data['id_kehadiran'] == 1) {
            $data['id_status'] = 1;
            $data['jam_masuk'] = $this->request->getPost('jam_masuk');
        } else {
            $data['id_status'] = 3;
            $data['jam_masuk'] = '00:00:00';
        }

        $validate = $this->presensiModel->insert($data);

        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan'
            ];

            return redirect()->to('/presensi')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->presensiModel->errors()
            ];

            return redirect()->to('/presensi/new')->withInput()->with('error', $data['message']);
        }
    }

    public function edit($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->presensiModel->id_exists($id)) {
            $data = [
                'title' => 'Form Edit Presensi',
                'data' => $this->presensiModel->getID($id),
                'peserta' => $this->pesertaModel->findAll(),
                'status' => $this->statusModel->findAll(),
                'kehadiran' => $this->kehadiranModel->findAll(),
                'isi' => 'presensi/edit'
            ];
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Presensi',
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
            'id_kehadiran' => $this->request->getPost('id_kehadiran'),
            'nim' => $this->request->getPost('nim'),
            'tanggal' => $this->request->getPost('tanggal'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        if ($data['id_kehadiran'] == 1) {
            $data['id_status'] = $this->request->getPost('id_status');
            $data['jam_masuk'] = $this->request->getPost('jam_masuk');
            $data['jam_keluar'] = $this->request->getPost('jam_keluar');
        } else {
            $data['id_status'] = 3;
            $data['jam_masuk'] = '00:00:00';
            $data['jam_keluar'] = '00:00:00';
        }

        $validate = $this->presensiModel->update($id, $data);

        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil diubah'
            ];

            return redirect()->to('/presensi')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->presensiModel->errors()
            ];

            return redirect()->to('/presensi/edit/' . $id)->withInput()->with('error', $data['message']);
        }
    }

    public function delete($id)
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        if ($this->presensiModel->id_exists($id)) {
            $this->presensiModel->delete($id);
            $data = [
                'status' => 200,
                'message' => 'Data berhasil dihapus'
            ];
            return redirect()->to('/presensi')->with('succes', $data['message']);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }
}
