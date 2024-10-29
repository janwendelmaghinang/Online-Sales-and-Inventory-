<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {
	public function __construct()
    {
		parent:: __construct();
		$this->load->model('Cart_Model');   
		$this->load->model('User_Model');   
	}

    public function index(){

		if($this->session->userdata('customer_logged_in')){
            redirect(base_url());
		} 
		
		$this->form_validation->set_rules('customer_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('customer_password', 'Password', 'trim|required|min_length[4]|max_length[50]');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if ($this->form_validation->run() == TRUE){

				$email = $this->input->post('customer_email');
				$password = md5($this->input->post('customer_password'));
				
				$customer = $this->User_Model->login($email, $password);

				if($customer['verified_email'] == 1)
				{
					// $customer_data = $this->User_Model->accountSetting($customer['id']);
					$data = array(
									'customer_id' => $customer['id'],
									'customer_lastname' => $customer['customer_lastname'],
									'customer_firstname' => $customer['customer_firstname'],
									'customer_email' => $customer['customer_email'],
									'customer_logged_in' => true
									);	
										
					$this->session->set_userdata($data);
					$this->session->set_flashdata('messages_success', 'You are logged in');
					redirect(base_url());
				}
				if($customer['verified_email'] == 0)
				{
					// $this->session->set_flashdata('messages_danger', 'Incorrect password or email!');
					redirect(base_url('User/verification/'.$customer['id']));
				}
				else
				{
					$this->session->set_flashdata('messages_danger', 'Incorrect password or email!');
					redirect(base_url('User'));
				}
		}
		$data['pages'] = 'user/index';
		$this->load->view('inc/template',$data);
	}
	
    public function register()
	{
	    	$six_digit_random_number = random_int(100000, 999999);
		// echo $six_digit_random_number;
			if($this->session->userdata('customer_logged_in')){
			redirect(base_url());
			} 

            $this->form_validation->set_rules('customer_firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('customer_lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('customer_middle', 'Middle', 'trim|required');
			$this->form_validation->set_rules('customer_email', 'Email', 'trim|required|valid_email');


			$this->form_validation->set_rules('customer_contact', 'Contact', 'trim|required');
			// $this->form_validation->set_rules('customer_street', 'First Name', 'trim|required|min_length[4]|max_length[20]');
			// $this->form_validation->set_rules('customer_subdivision', 'First Name', 'trim|required|min_length[4]|max_length[20]');
			$this->form_validation->set_rules('customer_barangay', 'Barangay', 'trim|required');
			$this->form_validation->set_rules('customer_city', 'City', 'trim|required');
			$this->form_validation->set_rules('customer_province', 'Province', 'trim|required');

			$this->form_validation->set_rules('customer_password', 'Password', 'trim|required|min_length[6]|max_length[50]');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[customer_password]');
		
		
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		
			if ($this->form_validation->run() == TRUE){
				
				$customer_id = $this->User_Model->register();
				$customer_data = $this->User_Model->accountSetting($customer_id);
					if ($customer_data['verified_email'] == 1)
					{
				
					$data = array(
									'customer_id' => $customer_data['id'],
									'customer_lastname' => $customer_data['customer_lastname'],
									'customer_firstname' => $customer_data['customer_firstname'],
									'customer_email' => $customer_data['customer_email'],
									'customer_logged_in' => true
									);	
					$this->session->set_userdata($data);
					$this->session->set_flashdata('messages_success', 'Your are now registered');
					redirect(base_url());
				   }
				   if($customer_data['verified_email'] == 0)
				   {
					   // $this->session->set_flashdata('messages_danger', 'Incorrect password or email!');
					   redirect(base_url('User/verification/'.$customer_id));
				   }
				   else
				   {
					   $this->session->set_flashdata('messages_danger', 'Incorrect password or email!');
					   redirect(base_url('User'));
				   }
			}

			$data['pages'] = 'user/register';
			$this->load->view('inc/template',$data);
	}

	public function verification($id = null){
            if($id){
				$data['id'] = $id;
				$data['pages'] = 'user/verification';
				$this->load->view('inc/template',$data);
			}
			else
			{
				redirect(base_url());
			}
	}

	public function sendVerification(){

		$response = array();
		$id = $this->input->post('id');
		$six_digit_random_number = random_int(100000, 999999);

		$customer_data = $this->User_Model->accountSetting($id);

		$from_email = "maghinangjanwendel.pdm@gmail.com";
        $to_email = $customer_data['customer_email'];

        //Load email library 
        $this->load->library('email');
        $this->email->from($from_email, 'Hpzebike');
        $this->email->to($to_email);
        $this->email->subject('Verification code');
        $this->email->message('Thank you for signing in to Hpzebike. To complete your registration, please use the verification code : '. $six_digit_random_number);
        $this->email->send();

        if($id){
            $data = array(
               'verification_code' => $six_digit_random_number
            );
            $update = $this->User_Model->update_account($data, $id);
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
	
	public function submit_verification($id = null){

		$Vcode = $this->input->post('Vcode');

		$data = array(
			'verified_email' => 1
		);
		$customer_data = $this->User_Model->vemail($data, $id, $Vcode);
        var_dump($customer_data);
		if($customer_data['verification_code'] == $Vcode)
		{
			$this->User_Model->update_account($data, $id);
			$data = array(
					'customer_id' => $customer_data['id'],
					'customer_lastname' => $customer_data['customer_lastname'],
					'customer_firstname' => $customer_data['customer_firstname'],
					'customer_email' => $customer_data['customer_email'],
					'customer_logged_in' => true
					);	
			$this->session->set_userdata($data);
			$this->session->set_flashdata('messages_success', 'Your Email is verified. You are now registered');
			redirect(base_url('User/verified'));
	   }
	   else
	   {
		   // $this->session->set_flashdata('messages_danger', 'Incorrect password or email!');
			// redirect(base_url('User/verification/'.$id));
			$data['id'] = $id;
			$data['pages'] = 'user/verification';
			$this->load->view('inc/template',$data);
	   }

	}
	
	public function verified(){
		
		$data['pages'] = 'user/verified';
		$this->load->view('inc/template',$data);
	}



	public function logout(){
		$this->session->unset_userdata('customer_logged_in');
        $this->session->unset_userdata('customer_id');
		$this->session->unset_userdata('customer_lastname');
		$this->session->unset_userdata('customer_firstname');
		$this->cart->destroy();
		// $this->session->sess_destroy();
		redirect(base_url());
	}

}