
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
        <h4>Completed</h4>
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
    <a id="link1" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Pullout') ?>">Pending<span class="badge"><?php  ?></span></a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-2 text-light btn btn-outline-dark notification" href="<?php echo base_url('Admin_Pullout/completed') ?>">Completed <span class="badge"><?php  ?></a>
  </li>
  <li class="nav-item">
    <a id="link3" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Pullout/Cancelled') ?>">Cancel <span class="badge"><?php ?></a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="pulloutTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Ebike</th>
                        <th>Color</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<!--  Complete modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="completeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Complete</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Pullout/complete') ?>" method="post" id="completeForm">
        <div class="modal-body">
          <!-- <p class="text-capitalize" id="complete_message"></p> -->
          Are you sure to complete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Cancel -->
<div class="modal fade" tabindex="-1" role="dialog" id="cancelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Cancel</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Pullout/cancel') ?>" method="post" id="cancelForm">
        <div class="modal-body">
        <!-- <p class="text-capitalize" id="cancel_message"></p> -->
        Are you sure to cancel?
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

$('#loan').addClass('show');
$('#loan_link3').addClass('btn-secondary');
$('#link2').addClass('btn-primary');


var pulloutTable;
$(document).ready(function() {

pulloutTable = $('#pulloutTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Pullout/fetchCompleted')?>',
  'order': []
});

});



function complete(id)
{
  if(id) {

    $("#completeForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
    
          pulloutTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
            $("#completeModal").modal('hide');
          } 
          else 
          {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
            $("#completeModal").modal('hide');
          }
        }
      }); 

      return false;
    });
  }
}

function cancel(id)
{
  if(id) {

    $("#cancelForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
    
          pulloutTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
            $("#cancelModal").modal('hide');
          } 
          else 
          {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
            $("#cancelModal").modal('hide');
          }
        }
      }); 

      return false;
    });
  }
}
</script>
