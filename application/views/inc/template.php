<?php

$data['footer_active'] = $this->Admin_Page_Controller_Model->getFooterActive();
$data['footer_text'] = $this->Admin_Page_Controller_Model->getFooterData();





$this->load->view('inc/header');
$this->load->view('inc/navigation');

$this->load->view($pages);

$this->load->view('inc/footer',$data);