<?php

class Admin_Company_Model extends CI_Model{
     
     public function __construct(){
        parent::__construct();
     }
     public function getCompanyData(){
      $query = $this->db->query("SELECT * FROM company");
      return $query->row_array();
   }
}

