<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->Model('Admin_Amortization_Model');
        $this->load->Model('Admin_Spareparts_Model');
        $this->load->Model('Admin_Customer_Model');
        $this->load->Model('Admin_Color_Model');
        $this->load->Model('Admin_Model_Model');
        $this->load->Model('Admin_Company_Model');
        $this->load->Model('Admin_Store_Model');
        $this->load->Model('Inquiry_Model');
        date_default_timezone_set("Asia/Manila");
    }
    public function index(){
       
        if(!$this->session->userdata('customer_logged_in')){
            $this->session->set_flashdata('messages_danger', 'You must login or create account');
            redirect('user');
        }
       
        $data['store_branch'] = $this->Admin_Store_Model->getStoreData();
        $data['models'] = $this->Admin_Model_Model->getModelData();
        $data['colors'] = $this->Admin_Color_Model->getColorData();
       
		$data['pages'] = 'inquiry/index';
		$this->load->view('inc/template',$data); 
    }

    public function submit(){
          
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('middlename', 'Middle', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('street', 'street', 'trim');
        $this->form_validation->set_rules('subdivision', 'Subdivision', 'trim');
        $this->form_validation->set_rules('barangay', 'Barangay', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('province', 'Province', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact', 'Contact', 'trim|required');
        $this->form_validation->set_rules('store', 'Branch', 'trim|required');
        $this->form_validation->set_rules('payment', 'Payment', 'trim|required');
        $this->form_validation->set_rules('model', 'Model', 'trim|required');
        $this->form_validation->set_rules('color', 'Color', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == True) {
            $customer_info = array(
                'customer_firstname' => $this->input->post('firstname'),
                'customer_middle' => $this->input->post('middlename'),
                'customer_lastname' => $this->input->post('lastname'),
                'customer_street' => $this->input->post('street'),
                'customer_subdivision' => $this->input->post('subdivision'),
                'customer_barangay' => $this->input->post('barangay'),
                'customer_city' => $this->input->post('city'),
                'customer_province' => $this->input->post('province'),
                'customer_email' => $this->input->post('email'),
                'customer_contact' => $this->input->post('contact'),
                'store_id' => $this->input->post('store'),
                'payment_option' => $this->input->post('payment'),
                'model_id' => $this->input->post('model'),
                'color_id' => $this->input->post('color'),
                'date_of_inquiry' => date('M d, Y'),
                'status' => 1
               );
               $insert = $this->Inquiry_Model->insert_inquiry($customer_info);
               if($insert){
                   $response['success'] = true;
                //    $response['messages'] = 'Thank you for your inquiry. Please wait the call from our sales  representative.
                //    ';
               }
               else
               {
                   $response['success'] = false;
                   $response['messages'] = 'Something Went Wrong!';
               }
        } 
        else
        {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
              $response['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($response);
    }
    
    public function submit1(){
        
        if(!$this->session->userdata('customer_logged_in')){
            $this->session->set_flashdata('messages_danger', 'You must login or create account');
            redirect('user');
        }
          
        $this->form_validation->set_rules('store', 'Branch', 'trim|required');
        $this->form_validation->set_rules('payment', 'Payment', 'trim|required');
        $this->form_validation->set_rules('model', 'Model', 'trim|required');
        $this->form_validation->set_rules('color', 'Color', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        $cust_id = $this->session->userdata('customer_id');
        $customer = $this->Inquiry_Model->getCustomerData($cust_id);
        if ($this->form_validation->run() == True) {
            $customer_info = array(
                'customer_firstname' => $customer['customer_firstname'],
                'customer_middle' => $customer['customer_middle'],
                'customer_lastname' => $customer['customer_lastname'],
                'customer_street' => $customer['customer_street'],
                'customer_subdivision' => $customer['customer_subdivision'],
                'customer_barangay' => $customer['customer_barangay'],
                'customer_city' => $customer['customer_city'],
                'customer_province' => $customer['customer_province'],
                'customer_email' => $customer['customer_email'],
                'customer_contact' => $customer['customer_contact'],
              
                'store_id' => $this->input->post('store'),
                'payment_option' => $this->input->post('payment'),
                'model_id' => $this->input->post('model'),
                'color_id' => $this->input->post('color'),
                'date_of_inquiry' => date('M d, Y'),
                'status' => 1
               );
               $insert = $this->Inquiry_Model->insert_inquiry($customer_info);
               if($insert){
                   $response['success'] = true;
                //    $response['messages'] = 'Thank you for your inquiry. Please wait the call from our sales  representative.
                //    ';
               }
               else
               {
                   $response['success'] = false;
                   $response['messages'] = 'Something Went Wrong!';
               }
        } 
        else
        {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
              $response['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($response);
    }

    public function success(){
        $data['pages'] = 'inquiry/landing';
		$this->load->view('inc/template',$data); 
    }
}