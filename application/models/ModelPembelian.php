<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPembelian extends CI_Model{

    public $tableName = 'pembelian';

    public function getAll($params=[])
    {
        $select = "$this->tableName.id, tanggal, no_dokumen, keterangan, s.nama as nama_supplier, $this->tableName.status";
        $join = "INNER JOIN supplier s ON s.id=$this->tableName.id_supplier::integer ";
//		$order = "ORDER BY id ASC";
		$order = "ORDER BY tanggal desc";
		$where = '';
		if (@$params['count'] != null) {
			$select = "count($this->tableName.id)";
			$order = '';
		}
		if (@$params['where'] != null) {
			$where = ' WHERE '.$params['where'];
		}
		if (@$params['join'] != null) {
			$join = $params['join'];
		}
		if (@$params['order'] != null) {
			$order = $params['order'];
		}

		$sql = "SELECT $select FROM $this->tableName $join $where $order";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getAllWithDetail($id=null)
    {
        $join = "INNER JOIN pembelian_detail pd ON pd.id_pembelian=$this->tableName.id ";
        $join .= "INNER JOIN supplier s ON s.id=$this->tableName.id_supplier::integer ";
        $join .= "INNER JOIN barang b ON b.id=pd.id_barang ";

        $where = '';
        if ($id != null) {
            $where = " WHERE $this->tableName.id=$id ";
        }

        $select = "$this->tableName.id, no_dokumen, $this->tableName.status, tanggal, id_barang, b.nama as nama_barang, b.harga, id_supplier, s.nama as nama_supplier, pd.qty, keterangan";

        $query = $this->db->query("SELECT $select FROM $this->tableName $join $where ORDER BY id ASC");
        return $query->result_array();
    }

    public function create($params)
    {        
        $data = [
            'id_supplier' => @$params['id_supplier'],
            'tanggal' => @$params['tanggal'],
            'keterangan' => @$params['keterangan'],
			'no_dokumen' => @$params['no_dokumen']
        ];
        $this->db->insert($this->tableName, $data);  
        
        $last_insert_id = $this->db->insert_id();

        return ($this->db->affected_rows() != 1) ? false : $last_insert_id;
    }

    public function read($id)
    {
        $query = $this->db->get_where($this->tableName, array('id' => $id));
        return $query->result_array()[0];
    }

    public function update($params)
    {
        $data = [];

		if (@$params['tanggal']) {
			$data['tanggal'] = $params['tanggal'];
		}
		if (@$params['id_supplier']) {
			$data['id_supplier'] = $params['id_supplier'];
		}
		if (@$params['keterangan']) {
			$data['keterangan'] = $params['keterangan'];
		}
		if (@$params['no_dokumen']) {
			$data['no_dokumen'] = $params['no_dokumen'];
		}
		if (@$params['status']) {
			$data['status'] = $params['status'];
		}
    
        $this->db->where('id', @$params['id']);
        $this->db->update($this->tableName, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tableName);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

}

?>
