<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Manage Ebike</h3>
    </div>

    <!-- <div class="col  mb-2">
        <div class="form-group">
            <label for="model">Choose Existing Model</label>
            <select class="form-control form-control-sm" id="select_exist" onchange="getEbike()" >
                <option value="" hidden></option>
                <?php foreach($ebikes as $ebike): ?>
                    <?php $store_name = $this->Admin_Store_Model->getStoreData($ebike['store_id'])?>
                    <?php $color = $this->Admin_Color_Model->getColorData($ebike['color_id'])?>
                    <option value="<?php echo $ebike['id']?>"> <?php echo $ebike['name'] ?> / <?php echo $color['color_name'] ?> / <?php echo $store_name['store_name'] ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div> -->
</div>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <div class="header-title">
                <h5>Add Ebike</h5>
            </div>
        </div>
    </div>

    <form action="<?php echo base_url('Admin_Ebike_Branch/create') ?>" method="post">
    <div class="row">
        <div class="col">
                <div class="form-group">
                    <label for="model">Units</label>
                    <select class="form-control form-control-sm" name="unit_id" id="unit_id">
                        <option value="" hidden></option>
                        <?php foreach($units as $unit): ?>
                        <?php $color = $this->Admin_Color_Model->getColorData($unit['color_id'])?>
                        <option value="<?php echo $unit['id']?>"><?php echo $unit['name']?> / <?php echo $color['color_name']?> </option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('model'); ?>
                </div>

                <div class="form-group">
                    <label for="model">Store</label>
                    <select class="form-control form-control-sm" name="store_id" id="store_id">
                        <option value="" hidden></option>
                        <?php foreach($stores as $store): ?>
                        <?php ?>
                        <option value="<?php echo $store['store_id']?>"><?php echo $store['store_name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('model'); ?>
                </div>

                <div class="form-group">
                    <label for="stock_critical">Stock critical</label>
                    <input class="form-control form-control-sm text-danger" type="number" name="stock_critical" id="stock_critical" min=0 oninput="validity.valid||(value='');" >
                    <?php echo form_error('stock_critical'); ?>
                </div>

                <div class="form-group">
                    <label for="active">Status</label>
                    <select class="form-control form-control-sm" id="active" name="active">
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="javascript:history.go(-1)" class="btn btn-warning">Back</a>
                </div>

            </div>
        </div>
    </form>
</div>

<script type="text/javascript"> 
    function getEbike(){
        var id = $('#select_exist').val();
      
        $.ajax({
            url: '<?php echo base_url('admin_ebike/getEbikeById')?>',
            type: 'post',
            data: { id: id }, 
            dataType: 'json',
            success:function(response){
                console.log(response)
              $("#model").val(response.ebike.model_id);
              $("#price").val(response.ebike.price);
              $("#stock_critical").val(response.ebike.stock_critical);
              $("#store").val(response.ebike.store_id);
              $("#description").val(response.ebike.description);
              $("#motor_type").val(response.specs.motor_type) ;
              $("#rated_voltage").val(response.specs.rated_voltage);
              $("#max_speed").val(response.specs.max_speed);
              $("#distance_full").val(response.specs.distance_full);
              $("#charging_time").val(response.specs.charging_time);
              $("#max_load").val(response.specs.max_load);
            }
       });
            
    }
    
</script>
