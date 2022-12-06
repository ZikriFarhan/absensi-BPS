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

        $jam_masuk = ['start' => '06:30:00', 'end' => '09:00:00'];
        $jam_pulang = ['start' => '15:30:00', 'end' => '18:00:00'];

        $jam_absen = [
            'jam_masuk' => $jam >= $jam_masuk['start'] && $jam <= $jam_masuk['end'] ? true : false,
            'jam_pulang' => $jam >= $jam_pulang['start'] && $jam <= $jam_pulang['end'] ? true : false,
        ];

        if ($cek_peserta) {
            $cek_kehadiran = $this->scanModel->cek_kehadiran($input_nim, $tgl);
            switch ($jam_absen) {
                case $jam_absen['jam_masuk']:
                    if ($cek_kehadiran == false) {
                        $data = [
                            'id_kehadiran' => 1,
                            'id_status' => 1,
                            'nim' => $input_nim,
                            'tanggal' => $tgl,
                            'jam_masuk' => $jam,
                        ];
                        $this->scanModel->absen_masuk($data);
                        return redirect()->to('/scan')->with('success', 'Absen masuk berhasil');
                    } else {
                        return redirect()->to('/scan')->with('error', 'Anda sudah absen masuk');
                    }
                    break;
                case $jam_absen['jam_pulang']:

                    if ($cek_kehadiran == true && $cek_kehadiran->id_status == 1) {
                        if ($cek_kehadiran->jam_keluar == '00:00:00') {
                            $data = [
                                'id_status' => 2,
                                'jam_keluar' => $jam,
                            ];
                            $this->scanModel->absen_pulang($input_nim, $data);
                            return redirect()->to('/scan')->with('success', 'Absen pulang berhasil');
                        } else {
                            return redirect()->to('/scan')->with('error', 'Anda sudah absen pulang');
                        }
                    } else {
                        return redirect()->to('/scan')->with('error', 'Anda belum absen masuk');
                    }
                    break;
                default:
                    return redirect()->to('/scan')->with('error', 'Bukan Waktu Absen');
                    break;
            }
        } else {
            return redirect()->to('/scan')->with('error', 'NIM Tidak Terdaftar');
        }
    }
}
