<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaMagangModel;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;

class Kartuabsen extends BaseController
{

    public function __construct()
    {
        $this->pesertaMagang = new PesertaMagangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Ambil QR',
            'isi'   => 'kartuabsen/index'
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function genKartu()
    {
        $input = $this->request->getPost();
        if ($input != null) {
            $data = $this->pesertaMagang->find($input['id_peserta']);
            $writer = new PngWriter();
            $qrCode = QrCode::create($data['nim']);
            $result = $writer->write($qrCode, null, null);
            $dataUri = $result->getDataUri();
            echo view('kartuabsen/wrapper', ['data' => $data, 'uri' => $dataUri]);
        } else {
            return redirect()->to('/kartuabsen')->with('error', 'Data tidak ditemukan');
        }
    }

    public function getPeserta()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $peserta = $this->pesertaMagang->like('nama', $keyword)->findAll();
        } else {
            $peserta = $this->pesertaMagang->findAll();
        }
        $query = $peserta;
        return json_encode($query);
    }
}
