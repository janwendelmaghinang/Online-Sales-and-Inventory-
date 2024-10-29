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
         <h3>Online Ebike Inquiry</h3>
    </div>
    <div class="col  mb-2">

    </div>
</div>

<ul class="nav nav-tabs my-3">
  <li class="nav-item">
    <a id="link1" class="mx-1 nav-link text-light btn notification" href="<?php echo base_url('Admin_Inquiry') ?>">Waiting <span class="badge"><?php ?> </span></a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-1 nav-link text-dark btn notification" href="<?php echo base_url('Admin_Inquiry/responded') ?>">Responded <span class="badge"><?php ?> </span></a>
  </li>
  <li class="nav-item">
    <a id="link3" class="mx-1 nav-link text-dark btn notification" href="<?php echo base_url('Admin_Inquiry/completed') ?>">Completed <span class="badge"><?php ?> </span></a>
  </li>
  <li class="nav-item">
    <a id="link4" class="mx-1 nav-link text-dark btn notification" href="<?php echo base_url('Admin_Inquiry/cancelled') ?>">Cancelled <span class="badge"><?php ?> </span></a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Online</h5>
            </div>
            <table id="inquiryTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Branch</th>
                        <th>Payment Method</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="callnowModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Complete</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Inquiry/update') ?>" method="post" id="callnowForm">
        <div class="modal-body">
          <p class="text-capitalize" id="callnow_message"></p>
          <!-- Call the Customer -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
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

      <form role="form" action="<?php echo base_url('Admin_Inquiry/update') ?>" method="post" id="cancelForm">
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

var inquiryTable;


$('#inquiry_link').addClass('bg-secondary');
// $('#order_link1').addClass('bg-secondary');
$('#link1').addClass('bg-primary');

$(document).ready(function(){

inquiryTable = $('#inquiryTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Inquiry/fetchAllPendingInquiryData')?>',
  'order': []
});
});



function callnow(id)
{
  if(id) {
    var url = '<?php echo base_url('Admin_Inquiry/getInquiryInfo') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {

           $('#callnow_message').html(
             'Please call Mr/s. '+response.customer_firstname+' '+response.customer_lastname+' at '+response.customer_contact+' to notify that registration is now available.'
           );
        }
    });

    $("#callnowForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id, status: 2, date: 'date_approved' }, 
        dataType: 'json',
        success:function(response) {
    
          inquiryTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
            $("#callnowModal").modal('hide');
          } 
          else 
          {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
            $("#callnowModal").modal('hide');
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
        data: { id:id , status: 4, date: 'date_cancelled'}, 
        dataType: 'json',
        success:function(response) {
    
          inquiryTable.ajax.reload(null, false); 

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