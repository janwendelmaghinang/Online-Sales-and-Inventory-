
<nav class="navigations navbar navbar-expand-lg border-top border-bottom">
  <div class="container">
<button class="toggle-nav-2 navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>       
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="nav nav-ul">
                   <li class="nav-item">
                        <a class="nav-link homeNav" href="<?php echo (base_url()); ?>">Home</a>
                   </li>
                    <li class="nav-item">
                        <a class="nav-link ebikeNav" href="<?php echo (base_url('ebike')); ?>"class="Ebike">E-Bikes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sparepartsNav" href="<?php echo (base_url('spareparts')); ?>">Spare Parts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link contactNav" href="<?php echo (base_url()); ?>contact"class="Contact">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link aboutNav" href="<?php echo (base_url()); ?>about">About us</a>
                    </li> 
                    <?php if (!$this->session->userdata('customer_logged_in')): ?>
                        <li class="nav-item">
                            <a class="nav-link userNav" href="<?php echo (base_url()); ?>user">Account</a>
                        </li>
                    <?php else: ?>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo (base_url()); ?>account">Account</a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo (base_url()); ?>user/logout">logout</a>
                      </li>
                    <?php endif; ?>
               </ul>
        </div>
      </div>
</nav>
<section class="main-container">
