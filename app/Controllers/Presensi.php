<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\PesertaMagangModel;
use App\Models\StatusModel;
use App\Models\KehadiranModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
            try {
                session()->setFlashdata('konfirmasi', 'Anda yakin menghapus bidang ini?');
                $delete = $this->presensiModel->delete($id);
                if ($delete) {
                    $data = [
                        'status' => 200,
                        'message' => 'Data berhasil dihapus'
                    ];
                    return redirect()->to('/presensi')->with('success', $data['message']);
                } else {
                    throw new \Exception();
                }
            } catch (\Exception $e) {
                $data = [
                    'status' => 500,
                    'message' => 'Data tidak dapat dihapus karena sedang digunakan'
                ];
                return redirect()->to('/presensi')->with('error', $data['message']);
            }
        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }

    public function tutupAbsen()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Form Tutup Presensi',
            'isi' => 'presensi/tutuppresensi'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function rekappresensi_harian()
    {
        $scanModel = model('ScanModel');
        $date = $this->request->getPost('tanggal');
        $peserta = $this->pesertaModel->findAll();
        $nim = [];
        foreach ($peserta as $p) {
            $nim[] = $p['nim'];
        }
        if (date('D') != 'Sun' && date('D') != 'Sat') {
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
                        $this->presensiModel->update($id_presensi, $data) ? $this->log_to_console('Berhasil') : $this->log_to_console('Gagal');
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
                    $this->presensiModel->insert($data) ? $this->log_to_console('Berhasil') : $this->log_to_console('Gagal');
                }
            }
            return redirect()->to('/presensi')->with('success', 'Rekap Presensi Harian Berhasil');
        } else {
            return redirect()->to('/presensi')->with('error', 'Rekap Presensi Harian Gagal, sekarang hari libur');
        }
    }

    public function rekap()
    {
        if (!auth()->user()->inGroup('admin')) {
            return redirect()->to('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $data = [
            'title' => 'Rekap Data Presensi',
            'isi' => 'presensi/rekap',
            'peserta' => $this->pesertaModel->findAll(),
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function export_excel()
    {
        $getByName = $this->request->getPost('getByName');
        if ($getByName == '1') {
            $nim = $this->request->getPost('nim');
            $data = $this->presensiModel->getByNim($nim);
        } else {
            $data = $this->presensiModel->getAll();
        }


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // mengatur alignment dan border
        $styleColumn = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        // 
        $borderArray = [
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ]
        ];
        $sheet->getStyle('A1')->getFont()->setBold(true);

        $sheet->getStyle('A3')->applyFromArray($styleColumn);
        $sheet->getStyle('B3')->applyFromArray($styleColumn);
        $sheet->getStyle('C3')->applyFromArray($styleColumn);
        $sheet->getStyle('D3')->applyFromArray($styleColumn);
        $sheet->getStyle('E3')->applyFromArray($styleColumn);
        $sheet->getStyle('F3')->applyFromArray($styleColumn);
        $sheet->getStyle('G3')->applyFromArray($styleColumn);
        $sheet->getStyle('H3')->applyFromArray($styleColumn);


        $sheet->getStyle('A3')->applyFromArray($borderArray);
        $sheet->getStyle('B3')->applyFromArray($borderArray);
        $sheet->getStyle('C3')->applyFromArray($borderArray);
        $sheet->getStyle('D3')->applyFromArray($borderArray);
        $sheet->getStyle('E3')->applyFromArray($borderArray);
        $sheet->getStyle('F3')->applyFromArray($borderArray);
        $sheet->getStyle('G3')->applyFromArray($borderArray);
        $sheet->getStyle('H3')->applyFromArray($borderArray);


        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', "Rekap Absensi PKL")
            ->mergeCells('A1:D1')
            ->setCellValue('A3', "No")
            ->setCellValue('B3', "Nama")
            ->setCellValue('C3', "Tanggal")
            ->setCellValue('D3', "Jam Masuk")
            ->setCellValue('E3', "Jam Keluar")
            ->setCellValue('F3', "Kehadiran")
            ->setCellValue('G3', "Keterangan");
            ->setCellValue('H3', "Status");


        $column = 4;
        // tulis data mobil ke cell
        $i = 1;
        foreach ($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $i++)
                ->setCellValue('B' . $column, $data['nama'])
                ->setCellValue('C' . $column, $data['tanggal'])
                ->setCellValue('D' . $column, $data['jam_masuk'])
                ->setCellValue('E' . $column, $data['jam_keluar'])
                ->setCellValue('F' . $column, $data['nama_kehadiran'])
                ->setCellValue('G' . $column, $data['keterangan'])
                ->setCellValue('H' . $column, $data['nama_status']);

            $sheet->getStyle('A' . $column)->applyFromArray($borderArray);
            $sheet->getStyle('B' . $column)->applyFromArray($borderArray);
            $sheet->getStyle('C' . $column)->applyFromArray($borderArray);
            $sheet->getStyle('D' . $column)->applyFromArray($borderArray);
            $sheet->getStyle('E' . $column)->applyFromArray($borderArray);
            $sheet->getStyle('F' . $column)->applyFromArray($borderArray);
            $sheet->getStyle('G' . $column)->applyFromArray($borderArray);
            $sheet->getStyle('H' . $column)->applyFromArray($borderArray);


            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

            $column++;
        }

            $column = $column + 2;
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('F' . $column, "Mengetahui,");
            $sheet->mergeCells('F' . $column. ':G' .   $column);
            $sheet->getStyle('F' . $column. ':G' .   $column)->getAlignment()->setHorizontal('center');

            $column = $column + 1;
            $sheet->setCellValue('F' . $column, "Kepala Kepegawaian");
            $sheet->mergeCells('F' . $column. ':G' .   $column);
            $sheet->getStyle('F' . $column. ':G' .   $column)->getAlignment()->setHorizontal('center');

            $column = $column + 5;
            $sheet->setCellValue('F' . $column, "M.Sobirin");
            $sheet->mergeCells('F' . $column. ':G' .   $column);
            $sheet->getStyle('F' . $column. ':G' .   $column)->getAlignment()->setHorizontal('center');

            $column = $column + 1;
            $sheet->setCellValue('F' . $column, "NIP.");
            $sheet->mergeCells('F' . $column. ':G' .   $column);
            $sheet->getStyle('F' . $column. ':G' .   $column)->getAlignment()->setHorizontal('center');

        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap PKL BPS Jateng';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('php://output');
        die;
    }
}