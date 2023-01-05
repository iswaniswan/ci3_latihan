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
		
		$allPembelian = $this->ModelPembelian->getAll();

		$this->load->view('pembelian/index', [
			'allPembelian' => $allPembelian
		]);
	}

	public function create()
	{
		$post = $this->input->post();
		if ($post != null) {
			// echo '<pre>'; var_dump($post); echo '</pre>'; die();
			// pembelian header
			$params = [
				'tanggal' => @$post['tanggal'],
				'id_supplier' => @$post['id_supplier'],
				'keterangan' => @$post['keterangan']
			];
			
			$this->load->model('ModelPembelian');
			
			$last_id_inserted = $this->ModelPembelian->create($params);

			if ($last_id_inserted >= 0) {						
				$this->load->model('ModelPembelianDetail');
				// pembelian_detail
				$success = true;
				foreach (@$post['items'] as $item) {
					$data = [
						'id_barang' => $item['id_barang'],
						'harga' => $item['harga'],
						'qty' => $item['qty'],
					];
					
					$data['id_pembelian'] = $last_id_inserted;
					if (!$this->ModelPembelianDetail->create($data)) {					
						$success = false;
					}					// echo '<pre>'; var_dump($params['qty']); echo '</pre>';
				}
				
				if ($success) {
					// return redirect('pembelian/read/'.$last_id_inserted);
					return redirect('pembelian/index');
				} else {
					die ('error pembelian detail');
				}

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
		$this->load->model('ModelPembelianDetail');

		$data = $this->ModelPembelian->getAllWithDetail($id)[0];

		$where = " WHERE id_pembelian=".$data['id'];
		$items = $this->ModelPembelianDetail->get('', '', $where, '', '');

		$allBarang = $this->getAllBarang();

		$this->load->view('pembelian/read', [
			'data' => $data,
			'items' => $items,
			'allBarang' => $allBarang
		]);
	}

	public function update($id=null)
	{
		$this->load->model('ModelPembelian');
		$this->load->model('ModelPembelianDetail');

		// action  post submit
		$post = $this->input->post();
		if ($post != null) {			
			// echo '<pre>'; var_dump($post); echo '</pre>'; die();			
			$params = [
				'id' => @$post['id'],
				'tanggal' => @$post['tanggal'],
				'id_supplier' => @$post['id_supplier'],
				'keterangan' => @$post['keterangan']
			];
						
			if ($this->ModelPembelian->update($params)) {
				$this->load->model('ModelPembelianDetail');
				// delete all item pembelian
				$this->ModelPembelianDetail->deleteBy('id_pembelian', $post['id']);

				// insert new item detail
				foreach (@$post['items'] as $item) {	
					if (intval($item['qty']) <= 0) {
						continue;
					}				
					$data = [
						'id_pembelian' => $post['id'],
						'id_barang' => $item['id_barang'],
						'harga' => $item['harga'],
						'qty' => $item['qty'],
					];
					
					//create pembelian detail
					$this->ModelPembelianDetail->create($data);
					// echo '<pre>'; var_dump($params['qty']); echo '</pre>';
				}
				
				redirect('pembelian/read/'.$post['id']);

			} else {
				echo 'error';
			}
		}

		$data = $this->ModelPembelian->getAllWithDetail($id)[0];

		$where = " WHERE id_pembelian=".$data['id'];
		$items = $this->ModelPembelianDetail->get('', '', $where, '', '');

		$allSupplier = $this->getAllSupplier();
		$allBarang = $this->getAllBarang();

		$this->load->view('pembelian/update', [
			'data' => $data,
			'items' => $items,
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
