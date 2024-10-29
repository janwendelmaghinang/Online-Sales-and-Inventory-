<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }

    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }

    /* .notification {
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
} */
</style>

<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Ready</h3>
    </div>
    <div class="col  mb-2">

    </div>
</div>

<ul class="nav nav-tabs my-3">
  <li class="nav-item">
    <a id="link1" class="mx-1 nav-link text-dark btn notification" href="<?php echo base_url('Admin_Order') ?>">Pending <span class="badge"><?php ?> </span></a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-1 nav-link text-light btn notification" href="<?php echo base_url('Admin_Order/ready') ?>">Ready <span class="badge"><?php ?> </span></a>
  </li>
  <li class="nav-item">
    <a id="link3" class="mx-1 nav-link text-dark btn notification" href="<?php echo base_url('Admin_Order/completed') ?>">Completed <span class="badge"><?php ?> </span></a>
  </li>
  <li class="nav-item">
    <a id="link4" class="mx-1 nav-link text-dark btn notification" href="<?php echo base_url('Admin_Order/cancelled') ?>">Cancelled <span class="badge"><?php ?> </span></a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Online</h5>
            </div>
            <table id="orderTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Total Products</th>
                        <th>Total Amount</th>
                        <!-- <th>Online</th> -->
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="completeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Complete</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Order/update1') ?>" method="post" id="completeForm">
        <div class="modal-body">
          <!-- <p class="text-capitalize" id="complete_message"></p> -->
          Are you sure to complete this order?
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

      <form role="form" action="<?php echo base_url('Admin_Order/update1') ?>" method="post" id="cancelForm">
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

<!-- end of modal -->
<script>

var orderTable;


$('#order_link').addClass('bg-secondary');
// $('#order_link1').addClass('bg-secondary');
$('#link2').addClass('bg-primary');

$(document).ready(function() {

orderTable = $('#orderTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Order/fetchAllReadyOrderData')?>',
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
        data: { id:id , status: 3}, 
        dataType: 'json',
        success:function(response) {
    
          orderTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
                       // send email  
              var mess = 'Your order is now Completed';
              var subjects = 'Order Status';
              $.ajax({
                url: '<?php echo base_url('Email/sendmail') ?>',
                type: 'post',
                data: { email:response.email , message: mess, subject: subjects}, 
                dataType: 'json',
                success:function(response) {

                }
              });   
              
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
        data: { id:id , status: 4}, 
        dataType: 'json',
        success:function(response) {
    
          orderTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            
                       // send email  
              var mess = 'Your order is cancelled';
              var subjects = 'Order Status';
              $.ajax({
                url: '<?php echo base_url('Email/sendmail') ?>',
                type: 'post',
                data: { email:response.email , message: mess, subject: subjects}, 
                dataType: 'json',
                success:function(response) {

                }
              });   
              
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