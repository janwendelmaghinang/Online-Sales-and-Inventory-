<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Helper_Model');   
        $this->load->model('Checkout_Model'); 
    }
    
    public function index()
	{
        if(!$this->session->userdata('customer_logged_in')){
            $this->session->set_flashdata('please_login', 'You must login or create account');
            redirect('user');
        } 

        $data['stores'] = $this->Checkout_Model->getStoreData();
        $data['banks'] = $this->Checkout_Model->getBankData();
		$data['pages'] = 'checkout/index';
		$this->load->view('inc/template',$data); 
    }

    public function insert()
    { 
        if(!$this->session->userdata('customer_logged_in')){
            $this->session->set_flashdata('please_login', 'You must login or create account');
            redirect('user');
        } 
        if(!$this->input->post('payment_method') == 0 ){
            $this->form_validation->set_rules('store_id', 'Store','required');
            $this->form_validation->set_rules('payment_method', 'payment method','required');
        
            if($this->form_validation->run() == true){

                $random = round(microtime(true) * 1000);
                $target_directory = "uploads/payment_receipt/"."receipt".$random.'.png';
                move_uploaded_file($_FILES['payment_receipt']['tmp_name'],$target_directory);
                
                $data['image'] = $target_directory;
                $insert = $this->Checkout_Model->insert_order($data);
                if($insert){
                    redirect(base_url('checkout/success'));
                }
            }
            else
            {
                redirect(base_url('checkout'));
            }
        }
        else
        {
            $this->form_validation->set_rules('store_id', 'Store','required');
            $this->form_validation->set_rules('payment_method', 'payment receipt','required');
       
            if($this->form_validation->run() == true){
    
                $insert = $this->Checkout_Model->insert_order1();
                if($insert){
                    redirect(base_url('checkout/success'));
                }
            }
            else
            {
                redirect(base_url('checkout'));
            }
        }
    }

    public function success(){
        $this->cart->destroy();
        $data['pages'] = 'checkout/success';
		$this->load->view('inc/template',$data); 
    }

    // extra 

    public function getBank(){
        $id = $this->input->post('id');
        
        $response = array();

        if($id){
            $bank = $this->Checkout_Model->getBankData();
            if($bank){
                $response['data'] = $bank;
                $response['success'] = true;
            }
            else
            {
                $response['success'] = false;
            }  
        }
        echo json_encode($response);
    }

}