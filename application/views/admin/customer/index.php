<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }
</style>

<div class="row border-bottom">
    <div class="col mb-2">
         <h3>Manage Customer</h3>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal"> 
          Add Customer
         </button> 
    </div>
</div>

<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Customer</h5>
            </div>
            <table id="customerTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<!-- add customer  -->
<div class="modal fade" tabindex="-1" role="dialog" id="addCustomerModal" aria-labelledby="modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">Add Customer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Customer/insert') ?>" method="post" id="createCustomerForm">
        <div class="modal-body">
        <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="lastname">Lastname <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="customer_lastname" name="customer_lastname" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">Firstname <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="customer_firstname" name="customer_firstname" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">Middle Name <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="customer_middle" name="customer_middle" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="firstname">Contact Number <small class="text-danger">(required)</small></label>
                <input type="number" class="form-control" id="customer_contact" name="customer_contact" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="firstname">Street <small>(optional)</small></label>
                <input type="text" class="form-control" id="customer_street" name="customer_street" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">Subdivision <small class="">(optional)</small></label>
                <input type="text" class="form-control" id="customer_subdivision" name="customer_subdivision" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="firstname">Barangay <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="customer_barangay" name="customer_barangay" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">City <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="customer_city" name="customer_city" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">Province <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="customer_province" name="customer_province" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="email">Email <small class="text-danger">(required)</small></label>
                <input type="email" class="form-control" id="customer_email" name="customer_email"  autocomplete="off">
              </div>
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

<!-- update customer -->
<div class="modal fade" tabindex="-1" role="dialog" id="editCustomerModal" aria-labelledby="modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">Update Customer Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Customer/update') ?>" method="post" id="editCustomerForm">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="lastname">Lastname <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="edit_customer_lastname" name="edit_customer_lastname" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">Firstname <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="edit_customer_firstname" name="edit_customer_firstname" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">Middle Name <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="edit_customer_middle" name="edit_customer_middle" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="firstname">Contact Number <small class="text-danger">(required)</small></label>
                <input type="number" class="form-control" id="edit_customer_contact" name="edit_customer_contact" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="firstname">Street <small>(optional)</small></label>
                <input type="text" class="form-control" id="edit_customer_street" name="edit_customer_street" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">Subdivision <small class="">(optional)</small></label>
                <input type="text" class="form-control" id="edit_customer_subdivision" name="edit_customer_subdivision" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="firstname">Barangay <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="edit_customer_barangay" name="edit_customer_barangay" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">City <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="edit_customer_city" name="edit_customer_city" autocomplete="off">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="firstname">Province <small class="text-danger">(required)</small></label>
                <input type="text" class="form-control" id="edit_customer_province" name="edit_customer_province" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="email">Email <small class="text-danger">(required)</small></label>
                <input type="email" class="form-control" id="edit_customer_email" name="edit_customer_email"  autocomplete="off">
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label for="Password">Password <small class="">(optional)</small></label>
                <input type="password" class="form-control" id="edit_customer_password" name="edit_customer_password" autocomplete="off">
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- remove User -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteCustomerModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove Customer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Customer/delete') ?>" method="post" id="deleteCustomerForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- end modal -->

<script>

$('#customer_link').addClass('bg-secondary');
$(document).ready(function(){
   customerTable = $('#customerTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Customer/fetchAllCustomer')?>',
  'order': []
});

$("#createCustomerForm").unbind('submit').on('submit', function(){
  var form = $(this);

  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success:function(response) {
       
        customerTable.ajax.reload(null, false); 
        
      
        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');

        $("#createCustomerForm").modal('hide');
        $("#createCustomerForm")[0].reset();
        $("#createCustomerForm .form-group").removeClass('has-error').removeClass('has-success');
        }
        else
        {
        if(response.messages instanceof Object){
            $.each(response.messages, function(index, value)
            {
              var id = $("#"+index);  
              id.after(value);
            });
          }
          else 
          {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
    }
  }); 
  return false;
 });

});

// update ajax
function editCustomer(id)
{ 
  $.ajax({
    url: '<?php echo base_url('Admin_Customer/getCustomerById')?>',
    type: 'post',
    data: { id: id }, 
    dataType: 'json',
    success:function(response) {
      
      $("#edit_customer_lastname").val(response.data.customer_lastname);
      $("#edit_customer_firstname").val(response.data.customer_firstname);
      $("#edit_customer_middle").val(response.data.customer_middle);
      $("#edit_customer_email").val(response.data.customer_email);
      $("#edit_customer_street").val(response.data.customer_street);
      $("#edit_customer_subdivision").val(response.data.customer_subdivision);
      $("#edit_customer_barangay").val(response.data.customer_barangay);
      $("#edit_customer_city").val(response.data.customer_city);
      $("#edit_customer_province").val(response.data.customer_province);
      $("#edit_customer_contact").val(response.data.customer_contact);

   
      $("#editCustomerForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // $(".text-danger").remove();
      
        $.ajax({
          url: form.attr('action')+'/'+id,
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success:function(response) {
          
            customerTable.ajax.reload(null, false); 
          
            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');
        
              $("#editCustomerModal").modal('hide');
              $("#editCustomerForm")[0].reset();
              $("#editCustomerForm .form-group").removeClass('text-danger');
             }
             else 
             { 
              if(response.messages instanceof Object){
                $.each(response.messages, function(index, value)
                {
                  var id = $("#"+index);  
                  id.after(value);
                });
                }
                else 
                {
                  $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                  '</div>');
                } 
              }
              $("#editCustomerForm .form-group").removeClass('text-danger');
            }
          }); 
        return false;
      });

    }
  });
}

// delete ajax
function deleteCustomer(id)
{
  if(id) {
    $("#deleteCustomerForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
      
           customerTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            $("#deleteCustomerModal").modal('hide');

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