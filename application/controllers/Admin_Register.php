<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Register extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Register_Model');
        $this->load->model('Admin_Sales_Model');
        $this->load->model('Admin_Customer_Model');
    }

    public function pending()
	{
        $data['pending'] = count($this->Admin_Register_Model->getPendingData(0));
        $data['unclaimed'] = count($this->Admin_Register_Model->getUnclaimedData(0));
        $data['pages'] = 'register/pending';
        $this->load->view('admin/layout/templates',$data);
    }

    public function fetchAllPending(){
        $result = array('data' => array());

        $pending = $this->Admin_Register_Model->getPendingData(0);
       
        foreach($pending as $key=>$value){
           
            $sales = $this->Admin_Sales_Model->getSalesData($value['order_id']);
        $customer = ''; 
        $name = $this->Admin_Customer_Model->getCustomerData($sales['customer_id']);
        if($name){
          $customer = $name['customer_firstname'].' '. $name['customer_lastname'];
        }

         $buttons = '';
            $buttons .= '<a class="btn btn-outline-dark" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal"><i class="fa fa-check"></i></a>';	
            $buttons .= '<a href="'.base_url('Admin_Register/print/').$value['order_id'].'" class="btn btn-outline-dark" target="_blank"><i class="fa fa-print"></i></a>';
            // $buttons .= '<a href="#" class="btn btn-outline-dark"><i class="fa fa-trash"></i></a>';
        
        $result['data'][$key] = array(
         
            $value['order_id'],
            $value['product_name'],
            $value['color'],
            $value['chasis_number'],
            $value['motor_number'],
            $customer,
            $buttons,
            );
        }
        echo json_encode($result);
    }

    function complete(){
        $id = $this->input->post('id');
        $response = array();

        $data = array(
            'registration' => 1
        );
        $update = $this->Admin_Register_Model->update($data, $id);
        if($update == true){
            $this->session->set_flashdata('messages','Completed');
            $response['success'] = true;
        }
        else
        {
 
        }
    echo json_encode($response);
    }

    
    public function registered()
	{
        $data['pending'] = count($this->Admin_Register_Model->getPendingData(0));
        $data['unclaimed'] = count($this->Admin_Register_Model->getUnclaimedData(0));
        $data['pages'] = 'register/registered';
        $this->load->view('admin/layout/templates',$data);
    }

    public function fetchAllRegistered(){
        $result = array('data' => array());

        $registered = $this->Admin_Register_Model->getPendingData(1);
       
        foreach($registered as $key=>$value){
           
            $sales = $this->Admin_Sales_Model->getSalesData($value['order_id']);

        $name = $this->Admin_Customer_Model->getCustomerData($sales['customer_id']);
        if($name){
          $customer = $name['customer_firstname'].' '. $name['customer_lastname'];
        }

         $buttons = '';
         $disabled = '';
            if($value['claim'] == 1){ $disabled = 'disabled'; } else { $disabled = ''; }

            $buttons .= '<button class="btn btn-outline-dark" '.$disabled.' onclick="claim('.$value['id'].')" data-toggle="modal" data-target="#claimModal"><i class="fa fa-check"></i></button>';	
            // $buttons .= '<a href="'.base_url('Admin_Register/print/').$value['id'].'" class="btn btn-outline-dark" target="_blank"><i class="fa fa-print"></i></a>';
            // $buttons .= '<a href="#" class="btn btn-outline-dark"><i class="fa fa-trash"></i></a>';
        
        $status = ($value['claim'] == 1) ? '<span class="badge badge-success">Claimed</span>' : '<span class="badge badge-warning">Unclaimed</span>';
   

        $result['data'][$key] = array(
         
            $value['order_id'],
            $value['product_name'],
            $value['color'],
            $value['chasis_number'],
            $value['motor_number'],
            $customer,
            $status,
            $buttons,
            );
        }
        echo json_encode($result);
    }

    function claim(){
        $id = $this->input->post('id');
        $response = array();

        $data = array(
            'claim' => 1
        );
        $update = $this->Admin_Register_Model->update($data, $id);
        if($update == true){
            $this->session->set_flashdata('messages','Completed');
            $response['success'] = true;
        }
        else
        {
 
        }
    echo json_encode($response);
    }

    function getCustomerInfo(){
        $id = $this->input->post('id');

        $items_id = $this->Admin_Register_Model->getItem($id);
        $sales = $this->Admin_Register_Model->getSales($items_id['order_id']);
        $customer = $this->Admin_Register_Model->getCustomer($sales['customer_id']);

        echo json_encode($customer);
    }

    public function print($id){
        
            $sales = $this->Admin_Register_Model->getSales($id);
            $customer = $this->Admin_Customer_Model->getCustomerData($sales['customer_id']);
            $html = '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>

                 
                </head>
                <style>
                   .container{
                       min-height: 100vh;        
                   }
                   .row{
                       display: flex;
                       justify-content: center; 
                       margin-top:300px;
                       margin-bottom:300px;
                   }
                   img{
                       max-height: 400px;  
                   }
                   @media print {
                    @page { margin: 0; }
                    .row { page-break-after: always; }
                }
                </style>
                <body onload="window.print() ">
                    <div class="container">
                        <div class="row">
                            <div class="id_img" >
                            <img src="'.base_url($customer['customer_valid_id']).'" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="id_img" >
                            <img src="'.base_url($sales['purchase_form']).'" >
                            </div>
                        </div>
                    </div>
                </body>
            </html>';
            echo $html;
        }

}