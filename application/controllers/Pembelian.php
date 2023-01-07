<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';
class Pembelian extends BaseController {

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
		
		$allPembelian = [];
		$query = $this->ModelPembelian->getAll();
		foreach ($query as $result) {
			$canUpdateStatus = $this->canUpdateStatus($result);
			$result['canUpdateStatus'] = $canUpdateStatus;
			$allPembelian[] = $result;
		}

		$this->render('pembelian/index', [
			'allPembelian' => $allPembelian
		]);
	}

	private function canUpdateStatus($params)
	{
		$tanggal = strtotime($params['tanggal']);
		$tanggalPeriode = date('Y-m', $tanggal);

		$todayPeriode = date('Y-m');
		if ($tanggalPeriode < $todayPeriode) {
			return false;
		}
		return true;
	}

	public function create()
	{
		$post = $this->input->post();
		if ($post != null) {
			// echo '<pre>'; var_dump($post); echo '</pre>';
			// pembelian header
			$params = [
				'tanggal' => @$post['tanggal'],
				'id_supplier' => @$post['id_supplier'],
				'keterangan' => @$post['keterangan'],
				'no_dokumen' => $this->generateNumberDocument(@$post['tanggal'])
			];
			
			$this->load->model('ModelPembelian');
			
			$last_id_inserted = $this->ModelPembelian->create($params);

			if ($last_id_inserted >= 0) {						
				$this->load->model('ModelPembelianDetail');
				// pembelian_detail
				$success = true;
				foreach (@$post['items'] as $item) {
					$harga = $this->currencyToInt($item['harga']);
					$data = [
						'id_barang' => $item['id_barang'],
						'harga' => $harga,
						'qty' => $item['qty'],
					];
					
					$data['id_pembelian'] = $last_id_inserted;
					if (!$this->ModelPembelianDetail->create($data)) {					
						$success = false;
					}					// echo '<pre>'; var_dump($params['qty']); echo '</pre>';
				}
				
				if ($success) {
					// return redirect('pembelian/read/'.$last_id_inserted);
//					var_dump($params);
					$message = 'Nomor dokumen '. $params['no_dokumen'] . ' berhasil tersimpan.';
					$this->session->set_flashdata('alert-success', $message);
					redirect('pembelian/read/'.$last_id_inserted);
				} else {
					die ('error pembelian detail');
				}

			} else {
				echo 'error Pembelian';
			}
		}

		$allSupplier = $this->getAllSupplier();
		$allBarang = $this->getAllBarang();

		$this->render('pembelian/create', [
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

	public function read($id) 
	{
		$this->load->model('ModelPembelian');
		$this->load->model('ModelPembelianDetail');

		$data = $this->ModelPembelian->getAllWithDetail($id)[0];

		$select = "pembelian_detail.id, pembelian_detail.id_pembelian, pembelian_detail.id_barang, pembelian_detail.qty, pembelian_detail.harga";
		$join = " INNER JOIN barang b ON b.id=pembelian_detail.id_barang ";
		$where = " WHERE id_pembelian=".$data['id'];
		$items = $this->ModelPembelianDetail->get($select, $join, $where, '', '');

		$allBarang = $this->getAllBarang();

		$this->render('pembelian/read', [
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
					$harga = $this->currencyToInt($item['harga']);	
					$data = [
						'id_pembelian' => $post['id'],
						'id_barang' => $item['id_barang'],
						'harga' => $harga,
						'qty' => $item['qty'],
					];
					
					//create pembelian detail
					$this->ModelPembelianDetail->create($data);
					// echo '<pre>'; var_dump($params['qty']); echo '</pre>';
				}
				$this->session->set_flashdata('alert-success', 'Update berhasil');
				redirect('pembelian/read/'.$post['id']);

			} else {
				echo 'error';
			}
		}

		$data = $this->ModelPembelian->getAllWithDetail($id)[0];

		$select = "pembelian_detail.id, pembelian_detail.id_pembelian, pembelian_detail.id_barang, pembelian_detail.qty, pembelian_detail.harga";
		$join = " INNER JOIN barang b ON b.id=pembelian_detail.id_barang ";
		$where = " WHERE id_pembelian=".$data['id'];
		$items = $this->ModelPembelianDetail->get($select, $join, $where, '', '');

		$allSupplier = $this->getAllSupplier();
		$allBarang = $this->getAllBarang();

		$this->render('pembelian/update', [
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

	protected function render($view, $data=[])
	{
		$active = 'pembelian';

		$this->load->view('layouts/header');
		$this->load->view('layouts/menu', [
			'active' => $active
		]);
		$this->load->view($view, $data);
		$this->load->view('layouts/footer');
	}

	private function getCountPembelian($periode=null)
	{
		$this->load->model('ModelPembelian');
		$nowMonth = date('Y-m');
		if ($periode != null) {
			$nowMonth = $periode;
		}
		$where = "TO_CHAR(tanggal, 'yyyy-mm') like '%$nowMonth'";
		$params = [
			'where' => $where,
			'count' => true,
			'join' => ' '
		];
		$query = $this->ModelPembelian->getAll($params);
		return @$query[0]['count'] ?? 0;
	}

	public function generateNumberDocument($tanggal='')
	{
		/* contoh format nomor dokumen
		"OP-2301-0001";
		*/
		$prefix = 'OP';
		$delimiter = '-';
		$nowMonth = date('y-m');
		if ($tanggal) {
			$date = strtotime($tanggal);
			$nowMonth = date('y-m', $date);
		}
		$count = $this->getCountPembelian($nowMonth) + 1;
		$nextCount = sprintf('%04d', $count);
		$nowMonth = str_replace("-", "", $nowMonth);
		$noDocument = $prefix . $delimiter . $nowMonth . $delimiter . $nextCount;
		return $noDocument;
	}

	public function test()
	{
		$params = [
			'tanggal' => '2022-12-31'
		];
		if ($this->canUpdateStatus($params)) {
			echo "allow";
		} else {
			echo "not allow";
		}
	}

	public function updateStatus()
	{
		$post = $this->input->post();
		if ($post != null) {
			$this->load->model('ModelPembelian');
			$params = [
				'id' => @$post['id'],
				'status'=> @$post['status']
			];
			$this->ModelPembelian->update($params);
			echo 'success';
		} else {
			echo 'error';
		}
	}


}
