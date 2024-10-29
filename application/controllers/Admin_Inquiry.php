<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Inquiry extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Inquiry_Model');
        $this->load->model('Admin_Spareparts_Model');
        date_default_timezone_set("Asia/Manila");
    }

    public function index()
	{
        $data['pages'] = 'inquiry/index';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllPendingInquiryData(){

        $result = array('data' => array());

        $inquiry = $this->Admin_Inquiry_Model->getOnlineInquiryData(1);
        foreach($inquiry as $key=>$value){

         $buttons = '';
            // $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Order/view/').$value['id'].'">View</a>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="callnow('.$value['id'].')" data-toggle="modal" data-target="#callnowModal">Call Now</button>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
            
         $store = '';
            $a = $this->Admin_Inquiry_Model->getStoreData($value['store_id']);
            $store = $a['store_name'];
         $model = '';
            $b = $this->Admin_Inquiry_Model->getModelData($value['model_id']);
            $model = $b['name'];
         $color = '';
            $c = $this->Admin_Inquiry_Model->getColorData($value['color_id']);
            $color = $c['color_name'];
         $status = 'Waiting';
         
         $payment = '';
            if( $value['payment_option'] == 1){
                $payment = 'Cash';
            }
            else
            {
                $payment = 'Installment';
            }
         $result['data'][$key] = array(
            $value['id'],
            $value['customer_firstname'].' '.$value['customer_lastname'],
            $value['date_of_inquiry'],
            $store,
            $payment,
            $model,
            $color,
            $status,
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function update(){
        $id = $this->input->post('id');
        $status =  $this->input->post('status');
        $date = $this->input->post('date');
        $response = array();

        if($id){
            $data = array(
               'status' => $status,
                $date => date('M d, Y') 
            );
            $update = $this->Admin_Inquiry_Model->update($data, $id);
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

    public function responded()
	{
        $data['pages'] = 'inquiry/index1';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllRespondedInquiryData(){

        $result = array('data' => array());

        $inquiry = $this->Admin_Inquiry_Model->getRespondedInquiryData(2);
        foreach($inquiry as $key=>$value){

         $buttons = '';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="callnow('.$value['id'].')" data-toggle="modal" data-target="#callnowModal">Call Now</button>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Completed</button>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
            
         $store = '';
            $a = $this->Admin_Inquiry_Model->getStoreData($value['store_id']);
            $store = $a['store_name'];
         $model = '';
            $b = $this->Admin_Inquiry_Model->getModelData($value['model_id']);
            $model = $b['name'];
         $color = '';
            $c = $this->Admin_Inquiry_Model->getColorData($value['color_id']);
            $color = $c['color_name'];
        
            $status = 'Responded';
         
         $payment = '';
            if( $value['payment_option'] == 1){
                $payment = 'Cash';
            }
            else
            {
                $payment = 'Installment';
            }
         $result['data'][$key] = array(
            $value['id'],
            $value['customer_firstname'].' '.$value['customer_lastname'],
            $value['date_approved'],
            $store,
            $payment,
            $model,
            $color,
            $status,
            $buttons,
            );
        }
        echo json_encode($result);
    }
    public function update1(){
        $id = $this->input->post('id');
        $status =   $this->input->post('status');
        $date =   $this->input->post('date');
        
        $response = array();

        if($id){
            $data = array(
               'status' => $status,
               $date => date('M d, Y') 
            );
            $update = $this->Admin_Inquiry_Model->update1($data, $id);
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
        $data['pages'] = 'inquiry/index2';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllCompletedInquiryData(){

        $result = array('data' => array());

        $inquiry = $this->Admin_Inquiry_Model->getCompletedInquiryData(3);
        foreach($inquiry as $key=>$value){

         $buttons = '';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="callnow('.$value['id'].')" data-toggle="modal" data-target="#callnowModal">Call Now</button>';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Completed</button>';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';

         $store = '';
            $a = $this->Admin_Inquiry_Model->getStoreData($value['store_id']);
            $store = $a['store_name'];
         $model = '';
            $b = $this->Admin_Inquiry_Model->getModelData($value['model_id']);
            $model = $b['name'];
         $color = '';
            $c = $this->Admin_Inquiry_Model->getColorData($value['color_id']);
            $color = $c['color_name'];
        
            $status = 'Completed';
         
         $payment = '';
            if( $value['payment_option'] == 1){
                $payment = 'Cash';
            }
            else
            {
                $payment = 'Installment';
            }
         $result['data'][$key] = array(
            $value['id'],
            $value['customer_firstname'].' '.$value['customer_lastname'],
            $value['date_completed'],
            $store,
            $payment,
            $model,
            $color,
            $status,
            // $buttons,
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
            $update = $this->Admin_Inquiry_Model->update2($data, $id);
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
        $data['pages'] = 'inquiry/index3';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllCancelledInquiryData(){

        $result = array('data' => array());

        $inquiry = $this->Admin_Inquiry_Model->getCancelledInquiryData(4);
        foreach($inquiry as $key=>$value){

         $buttons = '';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="callnow('.$value['id'].')" data-toggle="modal" data-target="#callnowModal">Call Now</button>';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal">Completed</button>';
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';

         $store = '';
            $a = $this->Admin_Inquiry_Model->getStoreData($value['store_id']);
            $store = $a['store_name'];
         $model = '';
            $b = $this->Admin_Inquiry_Model->getModelData($value['model_id']);
            $model = $b['name'];
         $color = '';
            $c = $this->Admin_Inquiry_Model->getColorData($value['color_id']);
            $color = $c['color_name'];
        
            $status = 'Cancelled';
         
         $payment = '';
            if( $value['payment_option'] == 1){
                $payment = 'Cash';
            }
            else
            {
                $payment = 'Installment';
            }
         $result['data'][$key] = array(
            $value['id'],
            $value['customer_firstname'].' '.$value['customer_lastname'],
            $value['date_cancelled'],
            $store,
            $payment,
            $model,
            $color,
            $status,
            // $buttons,
            );
        }
        echo json_encode($result);
    }

    // extra

    public function getInquiryInfo(){
        $id = $this->input->post('id');

        $response = $this->Admin_Inquiry_Model->getInquiryData($id);

        echo json_encode($response);
    }

}