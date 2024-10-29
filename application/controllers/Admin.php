<?php

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();  
        $this->load->model('Admin_Model');      
        $this->load->model('Helper_Model');      
    }
    public function index()
    { 
        if($this->session->userdata('userLogged_in')){
          redirect('Admin_Dashboard');
        }

        $this->form_validation->set_rules('username','username','trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if($this->form_validation->run() == true ){
  
            $username = $this->input->post('username');
            $password = $this->input->post('password');
       
            $id = $this->Admin_Model->login($username, $password);

            if($id)
               {
                  $user = $this->Admin_Model->getUserById($id);
                   
                  // if(!$user->active == 1){

                  $usersData = array(
                      'users_id' => $user->id,
                      'users_username' => $user->email,
                      'users_firstname' => $user->username,
                      'usertype' => $user->usertype,
                      'image' => $user->image,
                      'active' => $user->active,
                      'userLogged_in' => true
                  );
                  $this->session->set_userdata($usersData);

                  // single access
                  $this->Admin_Model->access($id, $active_status = '1');
                  
                  //  insert logs
                  $activity = 'login';
                  $this->Helper_Model->system_logs($activity);

                  redirect(base_url('Admin_Dashboard'));
                }

                else
                {
          
                }
          }   
          else
          {

          }

          $this->load->view('admin/user/index');
    }
    public function login(){

        if($this->session->userdata('userLogged_in')){
          redirect('Admin_Dashboard');
        }
          
        $this->form_validation->set_rules('username','username','trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if($this->form_validation->run() == true ){
  
            $username = $this->input->post('username');
            $password = $this->input->post('password');
       
            $id = $this->Admin_Model->login($username, $password);

            if($id)
               {
                  $user = $this->Admin_Model->getUserById($id);
                   
                  // if(!$user->active == 1){

                  $usersData = array(
                      'users_id' => $user->id,
                      'users_username' => $user->email,
                      'users_firstname' => $user->username,
                      'usertype' => $user->usertype,
                      'active' => $user->active,
                      'userLogged_in' => true
                  );
                  $this->session->set_userdata($usersData);

                  // single access
                  $this->Admin_Model->access($id, $active_status = '1');
                  
                  //  insert logs
                  $activity = 'login';
                  $this->Helper_Model->system_logs($activity);

                  redirect(base_url('Admin_Dashboard'));

                  // }
                  // $this->session->set_flashdata('logged_in','Account is already logged');
                  // redirect(base_url('admin'));
                }

                else
                {
                  redirect(base_url('admin'));
                }
        }   
        else
        {
          $this->session->flashdata('failed','wrong password/username');
          redirect(base_url('admin'));
        }

    }
    public function logout(){
      if(!$this->session->userdata('userLogged_in')){
        redirect('Admin');
      }
      // single access
      $id = $this->session->userdata('users_id');
      $this->Admin_Model->access($id, $active_status = '0');

      $activity = 'logout';
      $this->Helper_Model->system_logs($activity);

      $this->session->unset_userdata('users_id');
      $this->session->unset_userdata('users_username');
      $this->session->unset_userdata('user_firstname');
      $this->session->unset_userdata('usertype');
      $this->session->unset_userdata('active');
      $this->session->unset_userdata('userLogged_in');


      redirect(base_url('Admin'));
    }
}
