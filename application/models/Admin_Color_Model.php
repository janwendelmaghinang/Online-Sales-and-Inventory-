<?php

class Admin_Color_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }


    public function getColorData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_color_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_color_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	

    
    public function insertColor($data)
	{
		if($data) {
			$insert = $this->db->insert('ebike_color_tbl', $data);
			return ($insert == true) ? true : false;
		}
	}

    public function updateColor($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_color_tbl', $data);
			return ($update == true) ? true : false;
		}
    }
    public function removeColor($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ebike_color_tbl');
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