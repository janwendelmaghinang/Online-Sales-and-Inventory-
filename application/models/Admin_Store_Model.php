<?php

class Admin_Store_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }


    public function getStoreData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM store_tbl WHERE store_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM store_tbl";
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

    public function updateStore($data, $id)
	{
		if($data && $id) {
			$this->db->where('store_id', $id);
			$update = $this->db->update('store_tbl', $data);
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