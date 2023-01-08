<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
	public function index()
	{
        // echo phpinfo(); 
		$this->login();
	}

	public function login()
	{
		if($this->session->userdata('is_login')) {
			redirect('barang/index');
		}

		$post = $this->input->post();
		if (@$post != null) {
			$this->doLogin($post);
		}

		$this->render('public/login');
	}

	public function register()
	{
		if($this->session->userdata('is_login')) {
			redirect('barang/index');
		}

		$post = $this->input->post();
		if (@$post != null) {
			$this->doRegister($post);
		}

		$this->render('public/register');
	}

	protected function hash_verified($PlainPassword,$HashPassword)
	{
		return password_verify($PlainPassword,$HashPassword) ? true : false;
	}

	private function doLogin($params=[])
	{
		$username = $params['username'];
		$password = $params['password'];

		$this->load->model('ModelUser');
		$userdata = $this->ModelUser->getByUsername($username);

		if($this->hash_verified($password,$userdata[0]['password'])) {
			$this->session->set_userdata($userdata);

			$sessionData = [
				'is_login'=>TRUE,
				'user_id' => $userdata[0]['id']
			];
			$this->session->set_userdata($sessionData);

			$this->session->set_flashdata('success', 'Login berhasil.');
			redirect('barang/index');
		}

		$this->session->set_flashdata('danger', 'Login gagal!');
		redirect('auth/login');
	}

	private function validatePasswordConfirmation($password, $passwordConfirmation)
	{
		return $password == $passwordConfirmation;
	}

	private function doRegister($params=[])
	{
		$isPasswordValid = $this->validatePasswordConfirmation(
				@$params['password'], @$params['password-confirmation']
		);

		if ($isPasswordValid) {
			// check username exist
			if ($this->isUsernamExist($params['username'])) {
				$this->session->set_flashdata('danger', 'User sudah terdaftar');
				redirect('auth/register');
			}

			$this->load->model('ModelUser');
			if ($this->ModelUser->create($params)) {
				$message = 'Registrasi berhasil, silakan login';
				$this->session->set_flashdata('success', $message);
				redirect('auth/login');
			}
		}

		$message = 'Register gagal! cek kembali isian anda.';
		$this->session->set_flashdata('danger', $message);
		redirect('auth/register');
	}

	public function isUsernamExist($username)
	{
		$this->load->model('ModelUser');
		$userdata = $this->ModelUser->getByUsername($username);
		if ($userdata) {
			return true;
		}
		return false;
	}

	protected function render($view, $data=[])
	{
		$this->load->view('layouts/header');
		$this->load->view($view, $data);
		$this->load->view('layouts/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('is_login');
		$this->session->unset_userdata('user_id');

		session_destroy();
		//$this->session->set_flashdata('pesan', 'Sign Out Berhasil!');
		redirect('auth/login');
	}
}
