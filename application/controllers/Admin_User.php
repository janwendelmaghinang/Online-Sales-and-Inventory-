<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_User extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_User_Model');
        $this->load->model('Helper_Model');
    }

    public function index()
	{
        $data['pages'] = 'users/index';
        $this->load->view('admin/layout/templates',$data);
    }

    public function fetchAllUser(){
        $result = array('data' => array());

        $users = $this->Admin_User_Model->getUserData();
        foreach($users as $key=>$value){

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="editUser('.$value['id'].')" data-toggle="modal" data-target="#editUserModal"><i class="fa fa-pencil"></i></button>';	
            $buttons .= ' <button type="button" class="btn btn-outline-dark" onclick="deleteUser('.$value['id'].')" data-toggle="modal" data-target="#deleteUserModal"><i class="fa fa-trash"></i></button>';
            // $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
   
        $position = '';
            if($value['usertype'] == 1){$position = 'Administrator';}
            if($value['usertype'] == 2){$position = 'Manager';}
            if($value['usertype'] == 3){$position = 'Staff';}

        $result['data'][$key] = array(
            $value['firstname'],
            $value['lastname'],
            $value['email'],
            $position,
            $value['username'],
            // $value['password'],
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function insert()
    {
      $response = array();
      $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
      $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
      $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
      $this->form_validation->set_rules('username', 'username', 'trim|required');
      $this->form_validation->set_rules('password', 'password', 'trim|required');
      $this->form_validation->set_rules('usertype', 'usertype', 'trim|required');

      $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');


          if ($this->form_validation->run() == TRUE)
          {
            $data = array(
              'lastname' => $this->input->post('lastname'),
              'firstname' => $this->input->post('firstname'),
              'email' => $this->input->post('email'),
              'username' => $this->input->post('username'),
              'password' => $this->input->post('password'),
              'usertype' => $this->input->post('usertype'),
            );
              
            $insert = $this->Admin_User_Model->insertUser($data);
            if($insert == true) {

            $activity = 'Add user "'. $this->input->post('firstname').'"';
            $this->Helper_Model->system_logs($activity);
            
            $response['success'] = true;
            $response['messages'] = 'User Added';
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

    public function update($id)
	{
		$response = array();
		if($id) {
            $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
            $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            $this->form_validation->set_rules('usertype', 'usertype', 'trim|required');
      
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'lastname' => $this->input->post('lastname'),
                    'firstname' => $this->input->post('firstname'),
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'usertype' => $this->input->post('usertype'),
                  );
                
	        	$update = $this->Admin_User_Model->updateUser($data , $id);
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
                $response['messages'] = 'Something went Wrong!';		
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
          $delete = $this->Admin_User_Model->removeUser($id);
       
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

    
    public function getUserById(){
        $id = $this->input->post('user_id');
         if($id){
           $data = $this->Admin_User_Model->getUserData($id);
           echo json_encode($data);
          }
          return false;
  }

}