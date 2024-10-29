<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Database_Backup extends CI_Controller{

    public function index()
	{
        if(!$this->session->userdata('userLogged_in')){
            redirect('Admin');
        }
        $data['pages'] = 'database/index';
        $this->load->view('admin/layout/templates',$data);
    }
    public function backup(){
        if(!$this->session->userdata('userLogged_in')){
            redirect('Admin');
        }
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $this->load->helper('download');
        if( force_download('mydatabasebackup.zip', $backup)){
            $this->session->set_flashdata('messages_success','Success');
        }
        else
        {
            $this->session->set_flashdata('messages_danger','Failed');
        }
       redirect('Admin_Database_Backup');
    }
}