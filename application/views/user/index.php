
<style>
    .login-col{
        background: white;
    }
    .test-col{
        background: black;
    }
</style>
    <div class="container p-3 my-5">
         <div class="row justify-content-center">
            <div class="login-col col-10 col-sm-9 col-md-7 col-lg-6 shadow-lg p-3">
            <?php if($this->session->flashdata('messages_success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $this->session->flashdata('messages_success') ?>
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
                <h1 class="text-center">LOGIN</h1>

                <form method="post" action="<?php echo base_url('user') ?>" class="navbar-form navbar-right">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="customer_email" class="form-control" placeholder="Enter Email Address">
                        <?php echo form_error('customer_email'); ?>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" id="customer_password" name="customer_password" class="form-control" placeholder="Enter Password"  >
                        <?php echo form_error('customer_password'); ?>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" onclick="showPassword()">
                        <label for="">Show Password</label>
                    </div>
                    <div class="form-group">
                        <button name="submit" type="submit" class="btn btn-danger w-100">Login</button>
                    </div>


                    <div> 
                        <h5 class="text-center text-secondary">or</h5>
                    </div>

                    <a class="btn btn-primary w-100" href="<?php echo base_url('user/register')?>">register</a>
                </form>
                <a href="">Forgot Password?</a>
            </div>
         </div>
    </div>

 <script>
  $(".userNav").addClass('activeNav');

  function showPassword(){
    var x = document.getElementById("customer_password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }

</script>

