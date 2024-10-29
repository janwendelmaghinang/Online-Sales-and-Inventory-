
<style>
th{
    font-size: 11px;
}

.notification {
  position: relative;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}

</style>


<div class="row">
    <div class="col border-bottom my-1">
        <h4>Ebike Loan</h4>
        <button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#interestModal">Interest</button>
        <button type="button" class="btn btn-primary mb-1 float-right mx-1" data-toggle="modal" data-target="#penaltyModal">Penalty</button>
    </div>


</div>

<?php if($this->session->flashdata('messages')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('messages') ?>
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

<ul class="nav nav-tabs my-3">
  <li class="nav-item">
    <a id="link1" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment') ?>">Customer Investigation <span class="badge"><?php if(!$pending == 0){echo $pending;}?></span></a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/approved') ?>">Approved <span class="badge"><?php if(!$approved == 0){echo $approved;} ?></a>
  </li>
  <li class="nav-item">
    <a id="link3" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/disapproved') ?>">Disapproved <span class="badge"><?php if(!$disapproved == 0 ){echo $disapproved;}?></a>
  </li>
  <li class="nav-item">
    <a id="link4" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/released') ?>">Released <span class="badge"><?php if(!$released == 0 ){echo $released;}?></a>
  </li>
  <li class="nav-item">
    <a id="link5" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/cancelled') ?>">Cancelled <span class="badge"><?php if(!$cancelled == 0 ){echo $cancelled;}?></a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="approvedTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ebike</th>
                        <th>Color</th>
                        <th>Customer</th>
                        <th>Availability</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<!-- release modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="approvedModal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Cancel</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Installment/submit_release') ?>" method="post" id="approvedForm">
        <div class="modal-body">
        <!-- <p class="text-capitalize" id="cancel_message"></p> -->
            <table class="table table-bordered">
                <tr>
                    <th>Model</th>
                    <th>Ebike Number</th>
                    <th>Motor Warranty(Year)</th>
                    <th>Motor Warranty(Month)</th>
                    <th>Service Warranty(Year)</th>
                    <th>Service Warranty(Month)</th>
                </tr>
                <tr>
                    <td id="td_ebike_name"></td>
                    <td><select class="form-control" name="item_id" id="serial_select" required></select></td>

                    <td><select class="form-control" name="motor_war_year" id="">
                        <option  value="none">none</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value=""></option>
                    </select></td>

                    <td><select class="form-control" name="motor_war_month" id="">
                        <option  value="none">none</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select></td>

                    <td><select class="form-control" name="service_war_year" id="">
                        <option  value="none">none</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value=""></option>
                    </select></td>

                    <td><select class="form-control" name="service_war_month" id="">
                        <option  value="none">none</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select></td>
                </tr>
            </table>
            <table class="table table-bordered">
                 <tr>
                   <th>Downpayment</th>
                   <th>Terms</th>
                 </tr>
                <tr>
                    <td><select class="form-control" name="downpayment" id="" required>
                        <option hidden value=""></option>
                        <option value="10000">Php 10,000</option>
                        <option value="15000">Php 15,000</option>
                        <option value="20000">Php 20,000</option>
                    </select></td> 
                    <td><select class="form-control" name="interest_id" id="" required>
                        <option hidden value=""></option>
                        <?php foreach($interest as $value ): ?>
                           <option value="<?php echo $value['id'] ?>"><?php echo $value['month'] ?> Months</option>
                        <?php endforeach; ?>
                    </select></td> 
                </tr>
            </table>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="application_id" id="application_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- cancel modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="cancelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Cancel</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Installment/submit_cancelled') ?>" method="post" id="cancelForm">
        <div class="modal-body">
        <!-- <p class="text-capitalize" id="cancel_message"></p> -->
        Are you sure to cancel?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- interest modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="interestModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Installment/interest_update') ?>" method="post" id="interestForm">
        <div class="modal-body">
          <?php foreach($interest as $value ): ?>                       
            <div class="form-group">
              <label for=""><?php echo $value['month'] ?> Months (%)</label><input type="hidden" name="id[]" value="<?php echo $value['id']?>">
              <input class="form-control-sm form-control" type="number" name="interestValue[]"value="<?php echo $value['interest'] ?>">
            </div>
          <?php endforeach; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel </button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- receipt modal  -->

<div class="modal fade" tabindex="-1" role="dialog" id="receiptModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title"><strong>Print Receipt</strong></h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col">
                    
                </div>     
            </div>
        </div>

        <div class="modal-footer">
          <a class="btn btn-primary" href="<?php echo base_url('Admin_Installment/approved') ?>">Back</a>
            <a class="btn btn-warning" id="receiptLink" target="_blank">Proceed</a>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="contactModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">contact</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" id="contactForm">
        <div class="modal-body">
          <p style="text-indent: 50px;" id="contact_message"></p>
          <span>Good day,</span><br><br>
          <p id="email_message" style="text-indent: 50px;">This message is sent to inform you that the ebike unit you loaned is now ready for release. Please go to the store as soon as possible to pickup your unit.Make sure to bring 1 valid ID, proof of billing and at least PHP10,000 for the down payment. Thank you!
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send Email</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- penalty modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="penaltyModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Installment/penalty_update') ?>" method="post" id="penaltyForm">
        <div class="modal-body">
                    
            <div class="form-group">
              <label for="">Month/s Payment Delayed before Pulling out The Unit</label>
              <select class="form-control-sm form-control" name="months_delay" id="">
                <option <?php if($penalty['months_delay'] == 1): ?>selected <?php endif;?> value="1">1 Month</option>
                <option <?php if($penalty['months_delay'] == 2): ?>selected <?php endif;?> value="2">2 Months</option>
                <option <?php if($penalty['months_delay'] == 3): ?>selected <?php endif;?> value="3">3 Months</option>
                <option <?php if($penalty['months_delay'] == 4): ?>selected <?php endif;?> value="4">4 Months</option>
                <option <?php if($penalty['months_delay'] == 5): ?>selected <?php endif;?> value="5">5 Months</option>
                <option <?php if($penalty['months_delay'] == 6): ?>selected <?php endif;?> value="6">6 Months</option>
                <option <?php if($penalty['months_delay'] == 7): ?>selected <?php endif;?> value="7">7 Months</option>
                <option <?php if($penalty['months_delay'] == 8): ?>selected <?php endif;?> value="8">8 Months</option>
                <option <?php if($penalty['months_delay'] == 9): ?>selected <?php endif;?> value="9">9 Months</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">Penalty/ Late Payment Fee of unpaid monthly installment amount.</label>
              <select class="form-control-sm form-control" name="penalty_percentage" id="" >
              <option <?php if($penalty['penalty_percentage'] == 1): ?>selected <?php endif;?> value="1">1 %</option>
                <option <?php if($penalty['penalty_percentage'] == 2): ?>selected <?php endif;?> value="2">2 %</option>
                <option <?php if($penalty['penalty_percentage'] == 3): ?>selected <?php endif;?> value="3">3 %</option>
                <option <?php if($penalty['penalty_percentage'] == 4): ?>selected <?php endif;?> value="4">4 %</option>
                <option <?php if($penalty['penalty_percentage'] == 5): ?>selected <?php endif;?> value="5">5 %</option>
                <option <?php if($penalty['penalty_percentage'] == 6): ?>selected <?php endif;?> value="6">6 %</option>
                <option <?php if($penalty['penalty_percentage'] == 7): ?>selected <?php endif;?> value="7">7 %</option>
                <option <?php if($penalty['penalty_percentage'] == 8): ?>selected <?php endif;?> value="8">8 %</option>
                <option <?php if($penalty['penalty_percentage'] == 9): ?>selected <?php endif;?> value="9">9 %</option>
              </select>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel </button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>


<style>

</style>
<!-- end of modal -->

<script>
$('#link2').addClass('btn-primary');
$('#loan').addClass('show');
$('#loan_link1').addClass('btn-secondary');

var approvedTable;
$(document).ready(function() {

approvedTable = $('#approvedTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Installment/fetchApproved')?>',
  'order': []
});

});


function release(id){
    if(id){
    document.querySelector('#application_id').value = id;
    $.ajax({
        url: '<?php echo base_url('Admin_Installment/getApproved') ?>',
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
         console.log(response)
         $('#td_ebike_name').html(response.data.ebike_name)
         var opts;
          for(var i = 0; i < response.eItems.length; i++ ){ 
              opts += '<option hidden value=""></option><option value="'+response.eItems[i].id+'">'+response.eItems[i].id+'</option>';
          } 
          $('#serial_select').html(opts);
        }
    }); 
    $("#approvedForm").on('submit', function() {
          var form = $(this);
          $("#approvedModal").modal('hide');
          $(".text-danger").remove();

          $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), 
            dataType: 'json',
            success:function(response) {
              if(response.success === true) {          
                $('#receiptLink').attr({
                    'href' : '<?php echo base_url('Admin_Receipt') ?>/print1/' + response.insert_id
                })
             
                
                // setTimeout(openModelDelay, 30000) 
                $('#receiptModal').modal('show');
                }
            }
          }); 
          return false;
        });
    }
}

function cancelled(id)
{
  if(id){
    // var url = '<?php echo base_url('Admin_Ebike/getProductionData') ?>';
    // $.ajax({
    //     url: url,
    //     type: 'post',
    //     data: { id:id }, 
    //     dataType: 'json',
    //     success:function(response) {

    //        $('#complete_message').html(
    //          'Are you sure that '+response.production.quantity+' '+response.color.color_name+' '+response.model.name+' are now completed?'
    //        );
    //     }
    // });

    $("#cancelForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
          
          if(response.success === true){
           window.location.reload();
          }
          
        }
      }); 
      return false;
    });
  }
}

function contact(id){
    var url = '<?php echo base_url('Admin_Installment/getCustomerInfo') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response){
           $('#contact_message').html(
             'Please call Mr/s. '+response.customer_firstname+' '+response.customer_lastname+' at '+response.customer_contact+'. Advise that the unit is now ready for release.'
           );
          
           $("#contactForm").on('submit', function() {
            var form = $(this);
          
            $(".text-danger").remove();
            
              var mess = `
              Good day,

              This message is sent to inform you that the ebike unit you loaned is now ready for release. Please go to the store as soon as possible to pickup your unit.Make sure to bring 1 valid ID, proof of billing and at least PHP10,000 for the down payment. Thank you!
              `;
              var subjects = 'Ebike Loan';
              $.ajax({
              url: '<?php echo base_url('Admin_Installment/sendmail') ?>',
              type: 'post',
              data: { email:response.customer_email , message: mess, subject: subjects}, 
              dataType: 'json',
              success:function(response) {
                
               if(response.success === true){
                  $("#contactModal").modal('hide');
               }
                
              }
            }); 
            return false;
         
          });
           

        }

    });
    return false;
}

</script>
