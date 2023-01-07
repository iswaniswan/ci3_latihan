<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';
class Supplier extends BaseController {

	protected $menu = 'supplier';

	public function __construct()
	{
		parent::__construct();
		$this->setActiveMenu($this->menu);

		//load model
		$this->load->model('ModelSupplier');
	}

	public function index()
	{
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
		$data = $this->ModelSupplier->read($id);

		$this->render('supplier/read', [
			'data' => $data
		]);
	}

	public function update($id=null)
	{
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

}
