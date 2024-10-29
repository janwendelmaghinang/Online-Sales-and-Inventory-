<?php

class Admin_Pullout_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->Model('Admin_Amortization_Model');
		$this->load->Model('Admin_Installment_Model');
		$this->load->Model('Admin_Ebike_Model');
		date_default_timezone_set("Asia/Manila");

    }

	public function getPullout($id , $ps , $ps1)
	{
		$sql = "SELECT * FROM ebike_application_tbl Where status = ? AND cancelled = 0 AND paid_status = $ps AND pullout_status = $ps1";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
    }
    
    public function pullout_update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			 $update = $this->db->update('ebike_application_tbl', $data);
             return $update = $this->db->affected_rows();
		}
	}















    
    public function getSchedData($id)
	{
		$sql = "SELECT * FROM loan_payment_schedule Where application_id = ? ";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	// pay btn activated
	public function getSched($id)
	{
		$sql = "SELECT * FROM loan_payment_schedule Where application_id = ? AND payBtn = 1";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	public function payment_update($data, $id)
	{
		if($data && $id) {
				$application_id = $this->input->post('id_hidden');
	
				// update application tbl to fully paid
				// $sched1 = count($this->Admin_Amortization_Model->getAllUnpaid($application_id));
			    if($this->input->post('ending_balanced') == 0 || $this->input->post('ending_balanced') < 0 ){
					$data2 = array(
						'paid_status' => 1
					);
					$this->db->where('id', $application_id);
				    $this->db->update('ebike_application_tbl', $data2);
				}
				else
				{
					$sched = $this->Admin_Amortization_Model->getSchedUnpaid($application_id);
					$data1 = array(
						'beginning_balance' => $this->input->post('ending_balanced'),
						'payBtn' => 1
					);
					$this->db->where('id', $sched['id']);
					$this->db->update('loan_payment_schedule', $data1);
				}

			// insert sales here

			
			$this->db->where('id', $id);
			$update = $this->db->update('loan_payment_schedule', $data);
			return ($update == true) ? true : false;
		}
	}

// first unpaid
	public function getSchedUnpaid($id = null)
	{
		$sql = "SELECT * FROM loan_payment_schedule Where application_id = $id  AND payBtn = 0 AND paid = 0";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
// first due date
	public function getSchedDueDate($id = null)
	{
		$sql = "SELECT * FROM loan_payment_schedule Where application_id = $id  AND payBtn = 1 AND paid = 0";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

// trigger to fully paid
	public function getAllUnpaid($id= null)
	{
		$sql = "SELECT * FROM loan_payment_schedule Where application_id = $id  AND paid = 0";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
// ////////////////////////////
	public function update_due_date($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('loan_payment_schedule', $data);
			return ($update == true) ? true : false;
		}
	}

	public function getAllSchedData()
	{
		$sql = "SELECT * FROM loan_payment_schedule Where paid = 0";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	


	public function getInstallmentDataById($id)
	{
		$sql = "SELECT * FROM ebike_application_tbl Where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	
}