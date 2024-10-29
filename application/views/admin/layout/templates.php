<?php
$this->load->view('admin/layout/inc/header.php');
$this->load->view('admin/layout/inc/sidenav.php');

$this->load->view('admin/'.$pages);

$this->load->view('admin/layout/inc/footer.php');
?>