<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPembelianDetail extends CI_Model{

    public $tableName = 'pembelian_detail';

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
        $data = array(
			'id_pembelian' => @$params['id_pembelian'],
            'id_barang' => @$params['id_barang'],
			'harga' => @$params['harga'],
			'qty' => @$params['qty']
        );
    
        $this->db->where('id_pembelian', @$params['id_pembelian']);
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
