

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>
          
         

          <div class="row">
              <div class="col col-sm-6 col-lg-4 my-2 border shadow-sm">
                  <div class="icon-box"><i class="fas fa-tools fa-5x"></i></div>
                  <div class="title-box float-right">Total Spareparts</div><br>
                  <div class="total-box float-right"><?php echo $spareparts ?></div><br>
                  <div class="link border-top">
                    <a href="<?php echo base_url('Admin_Spareparts') ?>">view all</a>
                  </div>
              </div>
              <div class="col col-sm-6 col-lg-4 my-2 border shadow-sm">
                  <div class="icon-box"><i class="fas fa-motorcycle fa-5x"></i></div>
                  <div class="title-box float-right">Total Ebike Model</div><br>
                  <div class="total-box float-right"><?php echo $models ?></div><br>
                  <div class="link border-top">
                    <a href="<?php echo base_url('Admin_Model') ?>">view all</a>
                  </div>
              </div>
              <div class="col col-sm-6 col-lg-4 my-2 border shadow-sm">
                  <div class="icon-box"><i class="fas fa-store fa-5x"></i></div>
                  <div class="title-box float-right">Store</div><br>
                  <div class="total-box float-right"> <?php echo $stores ?></div><br>
                  <div class="link border-top">
                    <a href="<?php echo base_url('Admin_Store') ?>">view all</a>
                  </div>
              </div>
              <div class="col col-sm-6 col-lg-4 my-2 border shadow-sm">
                  <div class="icon-box"><i class="fas fa-users fa-5x"></i></div>
                  <div class="title-box float-right">Orders preparing</div><br>
                  <div class="total-box float-right"><?php echo $order_preparing ?></div><br>
                  <div class="link border-top">
                    <a href="">view all</a>
                  </div>
              </div>
              <div class="col col-sm-6 col-lg-4 my-2 border shadow-sm">
                  <div class="icon-box"><i class="fa fa-shopping-cart fa-5x"></i></div>
                  <div class="title-box float-right">Orders ready</div><br>
                  <div class="total-box float-right"><?php echo $order_ready ?></div><br>
                  <div class="link border-top">
                    <a href="">view all</a>
                  </div>
              </div>
              <div class="col col-sm-6 col-lg-4 my-2 border shadow-sm">
                  <div class="icon-box"><i class="fa fa-shopping-cart fa-5x"></i></div>
                  <div class="title-box float-right">orders completed</div><br>
                  <div class="total-box float-right"><?php echo $order_completed ?></div><br>
                  <div class="link border-top">
                    <a href="">view all</a>
                  </div>
              </div>
              <div class="col col-sm-6 col-lg-4 my-2 border shadow-sm">
                  <div class="icon-box"><i class="fas fa-users fa-5x"></i></div>
                  <div class="title-box float-right">Total User</div><br>
                  <div class="total-box float-right"><?php echo $users ?></div><br>
                  <div class="link border-top">
                    <a href="<?php echo base_url('Admin_User') ?>">view all</a>
                  </div>
              </div>
          </div>

  <a href="http://localhost/osishpz/Admin_Dashboard" target="popup" onclick="window.open('http://localhost/osishpz/Admin_Dashboard','popup','width=900,height=700'); return false;">
    Open Link in Popup
  </a>
<script>
   $('#dashboard_link').addClass('bg-secondary');
</script>