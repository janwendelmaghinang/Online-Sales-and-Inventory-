<?php

class Online_Form_Model extends CI_Model{
     
public function __construct(){
    parent::__construct();
}
public function getBranch(){
    $query = $this->db->query("SELECT * FROM store_tbl WHERE active = 1");
    return $query->result_array();
}
public function getModel(){
    $query = $this->db->query("SELECT * FROM ebike_model_tbl WHERE active = 1");
    return $query->result_array();
}
public function insert_form_data($customer_info){
    $insert = $this->db->insert('online_purchase_form', $customer_info);
    return $insert?$this->db->insert_id():false;
}
}