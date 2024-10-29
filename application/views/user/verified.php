
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


            <?php if($this->session->flashdata('messages_danger')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $this->session->flashdata('messages_danger') ?>
                </div>
            <?php endif; ?>
                <h2 class="text-center">Thank You</h2><br>
                <?php if($this->session->flashdata('messages_success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $this->session->flashdata('messages_success') ?>
                </div>
                <?php endif; ?>
               
                    <div class="form-group">
                       <a class="btn btn-warning w-100" href="<?php echo base_url()?>">Go to Homepage</a>
                    </div>


            </div>
         </div>
    </div>

 <script>
  $(".userNav").addClass('activeNav');


</script>

