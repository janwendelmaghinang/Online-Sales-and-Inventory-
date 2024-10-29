<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Pullout extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Admin_Pullout_Model');
        $this->load->Model('Admin_Amortization_Model');
        $this->load->Model('Admin_Spareparts_Model');
        $this->load->Model('Admin_Customer_Model');
        $this->load->Model('Admin_Color_Model');
        $this->load->Model('Admin_Model_Model');
        $this->load->Model('Admin_Company_Model');
        $this->load->Model('Admin_Pos_Model');
        $this->load->Model('Admin_Installment_Model');
        date_default_timezone_set("Asia/Manila");
    }

    public function index()
	{
        $data['pages'] = 'pullout/index';
        $this->load->view('admin/layout/templates',$data);
    }

    public function fetchPullout(){
        $result = array('data' => array());

        $loan = $this->Admin_Pullout_Model->getPullout(3, 4 , 1);
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);

         $buttons = '';
                $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Complete</button>';
                $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
    
        $result['data'][$key] = array(
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            '<span class=" badge badge-warning">Pending</span>',
            $buttons
            );
        }
        echo json_encode($result);
    }

    public function complete(){
        $id = $this->input->post('id');
        $response = array();

        if($id){
            $data = array(
               'pullout_status' => 2
            );
            $update = $this->Admin_Pullout_Model->pullout_update($data, $id);
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
    
    public function cancel(){
        $id = $this->input->post('id');
        $response = array();

        if($id){
            $data = array(
               'paid_status' => 2,
               'pullout_status' => 3
            );
            $update = $this->Admin_Pullout_Model->pullout_update($data, $id);
            if($update){
                $response['messages'] = 'Successfully Cancelled.';
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
        $data['pages'] = 'pullout/index1';
        $this->load->view('admin/layout/templates',$data);
    }

    public function fetchCompleted(){
        $result = array('data' => array());

        $loan = $this->Admin_Pullout_Model->getPullout(3, 4 , 2);
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);

         $buttons = '';
                $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Complete</button>';
                $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
    
        $result['data'][$key] = array(
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            '<span class=" badge badge-warning">Pending</span>',
            $buttons
            );
        }
        echo json_encode($result);
    }
     
    public function cancelled()
	{
        $data['pages'] = 'pullout/index2';
        $this->load->view('admin/layout/templates',$data);
    }

    public function fetchCancelled(){
        $result = array('data' => array());

        $loan = $this->Admin_Pullout_Model->getPullout(3, 2 , 3);
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);

         $buttons = '';
                $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Complete</button>';
                $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
    
        $result['data'][$key] = array(
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            '<span class=" badge badge-warning">Pending</span>',
            $buttons
            );
        }
        echo json_encode($result);
    }


}