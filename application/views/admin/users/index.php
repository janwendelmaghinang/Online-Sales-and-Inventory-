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
         <h3>Manage User</h3>
         <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
          Add User
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
                <h5>User</h5>
            </div>
            <table id="userTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Position</th> 
                        <th>Username</th>
                        <!-- <th>Password</th> -->
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<!-- add user  -->
<div class="modal fade" tabindex="-1" role="dialog" id="addUserModal" aria-labelledby="modal_title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_User/insert') ?>" method="post" id="createUserForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="lastname">Lastname <small class="text-danger">(required)</small></label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="firstname">Firstname <small class="text-danger">(required)</small></label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="email">Email <small class="text-danger">(required)</small></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="usertype">Position <small class="text-danger">(required)</small></label>
             <select class="form-control" name="usertype" id="">
                 <option value=""hidden></option>
                 <option value="2">Manager</option>
                 <option value="3">Staff</option>
             </select>
          </div>

          <div class="form-group">
            <label for="user_name">User Name <small class="text-danger">(required)</small></label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter user name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="Password">Password <small class="text-danger">(required)</small></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" autocomplete="off">
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
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- update user -->
<div class="modal fade" tabindex="-1" role="dialog" id="editUserModal" aria-labelledby="modal_title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">Update User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_User/update') ?>" method="post" id="editUserForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="lastname">Lastname <small class="text-danger">(required)</small></label>
            <input type="text" class="form-control" id="edit_user_lastname" name="lastname" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="firstname">Firstname <small class="text-danger">(required)</small></label>
            <input type="text" class="form-control" id="edit_user_firstname" name="firstname" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="email">Email <small class="text-danger">(required)</small></label>
            <input type="email" class="form-control" id="edit_user_email" name="email"  autocomplete="off">
          </div>

          <div class="form-group">
            <label for="usertype">Position <small class="text-danger">(required)</small></label>
             <select class="form-control" name="usertype" id="edit_user_usertype">
                 <option value="2">Manager</option>
                 <option value="3">Staff</option>
             </select>
          </div>

          <div class="form-group">
            <label for="username">User Name <small class="text-danger">(required)</small></label>
            <input type="text" class="form-control" id="edit_user_username" name="username" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="Password">Password <small class="text-danger">(required)</small></label>
            <input type="password" class="form-control" id="edit_user_password" name="password" autocomplete="off">
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
<div class="modal fade" tabindex="-1" role="dialog" id="deleteUserModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_User/delete') ?>" method="post" id="deleteUserForm">
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

$('#users_link').addClass('bg-secondary');
$(document).ready(function(){
   userTable = $('#userTable').DataTable({
  'ajax': '<?php echo base_url('Admin_User/fetchAllUser')?>',
  'order': []
});

$("#createUserForm").unbind('submit').on('submit', function(){
  var form = $(this);

  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success:function(response) {
       
        userTable.ajax.reload(null, false); 
        
      
        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');

        $("#addUserModal").modal('hide');
        $("#createUserForm")[0].reset();
        $("#createUserForm .form-group").removeClass('has-error').removeClass('has-success');
        }
        if(response.success === false) {
          $("#messages").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');

        $("#addUserModal").modal('hide');
        $("#createUserForm")[0].reset();
        $("#createUserForm .form-group").removeClass('has-error').removeClass('has-success');
        }
    }
  }); 
  return false;
 });

});

// update ajax
function editUser(id)
{ 
  $.ajax({
    url: '<?php echo base_url('Admin_User/getUserById')?>',
    type: 'post',
    data: { user_id: id }, 
    dataType: 'json',
    success:function(response) {
      
      $("#edit_user_lastname").val(response.lastname);
      $("#edit_user_firstname").val(response.firstname);
      $("#edit_user_email").val(response.email);
      $("#edit_user_usertype").val(response.usertype);
      $("#edit_user_username").val(response.username);
      // $("#edit_user_password").val(response.password);
  

   
      $("#editUserForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        $(".text-danger").remove();
      
        $.ajax({
          url: form.attr('action')+'/'+id,
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success:function(response) {
          
            userTable.ajax.reload(null, false); 
          
            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');
        
              $("#editUserModal").modal('hide');
             }
             else 
             { 
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
  });
}

// delete ajax
function deleteUser(id)
{
  if(id) {
    $("#deleteUserForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
      
           userTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            $("#deleteUserModal").modal('hide');

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