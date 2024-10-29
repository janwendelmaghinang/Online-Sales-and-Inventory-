<?php

class Admin_Model_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->model('Admin_Spareparts_Model');
    }

    public function getModelData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ebike_model_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_model_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	// get stock quanttity
	public function getStockQuantity($id = null){
		if($id) {
			$sql = "SELECT * FROM ebike_stock_items WHERE ebike_stock_id = ? AND status = ?";
			$query = $this->db->query($sql, array($id,1));
			return $query->result_array();
		}
		$sql = "SELECT * FROM ebike_stock_items";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
    
    public function insertModel($data)
	{
		if($data) {
			$insert = $this->db->insert('ebike_model_tbl', $data);
			$insert_id = $this->db->insert_id();
			if($insert_id){
				$data_specs = array(
					'model_id' => $insert_id,
					'description' => $this->input->post('description'),
					'motor_type' => $this->input->post('motor_type'),
					'rated_voltage' => $this->input->post('rated_voltage'),
					'max_speed' => $this->input->post('max_speed'),
					'distance_full' => $this->input->post('distance_full'),
					'charging_time' => $this->input->post('charging_time'),
					'max_load' => $this->input->post('max_load'),
				);
			    $this->db->insert('ebike_specification_tbl', $data_specs);
			}
			return ($insert == true) ? true : false;
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
	
	public function getNeededPartsData($id, $parts_id)
	{
		if($id && $parts_id) {
			$query = $this->db->query("SELECT * FROM ebike_needed_parts_tbl where model_id = $id and parts_id = $parts_id");
			return $query->row_array();
		}
		$sql = "SELECT * FROM ebike_needed_parts_tbl ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    public function updateModel($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_model_tbl', $data);

			if($update){
				$data_specs = array(
					'model_id' => $id,
					'description' => $this->input->post('description'),
					'motor_type' => $this->input->post('motor_type'),
					'rated_voltage' => $this->input->post('rated_voltage'),
					'max_speed' => $this->input->post('max_speed'),
					'distance_full' => $this->input->post('distance_full'),
					'charging_time' => $this->input->post('charging_time'),
					'max_load' => $this->input->post('max_load'),
				);
				$this->db->where('model_id', $id);
				$this->db->update('ebike_specification_tbl', $data_specs);
			}

			return ($update == true) ? true : false;
		}
    }
    public function removeModel($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ebike_model_tbl');
			return ($delete == true) ? true : false;
		}
    }
    
    public function checkModel($model)
    {
        $this->db->where('name', $model);
		// $this->db->where('color_id', $color);

        $result = $this->db->get('ebike_model_tbl');
        if ($result->num_rows() == 1) {
            return $result->row_array();
        }
         else 
        {
            return false;
        }
	}
	
	public function updateSetModel($id, $data){
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ebike_model_tbl', $data);
			
			if($update){
				for($i = 0; $i < count($this->input->post('parts_id')); $i++){
					$data1 = array(
						"parts_id" => $this->input->post('parts_id')[$i],
						"model_id" => $id
					);
					$this->db->insert('ebike_needed_parts_tbl', $data1);
				}
			}

			return $update;
		}
	}

	public function updateStockEbike($id,$data){
		$this->db->where('id', $id);
		$update = $this->db->update('ebike_stock_items', $data);
	}

}