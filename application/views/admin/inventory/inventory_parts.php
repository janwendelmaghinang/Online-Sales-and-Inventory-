<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    #modelFilter{
    display: inline;
    margin-left: 25px;
  }

  #modelFilter1{
    display: inline;
    margin-left: 25px;
  }
</style>

<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Spareparts Inventory</h3>
         <button class="btn btn-primary" data-toggle="modal" data-target="#addPartsStockModal">Add Stock</button>
    </div>
    <div class="col  mb-2">
     <br> <a class="btn btn-secondary float-right mt-2" href="<?php echo base_url('Admin_Inventory/serial_motor')?>">Serial Number</a>
</div>
</div>

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

<!-- <ul class="nav nav-tabs my-3">
  <li class="nav-item">
    <a id="link1" class="nav-link text-dark btn" href="<?php echo base_url('Admin_Inventory/spareparts') ?>">Spareparts</a>
  </li>
  <li class="nav-item">
    <a id="link2" class="nav-link text-dark btn" href="<?php echo base_url('Admin_Inventory/spareparts_with_serial') ?>">Parts with serial number</a>
  </li>
</ul> -->


<div id="messages"></div>
<div class="container-fluid">

  <div id="filter">
  <select class="form-control form-control-sm m-0"id="modelFilter" style="  width: 200px;">
        <option value="">All</option>
        <?php foreach($models as $model ): ?>
        <option value="<?php echo $model['name'] ?>"><?php echo $model['name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>

  <div id="filter1">
  <select class="form-control form-control-sm m-0"id="modelFilter1" style="  width: 200px;">
        <option value="">All</option>
        <option value="warehouse">warehouse </option>
        <?php foreach($stores as $store ): ?>
        <option value="<?php echo $store['store_name'] ?>"><?php echo $store['store_name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Spareparts</h5>
            </div>
            <table id="sparepartsTable" class="table table-bordered table-striped ">
              <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Stored_at</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->
<!-- add parts stock  -->
<div class="modal fade" tabindex="-1" role="dialog" id="addPartsStockModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="modal-messages"></div>
        <h4 class="modal-title" id="modal_title">
        </h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>

      <form role="form" action="<?php echo base_url('Admin_Inventory/addPartsStock') ?>" method="post" id="addPartsStockForm">
        <div class="modal-body">
          
        <div class="form-group">
               <label for="">Choose Model</label>
               <select class="form-control form-control-sm" name="model_id" id="model_id" onchange="getPartsByModel()">
                   <option hidden value=""></option>
                  <option value="0">generic</option>
                  <?php foreach($models as $model): ?>
                    <option value="<?php echo $model['id'] ?>"><?php echo $model['name'] ?></option>
                  <?php endforeach; ?>
               </select>
           </div>

           <div class="form-group">
               <label for="">Choose Parts</label>
               <select class="form-control form-control-sm" name="parts_id" id="parts_id" onchange="getPartsById()">
               </select>
           </div>

           <div class="form-group">
               <label for="">Choose Color</label>
               <select class="form-control form-control-sm" name="color_id" id="color_id">
                   <option hidden value=""></option>
                  <option value="0">generic</option>
                  <?php foreach($colors as $color): ?>
                    <option value="<?php echo $color['id'] ?>"><?php echo $color['color_name'] ?></option>
                  <?php endforeach; ?>
               </select>
           </div>

           <div class="form-group" id="serial_qty_form">
                <label for="quantity">Quantity</label>
                  <input class="form-control form-control-sm" type="number" name="qty" id="qty" min=1 oninput="validity.valid||(value='');">
                <?php echo form_error('qty'); ?>
          </div>

         <div class="form-group">
            <label for="serial">Serial Number</label>

            <input type="text" class="form-control form-control-sm"id="serial_display" readonly>
            <input type="hidden" class="form-control form-control-sm" id="serial" name="serial" onchange="show_field()" readonly>

            <div class="form-group">
                <label for="serial_div" class="mt-1" id="serial_div_label"></label>
                <div class="row ml-4" id="serial_div" name="serial_div"></div>
            </div>

         </div>
         </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" id="btn-submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- add stock quantity -->
<div class="modal fade" tabindex="-1" role="dialog" id="addStockQtyModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title_1">
        
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Inventory/addStockQty') ?>" method="post" id="addStockQtyForm">
        <div class="modal-body">

           <div class="form-group">
                <label for="quantity">Quantity</label>
                  <input class="form-control form-control-sm" type="number" name="qty_1" id="qty_1" min=1 oninput="validity.valid||(value='');">
          </div>

         <div class="form-group">
            <label for="serial">Serial Number</label>
            <input class="form-control form-control-sm" type="text" id="serial_1_display" readonly>
            <input type="hidden" name="serial_1" id="serial_1" readonly>

          </div>

            <div class="form-group">
            <label for="serial_div_1" class="mt-1" id="serial_div_1_label"></label>
                <div class="row ml-4" id="serial_div_1" name="serial_div_1"></div>
            </div>

         </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" id="submit2" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- upload image modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="uploadImageModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title_1">
            Upload Image
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Inventory/upload_image') ?>" method="post" id="uploadImageForm" enctype="multipart/form-data">

         <div class="modal-body">
           <div class="form-group">
             <label for="image">Choose Image</label>
             <input class="form-control" type="file" name="image" id="image" required>
              <input type="hidden" name="stock_id_image" id="stock_id_image">
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


<!-- end of modal -->

<script>

  

$('#inventory').addClass('show');
$('#inventory_link1').addClass('bg-secondary');
$('#link1').addClass('text-white-50 bg-primary');

var sparepartsTable;
var parts_name;

$(document).ready(function(){

    sparepartsTable = $('#sparepartsTable').DataTable({
    'ajax': '<?php echo base_url('Admin_Inventory/fetchAllStockData')?>',
    'spareparts': [],
});

$("#sparepartsTable_filter.dataTables_filter").append( '<label class="ml-3">Filter</label>:',$("#modelFilter"));
      
var modelIndex = 0;
$("#sparepartsTable th").each(function (i) {
  if ($($(this)).html() == "Model") {
    modelIndex = i; return false;
  }
});

//Use the built in datatables API to filter the existing rows by the Category column
$.fn.dataTable.ext.search.push(
  function (settings, data, dataIndex) {
    var selectedItem = $('#modelFilter').val()
    var category = data[modelIndex];
    if (selectedItem === "" || category.includes(selectedItem)) {
      return true;
    }
    return false;
  }
);

//Set the change event for the Category Filter dropdown to redraw the datatable each time
//a user selects a new filter.
$("#modelFilter").change(function (e) {
  sparepartsTable.draw();
});
sparepartsTable.draw();

// filter 1


$("#sparepartsTable_filter.dataTables_filter").append( '<label class="ml-3">Stored at</label>:',$("#modelFilter1"));
      
var modelIndex1 = 0;
$("#sparepartsTable th").each(function (i) {
  if ($($(this)).html() == "Stored_at") {
    modelIndex1 = i; return false;
  }
});

//Use the built in datatables API to filter the existing rows by the Category column
$.fn.dataTable.ext.search.push(
  function (settings, data, dataIndex) {
    var selectedItem = $('#modelFilter1').val()
    var category = data[modelIndex1];
    if (selectedItem === "" || category.includes(selectedItem)) {
      return true;
    }
    return false;
  }
);

//Set the change event for the Category Filter dropdown to redraw the datatable each time
//a user selects a new filter.
$("#modelFilter1").change(function (e) {
  sparepartsTable.draw();
});
sparepartsTable.draw();



$("#addPartsStockForm").unbind('submit').on('submit', function(){
  var form = $(this);

  
  $(".text-danger").remove();

  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success:function(response) {
       
        sparepartsTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');

        $("#addPartsStockModal").modal('hide');
        $("#addPartsStockForm")[0].reset();
        }

        else
        {
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


function addStockQty(id){

    $.ajax({
      url: '<?php echo base_url('Admin_Inventory/getStockById')?>',
      data: { id: id }, 
      type: 'post',
      dataType: 'json',
      success:function(response) {
        var color_name;
        if(response.color.color_name == null){
           color_name = 'Generic';
        }
        else 
        {
          color_name = response.color.color_name;
        }
        $('#modal_title_1').html(
          response.parts.name+' | '+response.model.name+' | '+ color_name
        )

        var serial_1 = document.querySelector('#serial_1');
        var serial_1_display = document.querySelector('#serial_1_display');

        serial_1.value = response.parts.serial_number;
        parts_name = response.parts.name
      //  display yes or no
       if(response.parts.serial_number == 1){
          serial_1_display.value = 'Yes';
       }
       else 
       { 
         serial_1_display.value = 'No';
       }
        show_field_1()
      }

    });

    $("#addStockQtyForm").unbind('submit').on('submit', function(){
    var form = $(this);
    
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action')+'/'+id,
      type: form.attr('method'),
      data: form.serialize(),
      dataType: 'json',
      success:function(response) {

          sparepartsTable.ajax.reload(null, false);  
          
          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

    
          $("#addStockQtyModal").modal('hide');
          $("#addStockQtyForm")[0].reset();
          }
          else
          {
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
}

 show_field();
 function show_field(){
      var serial = document.querySelector('#serial');
      var serial_display = document.querySelector('#serial_display');
         if(serial.value == 1){
    
            $('#qty').attr({
                'onkeyup': 'serial_qty()'
            })
           serial_display.value = 'Yes';

            serial_qty()
         }
         if(serial.value == 2){
             qty.value = null;
             $('#qty').attr({
                'onkeyup': ''
             })

            serial_display.value = 'No';

            serial_qty()
         }
   }
         
 function serial_qty(){
     var qty = document.querySelector('#qty');
     var serialHtml = '';
         
         if(qty.value == 0 || qty.value == null){
             $('#serial_div').html('');
             $('#serial_div_label').html('')
             
         }
         else 
         {
            $('#serial_div_label').html('Encode the serial number printed on each Motor/Chassis')
            for(var i = 0; i < qty.value; i++){
                serialHtml += '<div class="col col-4 my-1"><input class="form-control form-control-sm " type="text" id="serial_number'+i+'" name="serial_number[]" onkeyup="search_Serial('+i+')" placeholder="Enter Serial Number" aria-describedby="serial_warning'+i+'" required> <div class="invalid-feedback" id="serial_warning'+i+'"></div> </div>'
                $('#serial_div').html(serialHtml);
            }
         }
 }

 function search_Serial(i){
  
  var serial_number = document.querySelector('#serial_number'+i+'');
  var serial_warning = document.querySelector('#serial_warning'+i+'');
        if(!serial_number.value == ''){
            $.ajax({
            url: '<?php echo base_url('Admin_Inventory/searchSerialNumber')?>',
            data: { serial_number : serial_number.value, name : parts_name  }, 
            type: 'post',
            dataType: 'json',
            success:function(response) {

              if(response.success === true){       
                 $('#serial_number'+i+'').addClass('is-invalid');
                 serial_warning.innerHTML = response.messages;
                
                 serial_number.classList.add('true-warning');
          
                var t = document.querySelectorAll('.true-warning');
                if(t.length > 0){
                  document.querySelector('#btn-submit').disabled = true;
                }  
                //  disable_submit()
              }         
              if(response.success === false)
              {
                $('#serial_number'+i+'').removeClass('is-invalid');
                serial_warning.innerHTML = '';

                serial_number.classList.remove('true-warning');
 
                disable_submit()
              }   
            }
        });
        }
      
    checkinput(i);
 }
 function checkinput(c){
   var input = document.getElementsByName('serial_number[]');
   var i;
    for(i = 0; i < input.length; i++){
          if(i == c){
              // no action
          }
          else
          {
            if(input[c].value == input[i].value && !input[i].value == ''){
                input[c].classList.add('text-danger')
                input[i].classList.add('text-danger')

                $("#modal-messages").html('<div class="alert alert-danger" role="alert">'+
                      'Duplicate entries are not allowed'+
                    '</div>');
      
                break;
         
            }
            else
            {
                input[c].classList.remove('text-danger')
                input[i].classList.remove('text-danger')
               
                disable_submit()
                $("#modal-messages").html('');
            }
          }
      }
  disable_submit()
 }
function disable_submit(){
  var t = document.querySelectorAll('.true-warning');

  if(document.querySelector('#modal-messages').innerHTML == '' && t.length == 0 ){
    $('#btn-submit').prop('disabled', false); 
  }
  else
  {
    $('#btn-submit').prop('disabled', true); 
  }
}
  
  
//  new trigger
 show_field_1();
 function show_field_1(){
      var serial = document.querySelector('#serial_1');

         if(serial.value == 1){
            $('#qty_1').attr({
                'onkeyup': 'serial_qty_1()'
            })
            serial_qty_1();
         }
         if(serial.value == 2){
             qty.value = null;
             $('#qty_1').attr({
                'onkeyup': ''
             })
             serial_qty_1()
         }
  }
         
 function serial_qty_1(){
     var qty = document.querySelector('#qty_1');
     var serial = document.querySelector('#serial_1');
     var serialHtml = '';
         
         if(qty.value == 0 || qty.value == null){
             $('#serial_div_1').html('');
             $('#serial_div_label').html('')
         }
         else if(serial.value == 2){
             $('#serial_div_1').html('');
             $('#serial_div_label').html('')
         }
         else 
         {
          $('#serial_div_label').html('Encode the serial number printed on each Motor/Chassis')
          for(var i = 0; i < qty.value; i++){
                serialHtml += '<div class="col col-4 my-1"><input class="form-control form-control-sm " type="text" id="serial_number_1'+i+'" name="serial_number_1[]" onkeyup="search_Serial_1('+i+')" placeholder="Enter Serial Number" aria-describedby="serial_warning_1'+i+'" required> <div class="invalid-feedback" id="serial_warning_1'+i+'"></div> </div>'
                $('#serial_div_1').html(serialHtml);
            }
         }
  }

function search_Serial_1(i){

 
  var serial_number = document.querySelector('#serial_number_1'+i+'');
  var serial_warning = document.querySelector('#serial_warning_1'+i+'');
      if(!serial_number.value == ''){
            $.ajax({
            url: '<?php echo base_url('Admin_Inventory/searchSerialNumber')?>',
            data: { serial_number : serial_number.value, name : parts_name  }, 
            type: 'post',
            dataType: 'json',
            success:function(response) {
           
              if(response.success === true){       
                $('#serial_number_1'+i+'').addClass('is-invalid');
                serial_warning.innerHTML = response.messages;
            
              
              }         
              else
              {
                $('#serial_number_1'+i+'').removeClass('is-invalid');
                serial_warning.innerHTML = '';

           
              }   

            }
        });
        }

}

 function getPartsByModel(){

  var id = document.querySelector('#model_id').value
 
  $.ajax({
      url: '<?php echo base_url('Admin_Spareparts/fetchAllSparepartsByModel')?>',
      data: { id: id }, 
      type: 'post',
      dataType: 'json',
      success:function(response) {
          
          $('#parts_id').html('');
          for(var i = 0; i < response.length; i++){
            $('#parts_id').append(
              '<option value="'+response[i].id+'">'+ response[i].name +'</option>'
            )
          }
          getPartsById()
      }

    });
 }


 
 function getPartsById(){
  var id = document.querySelector('#parts_id').value
  var serial = document.querySelector('#serial')
  $.ajax({
      url: '<?php echo base_url('Admin_Spareparts/fetchAllSparepartsById')?>',
      data: { id: id }, 
      type: 'post',
      dataType: 'json',
      success:function(response) {
          serial.value = response.serial_number;
          parts_name = response.name;
          show_field();
      }
    });
 }

function uploadImage(id){
  var stock_id_image = document.querySelector('#stock_id_image'); 
  stock_id_image.value = id;

}

</script>
