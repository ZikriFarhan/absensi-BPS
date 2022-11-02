<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data=[
			'title' => 'Home',
			'isi'	=> 'v_home',
		];
		echo view('layout_admin/v_wrapper',$data);
	}

	public function guest()
	{
		$data=[
			'title' => 'Home',
			'isi'	=> 'v_home',
		];
		echo view('layout/v_wrapper',$data);
	}

	public function data_pkl()
	{
		$data=[
			'title' => 'PKL',
			'isi'	=> 'pkl/data_pkl',
		];
		echo view('layout/v_wrapper',$data);
	}
}