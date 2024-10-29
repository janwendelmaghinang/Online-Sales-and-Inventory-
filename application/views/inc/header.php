<!DOCTYPE html>
<html class="htmls" lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
   
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>


    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Sigmar+One" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Michroma" />
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">  
 
 
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">
    <title></title>
</head>
<body>
<header class="container-fluid header-con">
     <div class="container">
        <div class="row">
                <div class="header-col-0 col-4 col-sm-4" > 
                    <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
                </div>
                <div class="header-col-1 col-4 col-sm-4  col-lg-6 col-md-6">
                   <img class="hpz-logo"src="<?php echo (base_url());?>uploads/logo/Logo.png" alt="">
                </div>
                <div class="header-col-2 col-4 col-sm-4 col-lg-6 col-md-6">
                        
                        <a class="text-decoration-none text-white" href="<?php echo base_url()?>cart"><i class="fal fa-shopping-cart"></i>
                           <span id="cartCount">
                        </span>
                        </a>
               </div>
        </div>
     </div>
</header>