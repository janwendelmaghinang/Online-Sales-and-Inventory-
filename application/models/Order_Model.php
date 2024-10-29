<?php

class Order_Model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    // public function allorder(){
    //     $user = $this->session->userdata('user_id');
    //     $query = $this->db->query("SELECT * FROM online_order_items
    //     inner JOIN online_order ON online_order_items.order_id = online_order.order_id WHERE online_order_items.status = 1 AND online_order.customer_id = $user");
    //     return $query->result_array();  
    // }

    public function allorder($id = null)
    {
        $user = $this->session->userdata('customer_id');
        $sql = "SELECT * FROM order_tbl WHERE customer_id = $user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function allorderItems($id = null)
    {
        $user = $this->session->userdata('customer_id');
        $sql = "SELECT * FROM order_items_parts_tbl WHERE order_id = $id ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function allready($id = null)
    {
        $user = $this->session->userdata('customer_id');
        $sql = "SELECT * FROM order_tbl WHERE status = $id AND customer_id = $user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function allreadyItems($id = null)
    {
        $sql = "SELECT * FROM order_items_parts_tbl WHERE order_id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function allCompleted($id = null)
    {
        $user = $this->session->userdata('customer_id');
        $sql = "SELECT * FROM order_tbl WHERE status = $id AND customer_id = $user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function allCompletedItems($id = null)
    {
        $sql = "SELECT * FROM order_items_parts_tbl WHERE order_id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function allCancelled($id = null)
    {
        $user = $this->session->userdata('customer_id');
        $sql = "SELECT * FROM order_tbl WHERE status = $id AND customer_id = $user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function allCancelledItems($id = null)
    {
        $sql = "SELECT * FROM order_items_parts_tbl WHERE order_id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}