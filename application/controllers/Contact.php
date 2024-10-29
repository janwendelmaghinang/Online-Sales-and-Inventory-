<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller{

    public function index()
	{
		$data['pages'] = 'contact/index';
		$this->load->view('inc/template',$data);
	}
}