
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
    <div class="col border-bottom my-1 py-2">
        <h4>Registration</h4>
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
    <a id="link1" class="mx-1 nav-link text-dark btn notification" href="<?php echo base_url('Admin_Register/pending') ?>">Pending <span class="badge"><?php echo $pending?> </span></a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-1 nav-link text-dark btn notification" href="<?php echo base_url('Admin_Register/registered') ?>">Registered <span class="badge"><?php echo $unclaimed?> </span></a>
  </li>
  <!-- <li class="nav-item">
    <a id="link3" class="nav-link text-dark btn" href="<?php echo base_url('Admin_Delivery/cancelled') ?>">Cancelled</a>
  </li> -->
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="deliveryTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Chasis Number</th>
                        <th>Motor Number</th>
                        <th>Customer</th>
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<!--Complete -->
<div class="modal fade" tabindex="-1" role="dialog" id="completeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Complete</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" id="completeForm">
        <div class="modal-body">
          <p class="" id="complete_message"></p>
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- remove Cancel -->
<div class="modal fade" tabindex="-1" role="dialog" id="cancelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Cancel</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Ebike/production_cancelled') ?>" method="post" id="cancelForm">
        <div class="modal-body">
        <p class="text-capitalize" id="cancel_message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit"  class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- end modal -->


<script>

// $('#ebike_units').addClass('show');
$('#link1').addClass('btn-primary');
$('#registration_link').addClass('btn-secondary');

var deliveryTable;
$(document).ready(function() {

deliveryTable = $('#deliveryTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Register/fetchAllPending')?>',
  'order': []
});

});


function complete(id)
{
  if(id){
    var url = '<?php echo base_url('Admin_Register/getCustomerInfo') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {


           $('#complete_message').html(
             'Please call Mr/s. '+response.customer_firstname+' '+response.customer_lastname+' at '+response.customer_contact+' to notify that registration is now available.'
           );
        }
    });
  
    $("#completeForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: '<?php echo base_url('Admin_Register/complete') ?>',
        type: 'post',
        data: { id: id }, 
        dataType: 'json',
        success:function(response) {
          window.location.reload();
          
        }
      }); 

      return false;
    });
  }
}

function cancel(id)
{
  if(id) {

    var url = '<?php echo base_url('Admin_Ebike/getProductionData') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {

           $('#cancel_message').html(
             'Are you sure to cancel assembling '+response.production.quantity+' '+response.color.color_name+' '+response.model.name+'?'
           );
        }
    });

    $("#deleteColorForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
      
           colorTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            $("#deleteColorModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}
</script>
