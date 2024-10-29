<style>
.containers{
  display: flex;
  justify-content: center;
  flex-direction: column;
  min-height: 80vh;
}

</style>

  <div class="containers border">
    <div class="row justify-content-center">
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
     <div class="col col-10 col-sm-9 col-md-7 col-lg-6 shadow-lg p-3">
          <div>
              <p>Backup the Database to Computer Local Storage.</p>
          </div>
         <a href="<?php echo base_url('Admin_Database_Backup/backup')?>" class="btn bg-primary text-light w-100">Backup</a>
     </div>
   </div>
 </div>

 <script>
    $('#database_link').addClass('bg-secondary');

    // function backup(){
    //     $.ajax({
    //     url: '',
    //     type: 'post',
    //     dataType: 'json',
    //     success:function(response) {

    //         if(response.success === true){
    //           $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
    //             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
    //             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
    //           '</div>');
    //         }
    //         if(response.success === false) {
    //           $("#messages").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
    //             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
    //             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
    //           '</div>');
    //         }
    //     }
    //   }); 

    // }
 </script>