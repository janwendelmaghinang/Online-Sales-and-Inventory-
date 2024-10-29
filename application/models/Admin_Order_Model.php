<?php

class Admin_Order_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->model('Admin_Spareparts_Model');
    }


    public function getOrderData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM order_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id,));
			return $query->row_array();
		}
		$sql = "SELECT * FROM order_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
		public function getCustomerData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM customer_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id,));
			return $query->row_array();
		}
		$sql = "SELECT * FROM customer_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get online order
	public function getOnlineOrderData($id = null)
	{
		$sql = "SELECT * FROM order_tbl Where status = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	

	public function getOrderByStatusData($status = null)
	{
		if($status) {
			$sql = "SELECT * FROM order_tbl WHERE status = ?";
			$query = $this->db->query($sql, array($status));
			return $query->result_array();
		}
    }
    
    public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			 $update = $this->db->update('order_tbl', $data);
             return $update = $this->db->affected_rows();
		}
	}


    public function removeModel($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ebike_model_tbl');
			return ($delete == true) ? true : false;
		}
    }
    
    public function checkModel($model)
    {
        $this->db->where('model_name', $model);

        $result = $this->db->get('ebike_model_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->model_name;
        }
         else 
        {
            return false;
        }
	}
	
	public function updateSetModel($id, $set){
		if($id && $set){
			$update = $this->db->query("UPDATE ebike_model_tbl SET set_model = '$set' WHERE id = '$id'");
			return ($update == true) ? true : false;
		}
    }
    
    public function getOrderById($id = null)
	{

		$sql = "SELECT * FROM order_items_parts_tbl where order_id = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
}