<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPembelianDetail extends CI_Model{

    public $tableName = 'pembelian_detail';

    public function get($select='', $join='', $where='', $limit='', $order=' ORDER BY id ASC'){         
        if ($select == '') {
            $select = '*';
        }

        $sql = "SELECT $select FROM $this->tableName $join $where $limit $order";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getAll(){        
        $query = $this->db->query("SELECT * FROM $this->tableName");

        return $query->result_array();
    }

    public function create($params)
    {
        $data = [
            'id_pembelian' => @$params['id_pembelian'],
            'id_barang' => @$params['id_barang'],
            'harga' => @$params['harga'],
            'qty' => @$params['qty']
        ];
        $this->db->insert($this->tableName, $data); 

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function read($id)
    {
        $query = $this->db->get_where($this->tableName, array('id' => $id));
        return $query->result_array()[0];
    }

    public function update($params)
    {
        $data = array();

        if (@$params['id_pembelian']) {
            $data['id_pembelian'] = $params['id_pembelian'];
        }            
        if (@$params['id_barang']) {
            $data['id_barang'] = $params['id_barang'];
        }            
        if (@$params['harga']) {
            $data['harga'] = $params['harga'];
        }            
        if (@$params['qty']) {
            $data['qty'] = $params['qty'];
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

	public function deleteBy($key, $value)
	{
		$this->db->where($key, $value);
		$this->db->delete($this->tableName);

		return ($this->db->affected_rows() != 1) ? false : true;
	}

}

?>
