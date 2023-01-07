<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class BaseController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	protected $menu;

	public function __construct()
	{
		parent::__construct();
		$this->isUserLoggedIn();
	}

	protected function isUserLoggedIn()
	{
		if(!$this->session->userdata('is_login')) {
			redirect('auth/login');
		}
	}

	public function setActiveMenu($menu)
	{
		$this->menu = $menu;
	}

	public function render($viewFile, $data=[])
	{
		$this->load->view('layouts/header');
		$this->load->view('layouts/menu', [
			'active' => $this->menu
		]);
		$this->load->view($viewFile, $data);
		$this->load->view('layouts/footer');
	}
}
