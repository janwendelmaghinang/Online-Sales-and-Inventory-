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
         <h3>Manage Store</h3>
         <button class="btn btn-primary" data-toggle="modal" data-target=".add-store-modal-lg">
          Add Store
         </button>
    </div>
    <div class="col">
       <button onclick="refresh()" class="btn btn-primary float-right">Refresh</button>
    </div>
</div>

<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Store</h5>
            </div>
            <table id="storeTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Store id</th>
                        <th>Store Name</th>
                        <th>Contact</th>
                        <th>Street</th>
                        <th>Subdivision</th>
                        <th>Barangay</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Manager</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<!-- Add Store Modal -->
<div class="modal fade add-store-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true" id="addStoreModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Store</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?php echo base_url('Admin_Store/insert') ?>" method="post" id="createStoreForm"> 
             <div class="modal-body">
                 <h5>Manager Name</h5>
                 <div class="row">
                     <div class="col">
                         <label for="m_firstname">Firstname</label>
                         <input class="form-control" type="text" name="m_firstname" id="m_firstname" >
                     </div>
                     <div class="col">
                         <label for="m_lastname">Lastname</label>
                         <input class="form-control" type="text" name="m_lastname" id="m_lastname" >
                     </div>
                     <div class="col">
                         <div class="form-group">
                            <label for="m_middle">Middle Name</label>
                            <input class="form-control" type="text" name="m_middlename" id="m_middlename" >
                         </div>
                     </div>
                 </div>
                  
                  <h5>Store Information</h5>  
                 <div class="row">
                     <div class="col">
                       <div class="form-group">
                         <label for="store_name">Store Name</label>
                         <input class="form-control" type="text" name="store_name" id="store_name" >
                       </div>
                    </div>
                    <div class="col">
                       <div class="form-group">
                         <label for="store_contact">Store Contact</label>
                         <input class="form-control" type="text" name="store_contact"  id="store_contact" >
                       </div>
                    </div>
                 </div>

                 <h5>Address</h5>
                 <div class="row">
                    <div class="col-4">
                       <div class="form-group">
                         <label for="store_street">Store Street</label>
                         <input class="form-control" type="text" name="store_street" id="store_street" >
                       </div>
                    </div>
                    <div class="col-4">
                       <div class="form-group">
                         <label for="store_subdivision">Store Subdivision</label>
                         <input class="form-control" type="text" name="store_subdivision" id="store_subdivision">
                       </div>
                    </div>
                    <div class="col-4">
                       <div class="form-group">
                         <label for="store_barangay">Store Barangay</label>
                         <input class="form-control" type="text" name="store_barangay" id="store_barangay" >
                       </div>
                    </div>
                    <div class="col">
                       <div class="form-group">
                         <label for="store_city">Store City</label>
                         <input class="form-control" type="text" name="store_city"  id="store_city">
                       </div>
                    </div>
                    <div class="col">
                       <div class="form-group">
                         <label for="store_province">Store Province</label>
                         <input class="form-control" type="text" name="store_province" id="store_province">
                       </div>
                    </div>

                 </div>
                 <div class="row">
                   <div class="col">
                      <div class="form-group">
                        <label for="store_active">Status</label>
                          <select class="form-control" name="store_active" id="store_active" >
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                          </select>
                      </div>
                    </div>
                 </div>
              </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
        </div>

<!-- Edit Store Modal -->
<div class="modal fade edit-store-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true" id="editStoreModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Store</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?php echo base_url('Admin_Store/update') ?>" method="post" id="updateStoreForm"> 
             <div class="modal-body">
                 <h5>Manager Name</h5>
                 <div class="row">
                     <div class="col">
                         <label for="m_firstname">Firstname</label>
                         <input class="form-control" type="text" name="edit_m_firstname" id="edit_m_firstname">
                     </div>
                     <div class="col">
                         <label for="m_lastname">Lastname</label>
                         <input class="form-control" type="text" name="edit_m_lastname" id="edit_m_lastname">
                     </div>
                     <div class="col">
                         <div class="form-group">
                            <label for="m_middle">Middle Name</label>
                            <input class="form-control" type="text" name="edit_m_middlename" id="edit_m_middlename" >
                         </div>
                     </div>
                 </div>
                  
                  <h5>Store Information</h5>  
                 <div class="row">
                     <div class="col">
                       <div class="form-group">
                         <label for="store_name">Store Name</label>
                         <input class="form-control" type="text" name="edit_store_name" id="edit_store_name" >
                       </div>
                    </div>
                    <div class="col">
                       <div class="form-group">
                         <label for="store_contact">Store Contact</label>
                         <input class="form-control" type="text" name="edit_store_contact" id="edit_store_contact" >
                       </div>
                    </div>
                 </div>

                 <h5>Address</h5>
                 <div class="row">
                    <div class="col-4">
                       <div class="form-group">
                         <label for="store_street">Store Street</label>
                         <input class="form-control" type="text" name="edit_store_street" id="edit_store_street">
                       </div>
                    </div>
                    <div class="col-4">
                       <div class="form-group">
                         <label for="store_subdivision">Store Subdivision</label>
                         <input class="form-control" type="text" name="edit_store_subdivision" id="edit_store_subdivision">
                       </div>
                    </div>
                    <div class="col-4">
                       <div class="form-group">
                         <label for="store_barangay">Store Barangay</label>
                         <input class="form-control" type="text" name="edit_store_barangay" id="edit_store_barangay">
                       </div>
                    </div>
                    <div class="col">
                       <div class="form-group">
                         <label for="store_city">Store City</label>
                         <input class="form-control" type="text" name="edit_store_city" id="edit_store_city">
                       </div>
                    </div>
                    <div class="col">
                       <div class="form-group">
                         <label for="store_province">Store Province</label>
                         <input class="form-control" type="text" name="edit_store_province" id="edit_store_province">
                       </div>
                    </div>

                 </div>
                 <div class="row">
                   <div class="col">
                      <div class="form-group">
                        <label for="store_active">Status</label>
                          <select class="form-control" name="edit_store_active" id="edit_store_active">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                          </select>
                      </div>
                    </div>
                 </div>
              </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
        </form>
  </div>
</div>
</div>


<!-- delete store Modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="deleteStoreModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove Store</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Store/deleteStore') ?>" method="post" id="deleteStoreForm">
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

$('#store_link').addClass('bg-secondary');
$(document).ready(function(){
   storeTable = $('#storeTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Store/fetchAllStore')?>',
  'order': []
});

$("#createStoreForm").unbind('submit').on('submit', function(){
  var form = $(this);

  $(".text-danger").remove();

  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success:function(response) {
       
        storeTable.ajax.reload(null, false); 
        
        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');

        $("#addStoreModal").modal('hide');
        $("#createStoreForm")[0].reset();
        $("#createStoreForm .form-group").removeClass('has-error').removeClass('has-success');
        }
        // form error
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
function editStore(id)
{ 
  $.ajax({
    url: '<?php echo base_url('Admin_Store/getStoreById')?>',
    type: 'post',
    data: { store_id: id }, 
    dataType: 'json',
    success:function(response) {
    
      $("#edit_store_name").val(response.store_name);
      $("#edit_store_contact").val(response.store_contact);
      $("#edit_store_street").val(response.store_street);
      $("#edit_store_subdivision").val(response.store_subdivision);
      $("#edit_store_barangay").val(response.store_barangay);
      $("#edit_store_city").val(response.store_city);
      $("#edit_store_province").val(response.store_province);
      $("#edit_m_firstname").val(response.m_firstname);
      $("#edit_m_lastname").val(response.m_lastname);
      $("#edit_m_middlename").val(response.m_middlename);
      $("#edit_store_active").val(response.active);

   
      $("#updateStoreForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        $(".text-danger").remove();
      
        $.ajax({
          url: form.attr('action')+'/'+id,
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success:function(response) {
          
           storeTable.ajax.reload(null, false); 
            console.log(response)
            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');
        
              $("#editStoreModal").modal('hide');
              $("#updateStoreForm .form-group").removeClass('has-error').removeClass('has-success');

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

    }
  });
}

// delete ajax
function deleteStore(id)
{
  if(id) {
    $("#deleteStoreForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { store_id: id }, 
        dataType: 'json',
        success:function(response) {
      
           storeTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            $("#deleteStoreModal").modal('hide');

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
