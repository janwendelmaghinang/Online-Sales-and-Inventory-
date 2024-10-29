<?php

class Admin_Bank_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }


    public function getBankData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM bank_account WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM bank_account";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    
    public function insertBankData($data)
	{
		if($data) {
			$insert = $this->db->insert('bank_account', $data);
			return $this->db->insert_id();
		}
	}

    public function editBankData($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('bank_account', $data);
            return ($update == true) ? true : false;
		}
    }
    public function deleteBankData($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('bank_account');
			return ($delete == true) ? true : false;
		}
    }
    
    public function checkColor($color)
    {
        $this->db->where('color_name', $color);

        $result = $this->db->get('ebike_color_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->color_name;
        }
         else 
        {
            return false;
        }
    }
}