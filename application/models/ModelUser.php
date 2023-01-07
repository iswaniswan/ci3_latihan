<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelUser extends CI_Model{

    public $tableName = '"user"';

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM $this->tableName ORDER BY id ASC");
        return $query->result_array();
    }
	protected function get_hash($PlainPassword)
	{
		$option = ['cost' => 5];
		return password_hash($PlainPassword, null, $option);
	}

    public function create($params)
    {
        $data = [
            'username' => @$params['username'],
			'password'=> $this->get_hash($params['password'])
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

        if(@$params['password']) {
            $data['password'] = $params['password'];
        }
    
        $this->db->where('id', @$params['id']);
        $this->db->update($this->tableName, $data);

        // var_dump(print_r($this->db->last_query()));
        // die();

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tableName);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

	public function get($params=[])
	{
		$join = '';
		$where = '';
		$group = '';
		$limit = '';
		$order = "ORDER BY id ASC";

		if (@$params['where'] != null) {
			$where = ' WHERE '.$params['where'];
		}

		$sql = "SELECT username, password FROM $this->tableName $join $where $group $limit";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function getByUsername($username)
	{
		$where = "username='$username'";
		$params = [
			'where' => $where
		];
		return $this->get($params);
	}


}

?>
