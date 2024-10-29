<?php

class Admin_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }
    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        
        $result = $this->db->get('users_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        }
         else 
        {
         return false;
        }
    }
    public function getUserById($id){
        $query = $this->db->query("SELECT * FROM users_tbl WHERE id = $id");
        return $query->row();
    }

    public function access($id , $active_status){
        $query = $this->db->query("UPDATE users_tbl SET active = $active_status WHERE id = $id");
        return $query;
    }
}