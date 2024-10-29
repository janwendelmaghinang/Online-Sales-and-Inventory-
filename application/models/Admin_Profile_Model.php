<?php

class Admin_Profile_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }


    public function getProfileData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM users_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM users_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    
    public function insertStore($data)
	{
		if($data) {
			$insert = $this->db->insert('store_tbl', $data);
			return ($insert == true) ? true : false;
		}
	}

    public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('users_tbl', $data);
			return ($update == true) ? true : false;
		}
    }
    public function removeStore($id)
	{
		if($id) {
			$this->db->where('store_id', $id);
			$delete = $this->db->delete('store_tbl');
			return ($delete == true) ? true : false;
		}
    }
    
    public function checkModel($model)
    {
        $this->db->where('model_name', $model);

        $result = $this->db->get('store_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->model_name;
        }
         else 
        {
            return false;
        }
    }
}