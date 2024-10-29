<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }
</style>

<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Manage Model</h3>
         <button class="btn btn-primary" data-toggle="modal" data-target="#addModelModal">Add Model</button>
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
                <h5>Model</h5>
            </div>
            <table id="modelTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Model Id</th>
                        <th>Model Name</th>
                        <!-- <th>Customer Description</th> -->
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- add Model  -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Model</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('admin_attributes/addModel') ?>" method="post" id="createModelForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="Model_name">Model Name</label>
            <input type="text" class="form-control" id="Model_name" name="Model_name" placeholder="Enter Model name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
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


<!-- remove Model -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove Model</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('admin_attributes/deleteModel') ?>" method="post" id="deleteModelForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- update Model -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Model</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('admin_attributes/update_Model') ?>" method="post" id="updateModelForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_model_name">Model Name</label>
            <!-- <input type="hidden" id="$edit_model_id"  name="model_id"> -->
            <input type="text" class="form-control" id="edit_model_name" name="edit_model_name" placeholder="Enter Model name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
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
<!-- end of modal -->


<script>
var modelTable;
$(document).ready(function() {


modelTable = $('#modelTable').DataTable({
  'ajax': '<?php echo base_url('admin_attributes/fetchAllModel')?>',
  'order': []
});

// setTimeout(function(){
// modelTable.ajax.reload(null, false); 
// }, 3000);

$("#createModelForm").unbind('submit').on('submit', function(){
  var form = $(this);

  $(".text-danger").remove();

  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success:function(response) {
       
        modelTable.ajax.reload(null, false); 
        
        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');

        $("#addModelModal").modal('hide');
        $("#createModelForm")[0].reset();
        $("#createModelForm .form-group").removeClass('has-error').removeClass('has-success');
        }
        else{
          // form error
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
function editModel(id)
{ 
  $.ajax({
    url: '<?php echo base_url('admin_attributes/getModelById')?>',
    type: 'post',
    data: { id: id }, 
    dataType: 'json',
    success:function(response) {
      console.log(response)
      
      $("#edit_model_name").val(response.model_name);
      $("#edit_active").val(response.active);

   
      $("#updateModelForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        $(".text-danger").remove();
      
        $.ajax({
          url: form.attr('action')+'/'+id,
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success:function(response) {
          
            modelTable.ajax.reload(null, false); 
          
            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');
        
              $("#editModelModal").modal('hide');
              $("#updateModelForm .form-group").removeClass('has-error').removeClass('has-success');

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
function deleteModel(id)
{
  if(id) {
    $("#deleteModelForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
      
           modelTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            $("#deleteModelModal").modal('hide');

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
function refresh(){
  modelTable.ajax.reload(null, false); 
$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+'Table Refreshed'+
'</div>');
}


</script>