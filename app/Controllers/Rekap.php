<?php

namespace App\Controllers;

class Rekap extends BaseController
{
	public function index()
	{
		$data=[
			'title' => 'Home',
			'isi'	=> 'absensi/rekap_absensi/rekap_absensi',
		];
		echo view('layout_admin/v_wrapper',$data);
	}

}