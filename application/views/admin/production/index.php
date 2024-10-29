
<div class="row">
    <div class="col border-bottom my-1">
        <h4>Production</h4>
    </div>
</div>

<div class="row">
    <div class="col">
      <a href="javascript:history.go(-1)" class="btn btn-warning float-right">Back</a>
    </div>
</div>


<?php if($this->session->flashdata('completed')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('completed') ?>
    </div>
<?php endif; ?>

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
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
var ebikeTable;
$(document).ready(function() {

ebikeTable = $('#ebikeTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Production/fetchAllProductionData')?>',
  'order': []
});

});
</script>