<?php

class Admin_Page_Controller_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }

    public function getFooterActive()
	{
        $query = $this->db->query('SELECT * FROM page_content where id = 1');
        return $query->row_array();
    }

    public function getFooterData()
	{
        $query = $this->db->query('SELECT * FROM footer where id = 1');
        return $query->row_array();
    }

    public function getSliderActive(){
        $query = $this->db->query('SELECT * FROM page_content where id = 2');
        return $query->row_array();
    }
}
    