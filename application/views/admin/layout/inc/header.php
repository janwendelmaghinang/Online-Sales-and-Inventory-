<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
    <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">  

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
 
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>

    <link href="<?php echo base_url('assets/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />
    <script src="<?php echo base_url('assets/select2/dist/js/select2.min.js') ?>"></script>

    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/datatable/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>"> -->
    <!-- <script src="<?php echo base_url('assets/datatable/datatables.net/js/jquery.dataTables.min.js') ?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/datatable/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script> -->

    <!-- Custom styles for this template -->
    <!-- <link rel="stylesheet" href="style.css"> -->
 
  </head>

  <?php
     $user = '';
     if($this->session->userdata('usertype') == 1){
        $user = 'Administrator';
     }
     if($this->session->userdata('usertype') == 2){
        $user = 'Manager';
     }
     
  ?>

  <body>
    <div class="row navbar navbar-dark sticky-top" style=" background: black ">
      <div class="col">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo base_url('Admin_Dashboard') ?>">HPZ ECOBIKE</a>
      </div>
      <div class="col"> 
        <h5 class="text-white text-center"><?php echo $user ?></h5>
      </div>
      <div class="col">
           <div class="row">
              <div class="col">   
                <div class="logout_div float-right">
                  <form action="<?php echo base_url('admin/logout') ?>" method="post">
                    <button class="nav-link btn text-light " type="submit">Logout</button>
                  </form>
                </div>
                <div class="profile_div float-right">
                  <a href="<?php echo base_url('Admin_Profile') ?>">
                    <img style="width: 40px; height: 40px; border-radius: 100%; border:solid 1px white;" src="<?php echo base_url($this->session->userdata('image') ) ?>" alt="aseda">
                  </a>
                </div>  
              </div>
           </div>
      </div>
    </div>
