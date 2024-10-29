<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
	}
    public function index()
	{
		// var_dump($this->session->userdata());
		$data['slider_active'] = $this->Admin_Page_Controller_Model->getSliderActive();
		$data['pages'] = 'index';
		$this->load->view('inc/template',$data);
	}
}