<?php

class Admin_Receipt_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
        date_default_timezone_set("Asia/Bangkok");
    }


    public function getPendingData($id = null)
	{
        $sql = "SELECT * FROM order_items_ebike_tbl WHERE registration = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
    
    public function getSalesItemData($id = null)
	{
        $sql = "SELECT * FROM order_items_parts_tbl WHERE order_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
	}
     
    public function getOrderData($id)
	{
        $sql = "SELECT * FROM order_tbl WHERE sales_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function getSalesData($id)
	{
        $sql = "SELECT * FROM sales_tbl WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function getCustomerData($id = null)
	{
        $sql = "SELECT * FROM customer_tbl WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }
}