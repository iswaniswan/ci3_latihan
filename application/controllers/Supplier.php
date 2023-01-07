<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';
class Supplier extends BaseController {

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

		$this->render('supplier/index', [
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

		$this->render('supplier/create');
	}

	public function read($id) 
	{
		$this->load->model('ModelSupplier');
		$data = $this->ModelSupplier->read($id);

		$this->render('supplier/read', [
			'data' => $data
		]);
	}

	public function update($id=null)
	{
		$this->load->model('ModelSupplier');

		// action  post submit
		$post = $this->input->post();
		if ($post != null) {
			$status = 'false';
			if (@$post['status'] == 'on') {
				$status = true;
			}
			$params = [
				'id' => @$post['id'],
				'kode' => @$post['kode'],
				'nama' => @$post['nama'],
				'status' => $status
			];
						
			if ($this->ModelSupplier->update($params)) {
				redirect('supplier/index');
			} else {
				echo 'error';
			}
		}	

		$data = $this->ModelSupplier->read($id);

		$this->render('supplier/update', [
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

	public function updateStatus()
	{
		$post = $this->input->post();
		if ($post != null) {
			$this->load->model('ModelSupplier');
			$params = [
				'id' => @$post['id'],
				'status'=> @$post['status']
			];
			$this->ModelSupplier->update($params);
			echo 'success';			
		} else {
			echo 'error';
		}
		
	}

	protected function render($view, $data=[])
	{
		$active = 'supplier';

		$this->load->view('layouts/header');
		$this->load->view('layouts/menu', [
			'active' => $active
		]);
		$this->load->view($view, $data);
		$this->load->view('layouts/footer');
	}
}
