<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Manage Ebike</h3>
    </div>
    <div class="col  mb-2">

    </div>
</div>

<?php if($this->session->flashdata('exist')): ?>
    <div class="alert alert-danger" role="alert">
    <strong>This Parts is Existing</strong>
</div>
<?php endif; ?>


<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <div class="header-title">
                <h5>Edit Ebike</h5>
            </div>
        </div>
    </div>

    <form action="<?php echo base_url('Admin_Ebike/edit') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <div class="form-group ">
                    <label for="image">Image</label>
                    <input class="form-control form-control-sm" type="file" name="edit_image"id="image">
                </div>

                <!-- <div class="form-group">
                    <label for="edit_model">edit_Model</label>
                    <select class="form-control form-control-sm" name="edit_model" id="edit_model" >
                        <option value="" hidden></option>
                        <?php foreach($models as $model): ?>
                        <option value="<?php echo $model['id']?>"><?php echo $model['model_name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('edit_model'); ?>
                </div> -->

                <div class="form-group">
                    <label for="edit_price">Price</label>
                    <input class="form-control form-control-sm" value="<?php echo $units['price'] ?>" type="number" name="edit_price" id="price" min=0 oninput="validity.valid||(value='');" >
                    <?php echo form_error('edit_price'); ?>
                </div>

                <div class="form-group">
                    <label for="edit_stock_critical">Stock critical</label>
                    <input class="form-control form-control-sm text-danger" value="<?php echo $units['stock_critical'] ?>" type="number" name="edit_stock_critical" id="edit_stock_critical" min=0 oninput="validity.valid||(value='');" >
                    <?php echo form_error('edit_stock_critical'); ?>
                </div>

                <div class="form-group">
                    <label for="edit_description">Description</label>
                    <textarea class="form-control" name="description" id="" cols="100" rows="5"><?php echo $units['description'] ?></textarea>
                </div>
         
                <div class="form-group">
                    <label for="edit_motor_type">Motor type</label>
                    <input class="form-control form-control-sm" value="<?php echo $specs['motor_type'] ?>" type="text" name="edit_motor_type">
                </div>

                <div class="form-group">
                    <label for="edit_rated_voltage">rated voltage</label>
                    <input class="form-control form-control-sm" value="<?php echo $specs['rated_voltage'] ?>"  type="text" name="edit_rated_voltage">
                </div>

                <div class="form-group">
                    <label for="edit_max_speed">max speed</label>
                    <input class="form-control form-control-sm" value="<?php echo $specs['max_speed'] ?>" type="text" name="edit_max_speed">
                </div>

                <div class="form-group">
                    <label for="edit_distance_full">distance full</label>
                    <input class="form-control form-control-sm" value="<?php echo $specs['distance_full'] ?>" type="text" name="edit_distance_full">
                </div>

                <div class="form-group">
                    <label for="edit_charging_time">charging time</label>
                    <input class="form-control form-control-sm" value="<?php echo $specs['charging_time'] ?>" type="text" name="edit_charging_time">
                </div>

                <div class="form-group">
                    <label for="edit_max_load">max load</label>
                    <input class="form-control form-control-sm" value="<?php echo $specs['max_load'] ?>" type="text" name="edit_max_load">
                </div>

                <div class="form-group">
                    <label for="edit_others">others</label>
                    <textarea class="form-control" name="edit_others" id="" cols="100" rows="5"><?php echo $specs['others'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="edit_active">Status</label>
                    <select class="form-control form-control-sm" id="edit_active" name="edit_active">
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

    $('#ebike_units').addClass('show');

    $(document).ready(function(){
        $(".multiple-select").select2();
    });
</script>
