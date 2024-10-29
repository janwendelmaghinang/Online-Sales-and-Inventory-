<?php

class Admin_Spareparts_Model extends CI_Model{
	
    public function __construct()
    {
		parent:: __construct();
		$this->load->model('Admin_Spareparts_Model');
    }
    public function getSparepartsData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_parts_tbl where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM ebike_parts_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getSparepartsByModel($id)
	{
		$query = $this->db->query("SELECT * FROM ebike_parts_tbl where model_id = $id");
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {

			// insert parts
			$insert = $this->db->insert('ebike_parts_tbl', $data);
			// $insert_id = $this->db->insert_id();
			return $insert;
		}
	}

	// update parts	
	public function updateParts($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_parts_tbl', $data);
			return $update;
		}
	}

	public function getStockData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM parts_stock_tbl where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM parts_stock_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getStockDataByPartsId($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM parts_stock_tbl where parts_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}
	public function getStockDataByColorId($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM parts_stock_tbl where color_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}

	public function getStockDataArray($color_id = null , $model_id = null)
	{
		if($color_id && $model_id) {
			$sql = "SELECT * FROM parts_stock_tbl where model_id = ? AND color_id = ?";
			$query = $this->db->query($sql, array($model_id, $color_id));
			return $query->result_array();
		}
	}

	public function getStockByModelData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM parts_stock_tbl where model_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		$sql = "SELECT * FROM parts_stock_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function addStock($data){
			// insert parts
			$insert = $this->db->insert('parts_stock_tbl', $data);
			
			// insert serial number
			$parts = $this->Admin_Spareparts_Model->getSparepartsData($this->input->post('parts_id'));   

			if($this->input->post('serial_number') && $parts['serial_number'] == 1 && strtolower($parts['name']) == 'chasis' || strtolower($parts['name']) == 'chassis'){
				for($i = 0; $i < count($this->input->post('serial_number')); $i++){
	
					$data1 = array(
						'chasis_number' => $this->input->post('serial_number')[$i],
						'parts_id' => $data['parts_id'],
						'model_id' => $data['model_id'],
						'status' => 1
					);
		
					$insert = $this->db->insert('chasis_number',$data1 );
				}
				}
			if($this->input->post('serial_number') && strtolower($parts['name']) == 'motor' && $parts['serial_number'] == 1){
					for($i = 0; $i < count($this->input->post('serial_number')); $i++){
	
					$data1 = array(
							'motor_number' => $this->input->post('serial_number')[$i],
							'model_id' => $data['model_id'],
							'parts_id' => $data['parts_id'],
							'status' => 1
					);
		
					$insert = $this->db->insert('motor_number',$data1 );
				}
				}
			return $insert;
	}
	
	public function getSerialCount($parts_id  , $model_id, $name)
	{
		if($parts_id && $model_id && strtolower($name) == 'chasis' || strtolower($name) == 'chassis' ) {
			$query = $this->db->query("SELECT * FROM chasis_number WHERE parts_id = $parts_id AND model_id = $model_id AND status = 1");
			return $query->result_array();
		}
		if($parts_id && $model_id && strtolower($name) == 'motor') {
			$query = $this->db->query("SELECT * FROM  motor_number WHERE parts_id = $parts_id AND model_id = $model_id AND status = 1");
			return $query->result_array();
		}
	}

    public function getSerialNumberByName($data, $name){
		if($data && strtolower($name) == 'chasis' || strtolower($name) == 'chassis' ) {
            $number = array(
				'chasis_number' => $data
			);
			$sql = "SELECT * FROM chasis_number where chasis_number = ?";
			$query = $this->db->query($sql, array($number));
			return $query->row_array();
		}
		if($data && strtolower($name) == 'motor') {
            $number1 = array(
				'motor_number' => $data
			);
			$sql = "SELECT * FROM motor_number where motor_number = ?";
			$query = $this->db->query($sql, array($number1));
			return $query->row_array();
		}
	}

	// update stock
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('parts_stock_tbl', $data);

            // get parts
			$parts = $this->Admin_Spareparts_Model->getSparepartsData($data['parts_id']);   

			// insert serial number
			if($this->input->post('serial_number_1') && $parts['serial_number'] == 1 && strtolower($parts['name']) == 'chasis'  ||  strtolower($parts['name']) == 'chassis'  ){
				for($i = 0; $i < count($this->input->post('serial_number_1')); $i++){
	
					$data1 = array(
						'chasis_number' => $this->input->post('serial_number_1')[$i],
						'parts_id' => $parts['id'],
						'model_id' => $data['model_id'],
						'status' => 1
					);
		
						$insert = $this->db->insert('chasis_number',$data1 );
				}
				}
				if($this->input->post('serial_number_1') &&  strtolower($parts['name']) == 'motor' && $parts['serial_number'] == 1){
					for($i = 0; $i < count($this->input->post('serial_number_1')); $i++){
	
						$data1 = array(
							'motor_number' => $this->input->post('serial_number_1')[$i],
							'parts_id' => $parts['id'],
							'model_id' => $data['model_id'],
							'status' => 1
						);
		
						$insert = $this->db->insert('motor_number',$data1 );
					}
				}
			 
             return $update;
			// return ($update == true) ? true : false;
		}
	}
	public function update_stock($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('parts_stock_tbl', $data);
			return ($update == true) ? true : false;
		}
	}
    public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ebike_parts_tbl');
			return ($delete == true) ? true : false;
		}
	}
	public function limit_product(){
		$query = $this->db->query("SELECT * FROM ebike_parts_tbl LIMIT 8;");
		return $query->result_array();
	}

	public function checkParts($name = null, $model = null)
    {
    	$this->db->where('name', $name);
		$this->db->where('model_id', $model);
		// $this->db->where('color_id', $color);
		$result = $this->db->get('ebike_parts_tbl');
		
        if ($result->num_rows() == 1) {
            return $result->row_array();
        }
         else 
        {
            return false;
        }
	}
	
	public function checkStock($parts_id = null, $color_id = null)
    {
    	$this->db->where('color_id', $color_id);
		$this->db->where('parts_id', $parts_id);
		// $this->db->where('color_id', $color);
		$result = $this->db->get('parts_stock_tbl');
		
        if ($result->num_rows() == 1) {
            return $result->row_array();
        }
         else 
        {
            return false;
        }
	}

	public function checkNeededStock($parts_id)
    {
    	// $this->db->where('color_id', $color_id);
		$this->db->where('parts_id', $parts_id);
		// $this->db->where('model_id', $model_id);
		$check = $this->db->get('parts_stock_tbl');
		
        if ($check->num_rows() == 1) {
            return $check->row_array();
        }
         else 
        {
            return false;
        }
	}
	
	public function update_image($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('parts_stock_tbl', $data);
			return ($update == true)? true : false;
	 }
	}
	public function update_image1($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_stock_tbl', $data);
			return ($update == true)? true : false;
	 }
	}
// get motor number by model id
	public function getMotorNumber($id = ''){
		if($id) {
			$sql = "SELECT * FROM motor_number WHERE model_id = ? AND status = 1 ";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
		$sql = "SELECT * FROM motor_number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
// get chasis number by model id
	public function getChasisNumber($id = ''){
		if($id) {
			$sql = "SELECT * FROM chasis_number WHERE model_id = ? AND status = 1 ";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
		$sql = "SELECT * FROM chasis_number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

// get motor number by model id
public function getMotorNumberById($id = ''){
	if($id) {
		$sql = "SELECT * FROM motor_number WHERE id = ? AND status = 1 ";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	$sql = "SELECT * FROM motor_number";
	$query = $this->db->query($sql);
	return $query->result_array();
}
// get chasis number by model id
public function getChasisNumberById($id = ''){
	if($id) {
		$sql = "SELECT * FROM chasis_number WHERE id = ? AND status = 1 ";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	$sql = "SELECT * FROM chasis_number";
	$query = $this->db->query($sql);
	return $query->result_array();
}

// update motor and chassis number 
public function updateMotorNumber($data, $id)
{
	if($data && $id) {
		$this->db->where('id', $id);
		$update = $this->db->update('motor_number', $data);
		return $update;
	}
}
public function updateChasisNumber($data, $id)
{
	if($data && $id) {
		$this->db->where('id', $id);
		$update = $this->db->update('chasis_number', $data);
		return $update;
	}
}

public function getPartsByColorModel($color, $model)
{
	// if($color && $model) {
		$sql = "SELECT * FROM parts_stock_tbl where color_id = ? AND model_id = ?";
		$query = $this->db->query($sql, array($color, $model));
		return $query->result_array();
	// }

	// $sql = "SELECT * FROM ebike_parts_tbl ORDER BY id DESC";
	// $query = $this->db->query($sql);
	// return $query->result_array();
}

public function getGenericParts($color = null, $model = null)
{
	// // if model is generic
    //  if($color == 0 && !$model == 0){
	// 	$sql = "SELECT * FROM parts_stock_tbl where color_id = ? And model_id = ?";
	// 	$query = $this->db->query($sql, array($color, $model));
	// 	return $query->result_array();			 
	//  }
	// // //  if color is generic
	//  if(!$color == 0 && $model == 0){
	// 	$sql = "SELECT * FROM parts_stock_tbl where color_id = ? And model_id = ?";
	// 	$query = $this->db->query($sql, array($color, $model));
	// 	return $query->result_array();			 
	//  }
	// //  if both color and model are generic
	//  if($color == 0 && $model == 0){
	// 	$sql = "SELECT * FROM parts_stock_tbl where color_id = ? And model_id = ?";
	// 	$query = $this->db->query($sql, array($color, $model));
	// 	return $query->result_array();			 
	//  }
	// //  no generic parts
	//  if($color && $model){
		$sql = "SELECT * FROM parts_stock_tbl where color_id = ? And model_id = ?";
		$query = $this->db->query($sql, array($color, $model));
		return $query->result_array();			 
	//  }
}


public function getNeededParts($id = null)
{
	if($id) {
		$sql = "SELECT * FROM ebike_needed_parts_tbl where model_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
}

// public function getSample()
// {
// 		$sql = "SELECT * FROM parts_stock_tbl where color_id = ? And model_id = ?";
// 		$query = $this->db->query($sql, array(0,0));
// 		return $query->result_array();	
// }


}