<?php

class Admin_Amortization_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->Model('Admin_Amortization_Model');
		$this->load->Model('Admin_Installment_Model');
		$this->load->Model('Admin_Ebike_Model');
		date_default_timezone_set("Asia/Manila");

    }

	public function getInstallmentReleased($id , $ps)
	{
		$sql = "SELECT * FROM ebike_application_tbl Where status = ? AND cancelled = 0 AND paid_status = $ps";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
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
				$apply = $this->Admin_Amortization_Model->getInstallmentDataById($application_id);
				
				// always update paid status to paying
				$data3 = array(
					'paid_status' => 2
				);
				$this->db->where('id', $application_id);
				$this->db->update('ebike_application_tbl', $data3);

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
			$sales_data = array(
				'loan_id' => $application_id,
				'customer_id' => $apply['customer_id'],
				'amount_change' => $this->input->post('change'),
				'amount_tentered' => $this->input->post('amount_tendered'),
				'sales_date' => date('M d, Y'),
				'loan' => 1,
				'total_amount' => $data['total_payment'],
				'sales_from' => 1,
				'sales_type' => 2,
			);
			$this->db->insert('sales_tbl', $sales_data);
			
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
// /////////////////////////
	
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_application_tbl', $data);
			return ($update == true) ? true : false;
		}
	}

	public function pullout($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_application_tbl', $data);
			return ($update == true) ? true : false;
		}
	}
	// extra 

	public function getInstallmentDataById($id)
	{
		$sql = "SELECT * FROM ebike_application_tbl Where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	public function getLoanSched($id)
	{
		$sql = "SELECT * FROM loan_payment_schedule Where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	public function getPenaltyData()
	{
		$sql = "SELECT * FROM penalty_tbl Where id = ?";
		$query = $this->db->query($sql, array(1));
		return $query->row_array();
	}
	
}