<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Customer extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_Customer_Model');
        $this->load->model('Helper_Model');
    }

public function index()
	{
        $data['pages'] = 'customer/index';
        $this->load->view('admin/layout/templates',$data);
}

public function fetchAllCustomer(){
        $result = array('data' => array());

        $customers = $this->Admin_Customer_Model->getCustomerData();
        foreach($customers as $key=>$value){

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="editCustomer('.$value['id'].')" data-toggle="modal" data-target="#editCustomerModal"><i class="fa fa-pencil"></i></button>';	
            $buttons .= ' <button type="button" class="btn btn-outline-dark" onclick="deleteCustomer('.$value['id'].')" data-toggle="modal" data-target="#deleteCustomerModal"><i class="fa fa-trash"></i></button>';
        
            // $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
        $name = '<p class="text-capitalize">'. $value['customer_firstname'].' '.$value['customer_middle'].' '.$value['customer_lastname'].'</p>';
        $address = $value['customer_street'].' '.$value['customer_subdivision'].' '.$value['customer_barangay'].' '.$value['customer_city'].' '.$value['customer_province'];


        $result['data'][$key] = array(
            $name,
            $value['customer_email'],
            $value['customer_contact'],
            $address,
            $buttons,
            );
        }
        echo json_encode($result);
}

public function insert(){
    $response = array();
    $this->form_validation->set_rules('customer_lastname', 'Lastname', 'trim|required');
    $this->form_validation->set_rules('customer_firstname', 'Firstname', 'trim|required');
    $this->form_validation->set_rules('customer_middle', 'Middle', 'trim|required');
    $this->form_validation->set_rules('customer_contact', 'Contact', 'trim|required');
    $this->form_validation->set_rules('customer_barangay', 'Barangay', 'trim|required');
    $this->form_validation->set_rules('customer_city', 'City', 'trim|required');
    $this->form_validation->set_rules('customer_province', 'Province', 'trim|required');
    $this->form_validation->set_rules('customer_email', 'email', 'trim|required|valid_email');
    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
          
    $street = '';
    $sub = '';
    $pass = '';
    if($this->input->post('customer_street')){
      $street = $this->input->post('customer_street');
    }
    if($this->input->post('customer_subdivision')){
      $sub = $this->input->post('customer_subdivision');
    }
    if($this->input->post('customer_password')){
      $pass = md5($this->input->post('customer_password'));
    }

    if ($this->form_validation->run() == TRUE) {
        $data = array(
            'customer_lastname' => $this->input->post('customer_lastname'),
            'customer_firstname' => $this->input->post('customer_firstname'),
            'customer_middle' => $this->input->post('customer_middle'),
            'customer_contact' => $this->input->post('customer_contact'),
            'customer_street' => $street,
            'customer_subdivision' => $sub,
            'customer_barangay' => $this->input->post('customer_barangay'),
            'customer_city' => $this->input->post('customer_city'),
            'customer_province' => $this->input->post('customer_province'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_password' => $pass,
          );
          $insert = $this->Admin_Customer_Model->insertCustomerData($data);
          if($insert == true) {
            $response['success'] = true;
            $response['messages'] = 'Added Successfully';
          }
          else
          {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while inserting the customer information';			
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


public function update($id)
	{
		$response = array();
		if($id) {
            $this->form_validation->set_rules('edit_customer_lastname', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('edit_customer_firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('edit_customer_middle', 'Middle', 'trim|required');
            $this->form_validation->set_rules('edit_customer_contact', 'Contact', 'trim|required');
            $this->form_validation->set_rules('edit_customer_barangay', 'Barangay', 'trim|required');
            $this->form_validation->set_rules('edit_customer_city', 'City', 'trim|required');
            $this->form_validation->set_rules('edit_customer_province', 'Province', 'trim|required');
            $this->form_validation->set_rules('edit_customer_email', 'email', 'trim|required|valid_email');
         
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
            
            $street = '';
            $sub = '';
            $pass = '';
            if($this->input->post('edit_customer_street')){
              $street = $this->input->post('edit_customer_street');
            }
            if($this->input->post('edit_customer_subdivision')){
              $sub = $this->input->post('edit_customer_subdivision');
            }
            if($this->input->post('edit_customer_password')){
              $pass = md5($this->input->post('edit_customer_password'));
            }

	        if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'customer_lastname' => $this->input->post('edit_customer_lastname'),
                    'customer_firstname' => $this->input->post('edit_customer_firstname'),
                    'customer_middle' => $this->input->post('edit_customer_middle'),
                    'customer_contact' => $this->input->post('edit_customer_contact'),
                    'customer_street' => $street,
                    'customer_subdivision' => $sub,
                    'customer_barangay' => $this->input->post('edit_customer_barangay'),
                    'customer_city' => $this->input->post('edit_customer_city'),
                    'customer_province' => $this->input->post('edit_customer_province'),
                    'customer_email' => $this->input->post('edit_customer_email'),
                    'customer_password' => $pass,
                  );
          
	        	$update = $this->Admin_Customer_Model->updateCustomer($data , $id);
              if($update == true) {

                      // $activity = 'Update Color "'.$name['color_name'].'" to "'. $this->input->post('edit_color_name').'"';
                      // $this->Helper_Model->system_logs($activity);
                $response['success'] = true;
                $response['messages'] = 'Succesfully updated';
              }
              else
              {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while updated the color information';			
              }
	        }
          else 
          {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
              $response['messages'][$key] = form_error($key);
            }	;		
	        }
		 }
         else
         {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		 }
		echo json_encode($response);
    }
    
    public function delete(){
        $id = $this->input->post('id');
        $response = array();

        if($id) 
        {
        //   $name = $this->Admin_Color_Model->getColorData($id);
          $delete = $this->Admin_Customer_Model->removeCustomer($id);
       
          if($delete == true) {
 
        //   $activity = 'Delete Color "'. $name['color_name'].'"';
        //   $this->Helper_Model->system_logs($activity);

            $response['success'] = true;
            $response['messages'] = "Successfully removed";	
          }
          else 
          {
            $response['success'] = false;
            $response['messages'] = "Error in the database while removing the color information";
          }
        }
        else 
        {
          $response['success'] = false;
          $response['messages'] = "Refersh the page again!!";
        }
        echo json_encode($response);
    }
// extra
    public function getCustomerById(){
      $id = $this->input->post('id');
      $response = array();
      
      $customer = $this->Admin_Customer_Model->getCustomerData($id);
      if($customer){
        $response['success'] = true;
        $response['data'] = $customer;
      }
      else
      {
        $response['success'] = false;
      }
    echo json_encode($response);
    }

}