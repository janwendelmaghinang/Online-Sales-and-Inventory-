<?php

class Admin_Pos_Model extends CI_Model{
    public function __construct()
    {
		parent:: __construct();
		$this->load->model('Admin_Spareparts_Model');
		$this->load->model('Admin_Model_Model');
		$this->load->model('Admin_Ebike_Model');
		$this->load->model('Admin_Company_Model');
		date_default_timezone_set("Asia/Manila");
    }


    public function getSalesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM sales_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM sales_tbl";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	// for parts
	public function getSalesItemData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM order_items_parts_tbl WHERE order_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}
	// for ebike
	public function getSalesItemData1($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM order_items_ebike_tbl WHERE order_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}

    
    function getSalesByRefNoData($ref_no){
        $sql = "SELECT * FROM sales_tbl WHERE ref_no = ?";
        $query = $this->db->query($sql, array($ref_no));
        return $query->result_array();
    }
    
    public function insertSales($info)
	{
		if($info) {
            $data = array(
				'ref_no' => $info['ref_no'],
				'customer_id' => $info['customer_id'],
				'sales_from' => 1,
				'total_products' => count($this->input->post('prod_id')),
				'gross_amount' => $this->input->post('gross_amount'),
				'vatable' => $this->input->post('vatable'),
				'vat_charge_rate' => $this->input->post('vat_charge_value'),
				'vat_charge' => $this->input->post('vat_charge'),
				'discount' => $info['discount'],
				'total_amount' => $this->input->post('net_amount'),
				'amount_tentered' => $this->input->post('payment_amount_tentered'),
				'amount_change' => $this->input->post('payment_change'),
				'sales_date' => date('M d, Y'),
				'user_id' => $this->session->userdata('users_id'),
				'sales_type' => 1
			);
			$insert = $this->db->insert('sales_tbl', $data);
			$insert_id = $this->db->insert_id();

			// insert itemss 
            for($i = 0; $i < count($this->input->post('prod_id')); $i++ ){
				$items = array(
					'order_id' => $insert_id,
					'product_id' => $this->input->post('prod_id')[$i],
					'price' => $this->input->post('prod_price')[$i],
					'product_name' => $this->input->post('prod_name')[$i],
					'order_or_sales' => 2,
					'order_quantity' => $this->input->post('prod_qty')[$i],
					'order_subtotal' => $this->input->post('prod_total_amount')[$i],
				);
				$this->db->insert('order_items_parts_tbl', $items);
			}
			
			// decrease parts stock

            for($j = 0; $j < count($this->input->post('prod_id')); $j++ ){
				$id = $this->input->post('prod_id')[$j];
				// get parts stock
				$parts = $this->Admin_Spareparts_Model->getStockData($id);

				// decrease parts qty
				$parts_qty = $parts['qty'] - $this->input->post('prod_qty')[$j]; 
				$data = array(
					'qty' => $parts_qty,
				);
				$this->Admin_Spareparts_Model->update_stock($data, $id);
			}
		    return $insert_id;
		}
    }
	
	public function insertSalesEbike($info)
	{
		if($info) {
            $data = array(
				'ref_no' => $info['ref_no'],
				'customer_id' => $info['customer_id'],
				'sales_from' => 1,
				'total_products' => count($this->input->post('prod_id')),
				'gross_amount' => $this->input->post('gross_amount'),
				'vatable' => $this->input->post('vatable'),
				'vat_charge_rate' => $this->input->post('vat_charge_value'),
				'vat_charge' => $this->input->post('vat_charge'),
				'discount' => $info['discount'],
				'total_amount' => $this->input->post('net_amount'),
				'amount_tentered' => $this->input->post('payment_amount_tentered'),
				'amount_change' => $this->input->post('payment_change'),
				'sales_date' => date('M d, Y'),
				'purchase_form' => $info['purchase_form'],
				'user_id' => $this->session->userdata('users_id'),
				'sales_type' => 2
			);
			$insert = $this->db->insert('sales_tbl', $data);
			$insert_id = $this->db->insert_id();

			// insert itemss 
			$motor_war_end = '';
			$service_war_end = '';
            for($i = 0; $i < count($this->input->post('stock_ebike_id')); $i++ ){
				$ebike_stock = $this->Admin_Ebike_Model->getEbikeStockItemsRow($this->input->post('stock_ebike_id')[$i]);
			     	                                               
				$getStock = $this->Admin_Ebike_Model->getStockData($ebike_stock['ebike_stock_id']);
				
				$getModel = $this->Admin_Model_Model->getModelData($getStock['model_id']);

                // motor warranty
				if($this->input->post('motor_war_month')[$i] == 0 && $this->input->post('motor_war_year')[$i] == 0){
					$motor_war_end = 'none';
				}
				if(!$this->input->post('motor_war_month')[$i] == 0 && !$this->input->post('motor_war_year')[$i] == 0){
					$m =  $this->input->post('motor_war_month')[$i];
					$y =  $this->input->post('motor_war_year')[$i];
					$motor_war_end = date('M d, Y', strtotime('+'.$m. 'month +'.$y.' year'));
				}
				if(!$this->input->post('motor_war_month')[$i] == 0 && $this->input->post('motor_war_year')[$i] == 0){
					$m =  $this->input->post('motor_war_month')[$i];
					$motor_war_end = date('M d, Y', strtotime('+'.$m. 'month'));
				}
				if($this->input->post('motor_war_month')[$i] == 0 && !$this->input->post('motor_war_year')[$i] == 0){
					$y =  $this->input->post('motor_war_year')[$i];
					$motor_war_end = date('M d, Y', strtotime('+'.$y. 'year'));
				}
				// service warranty

				if($this->input->post('service_war_month')[$i] == 0 && $this->input->post('service_war_year')[$i] == 0){
					$service_war_end = 'none';
				}
				if(!$this->input->post('service_war_month')[$i] == 0 && !$this->input->post('service_war_year')[$i] == 0){
					$m1 =  $this->input->post('service_war_month')[$i];
					$y1 =  $this->input->post('service_war_year')[$i];
					$service_war_end = date('M d, Y', strtotime('+'.$m1. 'month +'.$y1.' year'));
				}
				if(!$this->input->post('service_war_month')[$i] == 0 && $this->input->post('service_war_year')[$i] == 0){
					$m1 =  $this->input->post('service_war_month')[$i];
					$service_war_end = date('M d, Y', strtotime('+'.$m1. 'month'));
				}
				if($this->input->post('service_war_month')[$i] == 0 && !$this->input->post('service_war_year')[$i] == 0){
					$y1 =  $this->input->post('service_war_year')[$i];
					$service_war_end = date('M d, Y', strtotime('+'.$y1. 'year'));
				}
				$war_start = date('M d, Y');
		
				$items = array(
					'order_id' => $insert_id,
					'color' => $this->input->post('ebike_colors')[$i],
					'product_name' => $this->input->post('prod_name')[$i],
					'order_or_sales' => 2,
					'ebike_stock_id' => $ebike_stock['ebike_stock_id'],
					'chasis_number' => $ebike_stock['chasis_number'],
					'motor_number' => $ebike_stock['motor_number'],
					'warranty_start' => $war_start,
					'motor_warranty_end' => $motor_war_end,
					'service_warranty_end' => $service_war_end,
					'registration' => 0,
					'product_id' => $getModel['id'],
					'price' => $getModel['price'],
					// 'order_subtotal' => $this->input->post('prod_total_amount')[$i],
				);
				$this->db->insert('order_items_ebike_tbl', $items);

				// decrease ebike stock
				$id = $this->input->post('stock_ebike_id')[$i];  
				$this->Admin_Model_Model->updateStockEbike($id, array('status'=>2));
			}
		    return $insert_id;
		}
    }
	
	public function insertOrder($info)
	{
		if($info) {
            $data = array(
				'ref_no' => $info['ref_no'],
				'customer_id' => $info['customer_id'],
				'order_type' => 2,
				'total_products' => count($this->input->post('prod_id')),
				// 'gross_amount' => $this->input->post('gross_amount'),
				'vatable' => $this->input->post('vatable'),
				'vat_charge_rate' => $this->input->post('vat_charge_value'),
				'vat_charge' => $this->input->post('vat_charge'),
				'discount' => $info['discount'],
				'total_amount' => $this->input->post('net_amount'),
				// 'amount_tentered' => $this->input->post('payment_amount_tentered'),
				// 'amount_change' => $this->input->post('payment_change'),
				'order_date' => date('M d, Y'),
				// 'user_id' => $this->session->userdata('users_id'),
			);
			$insert = $this->db->insert('order_tbl', $data);
			$insert_id = $this->db->insert_id();

			// insert itemss 
            for($i = 0; $i < count($this->input->post('prod_id')); $i++ ){
				$items = array(
					'order_id' => $insert_id,
					'product_id' => $this->input->post('prod_id')[$i],
					'product_name' => $this->input->post('prod_name')[$i],
					'order_or_sales' => 1,
					'order_quantity' => $this->input->post('prod_qty')[$i],
					'order_subtotal' => $this->input->post('prod_total_amount')[$i],
				);
				$this->db->insert('order_items_tbl', $items);
			}
			
			// decrease parts stock

            for($j = 0; $j < count($this->input->post('prod_id')); $j++ ){
				$id = $this->input->post('prod_id')[$j];
				// get parts stock
				$parts = $this->Admin_Spareparts_Model->getStockData($id);

				// decrease parts qty
				$parts_qty = $parts['qty'] - $this->input->post('prod_qty')[$j]; 
				$data = array(
					'qty' => $parts_qty,
				);
				$this->Admin_Spareparts_Model->update_stock($data, $id);
			}
		    return $insert_id;
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
			$delete = $this->db->delete('ebike_model_tbl');
			return ($delete == true) ? true : false;
		}
    }
    
    public function checkModel($model)
    {
        $this->db->where('model_name', $model);

        $result = $this->db->get('ebike_model_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->model_name;
        }
         else 
        {
            return false;
        }
	}
	
	public function updateSetModel($id, $set){
		if($id && $set){
			$update = $this->db->query("UPDATE ebike_model_tbl SET set_model = '$set' WHERE id = '$id'");
			return ($update == true) ? true : false;
		}
    }
    
    public function getOrderById($id = null)
	{

		$sql = "SELECT * FROM order_items_tbl where order_id = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
}