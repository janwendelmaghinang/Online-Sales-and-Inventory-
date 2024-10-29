
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>

<div class="row border-bottom">
    <div class="col">
         <h3>Manage Spareparts</h3>
    </div>
    <div class="col">
       <a href="<?php echo base_url('Admin_Spareparts') ?>" class="btn btn-warning float-right">Back</a>
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
                <h5>Add Spareparts</h5>
            </div>
        </div>
    </div>

    <form action="<?php echo base_url('Admin_Spareparts/create') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="image">Image <small class="text-danger">(required)</small></label>
                    <input class="form-control form-control-sm" type="file" name="image"id="image">
                </div>

                <div class="form-group">
                    <label for="name">Parts Name <small class="text-danger">(required)</small></label>
                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter parts name" autocomplete="off" onkeyup="check_name()" >
                    <?php echo form_error('name'); ?>
                </div>

                <div class="form-group">
                    <label for="model">Model <small class="text-danger">(required)</small></label>
                    <select class="form-control form-control-sm" name="model" id="model">
                        <option hidden value=""></option>
                        <option value="0">generic</option>
                        <?php foreach($models as $model): ?>
                        <!-- <?php $color = $this->Admin_Color_Model->getColorData($model['color_id'])?> -->
                        <option value="<?php echo $model['id']?>"><?php echo $model['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('model'); ?>
                </div>

                <!-- <div class="form-group">
                    <label for="color">Color</label>
                    <select class="form-control form-control-sm" name="color" id="color">
                        <option hidden value=""></option>
                        <option value="0">generic</option>
                        <?php foreach($colors as $color): ?>
                         <option value="<?php echo $color['id']?>"><?= $color['color_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('color'); ?>
                </div> -->

                <!-- <div class="form-group">
                    <label for="price">Price</label>
                    <input class="form-control form-control-sm" type="number" name="price" id="price" min=0 step="any" >
                    <?php echo form_error('price'); ?>
                </div> -->

                <div class="form-group">
                    <label for="price">Supplier's Price <small class="text-danger">(required)</small></label>
                    <input class="form-control form-control-sm" type="number" name="supplier_price" id="supplier_price" min=0 step="any" onkeyup="computeMarkup()" >
                    <?php echo form_error('supplier_price'); ?>
                </div>

                <div class="form-group">
                    <label for="price">Selling Price <small class="text-danger">(required)</small></label>
                    <input class="form-control form-control-sm" type="number" name="selling_price" id="selling_price" min=0 step="any" onkeyup="computeMarkup()"  >
                    <?php echo form_error('price'); ?>
                </div>

                <div class="form-group">
                    <label for="price">Mark_up</label>
                    <input class="form-control form-control-sm" type="number" name="markup" id="markup" min=0 step="any" readonly>
                    <?php echo form_error('markup'); ?>
                </div>


                <div class="form-group">
                    <label for="stock_critical">Stock critical <small class="text-danger">(required)</small></label>
                    <input class="form-control form-control-sm text-danger" type="number" name="stock_critical" id="stock_critical" min=0 oninput="validity.valid||(value='');" >
                    <?php echo form_error('stock_critical'); ?>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity Per Ebike <small class="text-danger">(required)</small></label>
                    <input class="form-control form-control-sm" type="number" name="qty_per_ebike" id="qty_per_ebike" min=0 oninput="validity.valid||(value='');" >
                    <?php echo form_error('qty'); ?>
                </div>

                <div class="form-group">
                    <label for="serial">Serial Number</label>
                    <input type="text" id="serial_number_display" class="form-control form-control-sm" value="No" readonly>
                    <input type="hidden" id="serial_number" name="serial_number" readonly>

                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input class="form-control form-control-sm" type="text" name="description">
                </div>

                <div class="form-group">
                    <label for="active">Status </label>
                    <select class="form-control form-control-sm" id="active" name="active">  
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
               
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript"> 

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

function check_name(){
    var partsname = document.querySelector("#name");
    var serial_number = document.querySelector("#serial_number");
    var serial_nummber_display = document.querySelector("#serial_number_display");
    
    if(partsname.value.toLowerCase() == 'chasis' || partsname.value.toLowerCase() == 'chassis' || partsname.value.toLowerCase() == 'motor'){
       serial_number.value = 1;
       serial_nummber_display.value = 'Yes'
    }
    else
    {
        serial_number.value = 2;
        serial_nummber_display.value = 'No'
    }

}


$('#spareparts_link').addClass('bg-secondary');
 
    $(document).ready(function(){
        $(".multiple-select").select2();
    });
   
</script>
