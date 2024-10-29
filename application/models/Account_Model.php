<?php

class Account_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }
    public function user($customer_id = ''){
        if($customer_id){
            $user = $customer_id;
        }
        else
        {
            $user = $this->session->userdata('customer_id');
        }
        $query = $this->db->query("SELECT * FROM customer_tbl WHERE id = $user");
        return $query->row_array();
  }
}