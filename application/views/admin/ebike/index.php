
<style>
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
        <h4>Production</h4>
        <?php if($btn_trigger == true ):?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addJOModal">Add J.O</button>
        <?php endif; ?>
        <?php if($btn_trigger == false ):?>
            <a class="btn btn-primary" href="<?php echo base_url('Admin_Ebike/production') ?>">Add J.O</a>
        <?php endif; ?>
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

<ul class="nav my-3">
  <li class="nav-item">
    <a id="link1" class=" mx-1 text-light btn btn-outline-dark notification" href="<?php echo base_url('Admin_Ebike/pending') ?>"><span>Pending</span> <span class="badge"><?php echo $pending?> </span> </a>
  </li>
  <li class="nav-item">
    <a id="link2" class=" mx-1 text-dark btn btn-outline-dark" href="<?php echo base_url('Admin_Ebike/completed') ?>">Completed</a>
  </li>
  <li class="nav-item">
    <a id="link3" class=" mx-1 text-dark btn btn-outline-dark" href="<?php echo base_url('Admin_Ebike/cancelled') ?>">Cancelled</a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="ebikeTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Technician</th>
                        <th>Store</th>
                        <th>Date Started</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="addJOModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong class="text-dark"> Please Set Chasis and Serial Number</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- set serial -->
<div class="modal fade" tabindex="-1" role="dialog" id="setSerialModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Set Serial Number</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Ebike/set_serial') ?>" method="post" id="setSerialForm">
        <div class="modal-body">
           <table class="table table-sm table-bordered">
              <thead>
                  <tr>
                      <th>Ebike</th>
                      <th>Motor Number</th>
                      <th>Chasis Number</th>
                  </tr>
              </thead>
              <tbody id="tBody"></tbody>
           </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--  Complete modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="completeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Complete</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Ebike/production_completed') ?>" method="post" id="completeForm">
        <div class="modal-body">
          <p class="text-capitalize" id="complete_message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Cancel -->
<div class="modal fade" tabindex="-1" role="dialog" id="cancelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Cancel</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Ebike/production_cancelled') ?>" method="post" id="cancelForm">
        <div class="modal-body">
        <p class="text-capitalize" id="cancel_message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- end modal -->

<script>

$('#ebike_units').addClass('show');
$('#link1').addClass('btn-primary');
$('#production_link1').addClass('btn-secondary');
var ebikeTable;
$(document).ready(function() {

ebikeTable = $('#ebikeTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Ebike/fetchAllProductionData/1')?>',
  'order': [],

});

});

function getProductionItems(id){
  
  if(id){
    var url = '<?php echo base_url('Admin_Ebike/getItemsByProductionId') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
          var trHTML = '';
          var j = 1;
          var count = 0;

          selectOption(response.model_id); // call the function for motor_number
          selectOption1(response.model_id); // call the function for chasis_number
          
            for ( var i = 0; i < response.p_items.length; i++){
              
                    trHTML +=`
                    <tr>
                       <td>`
                         + j + `<input type="hidden" name="item_id[]" value="`+response.p_items[i].id+`" ><input type="hidden" name="production_id[]" value="`+response.p_items[i].production_id+`">
                        </td>
                        <td>
                          <div class="input-group">
                            <select required class="form-control-sm form-control motor_number" name="motor_number[]" id="motor_number" onchange="validateSelected(`+count+`)">
                              <option hidden></option>
                            </select>
                              <div class="input-group-append">
                                <button class="btn-danger" type="button" onclick="clearSelect(`+count+`)" >x</button>
                              </div>
                          </div>
                         </td><td>
                          <div class="input-group">
                              <select required class="form-control-sm form-control chasis_number" name="chasis_number[]" id="chasis_number" onchange="validateSelected1(`+count+`)">
                                <option hidden></option>
                              </select>
                                <div class="input-group-append">
                                  <button class="btn-danger" type="button" onclick="clearSelect1(`+count+`)" >x</button>
                                </div>
                            </div>
                        </td>
                      </tr>
                    `
                j++;
                count++;
                }
              $('#tBody').html(trHTML);
              // selectDisplay();
        }
    });

    $("#setSerialForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action')+'/'+id,
        type: form.attr('method'),
        data: form.serialize(), 
        dataType: 'json',
        success:function(response) {
        
            ebikeTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            location.reload();
            $("#setSerialModal").modal('hide');

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

function selectOption(id){
    var url = '<?php echo base_url('Admin_Ebike/getMotorNumberByModel')?>';
    var model_id = id;
// get motor number
$.ajax({
        url: url,
        type: 'post',
        data: { id: model_id }, 
        dataType: 'json',
        success:function(response){

          for( i = 0 ; i < response.length; i++){
            $('.motor_number').append('<option value="'+response[i].id+'">'+ response[i].motor_number +'</option>')
          }
          
        }
    });   
}
function validateSelected(count){
    var motor_number = document.querySelectorAll('#motor_number');
    var i;

    for(i = 0; i < motor_number.length; i++){
      if(motor_number[count] == motor_number[i])
        {
            // no actions
        }
        else 
        {
         
          if(motor_number[count].value == motor_number[i].value){
            alert('This motor number is already selected')
            motor_number[count].value = '';
            
            break;
          }
        }
    }
}
function clearSelect(count){
   var motor_number = document.querySelectorAll('#motor_number');
   motor_number[count].value = '';
}

function selectOption1(id){
    var url = '<?php echo base_url('Admin_Ebike/getChasisNumberByModel')?>';
    var model_id = id;
// get chasis number
$.ajax({
        url: url,
        type: 'post',
        data: { id: model_id }, 
        dataType: 'json',
        success:function(response){

          for( i = 0 ; i < response.length; i++){
            $('.chasis_number').append('<option value="'+response[i].id+'">'+ response[i].chasis_number +'</option>')
          }
          
        }
    });   
}
function validateSelected1(count){
    var chasis_number = document.querySelectorAll('#chasis_number');
    var i;

    for(i = 0; i < chasis_number.length; i++){
      if(chasis_number[count] == chasis_number[i])
        {
            // no actions
        }
        else 
        {
         
          if(chasis_number[count].value == chasis_number[i].value){
            alert('This chassis number is already selected')
            chasis_number[count].value = '';
            
            break;
          }
        }
    }
}
function clearSelect1(count){
   var chasis_number = document.querySelectorAll('#chasis_number');
   chasis_number[count].value = '';
}

function complete(id)
{
  if(id){
    var url = '<?php echo base_url('Admin_Ebike/getProductionData') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {

           $('#complete_message').html(
             'Are you sure that '+response.production_quantity+' '+response.color.color_name+' '+response.model.name+' are now completed?'
           );
        }
    });

    $("#completeForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
      
            ebikeTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            $("#completeModal").modal('hide');

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

function cancel(id)
{
  if(id) {

    var url = '<?php echo base_url('Admin_Ebike/getProductionData') ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {

           $('#cancel_message').html(
             'Are you sure to cancel assembling '+response.production.quantity+' '+response.color.color_name+' '+response.model.name+'?'
           );
        }
    });

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


</script>
