
<div class="row border-bottom">
    <div class="col">
         <h3>Manage Spareparts</h3>
    </div>
    <div class="col">
    <a href="<?php echo base_url('Admin_Spareparts') ?>" class="btn btn-warning float-right">Back</a>
    </div>
</div>

<div class="container-fluid">
    <div class="row py-2">
        <div class="col">
            <div class="header-title">
                <h5>Edit Spareparts</h5>
            </div>
        </div>
    </div>

    <form action="<?php echo base_url('Admin_Spareparts/edit/'.$parts['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="image">Image</label>
                    <input class="form-control" type="file" name="image" id="image">
                    <input type="hidden" name="image_hidden" value="<?php echo $parts['image'] ?>">
                    <div>
                        <img src="<?php echo base_url($parts['image'])?>" alt="" height="150px" width="auto">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Parts Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $parts['name'] ?>" placeholder="Enter parts name" autocomplete="off">
                    <?php echo form_error('name'); ?>
                </div>

                <!-- <div class="form-group">
                    <label for="model">Model</label>
                    <select class="form-control" name="model" id="model" >
                        <option value=""></option>
                        <?php foreach($models as $model): ?>
                            <?php $color = $this->Admin_Color_Model->getColorData($model['color_id'])?>
                        <option value="<?php echo $model['id']?>" <?php if($model['id'] == $parts['model_id']):?> selected <?php endif; ?>><?php echo $model['name'] .' / '. $color['color_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('model'); ?>
                </div> -->

                <div class="form-group">
                    <?php
                    $model = '';
                    if($parts['model_id'] == 0){
                       $model = 'Generic';
                    }
                    else 
                    {
                       $data = $this->Admin_Model_Model->getModelData($parts['model_id']);
                       $model = $data['name'];
                    }
                    ?>
                    <label for="description">Model</label>
                    <input class="form-control" type="text" name="model" value="<?php echo $model ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="price">Supplier's Price</label>
                    <input class="form-control form-control-sm" type="number" name="supplier_price" value="<?php echo $parts['supplier_price'] ?>" id="supplier_price" min=0 step="any" onkeyup="computeMarkup()" >
                    <?php echo form_error('supplier_price'); ?>
                </div>

                <div class="form-group">
                    <label for="selling_price">Selling Price</label>
                    <input class="form-control" type="number" name="selling_price" id="selling_price" value="<?php echo $parts['price'] ?>" min=0 step="any"  oninput="computeMarkup()">
                    <?php echo form_error('price'); ?>
                </div>

                <div class="form-group">
                    <label for="price">Mark_up</label>
                    <input class="form-control form-control-sm" type="number" name="markup" value="<?php echo $parts['markup'] ?>" id="markup" min=0 step="any" readonly>
                    <?php echo form_error('markup'); ?>
                </div>

                <div class="form-group">
                    <label for="stock_critical">Stock critical</label>
                    <input class="form-control text-danger" type="number" name="stock_critical" id="stock_critical"  value="<?php echo $parts['stock_critical'] ?>" min=0 oninput="validity.valid||(value='');" >
                    <?php echo form_error('stock_critical'); ?>
                </div>

                <div class="form-group">

                    <?php 
                    $serial = '';
                    if($parts['serial_number'] == 1){
                       $serial = 'Yes';
                    }
                    else 
                    {
                        $serial = 'No';
                    }
                    ?>

                    <label for="serial_number">Serial Number</label>
                    <input class="form-control" type="text" value="<?php echo $serial ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input class="form-control" type="text" name="description" value="<?php echo $parts['description'] ?>">
                </div>

                <div class="form-group">
                    <label for="active">Status</label>
                    <select class="form-control" id="active" name="active">
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </form>

</div>

<script type="text/javascript"> 



    $('#spareparts_link').addClass('bg-secondary');
    $(document).ready(function(){
        $(".multiple-select").select2();
    });


    function computeMarkup(){
    var supplier_price = document.querySelector('#supplier_price');
    var selling_price = document.querySelector('#selling_price');
    var markup = document.querySelector('#markup');
    
   
    if(!selling_price.value == '' && !supplier_price.value == ''){
        var total = (selling_price.value - supplier_price.value);
        markup.value = total.toFixed(2);
    }
    else
    {
        markup.value = null;
    }
}

</script>
