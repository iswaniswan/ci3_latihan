<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

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
		$this->load->model('ModelSupplier');

		$allSupplier = $this->ModelSupplier->getAll();

		$this->load->view('supplier/index', [
			'allSupplier' => $allSupplier
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
			
			$this->load->model('ModelSupplier');
			if ($this->ModelSupplier->create($params)) {
				redirect('supplier/index');
			} else {
				echo 'error';
			}
		}

		$this->load->view('supplier/create');
	}

	public function read($id) 
	{
		$this->load->model('ModelSupplier');
		$data = $this->ModelSupplier->read($id);

		$this->load->view('supplier/read', [
			'data' => $data
		]);
	}

	public function update($id=null)
	{
		$this->load->model('ModelSupplier');

		// action  post submit
		$post = $this->input->post();
		if ($post != null) {
			$params = [
				'id' => @$post['id'],
				'kode' => @$post['kode'],
				'nama' => @$post['nama']
			];
						
			if ($this->ModelSupplier->update($params)) {
				redirect('supplier/index');
			} else {
				echo 'error';
			}
		}	

		$data = $this->ModelSupplier->read($id);

		$this->load->view('supplier/update', [
			'data' => $data
		]);
	}

	public function delete($id)
	{
		if ($id != null) {
			$this->load->model('ModelSupplier');
			if ($this->ModelSupplier->delete($id)) {
				redirect ('supplier/index');
			} else {
				echo 'Error';
			}
		}		
	}
}
