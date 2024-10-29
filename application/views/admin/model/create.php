<div class="row border-bottom">
    <div class="col">
         <h3>Manage Model</h3>
    </div>
    <div class="col">
       <a href="<?php echo base_url('Admin_Model') ?>" class="btn btn-warning float-right">Back</a>
    </div>
</div>


<?php if($this->session->flashdata('messages_success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('messages_success') ?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('messages_danger')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('messages_danger') ?>
    </div>
<?php endif; ?>

<div class="container-fluid">
    <div class="row py-2">
        <div class="col">
            <div class="header-title">
                <h5>Add Model</h5>
            </div>
        </div>
    </div>

    <form action="<?php echo base_url('Admin_Model/create') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
                <div class="form-group ">
                    <label for="image">Image <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="file" name="image"id="image" >
                </div>

                <div class="form-group">
                    <label for="model_name">Model Name <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="text" name="model_name" id="model_name">
                    <?php echo form_error('model_name'); ?>
                </div>
                
                <!-- <div class="form-group">
                    <label for="color">Color</label>
                    <select class="form-control" name="color" id="color" >
                    <option value=""hidden></option>
                    <?php foreach($colors as $color): ?>
                    <option value="<?php echo $color['id'] ?>"><?php echo $color['color_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                    <?php echo form_error('color'); ?>
                </div> -->

                <div class="form-group">
                    <label for="price">Price <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="number" name="price" id="price" min=0 oninput="validity.valid||(value='');" >
                    <?php echo form_error('price'); ?>
                </div>

                <div class="form-group">
                    <label for="stock_critical">Stock critical <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm text-danger" type="number" name="stock_critical" id="stock_critical" min=0 oninput="validity.valid||(value='');" >
                    <?php echo form_error('stock_critical'); ?>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="100" rows="5"></textarea>
                </div>
         
                <div class="form-group">
                    <label for="motor_type">Motor type <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="text" name="motor_type" id="motor_type" placeholder="W (watt)">
                </div>

                <div class="form-group">
                    <label for="rated_voltage">Rated_voltage <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="text" name="rated_voltage" id="rated_voltage" placeholder="V (Voltage)" >
                </div>

                <div class="form-group">
                    <label for="max_speed">Max_speed <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="text" name="max_speed" id="max_speed"placeholder="km/h">
                </div>

                <div class="form-group">
                    <label for="distance_full">distance_full <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="text" name="distance_full" id="distance_full" placeholder="km (kilometer)" >
                </div>

                <div class="form-group">
                    <label for="charging_time">charging_time <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="text" name="charging_time" id="charging_time" placeholder="hr (hour)" >
                </div>

                <div class="form-group">
                    <label for="max_load">max_load <small class="text-danger">(required)</small></label>
                    <input required class="form-control form-control-sm" type="text" name="max_load" id="max_load" placeholder="kg (kilogram)">
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

$('#model_link').addClass('bg-secondary');
    
    // function getEbike(){
    //     var id = $('#select_exist').val();
      
    //     $.ajax({
    //         url: '<?php echo base_url('admin_ebike/getEbikeById')?>',
    //         type: 'post',
    //         data: { id: id }, 
    //         dataType: 'json',
    //         success:function(response){
    //             console.log(response)
    //           $("#model").val(response.ebike.model_id);
    //           $("#price").val(response.ebike.price);
    //           $("#stock_critical").val(response.ebike.stock_critical);
    //           $("#description").val(response.ebike.description);
    //           $("#motor_type").val(response.specs.motor_type) ;
    //           $("#rated_voltage").val(response.specs.rated_voltage);
    //           $("#max_speed").val(response.specs.max_speed);
    //           $("#distance_full").val(response.specs.distance_full);
    //           $("#charging_time").val(response.specs.charging_time);
    //           $("#max_load").val(response.specs.max_load);
    //         }
    //    });     
    // }
    
</script>
