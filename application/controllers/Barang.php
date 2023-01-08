<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';
class Barang extends BaseController {

	protected $menu = 'barang';

	public function __construct()
	{
		parent::__construct();
		$this->setActiveMenu($this->menu);

		//load model
		$this->load->model('ModelBarang');
	}

	public function index()
	{
		$allBarang = $this->ModelBarang->getAll();

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
			$harga = $this->currencyToInt(@$post['harga']);
			$params = [
				'kode' => @$post['kode'],
				'nama' => @$post['nama'],
				'harga' => $harga,
				'status' => $status
			];

			if ($this->ModelBarang->create($params)) {
				$this->session->set_flashdata('success', 'Barang berhasil disimpan.');
				redirect('barang/index');
			} else {
				echo 'error';
			}
		}

		$this->render('barang/create');
	}

	public function read($id) 
	{
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
				$this->session->set_flashdata('success', 'Update barang berhasil.');
				redirect('barang/index');
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
			if ($this->ModelBarang->delete($id)) {
				$this->session->set_flashdata('success', 'Hapus barang berhasil.');
			} else {
				$this->session->set_flashdata('danger', 'Gagal hapus barang.');
			}
		}
		redirect ('barang/index');
	}

	public function updateStatus()
	{
		$post = $this->input->post();
		if ($post != null) {
			$params = [
				'id' => @$post['id'],
				'status'=> @$post['status']
			];
			if ($this->ModelBarang->update($params)) {
				$this->session->set_flashdata('success', 'Update status berhasil.');
			}
		}
		redirect('barang/index');
	}

	public function getHargaBarang()
	{
		$data = [];

		$post = $this->input->post();
		if (!$post) {
			return data;
		}
		$id_barang = $post['id_barang'];

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
