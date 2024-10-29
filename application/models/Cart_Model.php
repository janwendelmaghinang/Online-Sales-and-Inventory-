<?php

class Cart_Model extends CI_Model{
     
     public function __construct(){
        parent::__construct();
     }
     public function getBranch(){
             $query = $this->db->query("SELECT * FROM store_tbl WHERE active = 1");
             return $query->result_array();
     }
     public function order($data){
             foreach($data as $datas){
                $order = array(
                        'customer_id' => $this->session->userdata('user_id'),
                        'order_grand_total' => $datas['order_price'],
                        'customer_name' => $datas['customer_name'],
                        'customer_contact' => $datas['user_contact'],
                        'status' => 0
                );
             }
            $query = $this->db->insert('online_order', $order);
             return $query?$this->db->insert_id():false;
     }
     public function orderItems($order_item){
             $datas = array(
               'order_id' => $order_item['order_id'],
               'parts_id' =>  $order_item['parts_id'],
               'parts_name' => $order_item['order_name'],
               'stock_model' => $order_item['stock_model'],
               'order_quantity' =>  $order_item['order_qty'],
               'order_subtotal' =>  $order_item['subtotal'],
               'order_status' => $order_item['order_status'],
               'parts_image' => $order_item['parts_image'],
               'status' => 0
             );
             $query = $this->db->insert('online_order_items', $datas);
             return $query;
     }
     public function insertSales($order_items){
        $datas = array(
                'sales_customer' => $order_items['customer_name'],
                'sales_item' =>  $order_items['order_name'],
                'sales_total' => $order_items['order_subtotal'],
                'sales_date' =>   date("Y/m/d"),
                'sales_store' =>  $order_items['store']
        );
              $query = $this->db->insert('online_sales', $datas);
              return $query;
     }

public function pending($topay = ''){
        $query = $this->db->query("SELECT * FROM online_order_items WHERE order_id = $topay AND status = 0");
        return $query->result_array();
}

public function getOrderId(){
        $query = $this->db->query("SELECT * FROM online_order");
        return $query->result_array();
}
public function getAllOrder(){
        $user = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM online_order_items
        inner JOIN online_order ON online_order_items.order_id = online_order.order_id WHERE online_order_items.status = 1 AND online_order.customer_id = $user");
        return $query->result_array();   
}

// check stocks 
public function checkStocks($stock){
        $model = $stock['stock_model'];
        $name = $stock['order_name'];

        $query = $this->db->query("SELECT * FROM parts_stock_tbl WHERE stock_model = '$model' AND  stock_name = '$name' " );
        return $query->result_array();
}

// update order

public function update_order($order_place = ''){
        $payment = $order_place['payment_method'];
        $store = $order_place['store'];
        $order_date = $order_place['order_date'];
        $order_id = $order_place['order_id'];
        $status = $order_place['status'];  

        $query = $this->db->query("UPDATE online_order SET store = '$store', payment_method = '$payment', order_date = '$order_date', status = '$status', payment_receipt = 'none'  WHERE  order_id = '$order_id'");
        return $query;
}
// update order items
public function get_order_items($id = ''){
        $query = $this->db->query("SELECT * FROM online_order_items WHERE order_id = '$id'");
        return $query->result_array();
}

public function update_order_items($order_items = ''){
        $order_id = $order_items['order_id'];
        $order_status = $order_items['order_status'];
        $status = $order_items['status'];
        
        $query = $this->db->query("UPDATE online_order_items SET order_status = '$order_status', status = '$status' WHERE  order_id = '$order_id' ");
        return $query;
}

// less order in stock
public function updatePartsStock($order_items = ''){
        $order_quantity = $order_items['order_quantity'];
        $order_name = $order_items['order_name'];
        $order_model = $order_items['stock_model'];
        
        $query = $this->db->query("UPDATE parts_stock_tbl SET stock_quantity = stock_quantity - $order_quantity WHERE  stock_model = '$order_model' AND stock_name = '$order_name'");
        return $query;
}
public function updatePartsStockCancelled($stock){
        $order_quantity = $stock;
        $order_name = $stock;
        $order_model = $stock;
        
        $query = $this->db->query("UPDATE parts_stock_tbl SET stock_quantity = stock_quantity  - $order_quantity WHERE stock_name = $order_name AND stock_model = '$order_model'");
        return $query;
}
public function cancelOrder($id = ''){
           $user = $this->session->userdata('user_id');
           $query = $this->db->query("UPDATE online_order SET status = 0, order_status = 'cancelled' WHERE order_id = $id");
           return $query;
     }

}