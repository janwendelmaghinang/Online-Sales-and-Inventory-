<div class="row">
    <div class="col col-sm-6 col-lg-4 m-1 border shadow-sm">
        <div class="icon-box"><i class="fas fa-tools fa-5x"></i></div>
        <div class="title-box float-right">Total Spareparts</div><br>
        <div class="total-box float-right"><?php echo $stock_parts ?></div><br>
        <div class="link border-top">
        <a href="<?php echo base_url('Admin_Inventory/spareparts') ?>">view all</a>
        </div>
    </div>
    <div class="col col-sm-6 col-lg-4 m-1 border shadow-sm">
        <div class="icon-box"><i class="fas fa-motorcycle fa-5x"></i></div>
        <div class="title-box float-right">Total Ebike</div><br>
        <div class="total-box float-right"><?php echo $stock_models ?></div><br>
        <div class="link border-top">
        <a href="<?php echo base_url('Admin_Inventory/ebike') ?>">view all</a>
        </div>
    </div>
</div>
<script>
    $('#inventory_main').addClass('bg-secondary');
</script>