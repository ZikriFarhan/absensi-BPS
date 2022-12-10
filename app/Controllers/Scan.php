<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ScanModel;

class Scan extends BaseController
{
    public function __construct()
    {
        $this->scanModel = new ScanModel();
        if (date('D') != 'Sun' && date('D') != 'Sat') {
            $this->absensi_harian();
        } else {
            $this->log_to_console('Hari ini adalah hari libur');
        }
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

        $jam_masuk = ['start' => '06:30:00', 'end' => '08:00:00'];
        $jam_pulang = ['start' => '16:00:00', 'end' => '17:30:00'];

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
                    if ($cek_kehadiran == true) {
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

    private function absensi_harian()
    {
        $pesertaModel = model('PesertaMagangModel');
        $scanModel = model('ScanModel');
        $presensiModel = model('PresensiModel');
        $date = date('Y-m-d');
        $jam = date('H:i:s');
        $peserta = $pesertaModel->findAll();
        $nim = [];
        foreach ($peserta as $p) {
            $nim[] = $p['nim'];
        }
        if ($jam >= '17:30:00' && $jam <= '23:59:59') {
            $this->log_to_console('Pada Tanggal: ' . $date);
            foreach ($nim as $n) {
                $cek_absen = $scanModel->cek_kehadiran($n, $date);
                if ($cek_absen) {
                    if ($cek_absen->jam_keluar == '00:00:00' && $cek_absen->id_status == 1) {
                        $id_presensi = $cek_absen->id;
                        $data = [
                            'id_kehadiran' => 4,
                            'id_status' => 3,
                            'keterangan' => 'Tidak Absen Pulang',
                        ];
                        $presensiModel->update($id_presensi, $data) ? $this->log_to_console('Berhasil') : $this->log_to_console('Gagal');
                        $this->log_to_console('NIM : ' . $n . ' | Status : Belum Absen Keluar');
                    } else {
                        $this->log_to_console('NIM : ' . $n . ' | Status : Sudah Absen');
                    }
                } else {
                    $data = [
                        'id_kehadiran' => 4,
                        'id_status' => 3,
                        'nim' => $n,
                        'tanggal' => $date,
                        'jam_masuk' => '00:00:00',
                        'jam_keluar' => '00:00:00',
                        'keterangan' => 'Tidak Ada Keterangan',
                    ];
                    $presensiModel->insert($data) ? $this->log_to_console('Berhasil') : $this->log_to_console('Gagal');
                    $this->log_to_console('NIM : ' . $n . ' | Status : Belum Absen');
                }
            }
        } else {
            $this->log_to_console('Belum Waktu Tutup Presensi');
        }
    }
}
