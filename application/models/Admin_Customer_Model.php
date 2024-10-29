<?php

class Admin_Customer_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }


    public function getCustomerData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM customer_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM customer_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    
    public function insertCustomerData($data)
	{
		if($data) {
			$insert = $this->db->insert('customer_tbl', $data);
			return $this->db->insert_id();
		}
	}

    public function updateCustomer($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('customer_tbl', $data);
			return ($update == true) ? true : false;
		}
    }
    public function removeCustomer($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('customer_tbl');
			return ($delete == true) ? true : false;
		}
    }
    
    public function checkColor($color)
    {
        $this->db->where('color_name', $color);

        $result = $this->db->get('ebike_color_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->color_name;
        }
         else 
        {
            return false;
        }
    }
}