<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLaporan extends CI_Model{

	/**
	 * tables used
	 */
    private $barang = 'barang';
	private $supplir = 'supplir';
	private $pembelian = 'pembelian';
	private $pembelianDetail = 'pembelian_detail';

    public function getAll($params=[])
    {
		$select = 'SELECT s.nama AS nama_supplier, p.tanggal, p.no_dokumen, b.kode AS kode_barang, b.nama AS nama_barang, pd.qty, pd.harga AS harga_satuan, (pd.qty*pd.harga) AS subtotal ';
		$join = 'INNER JOIN pembelian AS p ON p.id=pd.id_pembelian ';
		$join .= 'LEFT JOIN barang AS b ON b.id=pd.id_barang ';
		$join .= 'LEFT JOIN supplier AS s ON s.id::integer=p.id_supplier::integer ';
		$where = '';
		$group = '';
		$limit = '';
		$order = 'ORDER BY 2 DESC';

		$tanggalMulai = null;
		$tanggalAkhir = null;
		if (@$params['tanggal_mulai'] != null) {
			$tanggalMulai = $params['tanggal_mulai'];
		}

		if (@$params['tanggal_akhir'] != null) {
			$tanggalAkhir = $params['tanggal_akhir'];
		}

		if ($tanggalMulai != null && $tanggalAkhir != null) {
			$where = " WHERE p.tanggal >= '$tanggalMulai' AND p.tanggal <= '$tanggalAkhir' ";
		}

		if (@$params['id_supplier'] != null) {
			if ($where != '') {
				$where .= " AND p.id_supplier::integer=".$params['id_supplier'];
			} else {
				$where = " WHERE p.id_supplier::integer=".$params['id_supplier'];
			}
		}

		$sql = "$select FROM pembelian_detail AS pd $join $where $group $limit $order";
//		var_dump($sql); die();
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
