<?php

class Admin_Installment_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->Model('Admin_Installment_Model');
		$this->load->Model('Admin_Ebike_Model');
		date_default_timezone_set("Asia/Manila");    

    }

	public function getInstallmentData($id)
	{
		$sql = "SELECT * FROM ebike_application_tbl Where status = ? AND cancelled = 0";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function getInstallmentCancelled()
	{
		$sql = "SELECT * FROM ebike_application_tbl Where cancelled = 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getInstallmentReleased()
	{
		$sql = "SELECT * FROM ebike_application_tbl Where cancelled = 0 AND status = 3";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getInstallmentDataById($id)
	{
		$sql = "SELECT * FROM ebike_application_tbl Where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	
	public function getApprovedData($id)
	{
		$sql = "SELECT * FROM ebike_application_tbl Where status = ? AND cancelled = 0";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function getApprovedById($id)
	{
		$sql = "SELECT * FROM ebike_application_tbl Where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	
	public function getEbikeStock($id,$color)
	{
		$sql = "SELECT * FROM ebike_stock_tbl Where model_id = ? AND color_id = ? ";
		$query = $this->db->query($sql, array($id,$color));
		return $query->row_array();
	}
	
	public function getEbikeStockItems($id)
	{
		$sql = "SELECT * FROM ebike_stock_items Where ebike_stock_id = ? And status = 1";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
    }
		
    public function insertApplication($data)
	{
		if($data) {
			$insert = $this->db->insert('ebike_application_tbl', $data);
			return ($insert == true) ? true : false;
		}
	}

    public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_application_tbl', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function getInterest($id = null)
	{
		if($id){
			$sql = "SELECT * FROM interest Where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM interest";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    public function update_interest(){
		$id = $this->input->post('id');
        for($i = 0; $i < count($id); $i++){
           $data = array(
               'id' => $this->input->post('id')[$i],
               'interest' => $this->input->post('interestValue')[$i]
		   );
		   $this->db->where('id', $data['id']);
		   $update = $this->db->update('interest', $data);
		}
		return ($update == true) ? true : false;
	}

	public function release(){
		$id = $this->input->post('application_id');
		$interest_id = $this->input->post('interest_id');
		$downpayment = $this->input->post('downpayment');
		$motor_war_end = '';
		$service_war_end = '';
		// motor warranty
		if($this->input->post('motor_war_month') == 0 && $this->input->post('motor_war_year') == 0){
		$motor_war_end = 'none';
		}
		if(!$this->input->post('motor_war_month') == 0 && !$this->input->post('motor_war_year') == 0){
			$m =  $this->input->post('motor_war_month');
			$y =  $this->input->post('motor_war_year');
			$motor_war_end = date('M d, Y', strtotime('+'.$m. 'month +'.$y.' year'));
		}
		if(!$this->input->post('motor_war_month') == 0 && $this->input->post('motor_war_year') == 0){
			$m =  $this->input->post('motor_war_month');
			$motor_war_end = date('M d, Y', strtotime('+'.$m. 'month'));
		}
		if($this->input->post('motor_war_month') == 0 && !$this->input->post('motor_war_year') == 0){
			$y =  $this->input->post('motor_war_year');
			$motor_war_end = date('M d, Y', strtotime('+'.$y. 'year'));
		}
		// service warranty

		if($this->input->post('service_war_month') == 0 && $this->input->post('service_war_year') == 0){
			$service_war_end = 'none';
		}
		if(!$this->input->post('service_war_month') == 0 && !$this->input->post('service_war_year') == 0){
			$m1 =  $this->input->post('service_war_month');
			$y1 =  $this->input->post('service_war_year');
			$service_war_end = date('M d, Y', strtotime('+'.$m1. 'month +'.$y1.' year'));
		}
		if(!$this->input->post('service_war_month') == 0 && $this->input->post('service_war_year') == 0){
			$m1 =  $this->input->post('service_war_month');
			$service_war_end = date('M d, Y', strtotime('+'.$m1. 'month'));
		}
		if($this->input->post('service_war_month') == 0 && !$this->input->post('service_war_year') == 0){
			$y1 =  $this->input->post('service_war_year');
			$service_war_end = date('M d, Y', strtotime('+'.$y1. 'year'));
		}
		$war_start = date('M d, Y');
		
		$eStock = $this->Admin_Ebike_Model->getEbikeStockItemsRow($this->input->post('item_id'));
		$interest = $this->Admin_Installment_Model->getInterest($interest_id);
		$installment = $this->Admin_Installment_Model->getInstallmentDataById($id);
		$model = $this->Admin_Model_Model->getModelData($installment['ebike_id']);
		

        $principal_price = ($model['price'] - $downpayment);
		$total_interest = ($principal_price * $interest['interest']) / 100;
		$total_price = ($principal_price + $total_interest);
		
		$principal_month =  ($principal_price / $interest['month']);
		$interest_month = ($principal_month * $interest['interest']) / 100;
		$monthly = ($principal_month + $interest_month);
		$data=array(
			'motor_warranty_year' => $this->input->post('motor_war_year'),
			'motor_warranty_month' => $this->input->post('motor_war_month'),
			'service_warranty_year' => $this->input->post('service_war_year'),
			'service_warranty_month' => $this->input->post('service_war_month'),
			'warranty_start' => $war_start,
			'motor_warranty_end' => $motor_war_end,
			'service_warranty_end' => $service_war_end,
			'interest_percentage' => $interest['interest'],
			'terms' => $interest['month'],
			'chasis_number' => $eStock['chasis_number'],
			'motor_number' => $eStock['motor_number'],
			'downpayment' => $downpayment,
			'interest' =>	$total_interest,
			'monthly' => $monthly,
			'due_date' => date('M d, Y'),
			'status' => 3,
			'paid_status' => 2

			
		);
		$this->db->where('id', $id);
		$update = $this->db->update('ebike_application_tbl', $data);
		
		if($update){
            $released = array(
				'status' => 2
			);
			$this->db->where('id', $this->input->post('item_id'));
			$this->db->update('ebike_stock_items', $released);
			
		}
		// return ($update == true) ? true : false;

		// insert sales
		$sales_data = array(
			'loan_id' => $id,
			'customer_id' => $installment['customer_id'],
			'sales_date' => date('M d, Y'),
			'loan' => 1,
			'total_amount' => $downpayment,
			'sales_from' => 1,
			'sales_type' => 2,
		);

		$add = 1;
		for($j=0;$j<$interest['month']; $j++){
			
			if($j == 0){
				$bg = ($total_price);
				$Btn = 1;
			}
			else
			{
				$bg = 0;
				$Btn = 0;
			}
			
			
			$d = date('M d, Y', strtotime('+'.$add. 'month'));

			$loan_data = array(
				'application_id' => $id,
				'date' => $d,
				'customer_id' => $installment['customer_id'],
				'beginning_balance' => $bg,
				'interest' => $interest_month,
				'principal' => $principal_month,
				'total_payment_due' => $monthly,
				'payBtn' => $Btn
			);
			$this->db->insert('loan_payment_schedule', $loan_data);
			$add++;
		}

		
		$insert = $this->db->insert('sales_tbl', $sales_data);
		return $this->db->insert_id();
	}


// extra
	public function getSalesItemData($id){
		$sql = "SELECT * FROM sales_tbl WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
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
	
	public function getPenalty($id = null)
	{
		if($id){
			$sql = "SELECT * FROM penalty_tbl Where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM interest";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function update_penalty(){
		
        $data = array(
			'penalty_percentage' => $this->input->post('penalty_percentage'),
			'months_delay' => $this->input->post('months_delay'),
		);
		$this->db->where('id', 1);
		$update = $this->db->update('penalty_tbl', $data);
		return $update = $this->db->affected_rows();
	}
}