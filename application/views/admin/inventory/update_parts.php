
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>

<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Update Spareparts Stock</h3>
    </div>
    <div class="col  mb-2">

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
    <div class="row mb-3">
        <div class="col">
            <div class="header-title">
                <h5>Spareparts</h5>
            </div>
        </div>
    </div>

    <form action="<?php echo base_url('Admin_Inventory/update_parts_stock/'.$id) ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col">

                <div class="form-group">
                    <label for="">Model</label>
                    <input readonly class="form-control form-control-sm" name="name" value="<?php echo $parts['name'] ?>" type="text">
                </div>

                <!-- <div class="form-group">
                    <label for="">Color</label>
                    <input disabled class="form-control form-control-sm" value="<?php echo $color['color_name'] ?>" type="text">
                </div> -->
   
                <div class="form-group" id="serial_qty_form">
                    <label for="quantity">Quantity</label>
                    <input class="form-control form-control-sm" type="number" name="qty" id="qty" min=1 oninput="validity.valid||(value='');">
                    <?php echo form_error('qty'); ?>
                </div>

                <div class="form-group">
                    <label for="serial">Serial Number</label>
                    <select class="form-control form-control-sm" id="serial" name="serial" onchange="show_field()" >
                    <?php if($parts['serial_number'] == 1 ):?>
                        <option selected disabled value="1">Yes</option>
                    <?php elseif($parts['serial_number'] == 2 || $parts['serial_number'] == null):?>
                        <option selected disabled value="2">No</option>
                    <?php endif; ?>
                    </select>

                    <div class="form-group">
                        <label for="serial_div"></label>
                        <div class="row ml-4" id="serial_div" name="serial_div"></div>
                    </div>
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

    $('#inventory').addClass('show');
    $('#inventory_link1').addClass('bg-secondary');

    show_field();
 
    $(document).ready(function(){
        $(".multiple-select").select2();
    });

    function show_field(){
         var serial = document.querySelector('#serial');

            if(serial.value == 1){
               $('#qty').attr({
                   'onkeyup': 'serial_qty()'
               })
               serial_qty()
            }
            if(serial.value == 2){
                qty.value = null;
                $('#qty').attr({
                   'onkeyup': ''
                })
               serial_qty()
            }
      }
            
    function serial_qty(){
        var qty = document.querySelector('#qty');
        var serialHtml = '';
            
            if(qty.value == 0 || qty.value == null){
                $('#serial_div').html('');
            }
            else 
            {
            for(var i = 0; i < qty.value; i++){
                serialHtml += '<div class="col col-4 my-1"><input class="form-control form-control-sm" type="text" id="serial_number" name="serial_number[]" placeholder="Enter Serial Number" required></div>'
                $('#serial_div').html(serialHtml);
            }
            }
    }
    

</script>
