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
         <h3>Adding Job Order</h3>
         <!-- <a class="btn btn-primary text-light" href="<?php echo base_url('Admin_Ebike/create') ?>">Add J.O</a> -->
    </div>
    <div class="col mb-2">
         <br> 
         <a href="<?php echo base_url('Admin_Ebike/pending') ?>" class="btn btn-warning float-right">Back</a>
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

<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">

            <table id="ebikeTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Model ID</th>
                        <th>Model Name</th>
                        <th>Color</th>
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->


<!-- production  -->
<div class="modal fade" tabindex="-1" role="dialog" id="productionModal-modal-lg">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Production</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
      </div>
      <div id="modal_message"></div>
      <form role="form" action="<?php echo base_url('Admin_Ebike/addProduction') ?>" method="post" id="productionForm">
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input class="form-control form-control-sm" disabled type="text" id="model">
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input class="form-control form-control-sm" disabled type="text" id="color">
                    </div>
                    <div class="form-group">
                        <label for="color">Voltage</label>
                        <input class="form-control form-control-sm" disabled type="text" name="voltage" id="voltage">
                    </div>

                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input class="form-control form-control-sm" onkeyup="computeParts()" required type="number" name="qty" id="qty" value="1" min="1" oninput="validity.valid||(value='');" >
                        
                    </div>
                    <div class="form-group">
                        <label for="">Technician</label>
                        <input class="form-control form-control-sm" type="text" name="technician" id="technician" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="color" id="h_color">
                        <input type="hidden" name="model" id="h_model">
                        <input type="hidden" name="ebike_stock_id" id="ebike_stock_id">
                    </div>
                </div>
                <div class="col">
                    <h3>Parts Needed</h3>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Parts Name</th>
                                <th>Needed Quantity</th>
                                <th>Available</th>
                            </tr>
                        </thead>
                        <tbody id="tBody"></tbody>
                    </table>
                </div>
 

            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="modalCloseBtn" data-dismiss="modal">Close</button>
          <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- deliver modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="deliverModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">deliver</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Ebike/deliver_to_store') ?>" method="post" id="deliverForm">
        <div class="modal-body">
            <div class="form-group">
                <label for="model">Model</label>
                <input class="form-control form-control-sm" disabled type="text" id="deliver_model">
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <input class="form-control form-control-sm" disabled type="text" id="deliver_color">
            </div>
            <div class="form-group">
                <label for="color">Voltage</label>
                <input class="form-control form-control-sm" disabled type="text" name="deliver_voltage" id="deliver_voltage">
            </div>

            <div class="form-group">
                <label for="store"></label>
                <select class="form-control form-control-sm" name="deliver_store">
                 
                </select>
            </div>

            <div class="form-group">
                <label for="">Quantity</label>
                <input class="form-control form-control-sm" required type="number" name="deliver_qty" id="deliver_qty" min=0  oninput="validity.valid||(value='');" >

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- end modal -->

<script>


var ebike_id;
var ebikeTable;
var parts_model_id;
var parts_color_id;
$('#ebike_units').addClass('show');
$('#production_link1').addClass('btn-secondary');


$(document).ready(function(){

ebikeTable = $('#ebikeTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Ebike/fetchAllEbikeData')?>',
  'order': []
});

});

function ebikeProduction(id){
    ebike_id = id;
    
   
    $('#modal_message').html('');
    $('#submitBtn').prop('disabled', false);  

    document.querySelector('#qty').value = '';
    
    $.ajax({
        url: '<?php echo base_url('Admin_Ebike/getEbikeById')?>',
        type: 'post',
        data: { id: id }, 
        dataType: 'json',
        success:function(response){
          console.log(response)
            //set value
            parts_model_id = response.model.id; 
            parts_color_id = response.color.id; 

            getParts(response.model.id , response.color.id);


            $("#model").val(response.model.name);
            $("#color").val(response.color.color_name);

            // $("#voltage").val(response.specs.rated_voltage);
   
            $("#h_model").val(response.model.id);
            $("#h_color").val(response.color.id);
            $("#ebike_stock_id").val(id);

            $("#productionForm").unbind('submit').bind('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response){
                    console.log(response)
                    if(response.success === true){
                        
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        '</div>');

                        $("#productionModal-modal-lg").modal('hide');
                        $("#productionForm")[0].reset();
                     }
                     if(response.success === false){
                        
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        '</div>');

                        $("#productionModal-modal-lg").modal('hide');
                        $("#productionForm")[0].reset();
                     }
                     
                    }
                });
            })
        }
    });
  
}


function getParts(model, color){
    // console.log(model + ' ' + color)

    $.ajax({
        url: '<?php echo base_url('Admin_Spareparts/getAllParts')?>',
        data: {model_id : model, color_id : color },
        type: 'post',
        dataType: 'json',
        success:function(response){
            var trHTML = '';
            for ( var i = 0; i < response.parts.length; i++){
                    trHTML +=
                        '<tr><td>'
                        + response.name[i].name
                        + '</td><td> <input id="qty_temp" type="hidden" value="'+ response.name[i].qty_per_ebike +'" readonly > <input id="tqty" type="text" class="form-control" disabled value="'
                        + response.name[i].qty_per_ebike + ' pcs'
                        + '"></td><td> <input id="available_qty" type="hidden" value="'+response.parts[i].qty+'"readonly >' 
                        + response.parts[i].qty + ' pcs'
                        + '</td></tr>'
                         
                }
              $('#tBody').html(trHTML);
            
        }
      
    })
    computeParts()
}

function computeParts(){
    var  tqty =  document.querySelectorAll('#tqty');
    var  qty_temp =  document.querySelectorAll('#qty_temp'); // multiplier
    var  qty =  document.querySelector('#qty');  
    var  available_qty = document.querySelectorAll('#available_qty');
    
    var found = [];
    for(var i = 0; i < tqty.length ; i++){
        total = parseInt(qty_temp[i].value) * qty.value
        tqty[i].value = total
        
        if(total > available_qty[i].value ){
            if(!found.includes(available_qty[i])){
                found.push(available_qty[i])
            }
        }
    }
    if(found.length == 0){
        $('#submitBtn').prop('disabled', false);
        $('#modal_message').html('');
    }
    else{
        $('#submitBtn').prop('disabled', true);
        $('#modal_message').html(
            `
            <div class="alert alert-danger" role="alert">
                Not enough parts stock.
            </div>
            `
        )
    }
}


function ebikeDeliver(id){
    $.ajax({
        url: '<?php echo base_url('Admin_Ebike/getEbikeById')?>',
        type: 'post',
        data: { id: id }, 
        dataType: 'json',
        success:function(response){

            $.ajax({
                url: '<?php echo base_url('Admin_Ebike/selectStore')?>',
                type: 'post',
                data: { id: id }, 
                dataType: 'json',
                success:function(data){ 
                 console.log(data)
                var opts;
   
                $.each(opts, function(i, d) {
                    $('#delivery_store').append('<option value="' + d.data.id + '">' + d.data.unit_id + '</option>');
                });
                }
             })
            

            $("#deliver_model").val(response.units.name);
            $("#deliver_color").val(response.color.color_name);
            $("#deliver_voltage").val(response.specs.rated_voltage);

            $("#deliver_qty").attr({
                "max" : response.units.quantity
            })
        
            $("#d_id").val(response.units.id);
            $("#d_model").val(response.units.ebike_id);
            $("#d_color").val(response.color.id);
    
            $("#deliverForm").unbind('submit').bind('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response){
                    console.log(response)
                    if(response.success === true){
                        
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        '</div>');

                        $("deliverModal").modal('hide');
                        $("deliverForm")[0].reset();
                     }
                     if(response.success === false){
                        
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        '</div>');

                        $("#deliverModal").modal('hide');
                        $("#deliverForm")[0].reset();
                     }
                     
                    }
                });
            })
        }
    });
}


</script>