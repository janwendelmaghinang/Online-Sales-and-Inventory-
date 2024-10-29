
<style>
th{
    font-size: 11px;
}

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
        <h4>Amortization</h4>
        <!-- <button type="button" onclick="newCustomer()" class="btn btn-primary mb-1" data-toggle="modal" data-target="#applicantModal">New Applicant</button> -->
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

<ul class="nav nav-tabs my-3">
  <li class="nav-item">
    <a id="link1" class="mx-2  btn btn-outline-dark notification text-dark" href="<?php echo base_url('Admin_Amortization') ?>">Amortization <span class="badge"><?php  ?></span></a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-2  btn btn-outline-dark notification text-light" href="<?php echo base_url('Admin_Amortization/pastdue') ?>">Past Due <span class="badge"><?php if(!$pastdue == 0 ){echo $pastdue;}  ?></a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="amortizationTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Customer</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modals -->

<div class="modal fade" tabindex="-1" role="dialog" id="pulloutModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Complete</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('Admin_Amortization/pullout') ?>" method="post" id="pulloutForm" enctype="multipart/form-data">
         
         <div class="modal-body">
            Are you sure to request a pullout of the unit?
         </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- end modal -->

<script>
$('#link2').addClass('btn-primary');
$('#loan').addClass('show');
$('#loan_link2').addClass('btn-secondary');

var amortizationTable;
$(document).ready(function() {

amortizationTable = $('#amortizationTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Amortization/fetchAmortizationPastDue')?>',
  'order': []
});

$.ajax({
    url: '<?php echo base_url('Admin_Amortization/update_due') ?>',
    type: 'post',
    dataType: 'json',
    success:function(response) {
        amortizationTable.ajax.reload(null, false); 
    }
    }); 
return false;

});

function pullout(id){
    if(id){
        $("#pulloutForm").on('submit', function() {
            var form = $(this);
            
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: {id: id}, 
                dataType: 'json',
                success:function(response) {
                    console.log(response)
                }
            }); 
            return false;
            });
    }
    // compute();
}

</script>