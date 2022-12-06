<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaMagangModel;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use Dompdf\Dompdf;

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
            'isi'   => 'kartuabsen/index',
            'data'  => $this->pesertaMagang->findAll()
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function genKartu()
    {
        $input = $this->request->getPost();
        if ($input != null) {
            $data = $this->pesertaMagang->find($input['id_peserta']);
            $title = 'ambil qr';

            $writer = new PngWriter();
            $qrCode = QrCode::create($data['nim']);
            $result = $writer->write($qrCode, null, null);
            $dataUri = $result->getDataUri();
            echo view('kartuabsen/wrapper', ['data' => $data, 'uri' => $dataUri, 'title' => $title]);
        } else {
            return redirect()->to('/kartuabsen')->with('error', 'Data tidak ditemukan');
        }
    }

        public function print_pdf($id)
    {

        $data =  $this->pesertaMagang->find($id);

        $writer = new PngWriter();
        $qrCode = QrCode::create($data['nim']);
        $result = $writer->write($qrCode, null, null);
        $dataUri = $result->getDataUri();
        $data = [
            'title' => 'Ambil QR',
            'isi'   => 'kartuabsen/index',
            'data'  => $data,
            'uri'   => $dataUri,
        ];
        
        $html = view('kartuabsen/kartu', $data);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('B5', 'Portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }


}
