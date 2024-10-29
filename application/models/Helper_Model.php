<?php

class Helper_Model extends CI_Model{
     
     public function __construct(){
        parent::__construct();
     }
     public function store(){
        $query = $this->db->query("SELECT * FROM store_tbl WHERE active = 1");
        return $query->result_array();
     }
     public function system_logs($activity){
        date_default_timezone_set("Hongkong");
        $data = array(
           'user_id' => $this->session->userdata('users_id'),
           'user' => $this->session->userdata('users_firstname'),
           'activity' => $activity,
           'date' => date('M D, Y'),
           'time' => date("h:i:sa")
        );
      $insert = $this->db->insert('system_logs',$data);
      // $order_id = $this->db->insert_id();
      return $insert;
     }

     public function getCompanyChargeData(){
      $query = $this->db->query("SELECT * FROM company");
      return $query->row_array();
   }
}

