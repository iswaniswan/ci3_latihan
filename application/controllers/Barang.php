<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';
class Barang extends BaseController {

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

		// $this->load->view('barang/index', [
		// 	'allBarang' => $allBarang
		// ]);
		$this->render('barang/index', [
			'allBarang' => $allBarang
		]);
	}

	public function create()
	{
		$post = $this->input->post();
		if ($post != null) {
			$status = 'false';
			if (@$post['status'] == 'on') {
				$status = true;
			}
			$params = [
				'kode' => @$post['kode'],
				'nama' => @$post['nama'],
				'harga' => @$post['harga'],
				'status' => $status
			];
			
			$this->load->model('ModelBarang');
			if ($this->ModelBarang->create($params)) {
				redirect('barang/index');
			} else {
				echo 'error';
			}
		}

		$this->render('barang/create');
	}

	public function read($id) 
	{
		$this->load->model('ModelBarang');
		$data = $this->ModelBarang->read($id);

		$this->render('barang/read', [
			'data' => $data
		]);
	}

	public function currencyToInt($str='')
	{
		// hapus prefix Rp.
		$str = str_replace("Rp.", "", $str);
		
		// hapus 2 digit dibelakang titik
		$str = str_replace(".00", "", $str);

		// hapus comma
		$str = str_replace(",", "", $str);
		return $str;
	}

	public function update($id=null)
	{
		$this->load->model('ModelBarang');

		// action  post submit
		$post = $this->input->post();
		if ($post != null) {
			// var_dump($post); die();
			$status = 'false';
			if (@$post['status'] == 'on') {
				$status = true;
			}
			$harga = $this->currencyToInt(@$post['harga']);
			$params = [
				'id' => @$post['id'],
				'kode' => @$post['kode'],
				'nama' => @$post['nama'],
				'harga' => $harga,
				'status' => $status
			];
			
			if ($this->ModelBarang->update($params)) {
				redirect('barang/index');
			} else {
				echo 'error';
			}
		}	

		$data = $this->ModelBarang->read($id);

		$this->render('barang/update', [
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

	public function updateStatus()
	{
		$post = $this->input->post();
		if ($post != null) {
			$this->load->model('ModelBarang');
			$params = [
				'id' => @$post['id'],
				'status'=> @$post['status']
			];
			$this->ModelBarang->update($params);
			echo 'success';			
		} else {
			echo 'error';
		}
		
	}

	protected function render($view, $data=[])
	{
		$active = 'barang';
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/menu', [
			'active' => $active
		]);
		$this->load->view($view, $data);
		$this->load->view('layouts/footer');
	}

	public function getHargaBarang()
	{
		$data = [];

		$post = $this->input->post();
		if (!$post) {
			return data;
		}
		$id_barang = $post['id_barang'];

		$this->load->model('ModelBarang');

		$allBarang = $this->ModelBarang->getAll();
		foreach ($allBarang as $barang) {
			$data['id'] = $barang['id'];
			$data['value'] = $barang['harga'];

			if ($id_barang == $data['id']) {				
				echo $barang['harga'];
			}
		}

		return $data;
	}

}
