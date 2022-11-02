<?php

namespace App\Controllers;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


class Ambilqr extends BaseController
{
	public function index()
	{
		$data=[
			'title' => 'Ambil_qr',
			'isi'	=> 'ambil_qr/ambil_qr',
		];
		echo view('layout_admin/v_wrapper',$data);
	}

	public function qr_generator()
	{
        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create('BPSJateng')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(100)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
   
        // Create generic logo
        $logo = Logo::create( FCPATH .'/logo.png')
            ->setResizeToWidth(150);
   
        // Create generic label
        $label = Label::create('')
            ->setTextColor(new Color(255, 0, 0));
   
        $result = $writer->write($qrCode, null, $label);
        
        $dataUri = $result->getDataUri();
        // Save it to a file
        // $result->saveToFile( FCPATH.'/qrcode.png');
        echo '<img src="'.$dataUri.'" alt="Sobatcoding.com">';
        $result->saveToFile( FCPATH .'qr/qrcode.png');

     

	}
}