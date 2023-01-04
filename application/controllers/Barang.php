<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

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
		$this->load->model('ModelBarang');

		$allBarang = $this->ModelBarang->getAll();

		$this->load->view('barang/index', [
			'allBarang' => $allBarang
		]);
	}

	public function create()
	{
		$post = $this->input->post();
		if ($post != null) {
			$params = [
				'kode' => @$post['kode'],
				'nama' => @$post['nama']
			];
			
			$this->load->model('ModelBarang');
			if ($this->ModelBarang->create($params)) {
				redirect('barang/index');
			} else {
				echo 'error';
			}
		}

		$this->load->view('barang/create');
	}

	public function read($id) 
	{
		$this->load->model('ModelBarang');
		$data = $this->ModelBarang->read($id);

		$this->load->view('barang/read', [
			'data' => $data
		]);
	}

	public function update($id=null)
	{
		$this->load->model('ModelBarang');

		// action  post submit
		$post = $this->input->post();
		if ($post != null) {
			$params = [
				'id' => @$post['id'],
				'kode' => @$post['kode'],
				'nama' => @$post['nama']
			];
						
			if ($this->ModelBarang->update($params)) {
				redirect('barang/index');
			} else {
				echo 'error';
			}
		}	

		$data = $this->ModelBarang->read($id);

		$this->load->view('barang/update', [
			'data' => $data
		]);
	}

	public function delete($id)
	{
		if ($id != null) {
			$this->load->model('ModelBarang');
			if ($this->ModelBarang->delete($id)) {
				redirect ('barang/index');
			} else {
				echo 'Error';
			}
		}		
	}


}