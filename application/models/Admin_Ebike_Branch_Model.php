<?php

class Admin_Ebike_Branch_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
    }
    public function getEbikeBranchData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_store_stock_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_store_stock_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getEbikeBranchByUnitId($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_store_stock_tbl WHERE unit_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
		$sql = "SELECT * FROM ebike_store_stock_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
	
    public function insertEbike($data)
	{
		if($data) {
			$insert = $this->db->insert('ebike_store_stock_tbl', $data);
			return ($insert == true)? true : false;
		}
	}

    public function updateUnit($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_unit_tbl', $data);
			return ($update == true) ? true : false;
		}
    }
    public function removeModel($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ebike_unit_tbl');
			return ($delete == true) ? true : false;
		}
    }
    
    public function checkModel($model)
    {
        $this->db->where('model_name', $model);

        $result = $this->db->get('ebike_unit_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->model_name;
        }
         else 
        {
            return false;
        }
	}

	public function getEbikeSpecsData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_specification_tbl WHERE ebike_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_specification_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
	
	public function updateSetModel($id, $set){
		if($id && $set){
			$update = $this->db->query("UPDATE ebike_unit_tbl SET set_model = '$set' WHERE id = '$id'");
			return ($update == true) ? true : false;
		}
	}


	// production

	public function getProductionData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_production_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_production_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
	
	public function Production($data){
		if($data) {
			$insert = $this->db->insert('ebike_production_tbl', $data);
            return ($insert == true) ? true : false;
		}
	}

	public function productionCompleted($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_production_tbl', $data);
			return ($update == true) ? true : false;
		}
    }
}