<style>
  .btn-nav{
    border: none;
    outline: none;
    background: none;
  }
  .btn-nav , .nav-link{
    color: white;
  }
  .bg-secondary{
    color: black;
  }
</style>
<div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar" style="background: black" >
          <div class="sidebar-sticky mt-5">
            <ul class="nav flex-column">
              <?php if($this->session->userdata('usertype') == 1 || $this->session->userdata('usertype') == 2 || $this->session->userdata('usertype') == 3):?>
              <li class="nav-item">
                <a id="dashboard_link" class="nav-link active" href="<?php echo base_url('Admin_Dashboard') ?>">
                <i class="fa fa-home "></i>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="pos_link" class="nav-link" href="<?php echo base_url('Admin_Pos') ?>">
                <i class="fas fa-cash-register"></i>
                  POS 
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item ">
                <div class="d-flex ml-1">
                  <button id="loan_link" class="btn btn-nav w-100 text-left ">
                  <i class="fa fa-motorcycle"></i>
                  Ebike Loan</button>
                      <span data-feather="file"></span>
                  </a>
                    <span class="dropdown-toggle float-right btn text-light" data-toggle="collapse" data-target="#loan" aria-expanded="false=" aria-controls="loan"></span>
                </div>
                <div class="collapse" id="loan">
                    <a id="loan_link1" href="<?php echo base_url('Admin_Installment') ?>" class="nav-link ml-2">Application</a>
                    <a id="loan_link2" href="<?php echo base_url('Admin_Amortization') ?>" class="nav-link ml-2">Amortization</a>
                    <a id="loan_link3" href="<?php echo base_url('Admin_Pullout') ?>" class="nav-link ml-2">Pull Out</a>
                  </div>
              </li>
              <?php endif; ?> 
              
              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="inquiry_link" class="nav-link" href="<?php echo base_url('Admin_Inquiry') ?>">
                 <i class="fa fa-question"></i>
                  Inquiry
                </a>
              </li>
              <?php endif; ?>


              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="sales_link" class="nav-link" href="<?php echo base_url('Admin_Sales') ?>">
                <i class="fas fa-receipt"></i>
                  Sales
                </a>
              </li>
              <?php endif; ?>


              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="registration_link" class="nav-link" href="<?php echo base_url('Admin_Register/pending') ?>">
                <i class="fa fa-registered"></i>
                Registration
                </a>
              </li>
              <?php endif; ?>


              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="order_link" class="nav-link" href="<?php echo base_url('Admin_Order') ?>">
                <i class="fa fa-shopping-cart"></i>
                Order
                </a>
              </li>
              <?php endif; ?>

              
              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="color_link" class="nav-link" href="<?php echo base_url('Admin_Color/color') ?>">
                <i class="fa fa-palette"></i>
                Color
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="model_link" class="nav-link" href="<?php echo base_url('Admin_Model') ?>">
                <i class="fa fa-motorcycle"></i>
                Model
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="spareparts_link" class="nav-link" href="<?php echo base_url('Admin_Spareparts') ?>">
                <i class="fa fa-tire"></i>
                Spareparts
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item ">
                <div class="d-flex ml-1">
                  <a id="inventory_main" class="btn btn-nav w-100 text-left " href="<?php echo base_url('Admin_Inventory') ?>">
                  <i class="fa fa-container-storage"></i>
                  Inventory
                  </a>
                    <span class="dropdown-toggle float-right btn text-light" data-toggle="collapse" data-target="#inventory" aria-expanded="false=" aria-controls="inventory"></span>
                </div>
                <div class="collapse" id="inventory">
                    <a id="inventory_link1" href="<?php echo base_url('Admin_Inventory/spareparts') ?>" class="nav-link ml-2">Spareparts</a>
                    <a id="inventory_link2" href="<?php echo base_url('Admin_Inventory/ebike') ?>" class="nav-link ml-2">Ebike</a>
                </div>
              </li>
              <?php endif; ?>


              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="production_link1" class="nav-link" href="<?php echo base_url('Admin_Ebike/pending') ?>">
                <i class="fa fa-wrench"></i>
                Production
                </a>
              </li>
              <?php endif; ?>
<!-- 
              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="delivery_link" class="nav-link" href="<?php echo base_url('Admin_Delivery/pending') ?>">
                
                Delivery
                </a>
              </li>
              <?php endif; ?> -->


              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="store_link" class="nav-link" href="<?php echo base_url('Admin_Store') ?>">
                <i class="fa fa-store"></i>
                  Store
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="users_link" class="nav-link" href="<?php echo base_url('Admin_User') ?>">
                  <i class="fa fa-users"></i>
                  Users
                </a>
              </li>
              <?php endif; ?>

              <?php if( $this->session->userdata('usertype') == 1 ):?>
              <li class="nav-item">
                <a id="customer_link" class="nav-link" href="<?php echo base_url('Admin_Customer') ?>">
                <i class="fa fa-list"></i>
                  Customers
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="bank_link" class="nav-link" href="<?php echo base_url('Admin_Bank') ?>">
                <i class="fa fa-building"></i>
                Bank Accounts
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="profile_link" class="nav-link" href="<?php echo base_url('Admin_Profile') ?>">
                <i class="fa fa-user"></i>
                 Profile 
                </a>
              </li>
              <?php endif; ?>

              <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="systemlogs_link" class="nav-link" href="<?php echo base_url('Admin_Logs') ?>">
                <i class="fa fa-tags"></i>
                 System Logs
                </a>
              </li>
              <?php endif; ?>
              
              <!-- <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('Admin_Settings') ?>">
                  <span data-feather="bar-chart-2"></span> 
                 Page settings
                </a>
              </li>
              <?php endif; ?> -->

              <!-- <?php if($this->session->userdata('usertype') == 1):?>
              <li class="nav-item">
                <a id="database_link" class="nav-link" href="<?php echo base_url('Admin_Database_Backup') ?>">
                   <span data-feather="users"></span> 
                   Backup Database
                </a>
              </li>
              <?php endif; ?> -->

            </ul>

          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

 <script>
   $('.bg-secondary').addClass('active');
 </script>