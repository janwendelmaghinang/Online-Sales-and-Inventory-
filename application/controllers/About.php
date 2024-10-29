<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller{

    public function index()
	{
		$data['pages'] = 'about/index';
		$this->load->view('inc/template',$data); 
	}
}