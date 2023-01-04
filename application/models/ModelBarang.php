<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelBarang extends CI_Model{

    public $tableName = 'barang';

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM $this->tableName");
        return $query->result_array();
    }

    public function create($params)
    {
        $data = [
            'kode' => @$params['kode'],
            'nama' => @$params['nama']
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
            'kode' => @$params['kode'],
            'nama' => @$params['nama']
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