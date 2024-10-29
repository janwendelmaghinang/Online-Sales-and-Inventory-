
<style>
  .notification {
  position: relative;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
</style>

<div class="row">
    <div class="col border-bottom my-1">
        <h4>Production</h4>
        <?php if($btn_trigger == true ):?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addJOModal">Add J.O</button>
        <?php endif; ?>
        <?php if($btn_trigger == false ):?>
            <a class="btn btn-primary" href="<?php echo base_url('Admin_Ebike/production') ?>">Add J.O</a>
        <?php endif; ?>
    </div>
</div>

<?php if($this->session->flashdata('messages')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('messages') ?>
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

<ul class="nav my-3">
  <li class="nav-item">
    <a id="link1" class=" mx-1 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Ebike/pending') ?>"><span>Pending</span> <span class="badge"><?php echo $pending?> </span> </a>
  </li>
  <li class="nav-item">
    <a id="link2" class=" mx-1 text-light btn btn-outline-dark" href="<?php echo base_url('Admin_Ebike/completed') ?>">Completed</a>
  </li>
  <li class="nav-item">
    <a id="link3" class=" mx-1 text-dark btn btn-outline-dark" href="<?php echo base_url('Admin_Ebike/cancelled') ?>">Cancelled</a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="ebikeTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Technician</th>
                        <th>Store</th>
                        <th>Date Started</th>
                        <th>Date Finished</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addJOModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong class="text-dark"> Please Set Chasis and Serial Number</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- end modal -->


<script>

$('#ebike_units').addClass('show');
$('#link2').addClass('btn-primary');
$('#production_link1').addClass('btn-secondary');

var ebikeTable;
$(document).ready(function() {

ebikeTable = $('#ebikeTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Ebike/fetchAllProductionData1/2')?>',
  'order': []
});

});
</script>