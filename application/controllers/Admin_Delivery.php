<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Delivery extends CI_Controller{

public function __construct()
{
    parent::__construct();
    $this->load->model('Admin_Model_Model');
    $this->load->model('Admin_Ebike_Model');
    $this->load->model('Admin_Ebike_Branch_Model');
    $this->load->model('Admin_Color_Model');
    $this->load->model('Admin_Store_Model');
    $this->load->model('Admin_Spareparts_Model');

}
public function pending()
{   
    $data['pages'] = 'delivery/index';
    $this->load->view('admin/layout/templates',$data);
}
public function completed()
{   
    $data['pages'] = 'delivery/index1';
    $this->load->view('admin/layout/templates',$data);
}
public function cancelled()
{   
    $data['pages'] = 'delivery/index2';
    $this->load->view('admin/layout/templates',$data);
}

}