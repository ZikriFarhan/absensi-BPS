<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

abstract class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var CLIRequest|IncomingRequest
	 */
	protected $request;
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['tanggal_helper'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		$this->helpers = array_merge($this->helpers, ['setting', 'form']);

		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();

		// set username and role to session
		if (auth()->loggedIn()) {
			$this->session = \Config\Services::session();
			$users = model('UserModel');
			$role = (auth()->user()->getGroups()[0]);
			$id = (session()->get()['user']['id']);
			$username = ($users->findById($id)->toArray()['username']);
			$userdata = [
				'username' => $username,
				'role' => $role,
			];

			$this->session->set($userdata);
		} //*
	}

	function log_to_console($data)
	{
		if (is_array($data) || is_object($data)) {
			echo ("<script>console.log('" . json_encode($data) . "');</script>");
		} else {
			echo ("<script>console.log('" . $data . "');</script>");
		}
	}
}
