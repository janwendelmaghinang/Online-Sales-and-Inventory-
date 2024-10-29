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
         <h3>Manage Color</h3>
         <button class="btn btn-primary" data-toggle="modal" data-target="#addColorModal">Add Color</button>
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
                <h5>Color</h5>
            </div>
            <table id="colorTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Color Id</th>
                        <th>Color Name</th>
                        <!-- <th>Customer Description</th> -->
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<!-- add color  -->
<div class="modal fade" tabindex="-1" role="dialog" id="addColorModal" aria-labelledby="modal_title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">Add color</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('admin_attributes/addColor') ?>" method="post" id="createColorForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="color_name">color Name</label>
            <input type="text" class="form-control" id="color_name" name="color_name" placeholder="Enter color name" autocomplete="off">
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


<!-- remove Color -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteColorModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove Color</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('admin_attributes/deleteColor') ?>" method="post" id="deleteColorForm">
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

<!-- update Color -->
<div class="modal fade" tabindex="-1" role="dialog" id="editColorModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Color</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('admin_attributes/update_color') ?>" method="post" id="updateColorForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_color_name">Color Name</label>
            <!-- <input type="hidden" id="$edit_Color_id"  name="Color_id"> -->
            <input type="text" class="form-control" id="edit_color_name" name="edit_color_name" placeholder="Enter Color name" autocomplete="off">
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
var colorTable;
$(document).ready(function() {

colorTable = $('#colorTable').DataTable({
  'ajax': '<?php echo base_url('admin_attributes/fetchAllColor')?>',
  'color': []
});

// setTimeout(function(){
// colorTable.ajax.reload(null, false); 
// }, 3000);

$("#createColorForm").unbind('submit').on('submit', function(){
  var form = $(this);
  
  $(".text-danger").remove();

  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success:function(response) {
       
        colorTable.ajax.reload(null, false); 
        
      
        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');

        $("#addColorModal").modal('hide');
        $("#createColorForm")[0].reset();
        $("#createColorForm .form-group").removeClass('has-error').removeClass('has-success');
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
function editColor(id)
{ 
  $.ajax({
    url: '<?php echo base_url('admin_attributes/getColorById')?>',
    type: 'post',
    data: { id: id }, 
    dataType: 'json',
    success:function(response) {
      console.log(response)
      
      $("#edit_color_name").val(response.color_name);
      $("#edit_active").val(response.active);

   
      $("#updateColorForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        $(".text-danger").remove();
      
        $.ajax({
          url: form.attr('action')+'/'+id,
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success:function(response) {
          
            colorTable.ajax.reload(null, false); 
          
            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');
        
              $("#editColorModal").modal('hide');
         
              $("#updateColorForm .form-group").removeClass('has-error').removeClass('has-success');

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
function deleteColor(id)
{
  if(id) {
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
function refresh(){
  colorTable.ajax.reload(null, false); 
$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+'Table Refreshed'+
'</div>');
}
</script>