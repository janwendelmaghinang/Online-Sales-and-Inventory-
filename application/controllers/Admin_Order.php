<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Order extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Order_Model');
        $this->load->model('Admin_Spareparts_Model');
    }

    public function index()
	{
        $data['pages'] = 'order/index';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllPendingOrderData(){

        $result = array('data' => array());

        $orders = $this->Admin_Order_Model->getOnlineOrderData(1);
        foreach($orders as $key=>$value){

         $buttons = '';
            $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Order/view/').$value['id'].'">View</a>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="ready('.$value['id'].')" data-toggle="modal" data-target="#readyModal">Ready</button>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
         
        $result['data'][$key] = array(
            $value['id'],
            $value['customer_name'],
            $value['order_date'],
            $value['total_products'],
            $this->cart->format_number($value['order_total']),
            $value['payment_method'],
            'Preparing',
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function update(){
        $id = $this->input->post('id');
        $status =   $this->input->post('status');
        $response = array();

        if($id){
            $data = array(
               'status' => $status
            );
            $order = $this->Admin_Order_Model->getOrderData($id);
            $customer = $this->Admin_Order_Model->getCustomerData($order['customer_id']);
            $response['email'] = $customer['customer_email'];
            $update = $this->Admin_Order_Model->update($data, $id);
            if($update){
                $response['messages'] = 'Successfully Updated.';
                $response['success'] = true;
            }
            else 
            {
                $response['messages'] = 'Something went wrong!';
                $response['success'] = false;
            }
        }
        else
        {
            $response['messages'] = 'Something went wrong!';
            $response['success'] = false;
        }

        echo json_encode($response);
    }

    public function ready()
	{
        $data['pages'] = 'order/index1';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllReadyOrderData(){

        $result = array('data' => array());

        $orders = $this->Admin_Order_Model->getOnlineOrderData(2);
        foreach($orders as $key=>$value){

         $buttons = '';
            $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Order/view/').$value['id'].'">View</a>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Complete</button>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
            

        $result['data'][$key] = array(
            $value['id'],
            $value['customer_name'],
            $value['order_date'],
            $value['total_products'],
            $this->cart->format_number($value['order_total']),
            $value['payment_method'],
            'Ready',
            $buttons,
            );
        }
        echo json_encode($result);
    }
    
    public function update1(){
        $id = $this->input->post('id');
        $status =   $this->input->post('status');
        $response = array();

        if($id){
            $data = array(
               'status' => $status
            );
            $order = $this->Admin_Order_Model->getOrderData($id);
            $customer = $this->Admin_Order_Model->getCustomerData($order['customer_id']);
            $response['email'] = $customer['customer_email'];
            $update = $this->Admin_Order_Model->update($data, $id);
            if($update){
                $response['messages'] = 'Successfully Updated.';
                $response['success'] = true;
            }
            else 
            {
                $response['messages'] = 'Something went wrong!';
                $response['success'] = false;
            }
        }
        else
        {
            $response['messages'] = 'Something went wrong!';
            $response['success'] = false;
        }

        echo json_encode($response);
    }

    
    public function completed()
	{
        $data['pages'] = 'order/index2';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllCompletedOrderData(){

        $result = array('data' => array());

        $orders = $this->Admin_Order_Model->getOnlineOrderData(3);
        foreach($orders as $key=>$value){

         $buttons = '';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="ready('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Complete</button>';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
            $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Order/view/').$value['id'].'">View</a>';

        $result['data'][$key] = array(
            $value['id'],
            $value['customer_name'],
            $value['order_date'],
            $value['total_products'],
            $this->cart->format_number($value['order_total']),
            $value['payment_method'],
            'Completed',
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function update2(){
        $id = $this->input->post('id');
        $status =   $this->input->post('status');
        $response = array();

        if($id){
            $data = array(
               'status' => $status
            );
            $update = $this->Admin_Order_Model->update($data, $id);
            if($update){
                $response['messages'] = 'Successfully Updated.';
                $response['success'] = true;
            }
            else 
            {
                $response['messages'] = 'Something went wrong!';
                $response['success'] = false;
            }
        }
        else
        {
            $response['messages'] = 'Something went wrong!';
            $response['success'] = false;
        }

        echo json_encode($response);
    }
    
    public function cancelled()
	{
        $data['pages'] = 'order/index3';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllCancelledOrderData(){

        $result = array('data' => array());

        $orders = $this->Admin_Order_Model->getOnlineOrderData(4);
        foreach($orders as $key=>$value){

         $buttons = '';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="ready('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Complete</button>';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
            $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Order/view/').$value['id'].'">View</a>';

        $result['data'][$key] = array(
            $value['id'],
            $value['customer_name'],
            $value['order_date'],
            $value['total_products'],
            $this->cart->format_number($value['order_total']),
            $value['payment_method'],
            'Cancelled',
            $buttons,
            );
        }
        echo json_encode($result);
    }

    
    public function createorder()
	{
        $data['pages'] = 'order/create';
        $this->load->view('admin/layout/templates',$data);
    }

    public function view($id){
        if($id){
            $data['order'] = $this->Admin_Order_Model->getOrderData($id); 
            $data['pages'] = 'order/view';
            $this->load->view('admin/layout/templates',$data);
        }
        else 
        {
            redirect('Admin_Dashboard');
        }
    }

    public function viewOrder($id){
       if($id){   
        $result = array('data' => array());

        $orders = $this->Admin_Order_Model->getOrderById($id);
        foreach($orders as $key=>$value){
 
        $result['data'][$key] = array(
            $value['product_id'],
            $value['product_name'],
            $value['order_quantity'],
            $this->cart->format_number($value['order_subtotal']),
            );
        }
       }
       echo json_encode($result);
    }

}