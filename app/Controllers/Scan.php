<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ScanModel;

class Scan extends BaseController
{
    public function __construct()
    {
        $this->scanModel = new ScanModel();
        helper('form');
    }

    public function index()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Scan QR',
            'isi'    => 'scan_qr/scan',
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function absen()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $input_nim = $this->request->getPost('qrcode');
        $tgl = date('Y-m-d');
        $jam = date('H:i:s');
        $cek_peserta = $this->scanModel->cek_peserta($input_nim);

        if ($cek_peserta) {
            $cek_kehadiran = $this->scanModel->cek_kehadiran($input_nim, $tgl);
            if ($cek_kehadiran) {
                if ($cek_kehadiran->jam_keluar == '00:00:00') {
                    $data = [
                        'id_status' => 2,
                        'jam_keluar' => $jam
                    ];
                    $this->scanModel->absen_pulang($input_nim, $data);
                    session()->setFlashdata('pesan', 'Absen Pulang Berhasil');
                    session()->setFlashdata('success', 'Absen Pulang Berhasil');
                    return redirect()->to(base_url('scan'));
                } else {
                    session()->setFlashdata('pesan', 'Anda Sudah Absen Pulang');
                    session()->setFlashdata('success', 'Anda sudah Absen Pulang');
                    return redirect()->to(base_url('scan'));
                }
            } else {
                $data = [
                    'id_kehadiran' => 1,
                    'id_status' => 1,
                    'nim' => $input_nim,
                    'tanggal' => $tgl,
                    'jam_masuk' => $jam
                ];
                $this->scanModel->absen_masuk($data);
                session()->setFlashdata('pesan', 'Absen Masuk Berhasil');
                session()->setFlashdata('success', 'Absen Masuk Berhasil');
                return redirect()->to(base_url('scan'));
            }
        } else {
            session()->setFlashdata('pesan', 'NIM Tidak Terdaftar');
            session()->setFlashdata('error', 'NIM Tidak Terdaftar');
            return redirect()->to(base_url('scan'));
        }
    }
}
