<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
</style>
<h3>User Profile</h3>
<div id="messages"></div>
<div class="row">
        <div class="col">
        
        <div class="form-group">
            <label for="">Profile Picture</label>
            <img class="form-control" src="<?php echo base_url($user['image']) ?>" alt="" style="width: 150px; height: 150px; border: 0; border-radius: 100%"> 
            <button class="btn btn-secondary" data-toggle="modal" data-target="#changeImageModal">Change Picture</button>
        </div>
            
        <div class="form-group">
            <label for="">Firstname</label>
            <input readonly style="border: 0;" class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['firstname'] ?>" >
        </div>
        <div class="form-group">
            <label for="">Lastname</label>
            <input readonly style="border: 0;" class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['lastname'] ?>" >
        </div>
        <div class="form-group">
            <label for="">Middle</label>
            <input readonly style="border: 0;" class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['middle'] ?>" >
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input readonly style="border: 0;" class="form-control form-control-sm" type="email" value="<?php echo $user['email'] ?>" >
        </div>
        <div class="form-group">
            <label for="">Contact Number</label>
            <input readonly class="form-control form-control-sm text-capitalize" type="number" value="<?php echo $user['contact'] ?>">
        </div>
        <div class="form-group">
            <label for="">Username</label>
            <input readonly class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['username'] ?>">
        </div>
        <div class="form-group">
            <label for="">Street</label>
            <input readonly style="border: 0;" class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['street'] ?>" >
        </div>
        <div class="form-group">
            <label for="">Subdivision</label>
            <input readonly style="border: 0;" class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['subdivision'] ?>" >
        </div>
        <div class="form-group">
            <label for="">Barangay</label>
            <input readonly style="border: 0;" class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['barangay'] ?>" >
        </div>
        <div class="form-group">
            <label for="">City</label>
            <input readonly style="border: 0;" class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['city'] ?>" >
        </div>
        <div class="form-group">
            <label for="">Province</label>
            <input readonly style="border: 0;" class="form-control form-control-sm text-capitalize" type="text" value="<?php echo $user['province'] ?>" >
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-4">
                   <button class="btn btn-primary" data-toggle="modal" data-target="#editInfoModal">Edit</button>
                   <button class="btn btn-warning"  data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->

<!-- change image modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="changeImageModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Profile Picture</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Profile/changeImage/'.$user['id']) ?>" method="post" id="changeImageForm" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
              <label for="">Upload Image</label>
              <input type="file" class="form-control" name="image">
          </div>
  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- edit info modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editInfoModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Information</h4>
      </div>

      <form action="<?php echo base_url('Admin_Profile/editInfo/'.$user['id']) ?>" method="post">
        <div class="modal-body">
            <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="">Firstname <small class="text-danger">(required)</small></label>
                    <input class="form-control form-control-sm text-capitalize" type="text" name="edit_firstname" id="edit_firsname" value="<?php echo $user['firstname'] ?>">
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                        <label for="">Lastname <small class="text-danger">(required)</small></label>
                        <input class="form-control form-control-sm text-capitalize" type="text" name="edit_lastname" id="edit_lastname" value="<?php echo $user['lastname'] ?>">
                  </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="">Middle Name <small class="text-danger">(required)</small></label>
                        <input class="form-control form-control-sm text-capitalize" type="text" name="edit_middle" id="edit_middle" value="<?php echo $user['middle'] ?>">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="">Username <small class="text-danger">(required)</small></label>
                        <input class="form-control form-control-sm text-capitalize" type="text" name="edit_username" id="edit_username" value="<?php echo $user['username'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Email <small class="text-danger">(required)</small></label>
                        <input class="form-control form-control-sm" type="email" name="edit_email" id="edit_email" value="<?php echo $user['email'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Contact Number <small class="text-danger">(required)</small></label>
                        <input class="form-control form-control-sm text-capitalize" type="number" name="edit_contact" id="edit_contact" value="<?php echo $user['contact'] ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                <div class="form-group">
                <label for="">Street</label>
                <input class="form-control form-control-sm text-capitalize" type="text" name="edit_street" id="edit_street"  value="<?php echo $user['street'] ?>">
            </div>
                </div>
                <div class="col">
                <div class="form-group">
                <label for="">Subdivision</label>
                <input class="form-control form-control-sm text-capitalize" type="text" name="edit_subdivision" id="edit_subdivision"  value="<?php echo $user['subdivision'] ?>">
            </div>
                </div>
                <div class="col">
                <div class="form-group">
                <label for="">Barangay <small class="text-danger">(required)</small></label>
                <input class="form-control form-control-sm text-capitalize" type="text" name="edit_barangay" id="edit_barangay"  value="<?php echo $user['barangay'] ?>">
            </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <div class="form-group">
                <label for="">City <small class="text-danger">(required)</small></label>
                <input class="form-control form-control-sm text-capitalize" type="text" name="edit_city" id="edit_city"  value="<?php echo $user['city'] ?>">
            </div>
                </div>
                <div class="col">
                <div class="form-group">
                <label for="">Province <small class="text-danger">(required)</small></label>
                <input class="form-control form-control-sm text-capitalize" type="text" name="edit_province" id="edit_province"  value="<?php echo $user['province'] ?>">
            </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- edit password -->

<div class="modal fade" tabindex="-1" role="dialog" id="changePasswordModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('Admin_Profile/changePassword/'.$user['id']) ?>" method="post" id="changePasswordForm">
        <div class="modal-body">

          <div class="form-group">
              <label for="">Enter Current Password</label>
              <input class="form-control form-control-sm" type="password" name="currentPassword" id="currentPassword">
          </div>

          <div class="form-group">
              <label for="">Enter New Password</label>
              <input class="form-control form-control-sm" type="password" name="newPassword" id="newPassword">
          </div>

          <div class="form-group">
              <label for="">Confirm New Password</label>
              <input class="form-control form-control-sm" type="password" name="confirmPassword" id="confirmPassword">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- end of modal -->

<script>
    $('#profile_link').addClass('bg-secondary')

    $("#changePasswordForm").unbind('submit').on('submit', function(){
    var form = $(this);
    $(".text-danger").remove();
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success:function(response) {
        
            if(response.success === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                '</div>');

                $("#changePasswordModal").modal('hide');
                $("#changePasswordForm")[0].reset();
            
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


</script>