
<style>
th{
    font-size: 11px;
}
</style>


<div class="row">
    <div class="col border-bottom my-1 py-2">
        <h4>Delivery</h4>
        <a class="btn btn-secondary" href="<?php echo base_url('Admin_Delivery/add_deliver') ?>">Deliver</a>
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
    <a id="link1" class="nav-link text-dark btn" href="<?php echo base_url('Admin_Delivery/pending') ?>">Pending</a>
  </li>
  <li class="nav-item">
    <a id="link2" class="nav-link text-dark btn" href="<?php echo base_url('Admin_Delivery/completed') ?>">Completed</a>
  </li>
  <li class="nav-item">
    <a id="link3" class="nav-link text-dark btn" href="<?php echo base_url('Admin_Delivery/cancelled') ?>">Cancelled</a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="deliveryTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Delivery Number</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Selling Price per item</th>
                        <th>Total Price</th>
                        <th>Prepared by</th>
                        <th>Received by</th>
                        <th>Date Time Prepared</th>
                        <th>Date Time Received</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                        Delivery no.
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<!-- remove Complete -->
<div class="modal fade" tabindex="-1" role="dialog" id="completeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Complete</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Ebike/production_completed') ?>" method="post" id="completeForm">
        <div class="modal-body">
          <p class="text-capitalize" id="complete_message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
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
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- end modal -->


<script>

// $('#ebike_units').addClass('show');
$('#link1').addClass('btn-primary');
$('#delivery_link').addClass('btn-secondary');

var deliveryTable;
$(document).ready(function() {

deliveryTable = $('#deliveryTable').DataTable({
//   'ajax': '<?php echo base_url('Admin_Ebike/fetchAllProductionData/1')?>',
//   'order': []
});

});

// delete ajax
function complete(id)
{
  if(id){
    var url = '<?php echo base_url('Admin_Ebike/getProductionData') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {

           $('#complete_message').html(
             'Are you sure that '+response.production.quantity+' '+response.color.color_name+' '+response.model.name+' are now completed?'
           );
        }
    });

    $("#completeForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
      
            deliveryTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            $("#completeModal").modal('hide');

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
