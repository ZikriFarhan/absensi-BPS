<?php

namespace App\Controllers;

class Auth extends BaseController
{
	public function index()
	{
		echo view('auth/login');
	}

	public function register()
	{
		echo view('auth/register');
	}

}