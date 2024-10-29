<?php

class Checkout_Model extends CI_Model{
     
     public function __construct(){
        parent::__construct();
        $this->load->Model('Checkout_Model');
        
        date_default_timezone_set("Asia/Manila");    
     }
     public function insert_order($data = null){
      $refNo = mt_rand(1,999999);
      
      if($data){
         $sales = array(
				'ref_no' => $refNo,
				'customer_id' => $this->session->userdata('customer_id'),
				'sales_from' => 2,
				'total_products' => count($this->cart->contents()),
				'total_amount' => $this->cart->total(),
				'amount_tentered' => $this->cart->total(),
				'sales_date' => date('M d, Y'),
				'sales_type' => 1
         );
         $this->db->insert('sales_tbl', $sales);
         $sales_id = $this->db->insert_id();
         

         $data = array(
            'ref_no' => $refNo,
            'sales_id' => $sales_id,
            'customer_id' => $this->session->userdata('customer_id'),
            'store_id' => $this->input->post('store_id'),
            'customer_name' => $this->session->userdata('customer_firstname').' '.$this->session->userdata('customer_lastname'),
            'customer_email' => $this->session->userdata('customer_email'),
            'order_date' => date('M d, Y'),
            'order_type' => 1,
            'total_products' => count($this->cart->contents()),
            'order_total' => $this->cart->total(),
            'payment_method' => $this->input->post('payment_method'),
            'payment_receipt' => $data['image'],
            'status' => 1
         );
         $insert = $this->db->insert('order_tbl',$data);
         $order_id = $this->db->insert_id();
         foreach($this->cart->contents() as $items){
             $col = $this->Checkout_Model->getColorData($items['options']['color']);
             if($col){
                $color = $col['color_name'];
             }
             else
             {
                $color = 'Generic';
             }
             $data = array(
                'order_id' => $order_id,
                'product_id' => $items['id'],
                'price'  => $items['price'],
                'order_quantity' => $items['qty'],
                'order_subtotal' => $items['subtotal'],
                'product_name' => $items['name'],
                'image' => $items['image'],
                'color' => $color   
             );

             $this->db->insert('order_items_parts_tbl',$data);
             
            //  decrease stock
            $parts = $this->Checkout_Model->getStockData($items['id']);

            $parts_qty = $parts['qty'] - $items['qty']; 
				$total = array(
					'qty' => $parts_qty,
				);
				$this->Checkout_Model->update_stock($total, $parts['id']);
            
         }
         return ($insert == true) ? true : false;
      }
     }

     public function insert_order1(){
      $refNo = mt_rand(1,999999);
      

         $sales = array(
				'ref_no' => $refNo,
				'customer_id' => $this->session->userdata('customer_id'),
				'sales_from' => 2,
				'total_products' => count($this->cart->contents()),
				'total_amount' => $this->cart->total(),
				'amount_tentered' => $this->cart->total(),
				'sales_date' => date('M d, Y'),
				'sales_type' => 1
         );
         $this->db->insert('sales_tbl', $sales);
         $sales_id = $this->db->insert_id();
         

         $data = array(
            'ref_no' => $refNo,
            'sales_id' => $sales_id,
            'customer_id' => $this->session->userdata('customer_id'),
            'store_id' => $this->input->post('store_id'),
            'customer_name' => $this->session->userdata('customer_firstname').' '.$this->session->userdata('customer_lastname'),
            'customer_email' => $this->session->userdata('customer_email'),
            'order_date' => date('M d, Y'),
            'order_type' => 1,
            'total_products' => count($this->cart->contents()),
            'order_total' => $this->cart->total(),
            'payment_method' => 'cashonpickup',
            'status' => 1
         );
         $insert = $this->db->insert('order_tbl',$data);
         $order_id = $this->db->insert_id();
         foreach($this->cart->contents() as $items){
             $col = $this->Checkout_Model->getColorData($items['options']['color']);
             if($col){
                $color = $col['color_name'];
             }
             else
             {
                $color = 'Generic';
             }
             $data = array(
                'order_id' => $order_id,
                'product_id' => $items['id'],
                'price'  => $items['price'],
                'order_quantity' => $items['qty'],
                'order_subtotal' => $items['subtotal'],
                'product_name' => $items['name'],
                'image' => $items['image'],
                'color' => $color   
             );

             $this->db->insert('order_items_parts_tbl',$data);
             
            //  decrease stock
            $parts = $this->Checkout_Model->getStockData($items['id']);

            $parts_qty = $parts['qty'] - $items['qty']; 
				$total = array(
					'qty' => $parts_qty,
				);
				$this->Checkout_Model->update_stock($total, $parts['id']);
            
         }
         return ($insert == true) ? true : false;

     }


   //   extra
   public function getStockData($id)
   {
         $sql = "SELECT * FROM parts_stock_tbl WHERE id = ?";
         $query = $this->db->query($sql, array($id));
         return $query->row_array();
   }

   public function update_stock($data, $id)
   {
      if($data && $id) {
         $this->db->where('id', $id);
         $update = $this->db->update('parts_stock_tbl', $data);
         return ($update == true) ? true : false;
      }
   }

   public function getColorData($id = null)
	{
			$sql = "SELECT * FROM ebike_color_tbl WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
   }
   
   public function getStoreData()
	{
			$sql = "SELECT * FROM store_tbl";
			$query = $this->db->query($sql);
			return $query->result_array();
   }

      
   public function getBankData($id = null)
	{
      if($id){
         $sql = "SELECT * FROM bank_account WHERE id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
      }
			$sql = "SELECT * FROM bank_account";
			$query = $this->db->query($sql);
			return $query->result_array();
   }

}