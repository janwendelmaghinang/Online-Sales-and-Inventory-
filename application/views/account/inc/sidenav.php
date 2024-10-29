<div class="col col-md-3">

    <div class="row">
        <label for=""><strong>My Account</strong></label>
        <a class="btn w-100 text-left text-dark border-0 shadow-lg" href="<?php echo base_url('account') ?>">Profile</a>
        <a class="btn w-100 text-left text-dark border-0 shadow-lg" href="<?php echo base_url('account/set_password') ?>">Set Password</a>
    </div>
    <div class="row">
        <label for=""><strong>My Orders</strong></label>
       <!-- <a class="btn w-100 text-left text-dark border-0 shadow-lg" href="<?php echo base_url('account/myorders') ?>">Orders</a> -->
    </div>
    <div class="row">
       <a id="link1" class="btColor btn w-100 text-left border-0 shadow-lg" href="<?php echo base_url('order/allorder') ?>">All</a>
    </div>
    <!-- <div class="row">
       <a class="btColor btn w-100 text-left text-dark border-0 shadow-lg" href="<?php echo base_url('') ?>">To Pay</a>
    </div>
    <div class="row">
       <a class="btColor btn w-100 text-left text-dark border-0 shadow-lg" href="<?php echo base_url('account/to_ship') ?>">To Ship</a>
    </div> -->
    <div class="row">
       <a id="link2" class="btColor btn w-100 text-left border-0 shadow-lg" href="<?php echo base_url('order/ready') ?>">Ready</a>
    </div>
    <div class="row">
       <a id="link3" class="btColor btn w-100 text-left border-0 shadow-lg" href="<?php echo base_url('order/completed') ?>">Completed</a>
    </div>
    <div class="row">
       <a id="link4" class="btColor btn w-100 text-left border-0 shadow-lg" href="<?php echo base_url('order/cancelled') ?>">Cancelled</a>
    </div>
</div>