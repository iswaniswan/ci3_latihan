<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

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
		$this->load->model('ModelPembelian');
		
		$allPembelian = $this->ModelPembelian->getAllWithDetail();

		$this->load->view('pembelian/index', [
			'allPembelian' => $allPembelian
		]);
	}

	public function create()
	{
		$post = $this->input->post();
		if ($post != null) {
			$params = [
				'tanggal' => @$post['tanggal'],
				'id_supplier' => @$post['id_supplier'],
				'id_barang' => @$post['id_barang'],
				'harga' => @$post['harga'],
				'qty' => @$post['qty'],
				'keterangan' => @$post['keterangan']
			];
			
			$this->load->model('ModelPembelian');
			
			$last_id_inserted = $this->ModelPembelian->create($params);

			if ($last_id_inserted >= 0) {				
				//insert into pembelian_detail
				$this->load->model('ModelPembelianDetail');
				$params['id_pembelian'] = $last_id_inserted;
				if ($this->ModelPembelianDetail->create($params)) {
					redirect('pembelian/index');
				}				
				echo 'error Pembelian detail';
			} else {
				echo 'error Pembelian';
			}
		}

		$allSupplier = $this->getAllSupplier();
		$allBarang = $this->getAllBarang();

		$this->load->view('pembelian/create', [
			'allSupplier' => $allSupplier,
			'allBarang' => $allBarang
		]);
	}

	private function getAllSupplier()
	{
		$this->load->model('ModelSupplier');
		$allSupplier = $this->ModelSupplier->getAll();
		return $allSupplier;
	}

	private function getAllBarang()
	{
		$this->load->model('ModelBarang');
		$allBarang = $this->ModelBarang->getAll();
		return $allBarang;
	}

	public function read($id) 
	{
		$this->load->model('ModelPembelian');

		$data = $this->ModelPembelian->getAllWithDetail($id)[0];

		$this->load->view('pembelian/read', [
			'data' => $data,
		]);
	}

	public function update($id=null)
	{
		$this->load->model('ModelPembelian');

		// action  post submit
		$post = $this->input->post();
		if ($post != null) {
//			var_dump($post); die();
			$params = [
				'id' => @$post['id'],
				'tanggal' => @$post['tanggal'],
				'id_supplier' => @$post['id_supplier'],
				'id_barang' => @$post['id_barang'],
				'harga' => @$post['harga'],
				'qty' => @$post['qty'],
				'keterangan' => @$post['keterangan']
			];
						
			if ($this->ModelPembelian->update($params)) {
				$this->load->model('ModelPembelianDetail');
				$params['id_pembelian'] = @$post['id'];
				if ($this->ModelPembelianDetail->update($params)) {
					redirect('pembelian/index');
				}
				echo 'error Pembelian detail';
			} else {
				echo 'error';
			}
		}

		$data = $this->ModelPembelian->getAllWithDetail($id)[0];

		$allSupplier = $this->getAllSupplier();
		$allBarang = $this->getAllBarang();

		$this->load->view('pembelian/update', [
			'data' => $data,
			'allSupplier' => $allSupplier,
			'allBarang' => $allBarang
		]);
	}

	public function delete($id)
	{
		if ($id != null) {
			$this->load->model('ModelPembelian');
			if ($this->ModelPembelian->delete($id)) {
				// delete pembelian detail
				$this->load->model('ModelPembelianDetail');
				$this->ModelPembelianDetail->deleteBy('id_pembelian', $id);
				redirect ('pembelian/index');
			} else {
				echo 'Error';
			}
		}		
	}

}
