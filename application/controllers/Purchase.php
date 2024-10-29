<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Online_Form_Model');
    }
    public function application(){
        if(isset($_POST['btn-checkout'])){
            if(!$this->session->userdata('logged_in')){
                $this->session->set_flashdata('please_login', 'You must login or create account');
                redirect('user/auth');
            }
        }
        if(isset($_POST['online_form_btn'])){
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
			$this->form_validation->set_rules('branch', 'branch', 'trim|required');
            $this->form_validation->set_rules('payment', 'payment', 'trim|required');
            $this->form_validation->set_rules('model', 'model', 'trim|required');
            $this->form_validation->set_rules('voltage', 'voltage', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
			   
            } 
            else 
            {
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
                'store_branch' => $this->input->post('branch'),
                'payment_option' => $this->input->post('payment'),
                'unit_model' => $this->input->post('model'),
                'unit_voltage' => $this->input->post('voltage'),
               );
               $data['insert_id'] = $this->Online_Form_Model->insert_form_data($customer_info);
            }
        }
        $data['store_branch'] = $this->Online_Form_Model->getBranch();
        $data['models'] = $this->Online_Form_Model->getModel();
       
        $this->load->view('inc/header.php');
        $this->load->view('inc/navigation.php');
        $this->load->view('inquiry/application.php',$data);
        $this->load->view('inc/footer.php');
    }
}