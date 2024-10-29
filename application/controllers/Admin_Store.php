<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Store extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Store_Model');
        $this->load->model('Helper_Model');
    }

    public function index()
	{
        $data['pages'] = 'store/index';
        $this->load->view('admin/layout/templates',$data);
    }
    public function fetchAllStore(){
        $result = array('data' => array());

        $stores = $this->Admin_Store_Model->getStoreData();
        foreach($stores as $key=>$value){

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="editStore('.$value['store_id'].')" data-toggle="modal" data-target="#editStoreModal"><i class="fa fa-pencil"></i></button>';	
            $buttons .= ' <button type="button" class="btn btn-outline-dark" onclick="deleteStore('.$value['store_id'].')" data-toggle="modal" data-target="#deleteStoreModal"><i class="fa fa-trash"></i></button>';
            $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            $manager = $value['m_firstname'].' '.$value['m_lastname'] ;

        $result['data'][$key] = array(
            $value['store_id'],
            $value['store_name'],
            $value['store_contact'],
            $value['store_street'],
            $value['store_subdivision'],
            $value['store_barangay'],
            $value['store_city'],
            $value['store_province'],
            $manager,
            $status,
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function insert(){
 
        $response = array();
        
        $this->form_validation->set_rules('m_firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('m_lastname', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('m_middlename', 'Middle', 'trim|required');
        $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required');
        $this->form_validation->set_rules('store_contact', 'Contact', 'trim|required');
        $this->form_validation->set_rules('store_street', 'Street', 'trim|required');
        $this->form_validation->set_rules('store_subdivision', 'Subdivision', 'trim|required');
        $this->form_validation->set_rules('store_barangay', 'Barangay', 'trim|required');
        $this->form_validation->set_rules('store_city', 'City', 'trim|required');
        $this->form_validation->set_rules('store_province', 'Province', 'trim|required');
        $this->form_validation->set_rules('store_active', 'status', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');


        if($this->form_validation->run() == TRUE){

            $data = array(
                'store_name' => $this->input->post('store_name'),
                'store_contact' => $this->input->post('store_contact'),
                'store_street' => $this->input->post('store_street'),
                'store_subdivision' => $this->input->post('store_subdivision'),
                'store_barangay' => $this->input->post('store_barangay'),
                'store_city' => $this->input->post('store_city'),
                'store_province' => $this->input->post('store_province'),
                'm_firstname' => $this->input->post('m_firstname'),
                'm_lastname' => $this->input->post('m_lastname'),
                'm_middlename' => $this->input->post('m_middlename'),
                'active' => $this->input->post('store_active')
            );

            $insert = $this->Admin_Store_Model->insertStore($data);
            if($insert == true){
                $response['success'] = true; 
                $response['messages'] = 'Successfully inserted';
            }
            else 
            {
                $response['success'] = false; 
                $response['messages'] = 'Something went Wrong!';
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
    public function deleteStore(){
        $store_id = $this->input->post('store_id');
        $response = array();

        if($store_id) 
        {
          $name = $this->Admin_Store_Model->getStoreData($store_id);
          $delete = $this->Admin_Store_Model->removeStore($store_id);
       
          if($delete == true) {

          
          $activity = 'Delete store "'. $name['store_name'].'"';
          $this->Helper_Model->system_logs($activity);

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

    public function getStoreById(){
        $id = $this->input->post('store_id');
         if($id){
           $data = $this->Admin_Store_Model->getStoreData($id);
           echo json_encode($data);
          }
          return false;
  }

  public function update($id)
  {
      $response = array();
      if($id) {
        $this->form_validation->set_rules('edit_m_firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('edit_m_lastname', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('edit_m_middlename', 'Middle', 'trim|required');
        $this->form_validation->set_rules('edit_store_name', 'Store Name', 'trim|required');
        $this->form_validation->set_rules('edit_store_contact', 'Contact', 'trim|required');
        $this->form_validation->set_rules('edit_store_street', 'Street', 'trim|required');
        $this->form_validation->set_rules('edit_store_subdivision', 'Subdivision', 'trim|required');
        $this->form_validation->set_rules('edit_store_barangay', 'Barangay', 'trim|required');
        $this->form_validation->set_rules('edit_store_city', 'City', 'trim|required');
        $this->form_validation->set_rules('edit_store_province', 'Province', 'trim|required');
        $this->form_validation->set_rules('edit_store_active', 'status', 'trim|required');
 
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');


        if($this->form_validation->run() == TRUE){

            $data = array(
                'store_name' => $this->input->post('edit_store_name'),
                'store_contact' => $this->input->post('edit_store_contact'),
                'store_street' => $this->input->post('edit_store_street'),
                'store_subdivision' => $this->input->post('edit_store_subdivision'),
                'store_barangay' => $this->input->post('edit_store_barangay'),
                'store_city' => $this->input->post('edit_store_city'),
                'store_province' => $this->input->post('edit_store_province'),
                'm_firstname' => $this->input->post('edit_m_firstname'),
                'm_lastname' => $this->input->post('edit_m_lastname'),
                'm_middlename' => $this->input->post('edit_m_middlename'),
                'active' => $this->input->post('edit_store_active')
            );

              $name = $this->Admin_Store_Model->getStoreData($id);

              $update = $this->Admin_Store_Model->updateStore($data , $id);
              if($update == true) {

                  $activity = 'Update Store "'.$name['store_name'].'" to "'. $this->input->post('m_store_name').'"';
                  $this->Helper_Model->system_logs($activity);

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
              }
          }
       }
     else
       {
          $response['success'] = false;
          $response['messages'] = 'Error please refresh the page again!!';
       }
      echo json_encode($response);
  }
  

}