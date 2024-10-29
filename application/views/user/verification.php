
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
                <h2 class="text-center">Thank You for signing in</h2><br>
                <h4 class="text-center">Verify your email address</h4>
	             <p class="text-center">We sent a verification code to complete your registration.</p>


                <form method="post" action="<?php echo base_url('User/submit_verification/'.$id) ?>" class="navbar-form navbar-right">
                  
                    <div class="form-group">
                        <input class="form-control text-center" type="number" name="Vcode" id="Vcode" onkeyup="activate()" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" />
 
                    </div>

                    <div class="form-group">
                        <button name="submit"  disabled type="submit" id="submit" class="btn btn-danger w-100">Submit</button>
                    </div>

                </form>

            </div>
         </div>
    </div>
    <input type="hidden" id="verificationcode" value="<?php echo $id ?>">
 <script>
  $(".userNav").addClass('activeNav');

  sendVcode();
  function sendVcode(){
    var ids = document.querySelector('#verificationcode');

    $.ajax({
        url: '<?php echo base_url('User/sendVerification') ?>',
        type: 'post',
        data: { id: ids.value}, 
        dataType: 'json',
        success:function(response) {

        }
    });
  }

  function activate(){
    var Vcode = document.querySelector('#Vcode');
    var submit = document.querySelector('#submit');
        // console.log(Vcode.value.length)
    if(Vcode.value.length == 6){
        submit.toggleAttribute('disabled', false)
    }
    else
    {
        submit.toggleAttribute('disabled', true)
    }
  }

</script>

