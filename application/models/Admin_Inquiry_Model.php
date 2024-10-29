<?php

class Admin_Inquiry_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->model('Admin_Spareparts_Model');
		$this->load->model('Admin_Inquiry_Model');
		date_default_timezone_set("Asia/Manila");
    }


	// get online inquiry
	public function getOnlineInquiryData($id = null)
	{
		$sql = "SELECT * FROM inquiry_form Where status = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			 $update = $this->db->update('inquiry_form', $data);
			 
			 $inquiry = $this->Admin_Inquiry_Model->getInquiryData($id);
             $cust = array(
				'customer_firstname' => $inquiry['customer_firstname'],
				'customer_lastname' => $inquiry['customer_lastname'],
				'customer_middle' => $inquiry['customer_middle'],
				'customer_contact' => $inquiry['customer_contact'],
				'customer_email' => $inquiry['customer_email'],
				'customer_street' => $inquiry['customer_street'],
				'customer_subdivision' => $inquiry['customer_subdivision'],
				'customer_barangay' => $inquiry['customer_barangay'],
				'customer_city' => $inquiry['customer_city'],
				'customer_province' => $inquiry['customer_province'],
				'active' => 1
			 );
			 $this->db->insert('customer_tbl', $cust);

             return $update = $this->db->affected_rows();
		}
	}
	
	public function getRespondedInquiryData($id = null)
	{
		$sql = "SELECT * FROM inquiry_form Where status = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function update1($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('inquiry_form', $data);
             return $update = $this->db->affected_rows();
		}
	}
	
	
	public function getCompletedInquiryData($id = null)
	{
		$sql = "SELECT * FROM inquiry_form Where status = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function update2($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			 $update = $this->db->update('inquiry_form', $data);
             return $update = $this->db->affected_rows();
		}
	}
	
	
	public function getCancelledInquiryData($id = null)
	{
		$sql = "SELECT * FROM inquiry_form Where status = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
	
	public function update4($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			 $update = $this->db->update('inquiry_form', $data);
             return $update = $this->db->affected_rows();
		}
	}

    //  extra 

    public function getColorData($id = null)
	{
		$sql = "SELECT * FROM ebike_color_tbl Where id = $id";
		$query = $this->db->query($sql);
		return $query->row_array();
    }
    
    public function getModelData($id = null)
	{
		$sql = "SELECT * FROM ebike_model_tbl Where id = $id";
		$query = $this->db->query($sql);
		return $query->row_array();
    }

    public function getStoreData($id = null)
	{
		$sql = "SELECT * FROM store_tbl Where store_id = $id";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function getInquiryData($id = null)
	{
		$sql = "SELECT * FROM inquiry_form Where id = $id";
		$query = $this->db->query($sql);
		return $query->row_array();
    }
	
}