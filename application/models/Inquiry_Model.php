<?php

class Inquiry_Model extends CI_Model{
     
public function __construct(){

    parent::__construct();
    date_default_timezone_set("Asia/Manila");
}

public function insert_inquiry($data){
    if($data) {
        $insert = $this->db->insert('inquiry_form', $data);
        return ($insert == true) ? true : false;
    }
}
    // extra
    
    public function getCustomerData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM customer_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM customer_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
}