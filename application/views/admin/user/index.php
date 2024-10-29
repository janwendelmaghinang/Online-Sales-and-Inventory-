<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <!-- jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
    <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/bootstrap.min.css')?>">   -->
    
  </head>
  
  <style>

      .login-box{
          min-height: 75vh;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
      }

      .logo{
        max-width: 35%;
      }
      .logo2{
        max-height: 250px;
        min-width: 300px;
      }
      .form-box{
          min-height: 350px;
          min-width: 300px;
      }
      .title-box{
        display: flex;
        justify-content: center;
        align-items: center;
      }
 
  </style>

  <body>

      <div class="container-fluid p-0">

        <div class="container-fluid shadow-lg border-bottom">
           <div class="container">
             <div class="row  px-5">
               <div class="col p-2">
                  <div class="logo-box">
                    <img class="logo" src="<?php echo base_url("uploads/logo/Logo.png") ?>" alt="Logo.png">
                  </div>
               </div>
             </div>
           </div>
        </div>
          
        <div class="container">
            <div class="row px-5">
              <div class="col title-box">
                 <div class="box">
                    <h1 class="text-center text-danger">Admin Panel</h1><br>
                    <img class="logo2" src="<?php echo base_url('uploads/logo/logo2.jpg') ?>" alt="">
                 </div>
              </div>

              <div class="col">
                <div class="login-box">
                   
                  <div class="row form-box justify-content-center border shadow-lg">
                    <div class="col mt-3">
                      <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>     
                      <form action="<?php echo base_url('Admin')?>" method="post">
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input name="username" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input name="password" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-danger w-100">Login</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

      </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="<?php echo base_url()?>/assets/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>/assets/smoothscroll/smooth-scroll.js"></script>


  </body>
</html>