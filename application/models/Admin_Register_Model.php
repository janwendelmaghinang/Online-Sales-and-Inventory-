<?php

class Admin_Register_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }


    public function getPendingData($id = null)
	{
        $sql = "SELECT * FROM order_items_ebike_tbl WHERE registration = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
    
    public function getUnclaimedData($id = null)
	{
        $sql = "SELECT * FROM order_items_ebike_tbl WHERE claim = ? And registration = 1";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
    public function insertColor($data)
	{
		if($data) {
			$insert = $this->db->insert('ebike_color_tbl', $data);
			return ($insert == true) ? true : false;
		}
	}

    public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('order_items_ebike_tbl', $data);
			return ($update == true) ? true : false;
		}
    }
    public function removeColor($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ebike_color_tbl');
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

    public function getItem($id = null)
	{
        $sql = "SELECT * FROM order_items_ebike_tbl WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function getSales($id = null)
	{
        $sql = "SELECT * FROM sales_tbl WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function getCustomer($id = null)
	{
        $sql = "SELECT * FROM customer_tbl WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }
}