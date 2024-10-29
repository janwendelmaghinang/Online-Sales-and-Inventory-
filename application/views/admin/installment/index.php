
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
        <h4>Ebike Loan</h4>
        <button type="button" onclick="newCustomer()" class="btn btn-primary mb-1" data-toggle="modal" data-target="#applicantModal">New Applicant</button>
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
    <a id="link1" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment') ?>">Customer Investigation <span class="badge"><?php if(!$pending == 0){echo $pending;} ?></span></a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/approved') ?>">Approved <span class="badge"><?php if(!$approved == 0){echo $approved;} ?></a>
  </li>
  <li class="nav-item">
    <a id="link3" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/disapproved') ?>">Disapproved <span class="badge"><?php if(!$disapproved == 0 ){echo $disapproved;}?></a>
  </li>
  <li class="nav-item">
    <a id="link4" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/released') ?>">Released <span class="badge"><?php if(!$released == 0 ){echo $released;}?></a>
  </li>
  <li class="nav-item">
    <a id="link5" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/cancelled') ?>">Cancelled <span class="badge"><?php if(!$cancelled == 0 ){echo $cancelled;}?></a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="installmentTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ebike</th>
                        <th>Color</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<!-- new applicant modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="applicantModal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Complete</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Installment/application') ?>" method="post" id="applicantForm" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
              <div class="col">
                <div class="form-group" id="select_form_div">
                    <label for="Customer">Customer</label>
                    <select required class="form-control form-control-sm" name="customer_select_id" id="customer_select_id" required>
                        <option hidden></option>
                        <?php foreach($customers as $customer): ?>
                            <option value="<?php echo $customer['id'] ?>"><?php echo $customer['customer_firstname'] ?> <?php echo $customer['customer_lastname'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

              </div>
              <div class="col d-flex flex-wrap align-content-center">
                    <div class="btn-group ">
                        <button type="button" onclick="newCustomer()"class="btn btn-sm btn-primary" id="newCustBtn">New Customer</button>
                    </div>
              </div>   
          </div>
          <div class="row">
            <div class="col">
             <div class="form-group">
                <label for="">Choose Model</label>
                  <div class="form-group">
                      <select class="form-control form-control-sm " name="ebike_id" id="ebike_id" required>
                          <option value=""hidden></option>
                          <?php foreach($models as $model): ?>
                              <option value="<?php echo $model['id']?>"><?php echo $model['name'] ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                  <label for="">Choose Color</label>
                  <div class="form-group">
                      <select class="form-control form-control-sm " name="color_id" id="color_id" required>
                          <option value=""hidden></option>
                          <?php foreach($colors as $color): ?> 
                              <option value="<?php echo $color['id']?>"><?php echo $color['color_name'] ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
              </div>
          </div>
        
          <input type="hidden" id="form_show" value="0"> <!-- boolean -->
          <div id="new_form"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button onclick="applicant()" type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- approved modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="approvedModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Cancel</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Installment/submit_approved') ?>" method="post" id="approvedForm">
        <div class="modal-body">
        <p class="" id="message1"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- disapproved modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="disapprovedModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Cancel</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Installment/submit_disapproved') ?>" method="post" id="disapprovedForm">
        <div class="modal-body">
        <!-- <p class="text-capitalize" id="cancel_message"></p> -->
        Are you sure?
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
$('#loan_link1').addClass('btn-secondary');
$('#link1').addClass('btn-primary');


var installmentTable;
$(document).ready(function() {

installmentTable = $('#installmentTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Installment/fetchInstallment')?>',
  'order': []
});

});

function newCustomer(){
     var form_show = document.querySelector('#form_show');
     var cust_select = document.querySelector('#customer_select_id');
     if(form_show.value == 0){
        form_show.value = 1;
        cust_select.toggleAttribute('disabled', true);
        cust_select.value = ''; 
        $('#new_form').html(
         `
         <strong><label>Customer Name</label></strong> 
         <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Firstname</label>
                    <input class="form-control form-control-sm" name="customer_firstname" id="customer_firstname" type="text" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Lastname</label>
                    <input class="form-control form-control-sm" name="customer_lastname" id="customer_lastname" type="text" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Middle Name</label>
                    <input class="form-control form-control-sm" name="customer_middle" id="customer_middle" type="text" required>
                </div>
            </div>
        </div>

        <strong><label>Customer Address</label></strong> 
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Number</label>
                    <input class="form-control form-control-sm" name="customer_contact" id="customer_contact" type="number" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control form-control-sm" name="customer_email" id="customer_email" type="email" required>
                </div>
            </div>
        </div>

        <strong><label>Customer Address</label></strong> 
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Street</label>
                    <input class="form-control form-control-sm" name="customer_street" id="customer_street" type="text" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Subdivision</label>
                    <input class="form-control form-control-sm" name="customer_subdivision" id="customer_subdivision" type="text" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Barangay</label>
                    <input class="form-control form-control-sm" name="customer_barangay" id="customer_barangay" type="text" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">City</label>
                    <input class="form-control form-control-sm" name="customer_city" id="customer_city" type="text" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Province</label>
                    <input class="form-control form-control-sm" name="customer_province" id="customer_province" type="text" required>
                </div>
            </div>
        </div>
        <strong><label>Uploading Requirements</label></strong> 
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Barangay Clearance</label>
                    <input class="form-control form-control-sm" name="application_form" id="application_form" type="file" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Valid Id</label>
                    <input class="form-control form-control-sm" name="customer_valid_id" id="customer_valid_id" type="file" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Proof of Billing/Payslip</label>
                    <input class="form-control form-control-sm" name="pob" id="pob" type="file" required>
                </div>
            </div>
        </div>
   
        <input name="truecase" id="truecase" type="hidden" value="2" >                                   
         `
      )   
     }
     else
     {
         cust_select.toggleAttribute('disabled', false);
         cust_select.value = ''; 
         $('#new_form').html(`
         <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Barangay Clearance</label>
                    <input class="form-control form-control-sm" name="application_form" id="application_form" type="file" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Proof of Billing/Payslip</label>
                    <input class="form-control form-control-sm" name="pob" id="pob" type="file" required >
                </div>
            </div>
          </div>
          <input name="truecase" id="truecase" type="hidden" value="1" >
         `);
         form_show.value = 0;
     }
}









// delete ajax
function approved(id)
{
  var cust_email;
  if(id){
    var url = '<?php echo base_url('Admin_Installment/getCustomer') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
           cust_email = response.customer_email;
           $('#message1').html(
             'Are you sure to aprrove Mr/s. '+'<span class="text-capitalize">'+response.customer_firstname+' '+response.customer_lastname+'</span>'+' Ebike Loan Application?'
           );
        }
    });

    $("#approvedForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();
      $('#approvedModal').modal('hide');
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
          if(response.success === true){
               var mess = `
              Good day,

              This message is sent to inform you that the ebike unit you loaned is now approve. Thank you!
              `;
              var subjects = 'Ebike Loan';
              $.ajax({
              url: '<?php echo base_url('Admin_Installment/sendmail') ?>',
              type: 'post',
              data: { email: cust_email , message: mess, subject: subjects}, 
              dataType: 'json',
              success:function(response) {
                
              if(response.success === true){
                window.location.reload();
              }
                
              }
            }); 
            return false;
         
          }
        }
      }); 
      return false;
    });
  }
}


function disapproved(id)
{
  var cust_email;
  if(id){
    var url = '<?php echo base_url('Admin_Ebike/getProductionData') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
          cust_email = response.customer_email;
          //  $('#complete_message').html(
          //    'Are you sure that '+response.production.quantity+' '+response.color.color_name+' '+response.model.name+' are now completed?'
          //  );
        }
    });

    $("#disapprovedForm").on('submit', function() {
      var form = $(this);
        $('#disapprovedModal').modal('hide');
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
          
          if(response.success === true){
            var mess = `
              Good day,

              This message is sent to inform you that the ebike unit you loaned is disapproved. Thank you!
              `;
              var subjects = 'Ebike Loan';
              $.ajax({
              url: '<?php echo base_url('Admin_Installment/sendmail') ?>',
              type: 'post',
              data: { email: cust_email , message: mess, subject: subjects}, 
              dataType: 'json',
              success:function(response) {
                
              if(response.success === true){
              window.location.reload();
              }
                
              }
            }); 
          
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
function applicant(){
  $("#applicantModal").modal('hide');
}
</script>
