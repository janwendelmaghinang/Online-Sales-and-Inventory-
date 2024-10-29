<style>
    .register-col{
        background: white;
    }
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
<div class="container p-3 my-5">
    <div class="row justify-content-center">
        <div class="register-col shadow-lg p-3">
            <h1 class="text-center">REGISTER</h1>
        
            <form role="form" method="POST" action="<?php echo base_url('user/register') ?>">
              <div class="row">
                 <div class="col">
                        <div class="form-group">
                          <label>Last Name</label><input value="<?php if(isset($_POST['customer_lastname'])){echo $_POST['customer_lastname']; } ?>" type="text" class="form-control form-control-sm" name="customer_lastname" placeholder= "Enter Your Last Name">
                          <?php echo form_error('customer_lastname'); ?>
                        </div>
                  </div>
                  <div class="col">
                       <div class="form-group">
                          <label>First Name</label><input value="<?php if(isset($_POST['customer_firstname'])){echo $_POST['customer_firstname']; } ?>" type="text" class="form-control form-control-sm" name="customer_firstname" placeholder="Enter Your First Name">
                          <?php echo form_error('customer_firstname'); ?>
                       </div>
                  </div>
                  <div class="col">
                       <div class="form-group">
                          <label>Middle Name</label><input value="<?php if(isset($_POST['customer_middle'])){echo $_POST['customer_middle']; } ?>" type="text" class="form-control form-control-sm" name="customer_middle" placeholder="Enter Your Middle Name">
                          <?php echo form_error('customer_middle'); ?>
                       </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                       <div class="form-group">
                          <label>Street</label><input value="<?php if(isset($_POST['customer_street'])){echo $_POST['customer_street']; } ?>" type="text" class="form-control form-control-sm" name="customer_street" placeholder="">
                          <?php echo form_error('customer_street'); ?>
                       </div>
                  </div>
                  <div class="col">
                       <div class="form-group">
                          <label>Subdivision</label><input value="<?php if(isset($_POST['customer_subdivision'])){echo $_POST['customer_subdivision']; } ?>" type="text" class="form-control form-control-sm" name="customer_subdivision" placeholder="">
                          <?php echo form_error('customer_subdivision'); ?>
                       </div>
                  </div>
                  <div class="col">
                       <div class="form-group">
                          <label>Barangay</label><input value="<?php if(isset($_POST['customer_barangay'])){echo $_POST['customer_barangay']; } ?>" type="text" class="form-control form-control-sm" name="customer_barangay" placeholder="">
                          <?php echo form_error('customer_barangay'); ?>
                       </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                       <div class="form-group">
                          <label>City</label><input value="<?php if(isset($_POST['customer_city'])){echo $_POST['customer_city']; } ?>" type="text" class="form-control form-control-sm" name="customer_city" placeholder="">
                          <?php echo form_error('customer_city'); ?>
                       </div>
                  </div>
                  <div class="col">
                       <div class="form-group">
                          <label>Province</label><input value="<?php if(isset($_POST['customer_province'])){echo $_POST['customer_province']; } ?>" type="text" class="form-control form-control-sm" name="customer_province" placeholder="">
                          <?php echo form_error('customer_province'); ?>
                       </div>
                  </div>
              </div>
             <div class="row">
                 <div class="col">
                    <div class="form-group">
                        <label>Email Address</label><input value="<?php if(isset($_POST['customer_email'])){echo $_POST['customer_email']; } ?>" type="email" class="form-control form-control-sm" name="customer_email" placeholder="Email">
                        <?php echo form_error('customer_email'); ?>
                    </div>
                 </div>
                 <div class="col">
                    <div class="form-group">
                        <label>Contact</label><input value="<?php if(isset($_POST['customer_contact'])){echo $_POST['customer_contact']; } ?>" type="number" class="form-control form-control-sm" name="customer_contact" placeholder="contact">
                        <?php echo form_error('customer_contact'); ?>
                    </div>
                 </div>
             </div>


                <div class="form-group">
                    <label>Password</label><input type="password" class="form-control form-control-sm" id="customer_password" name="customer_password" placeholder="Enter Password">
                    <?php echo form_error('customer_password'); ?>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label><input type="password" class="form-control form-control-sm" id="password2" name="password2" placeholder="Enter Password">
                    <?php echo form_error('password2'); ?>
                </div>
                 <div class="form-group">
                     <input type="checkbox" onclick="showPassword()">
                     <label for="">Show Password</label>
                 </div>
                <div class="form-group">
                    <input name="submit" type="submit"id="btn-all" class="btn btn-danger w-100" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    function showPassword(){
    var x = document.getElementById("customer_password");
    var y = document.getElementById("password2");
    if (x.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
  }

</script>

