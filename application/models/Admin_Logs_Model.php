<?php

class Admin_Logs_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }
    public function logs(){
        $query = $this->db->query("SELECT * FROM system_logs ORDER BY id DESC");
        return $query->result_array();
  }
    public function getName($id){
        $query = $this->db->query("SELECT * FROM users_tbl WHERE id = $id");
        return $query->row_array();
    }
}