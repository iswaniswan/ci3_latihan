<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSupplier extends CI_Model{

    public $tableName = 'supplier';

    public function getAll(){
        $query = $this->db->query("SELECT * FROM $this->tableName ORDER BY id ASC");
        return $query->result_array();
    }

	public function get($select='*', $join='', $where='', $limit='')
	{
		if ($where != '') {
			$where = ' WHERE '.$where;
		}

		if ($limit != '') {
			$limit = ' LIMIT '.$limit;
		}

		$query = $this->db->query("SELECT $select FROM $this->tableName $join $where $limit");
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
        $data = array();

        if(@$params['kode']) {
            $data['kode'] = $params['kode'];
        }            
        if(@$params['nama']) {
            $data['nama'] = $params['nama'];
        }            
        if(@$params['status']) {
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

	public static function getById($id=null, $key=null)
	{
		$where = "id=$id";
		$query = self::get('', '', $where, '');
		return $query[0][$key];
	}

}

?>
