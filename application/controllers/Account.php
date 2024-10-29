<?php

class Account extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Account_Model');
    }
    public function index()
    {
        $data['user'] = $this->Account_Model->user();
        $data['pages'] = 'account/index';
        $this->load->view('inc/template',$data);
    }
    public function set_password()
    {
        $data['pages'] = 'account/password';
        $this->load->view('inc/template',$data);
    }
    public function update(){
        $data['user'] = $this->Account_Model->user();
        $data['pages'] = 'account/update';
        $this->load->view('inc/template',$data);
    }
}