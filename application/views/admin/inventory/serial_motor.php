<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    #modelFilter{
    display: inline;
    margin-left: 25px;
  }
  
  #modelFilter1{
    display: inline;
    margin-left: 25px;
  }
</style>

<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Motor</h3>
         <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addEbikeStockModal">Add Stock</button> -->
    </div>
</div>

<div class="row p-2 border-bottom">
  <div class="col">
      <ul class="nav">
        <li class="nav-item">
          <a id="link1" class=" text-dark btn" href="<?php echo base_url('Admin_Inventory/serial_motor') ?>">Motor</a>
        </li>
        <li class="nav-item">
          <a id="link2" class=" text-dark btn" href="<?php echo base_url('Admin_Inventory/serial_chasis') ?>">Chassis</a>
        </li>
      </ul>
  </div>

  <div class="col ">
      <a class="btn btn-warning float-right" href="<?php echo base_url('Admin_Inventory/spareparts') ?>">Back</a>
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

<div id="messages"></div>
<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Motor</h5>
            </div>
            <table id="serialTable" class="table table-bordered table-striped ">
              <thead>
                    <tr>
                        <th>Id</th>
                        <th>Serial Number</th>
                        <th>Model</th>
                        <th>Status</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->
<!-- add parts stock  -->
<div class="modal fade" tabindex="-1" role="dialog" id="addEbikeStockModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Inventory/addEbikeStock') ?>" method="post" id="addEbikeStockForm">
        <div class="modal-body">
           <div class="form-group">
               <label for="">Choose Model</label>
               <select class="form-control form-control-sm" name="model_id" id="model_id">
                  <option hidden value=""></option>
                  <?php foreach($models as $model): ?>
                    <option value="<?php echo $model['id'] ?>"><?php echo $model['name']?></option>
                  <?php endforeach; ?>
               </select>
           </div>

           <div class="form-group">
               <label for="">Choose Color</label>
               <select class="form-control form-control-sm" name="color_id" id="color_id">
                   <option hidden value=""></option>
                  <option value="0">generic</option>
                  <?php foreach($colors as $color): ?>
                    <option value="<?php echo $color['id'] ?>"><?php echo $color['color_name'] ?></option>
                  <?php endforeach; ?>
               </select>
           </div>

           <div class="form-group">
               <label for="">Stored at</label>
               <input class="form-control" type="text" value="Warehouse" readonly>
           </div>
         </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- add stock quantity -->
<div class="modal fade" tabindex="-1" role="dialog" id="addStockQtyModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title_1">

        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Inventory/addStockQty') ?>" method="post" id="addStockQtyForm">
        <div class="modal-body">

           <div class="form-group">
                <label for="quantity">Quantity</label>
                  <input class="form-control form-control-sm" type="number" name="qty_1" id="qty_1" min=1 oninput="validity.valid||(value='');">
          </div>

         <div class="form-group">
            <label for="serial">Serial Number</label>
            <select class="form-control form-control-sm" id="serial_1" name="serial_1" onchange="show_field_1()" >
                <option id="opt1" value="1">Yes</option>
                <option id="opt2" selected value="2">No</option>
            </select>

            <div class="form-group">
                <label for="serial_div_1"></label>
                <div class="row ml-4" id="serial_div_1" name="serial_div_1"></div>
            </div>

         </div>

         </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- end of modal -->

<script>
$('#inventory').addClass('show');
$('#inventory_link1').addClass('bg-secondary');
$('#link1').addClass('bg-primary');


var serialTable = $('#serialTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Inventory/fetchAllMotorData/')?>',
  'spareparts': [],
});

</script>
