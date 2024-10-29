<?php

class Admin_Ebike_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->model('Admin_Spareparts_Model');
    }
    public function getEbikeData($id = null)
	{
			$sql = "SELECT * FROM ebike_model_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
	}
	
	public function getStockData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_stock_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_stock_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getEbikeStockItems($id = null)
	{
		$sql = "SELECT * FROM ebike_stock_items Where ebike_stock_id = ? AND status = ? ";
		$query = $this->db->query($sql, array($id,1));
		return $query->result_array();
	}
	public function getEbikeStockItemsRow($id = null)
	{
		$sql = "SELECT * FROM ebike_stock_items Where id = ? AND status = ? ";
		$query = $this->db->query($sql, array($id,1));
		return $query->row_array();
	}

	
	public function addStock($data)
	{
		if($data) {
			$insert = $this->db->insert('ebike_stock_tbl', $data);
            return $insert;
		}
	}
	
    public function insertEbike($data)
	{
		if($data) {
			$insert = $this->db->insert('ebike_unit_tbl', $data);
			$insert_id = $this->db->insert_id();

			if($insert_id){
				$data_specs = array(
					'ebike_id' => $insert_id,
					'motor_type' => $this->input->post('motor_type'),
					'rated_voltage' => $this->input->post('rated_voltage'),
					'max_speed' => $this->input->post('max_speed'),
					'distance_full' => $this->input->post('distance_full'),
					'charging_time' => $this->input->post('charging_time'),
					'max_load' => $this->input->post('max_load'),
				);
			    $this->db->insert('ebike_specification_tbl', $data_specs);
			}
			return ($insert_id) ? $insert_id : false;
		}
	}

    public function updateModel($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_model_tbl', $data);
			return ($update == true) ? true : false;
		}
    }
    public function removeModel($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ebike_unit_tbl');
			return ($delete == true) ? true : false;
		}
	}
	
	public function checkStock($model_id = null, $color_id = null)
    {
    	$this->db->where('color_id', $color_id);
		$this->db->where('model_id', $model_id);
		// $this->db->where('color_id', $color);
		$result = $this->db->get('ebike_stock_tbl');
		
        if ($result->num_rows() == 1) {
            return $result->row_array();
        }
         else 
        {
            return false;
        }
	}
    
    public function checkModel($model)
    {
        $this->db->where('model_name', $model);

        $result = $this->db->get('ebike_unit_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->model_name;
        }
         else 
        {
            return false;
        }
	}

	public function getNeededPartsData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_needed_parts_tbl WHERE model_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
		$sql = "SELECT * FROM ebike_needed_parts_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getSparepartsByIdArray($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_parts_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}
	
	public function getSparepartsByModelId($id)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_parts_tbl where model_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}


	public function getEbikeSpecsData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_specification_tbl WHERE model_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_specification_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
	
	public function updateSetModel($id, $set){
		if($id && $set){
			$update = $this->db->query("UPDATE ebike_unit_tbl SET set_model = '$set' WHERE id = '$id'");
			return ($update == true) ? true : false;
		}
	}

	// production

// get production with unset serial
	public function getProductionUnsetSerial($id)
	{
		// if($id) {
			$sql = "SELECT * FROM ebike_production_tbl WHERE status = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		// }
	}

	// result array
	public function getProductionData($id = null)
	{
		// if($id) {
			$sql = "SELECT * FROM ebike_production_tbl WHERE status = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		// }
		// $sql = "SELECT * FROM ebike_production_tbl ORDER BY id ASC";
		// $query = $this->db->query($sql);
		// return $query->result_array();
	}
 
	// row array
	public function getProductionData1($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_production_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}
	
	// get production qty

	public function getProductionQuantity($id){
		if($id) {
			$sql = "SELECT * FROM ebike_production_items WHERE production_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}

	public function getProductionItems($id){
		if($id) {
			$sql = "SELECT * FROM ebike_production_items WHERE production_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}

	public function getProductionByIdData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_production_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_production_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
	
	public function Production($data){
		if($data) {
			$insert = $this->db->insert('ebike_production_tbl', $data);
			$insert_id = $this->db->insert_id();
			
			$qty = $this->input->post('qty');
			$data1 = array(
			  'production_id' => $insert_id, 
			  'ebike_stock_id' =>$data['ebike_stock_id']
			);
			for($i = 0; $i < $qty; $i++){	
			$this->db->insert('ebike_production_items', $data1);
			}
			
            return ($insert == true) ? true : false;
		}
	}

	public function setSerialNumber($id = null){
      if($id){
		
		for($i = 0; $i < count($this->input->post('motor_number')); $i++){

			$motor_number_id = $this->input->post('motor_number')[$i];
			$motor_number_name = $this->Admin_Spareparts_Model->getMotorNumberById($motor_number_id);

			$chasis_number_id = $this->input->post('chasis_number')[$i];
			$chasis_number_name = $this->Admin_Spareparts_Model->getChasisNumberById($chasis_number_id);

			$data = array(
				'motor_number' => $motor_number_name['motor_number'],
				'chasis_number' => $chasis_number_name['chasis_number'],
                'set_serial' => 1
			);

			$this->db->where('id', $this->input->post('item_id')[$i]);
			$this->db->where('production_id', $id);
			$setSerial = $this->db->update('ebike_production_items', $data);

			// // update motor and chasis number
			
			$n = array(
				'status' => 0,
			);
			$this->Admin_Spareparts_Model->updateMotorNumber($n, $motor_number_id);
			$this->Admin_Spareparts_Model->updateChasisNumber($n, $chasis_number_id);

		}
		if($setSerial){
			$data1 = array(
				'set_serial' => 1
			);

			$this->db->where('id', $id);
			$this->db->update('ebike_production_tbl', $data1);
			}

		return ($setSerial== true) ? true : false;

	  }
	}

	public function productionCompleted($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_production_tbl', $data);
			return ($update == true) ? true : false;
		}
	}

	// add ebike stock items
	
	public function addEbikeStockItems($id = null){
		if($id){
			$production = $this->Admin_Ebike_Model->getProductionItems($id);
			foreach($production as $stock){
			$data = array(
			   'ebike_stock_id' => $stock['ebike_stock_id'],
			   'chasis_number' => $stock['chasis_number'],
			   'motor_number' => $stock['motor_number'],
			   'status' => 1
			);
            $this->db->insert('ebike_stock_items', $data);
	
			}
		}
	}

    	public function productionCancelled($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_production_tbl', $data);
			return ($update == true) ? true : false;
		}
	}
	
	// pos ebike

	public function getEbikeByColorModel($color, $model){
		$sql = "SELECT * FROM ebike_stock_tbl WHERE color_id = ? AND model_id = ?";
		$query = $this->db->query($sql, array($color, $model));
		return $query->row_array();
	}
}