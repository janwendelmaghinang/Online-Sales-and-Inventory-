<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Profile extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Profile_Model');
    }
    public function index()
	{
        $info = array(
            'users_id' => $this->session->userdata('users_id')
        );

        $data['user'] = $this->Admin_Profile_Model->getProfileData($info['users_id']);
        $data['pages'] = 'profile/index';
        $this->load->view('admin/layout/templates',$data);
    }

    public function changeImage($id = null){
       if($id){
          $random = round(microtime(true) * 1000);
          $target_directory = "uploads/profile/"."profile".$random.'.png';
          move_uploaded_file($_FILES['image']['tmp_name'],$target_directory);

          $data = array(
              'image' => $target_directory
          );
          $update = $this->Admin_Profile_Model->update($data, $id); 
          if($update){
                 //add messages
            redirect(base_url('Admin_Profile'));
          }
          else
          {
                 //add messages
            redirect(base_url('Admin_Profile'));
          }
       }
       else
       {
        //add messages
          redirect(base_url('Admin_Profile'));
       }
    }

    public function editInfo($id = null){
        if($id){
           
           $this->form_validation->set_rules('edit_firstname', 'Firstname', 'trim|required');
           $this->form_validation->set_rules('edit_lastname', 'Lastname', 'trim|required');
           $this->form_validation->set_rules('edit_middle', 'Middle Name', 'trim|required');
           $this->form_validation->set_rules('edit_username', 'Middle Name', 'trim|required');
           $this->form_validation->set_rules('edit_email', 'Email', 'trim|required');
           $this->form_validation->set_rules('edit_contact', 'Contact', 'trim|required');
           $this->form_validation->set_rules('edit_barangay', 'Barangay', 'trim|required');
           $this->form_validation->set_rules('edit_city', 'City', 'trim|required');
           $this->form_validation->set_rules('edit_province', 'Province', 'trim|required');
           $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
           
           $street = '';
           $subdivision = '';
           if($this->input->post('edit_street')){
              $street = $this->input->post('edit_street');
           }
           if($this->input->post('edit_subdivision')){
              $subdivision = $this->input->post('edit_subdivision');
           }


           $data = array(
              'firstname' => $this->input->post('edit_firstname'),
              'lastname' => $this->input->post('edit_lastname'),
              'middle' => $this->input->post('edit_middle'),
              'email' => $this->input->post('edit_email'),
              'contact' => $this->input->post('edit_contact'),
              'barangay' => $this->input->post('edit_barangay'),
              'city' => $this->input->post('edit_city'),
              'province' => $this->input->post('edit_province'),
              'street' => $street,
              'subdivision' => $subdivision
           );
           $update = $this->Admin_Profile_Model->update($data, $id); 
           if($update){
                  //add messages
             redirect(base_url('Admin_Profile'));
           }
           else
           {
                  //add messages
             redirect(base_url('Admin_Profile'));
           }
        }
        else
        {
         //add messages
           redirect(base_url('Admin_Profile'));
        }
     }

     
    public function changePassword($id = null){
      $response = array();
      
      $user = $this->Admin_Profile_Model->getProfileData($id);
      $pass = $user['password'];

      $this->form_validation->set_rules('currentPassword', 'Current Password', 'trim|required');
      $this->form_validation->set_rules('newPassword', 'New Password', 'trim|required|min_length[6]|max_length[50]');
      $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'trim|required|matches[newPassword]');
   
      $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
      
      if($this->form_validation->run() == true){
         if($this->input->post('currentPassword') == $user['password']){
            $data = array(
               'password' => $this->input->post('newPassword'),
            );
            $update = $this->Admin_Profile_Model->update($data, $id); 
            if($update){
               $response['success'] = true;
               $response['messages'] = 'Password Successfully Changed';
            }
            else
            {
                  //add messages
               $response['success'] = false;
               $response['messages'] = 'Something Went Wrong!';
            }
         }
         else
         {
            $response['success'] = false;
            $response['messages'] = array(
               'currentPassword' => '<p class="text-danger">You have entered wrong password</p>',
            );
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
}