<?php

class Admin_Sales_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->model('Admin_Spareparts_Model');
    }

    public function getSalesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM sales_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM sales_tbl WHERE loan = 0 ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	

	public function getSalesWalkin()
	{
		$sql = "SELECT * FROM sales_tbl WHERE sales_from = 1 AND loan = 0 ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getSalesOnline()
	{
		$sql = "SELECT * FROM sales_tbl WHERE sales_from = 2 AND loan = 0 ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	public function getSalesLoanData($id = null)
	{
		$sql = "SELECT * FROM sales_tbl WHERE loan = 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	

	public function getSalesItemData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM order_items_tbl WHERE order_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}
    
    function getSalesByRefNoData($ref_no){
        $sql = "SELECT * FROM sales_tbl WHERE ref_no = ?";
        $query = $this->db->query($sql, array($ref_no));
        return $query->result_array();
    }
      
    public function updateModel($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_model_tbl', $data);
			return ($update == true) ? true : false;
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

		$sql = "SELECT * FROM order_items_tbl where order_id = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
}