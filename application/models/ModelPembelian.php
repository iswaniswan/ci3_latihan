<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPembelian extends CI_Model{

    public $tableName = 'pembelian';

    public function getAll()
    {
        $join = "INNER JOIN supplier s ON s.id=$this->tableName.id_supplier::integer ";
        $select = "$this->tableName.id, tanggal, keterangan, s.nama as nama_supplier";
        $query = $this->db->query("SELECT $select FROM $this->tableName $join ORDER BY id ASC");
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

        $select = "$this->tableName.id, tanggal, id_barang, b.nama as nama_barang, b.harga, id_supplier, s.nama as nama_supplier, pd.qty, keterangan";

        $query = $this->db->query("SELECT $select FROM $this->tableName $join $where ORDER BY id ASC");
        return $query->result_array();
    }

    public function create($params)
    {        
        $data = [
            'id_supplier' => @$params['id_supplier'],
            'tanggal' => @$params['tanggal'],
            'keterangan' => @$params['keterangan']
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
        $data = array(
            'tanggal' => @$params['tanggal'],
            'id_supplier' => @$params['id_supplier'],
			'keterangan' => @$params['keterangan']
        );
    
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
