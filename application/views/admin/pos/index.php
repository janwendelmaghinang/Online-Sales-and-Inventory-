<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
#ebike_page{
   color: black;
}
#parts_page{
   color: black;
}
#ebike_page:hover{
   color: white;
   background: gray;
}
#parts_page:hover{
   color: white;
   background: gray;
}
</style>

<div class="row border-bottom">
   <div class="col">
        <h3>Point of Sale</h3>
   </div>
</div>

<div class="row">
   <div class="col">
        <ul class="nav my-3">
            <li class="nav-item"><button class="nav-link btn btn-outline-dark mr-1" id="parts_page" onclick="spareparts_page()">Parts</button></li>
            <li class="nav-item"><button class="nav-link btn btn-outline-dark" id="ebike_page" onclick="ebike_page()" >Ebike</button></li>
        </ul> 
   </div>
</div>

<div id="pageContent"></div>



<script>
    spareparts_page();
    
    $('#pos_link').addClass('bg-secondary');

    var link;
    var url = '<?php echo base_url('Admin_Receipt/print/') ?>';

        $(".select2").select2();
        
        function model_color(){
            var model = document.querySelector('#model');
            var color = document.querySelector('#color');
            if(model.value !== '' && color.value !== ''){
            getProduct(model.value, color.value);
            }
            if(!model.value === null && !color.value === null && model.value == 0 && color.value == 0 )
            {
                getProduct(model.value, color.value);
            }
        }

        function getProduct(model, color){
            console.log(model , color)
            $.ajax({
                url: '<?php echo base_url('Admin_Spareparts/fetchAllSparepartsByColorModel') ?>',
                type: 'post',
                data: {model_id : model, color_id : color},
                dataType: 'json',
                success:function(response) {
            
                    $('#parts').html('');
                        for(var i = 0; i < response.stock.length; i++){
                            $('#parts').append(
                            '<option value="'+response.stock[i].id+'">'+ response.parts[i].name +'</option>'
                            )
                        }
                     if(response['success'] === false){
                        document.getElementById('stock').value = '';
                        document.getElementById('displayPrice').value = '';
                     }   
                        getPartsById()

                }
                });

        }

        function getPartsById(){
            var id = document.querySelector('#parts').value;

            $.ajax({
                url: '<?php echo base_url('Admin_Inventory/getStockById') ?>',
                type: 'post',
                data: {id : id},
                dataType: 'json',
                success:function(response) {
                    if(response.success === true){
                        // set the max qty
                        $('#product_qty').attr({
                            max: response.stock.qty
                        })
                        document.getElementById('stock').value = response.stock.qty +' pcs';
                        document.getElementById('displayPrice').value = '₱'+ response.parts.price.replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                    else
                    {
                          // set the max qty
                        $('#product_qty').attr({
                            max: 0
                        })
                        document.getElementById('stock').value = '';
                        document.getElementById('displayPrice').value = '';
                    }
                }
                });
        }
    // add new customer
        function newCustomer(){
            var btnName = document.querySelector('#newcustbtn')
    
            if(btnName.innerHTML === 'Select Customer'){
                document.querySelector('#truecase').value = 1;
                document.querySelector('#customer_select_id').toggleAttribute('disabled', false)
                document.querySelector('#customer_firstname').toggleAttribute('disabled', true)
                document.querySelector('#customer_lastname').toggleAttribute('disabled', true)
                document.querySelector('#customer_contact').toggleAttribute('disabled', true)
                // document.querySelector('#customer_address').toggleAttribute('disabled', true)
                btnName.innerHTML = 'New Customer';
            }
            else
            {
                document.querySelector('#truecase').value = 0;
                document.querySelector('#customer_select_id').toggleAttribute('disabled', true)
                document.querySelector('#customer_firstname').toggleAttribute('disabled', false)
                document.querySelector('#customer_lastname').toggleAttribute('disabled', false)
                document.querySelector('#customer_contact').toggleAttribute('disabled', false)
                // document.querySelector('#customer_address').toggleAttribute('disabled', false)
                btnName.innerHTML = 'Select Customer'
            
            //    remove text danger
                $(".text-danger").remove();
                var customer_select_id = document.querySelector('#customer_select_id');
                customer_select_id.selectedIndex = '';


            }
            $('#new_form_div').toggle();
        select_ // $('#customer_select_id').toggle()
        }
    // add products to list
        function addToList(){
            // e.preventDefault();
            var table = document.getElementById("list_table");

            var list = document.querySelectorAll('#prod_id');
            var model = document.querySelector('#model');
            var color = document.querySelector('#color');
         
            // var prod = $('#product').find('option:selected');
            var prod = document.getElementById('parts');
            var prod_qty = document.getElementById('product_qty');
            var prod_stock = document.getElementById('stock');
            var prod_price = document.getElementById('displayPrice');

            // console.log(prod.options[prod.selectedIndex])
            if(prod.options[prod.selectedIndex] || prod_qty.value ){
                if(!prod.options[prod.selectedIndex]){
                alert('please select product')   
                }
                else if(!prod_qty.value){
                alert('please input quantity')
                }
                else if(prod_stock.value == 0 ||prod_stock.value == null ){
                alert('No Available Stock')
                }
                else
                {
                    if(!list.length == 0){
                    for(var i=0;i<list.length;i++){
                        if(prod.options[prod.selectedIndex].value ==  list[i].value){
                            alert('This Item is Already in the list')
                            return false;
                        }
                    }
                    }
                    // success
                    var row = table.insertRow(1);
                    var cell0 = row.insertCell(0);
                    var cell1 = row.insertCell(1);
                    var cell2 = row.insertCell(2);
                    var cell3 = row.insertCell(3);
                    var cell4 = row.insertCell(4);
                    var cell5 = row.insertCell(5);
            
                    $.ajax({
                        url: '<?php echo base_url('Admin_Inventory/getStockById') ?>',
                        type: 'post',
                        data: {id : prod.options[prod.selectedIndex].value},
                        dataType: 'json',
                        success:function(response) {
                    
                        var total_amount = response.parts.price * prod_qty.value;
                        
                        var i = 1;

                        cell0.innerHTML = response.stock.id + '<input type="hidden" name="prod_id[]" id="prod_id" value="'+response.stock.id+'">';
                        cell1.innerHTML = response.parts.name + '<input type="hidden" name="prod_name[]" value="'+response.parts.name+'">';
                        cell2.innerHTML = prod_qty.value + '<input type="hidden" name="prod_qty[]" value="'+prod_qty.value+'">';
                        cell3.innerHTML = response.parts.price + '<input type="hidden" name="prod_price[]" value="'+response.parts.price+'">';
                        cell4.innerHTML = total_amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '<input type="hidden" name="prod_total_amount[]" id="prod_total_amount" value="'+total_amount+'">';
                        cell5.innerHTML = '<button onclick="removeToList(this)" class="btn btn-danger">Delete</button>'
                
                        // call the amount
                        totalAmount();

                        // reset select product
                        prod.selectedIndex = 0;
                        color.selectedIndex = 0;
                        model.selectedIndex = 0 ;
                        prod_qty.value = '';
                        prod_stock.value = '';
                        prod_price.value = '';
                        // $("#product").select2('destroy').val("").select2();
                        }
                    });
                }
            }
            else 
            {
                alert('Please Select Product and Quantity')   
            }


        }
    // remove product to list
        function removeToList(r){
            var i  = r.parentNode.parentNode.rowIndex;
            document.getElementById("list_table").deleteRow(i)

            // call the amount
            totalAmount();
        }

    // compute the total amount
        function totalAmount(){
            

                var prod_total = document.querySelectorAll('#prod_total_amount');
                var tamount = document.querySelector('#tamount');
                var gross_amount = document.querySelector('#gross_amount');

                var vat_charge = document.querySelector('#vat_charge');
                var vat_charge_value = document.querySelector('#vat_charge_value');

                var vatable = document.querySelector('#vatable');

                var net_amount = document.querySelector('#net_amount');



                var sum = 0;
                for(var i = 0 ; i < prod_total.length; i++){
                sum = parseFloat(sum) + parseFloat(prod_total[i].value);
                }
                tamount.value = sum.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                
                // set gross amount  
                gross_amount.value = sum.toFixed(2);

                // vatable
                var vat_temp = ((vat_charge_value.value / parseFloat(100)) + parseFloat(1))
                var computed_vatable = parseFloat(sum) / parseFloat(vat_temp);
                vatable.value = computed_vatable.toFixed(2)

                // vat charge
                var vatTotal = computed_vatable * (vat_charge_value.value / 100);
                vat_charge.value = vatTotal.toFixed(2);
                
                var discount = document.querySelector('#discount');

                // net amount
                var netTotal = computed_vatable + vatTotal

                if(discount.value){
                    netTotal = netTotal - discount.value;
                }
                net_amount.value = netTotal.toFixed(2);
                
                var paymentTamount = document.querySelector('#paymentTamount');
                paymentTamount.value = netTotal.toFixed(2);
        }
    // check table list 
        function checkList0(){ 
            link = 'proceedpayment'
            var list = document.querySelectorAll('#prod_id');
    
            var paymentBtn = document.querySelector('#paymentBtn');
        
            if(list.length == 0 ){
                alert('Please Add atleast one Item');
                $('#paymentBtn').attr({
                    'data-toggle': "",
                    'data-target': ""
                })
            }
            else 
            {
                // show modal
                $('#paymentBtn').attr({
                    'data-toggle': "modal",
                    'data-target': "#paymentModal"
                })
                computeChange();
                }
        }
        function checkList1(){ 
            link = 'placeOrder'
            var list = document.querySelectorAll('#prod_id');
            var paymentBtn = document.querySelector('#placeOrderBtn');
        
            if(list.length == 0 ){
                alert('Please Add atleast one Item');
                $('#placeOrderBtn').attr({
                    'data-toggle': "",
                    'data-target': ""
                })
            }
            else 
            {
                // show modal
                $('#placeOrderBtn').attr({
                    'data-toggle': "modal",
                    'data-target': "#placeOrderModal"
                })
                computeChange();
                }
        }
    //  compute change
        function computeChange(){
            var paymentTamount = document.querySelector('#paymentTamount');
            var payment_amount_tentered = document.querySelector('#payment_amount_tentered');
            var payment_change = document.querySelector('#payment_change');
        
            var total = parseFloat(payment_amount_tentered.value) - parseFloat(paymentTamount.value);

            payment_change.value = (total.toFixed(2)); 


        }

        $(document).ready(function(){
        
            $("#posForm").unbind('submit').on('submit', function(){
            var form = $(this);
            
            $(".text-danger").remove();

            // if()

            $.ajax({
                url: '<?php echo base_url('Admin_Pos/')?>'+link,
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response) {
                
                    if(response.success === true) {
                        
                        $('#receiptLink').attr({
                            'href' : url + response.insert_id
                        })
                    
                    $("#paymentModal").modal('hide');
                    $("#placeOrderModal").modal('hide');
                    
                    // setTimeout(openModelDelay, 30000) 
                    $('#receiptModal').modal('show');
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



        function spareparts_page(){
            $('#parts_page').addClass('btn-primary')
            $('#ebike_page').removeClass('btn-primary')
            $('#pageContent').html(
                `   
                    <form method="post" id="posForm">

                    <div class="row">
                    <div class="col">    
                        <div class="row">
                            <div class="col col-4">
                                <label for="">Choose Model</label>
                                <div class="form-group">
                                    <select class="form-control form-control-sm " name="model" id="model" onchange="model_color()">
                                        <option value=""hidden></option>
                                        <option value="0">Generic</option>
                                        <?php foreach($models as $model): ?>
                                            <option value="<?php echo $model['id']?>"><?php echo $model['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-4">
                                <label for="">Choose Color</label>
                                <div class="form-group">
                                    <select class="form-control form-control-sm " name="color" id="color" onchange="model_color()">
                                        <option value=""hidden></option>
                                        <option value="0">Generic</option>
                                        <?php foreach($colors as $color): ?> 
                                            <option value="<?php echo $color['id']?>"><?php echo $color['color_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-4">
                            <label for="">Choose Parts</label>
                                <div class="form-group">
                                    <select class="form-control form-control-sm" name="parts" id="parts" onchange="getPartsById()">
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Price</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" disabled="disabled" id="displayPrice">
                                </div>
                            </div>

                            <div class="col">
                                <label for="">Available</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" disabled="disabled" id="stock">
                                </div>
                            </div>

                            <div class="col">
                                <label for="">Qty</label>
                                <div class="form-group">
                                    <input class="form-control text-right" type="number" name="product_qty" id="product_qty" min=0  oninput="validity.valid||(value='');">
                                </div>
                            </div>
                            <div class="col">
                                <label for="">Action</label>
                                <div class="form-group">
                                <button type="button" onclick="addToList()" class="btn btn-primary">Add to list</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col col-8">
                        <table class="table table-bordered" id="list_table">
                            <tr>
                                <th>Product_id</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                            <tfoot>
                                <tr>
                                    <th class="text-right" colspan="4">Total</th>
                                    <th ><input id="tamount" type="text" disabled="disabled" value="0.00" style="border: none;"></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="col bg-light border shadow-lg py-2">
                        <!-- gross amount -->
                        <div class="form-group row">
                            <label style="font-size: 11px;" for="vat" class="col-sm-3 col-form-label "><strong>Gross Amount</strong></label>
                            <div class="col-sm-9">
                                <input type="text" readonly="" class="form-control form-control-sm" name="gross_amount" id="gross_amount">
                            </div>
                        </div>  

                        <!-- vatable  -->
                        <div class="form-group row">
                            <label style="font-size: 11px;" for="vat" class="col-sm-3 col-form-label "><strong>Vatable</strong></label>
                            <div class="col-sm-9">
                                <input type="text" readonly="" class="form-control form-control-sm" name="vatable" id="vatable">
                            </div>
                        </div>         
                    
                        <!-- vat -->
                        <div class="form-group row">
                            <label style="font-size: 12px;" for="vat" class="col-sm-3 col-form-label "><strong>Vat <?php echo $company['vat_charge_value'] ?>%</strong></label>
                            <div class="col-sm-9">
                                <input type="text" readonly="" class="form-control form-control-sm" name="vat_charge" id="vat_charge">
                                <input type="hidden" readonly="" class="form-control form-control-sm" value="<?php echo $company['vat_charge_value'] ?>"  name="vat_charge_value" id="vat_charge_value">
                            </div>
                        </div>
                        <!-- discount -->
                        <div class="form-group row">
                            <label style="font-size: 12px;" for="vat" class="col-sm-3 col-form-label "><strong>Discount</strong></label>
                            <div class="col-sm-9">
                                <input onkeyup="totalAmount()" type="number"class="form-control form-control-sm text-right" name="discount" id="discount" min=0 step="any">
                            </div>
                        </div>
                        <!-- net amount -->
                        <div class="form-group row">
                            <label style="font-size: 12px;" for="vat" class="col-sm-3 col-form-label "><strong>Total Amount</strong></label>
                            <div class="col-sm-9">
                                <input type="text" readonly="" class="form-control form-control-sm" name="net_amount" id="net_amount" step="any">
                            </div>
                        </div>
                        <button type="button" onclick="checkList0()" id="paymentBtn"  class="btn btn-primary my-1 w-100">Proceed Payment</button>
                        <!-- <button type="button" onclick="checkList1()" id="placeOrderBtn"  class="btn btn-warning mb-1 w-100">Place Order</button> -->
                    </div>
                    </div>

                    <!-- modal -->

                    <!-- payment modal -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="paymentModal">
                    <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                        <h4 class="modal-title">Sales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col col-8 ">   
                                  <div class="row">
                                    <div class="col">  
                                        <div class="form-group" id="select_form_div">
                                            <label for="Customer">Customer</label>
                                            <select class="form-control form-control-sm" name="customer_select_id" id="customer_select_id">
                                                <option hidden></option>
                                                <?php foreach($customers as $customer): ?>
                                                    <option value="<?php echo $customer['id'] ?>"><?php echo $customer['customer_firstname'] ?> <?php echo $customer['customer_lastname'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col d-flex flex-wrap align-content-center">
                                       <div class="btn-group ">
                                         <button type="button" onclick="newCustomer()"class="btn btn-sm btn-primary" id="newcustbtn">New Customer</button>
                                       </div>
                                    </div>
                                  </div>

                                    <div id="new_form_div" style="display: none">
                                    <input type="hidden" name="truecase" id="truecase" value="1" readonly >
                                        <strong><label>Customer Information</label></strong>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">firstname</label>
                                                    <input class="form-control form-control-sm" name="customer_firstname" id="customer_firstname" type="text">
                                                </div>
                                            </div>
                                            <div class="col">
                                               <div class="form-group">
                                                    <label for="">lastname</label>
                                                    <input class="form-control form-control-sm" name="customer_lastname" id="customer_lastname" type="text">
                                               </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Middle Name</label>
                                                    <input class="form-control form-control-sm" name="customer_middle" id="customer_middle" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <strong><label>Customer Address</label></strong> 
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Number</label>
                                                    <input class="form-control form-control-sm" name="customer_contact" id="customer_contact" type="number">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input class="form-control form-control-sm" name="customer_email" id="customer_email" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <strong><label>Customer Address</label></strong> 
                                        <div class="row">
                                           <div class="col">
                                                <div class="form-group">
                                                    <label for="">Street</label>
                                                    <input class="form-control form-control-sm" name="customer_street" id="customer_street" type="text">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Subdivision</label>
                                                    <input class="form-control form-control-sm" name="customer_subdivision" id="customer_subdivision" type="text">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Barangay</label>
                                                    <input class="form-control form-control-sm" name="customer_barangay" id="customer_barangay" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">City</label>
                                                    <input class="form-control form-control-sm" name="customer_city" id="customer_city" type="text">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Province</label>
                                                    <input class="form-control form-control-sm" name="customer_province" id="customer_province" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        


                                    </div>
                                </div>

                                <div class="col shadow-lg">
                                    <strong><label>Enter Amount</label></strong> 
                                    <div class="form-group">
                                        <input onkeyup="computeChange()" class="form-control form-control-sm text-right" type="number" name="payment_amount_tentered" id="payment_amount_tentered">
                                    </div>

                                    <strong><label>Total Amount</label></strong> 
                                    <div class="form-group">
                                        <input readonly="" class="form-control form-control-sm text-right" value="0.00" type="text" name="paymentTamount" id="paymentTamount">
                                    </div>

                                    <strong><label>Change</label></strong> 
                                    <div class="form-group">
                                        <input readonly="" class="form-control form-control-sm text-right" type="number" name="payment_change" id="payment_change">
                                        
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </div>

                    </div>
                    </div>
                    </div>

                    <!-- place order modal -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="placeOrderModal">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                        <h4 class="modal-title">Place Order</h4>
                        </div>

                        <div class="modal-body">
                            <h4>Customer Information</h4>
                            <div class="row">
                                <div class="col">
                                
                                    <div class="form-group">
                                        <label for="">FirstName</label>
                                        <input class="form-control" type="text" name="c_firstname" id="c_firstname">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Lastname</label>
                                        <input class="form-control" type="text" name="c_lastname" id="c_lastname">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Contact Number</label>
                                        <input class="form-control" type="text" name="c_contact" id="c_contact">
                                    </div>
                            
                                </div>     
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </div>
                    </div>
                    </div>
                    </div> 
                    <!-- end modal -->
                    </form>

                    <!-- receipt modal outside the form -->
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
                            <a class="btn btn-warning" id="receiptLink" target="_blank">Proceed</a>
                            <a class="btn btn-primary" href="<?php echo base_url('Admin_Pos') ?>">New Sales</a>
                        </div>
                    </div>
                    </div>
                    </div> 

                `
            );    
        }

// ebike pos
        function ebike_page(){
            $('#ebike_page').addClass('btn-primary')
            $('#parts_page').removeClass('btn-primary')
            $('#pageContent').html(
                `
          <form method="post" id="posForm1" enctype="multipart/form-data" action="<?php echo base_url('Admin_Pos/purchaseEbike') ?>">

            <div class="row">
            <div class="col">    
                <div class="row">
                    <div class="col col-4">
                        <label for="">Choose Model</label>
                        <div class="form-group">
                            <select class="form-control form-control-sm " name="ebike_model" id="ebike_model" onchange="EbikeProduct()">
                                <option value=""hidden></option>
                                <?php foreach($models as $model): ?>
                                    <option value="<?php echo $model['id']?>"><?php echo $model['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col col-4">
                        <label for="">Choose Color</label>
                        <div class="form-group">
                            <select class="form-control form-control-sm " name="ebike_color" id="ebike_color" onchange="EbikeProduct()">
                                <option value=""hidden></option>
                                <?php foreach($colors as $color): ?> 
                                    <option value="<?php echo $color['id']?>"><?php echo $color['color_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="">Price</label>
                        <div class="form-group">
                            <input class="form-control" type="text" readonly id="ebikeDisplayPrice">
                        </div>
                    </div>

                    <div class="col">
                        <label for="">Available</label>
                        <div class="form-group">
                            <input class="form-control" type="text" readonly id="ebikeStock">
                        </div>
                    </div>

                    <div class="col">
                        <label for="">Qty</label>
                        <div class="form-group">
                            <input class="form-control text-right" type="number" name="ebike_product_qty" id="ebike_product_qty" min=0  oninput="validity.valid||(value='');">
                        </div>
                    </div>
                    <div class="col">
                        <label for="">Action</label>
                        <div class="form-group">
                        <button type="button" onclick="addToList1()" class="btn btn-primary">Add to list</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="row">
            <div class="col col-8">
                <table class="table table-bordered" id="list_table1">
                    <tr>
                        <th>Product_id</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="4">Total</th>
                            <th ><input id="tamount" type="text" disabled="disabled" value="0.00" style="border: none;"></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <div class="col bg-light border shadow-lg py-2">
                <!-- gross amount -->
                <div class="form-group row">
                    <label style="font-size: 11px;" for="vat" class="col-sm-3 col-form-label "><strong>Gross Amount</strong></label>
                    <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control form-control-sm" name="gross_amount" id="gross_amount">
                    </div>
                </div>  

                <!-- vatable  -->
                <div class="form-group row">
                    <label style="font-size: 11px;" for="vat" class="col-sm-3 col-form-label "><strong>Vatable</strong></label>
                    <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control form-control-sm" name="vatable" id="vatable">
                    </div>
                </div>         
            
                <!-- vat -->
                <div class="form-group row">
                    <label style="font-size: 12px;" for="vat" class="col-sm-3 col-form-label "><strong>Vat <?php echo $company['vat_charge_value'] ?>%</strong></label>
                    <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control form-control-sm" name="vat_charge" id="vat_charge">
                        <input type="hidden" readonly="" class="form-control form-control-sm" value="<?php echo $company['vat_charge_value'] ?>"  name="vat_charge_value" id="vat_charge_value">
                    </div>
                </div>
                <!-- discount -->
                <div class="form-group row">
                    <label style="font-size: 12px;" for="vat" class="col-sm-3 col-form-label "><strong>Discount</strong></label>
                    <div class="col-sm-9">
                        <input onkeyup="totalAmount()" type="number"class="form-control form-control-sm text-right" name="discount" id="discount" min=0 step="any">
                    </div>
                </div>
                <!-- net amount -->
                <div class="form-group row">
                    <label style="font-size: 12px;" for="vat" class="col-sm-3 col-form-label "><strong>Total Amount</strong></label>
                    <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control form-control-sm" name="net_amount" id="net_amount" step="any">
                    </div>
                </div>
                <button type="button" onclick="ebikeCheckList()" id="paymentBtn"  class="btn btn-primary my-1 w-100">Proceed Payment</button>
              
            </div>
            </div>

            <!-- modal -->

            <!-- payment modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="paymentModal"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">

                <div class="modal-header">
                <h4 class="modal-title">Sales</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col">   
                            <div class="row">
                            <div class="col">  
                                <div class="form-group" id="select_form_div">
                                    <label for="Customer">Customer</label>
                                    <select required class="form-control form-control-sm" name="customer_select_id" id="customer_select_id">
                                        <option hidden></option>
                                        <?php foreach($customers as $customer): ?>
                                            <option value="<?php echo $customer['id'] ?>"><?php echo $customer['customer_firstname'] ?> <?php echo $customer['customer_lastname'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col d-flex flex-wrap align-content-center">
                                <div class="btn-group ">
                                    <button type="button" onclick="newCustomer1()"class="btn btn-sm btn-primary" id="newcustbtn">New Customer</button>
                                </div>
                            </div>
                            </div>

                            <div class="form-group"id="purchase_div">
                               <label for="">Barangay Clearance</label>
                                <input required  class="form-control form-control-sm" name="purchase_form" id="purchase_form1" type="file">
                            </div>

                            <div id="new_form_div" style="display: none">
                            <input type="hidden" name="truecase" id="truecase" value="1" readonly >
                                <strong><label>Customer Information</label></strong>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">firstname</label>
                                            <input required class="form-control form-control-sm" name="customer_firstname" id="customer_firstname" type="text">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">lastname</label>
                                            <input required class="form-control form-control-sm" name="customer_lastname" id="customer_lastname" type="text">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Middle Name</label>
                                            <input required class="form-control form-control-sm" name="customer_middle" id="customer_middle" type="text">
                                        </div>
                                    </div>
                                </div>

                                <strong><label>Customer Address</label></strong> 
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Number</label>
                                            <input required class="form-control form-control-sm" name="customer_contact" id="customer_contact" type="number">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input required class="form-control form-control-sm" name="customer_email" id="customer_email" type="text">
                                        </div>
                                    </div>
                                </div>

                                <strong><label>Customer Address</label></strong> 
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Street</label>
                                            <input required class="form-control form-control-sm" name="customer_street" id="customer_street" type="text">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Subdivision</label>
                                            <input required class="form-control form-control-sm" name="customer_subdivision" id="customer_subdivision" type="text">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Barangay</label>
                                            <input required class="form-control form-control-sm" name="customer_barangay" id="customer_barangay" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input required class="form-control form-control-sm" name="customer_city" id="customer_city" type="text">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Province</label>
                                            <input required class="form-control form-control-sm" name="customer_province" id="customer_province" type="text">
                                        </div>
                                    </div>
                                </div>
                                <strong><label>Upload Requirements</label></strong> 
                                <div class="row">
                                    
                                    <div class="col">
                                        <div class="form-group">
                                          <label for="">Choose ID</label>
                                            <select required  class="form-control form-control-sm" class name="idList" id="idList">
                                                <option hidden></option>
                                                <option value="Driver’s License">Driver’s License</option>
                                                <option value="Passport">Passport</option>
                                                <option value="PhilHealth Card">PhilHealth Card</option>
                                                <option value="Philippine Postal ID">Philippine Postal ID</option>
                                                <option value="PRC ID">PRC ID</option>
                                                <option value="SSS ID">SSS ID</option>
                                                <option value="UMID">UMID</option>
                                                <option value="Voter’s ID">Voter’s ID</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Upload ID</label>
                                            <input required  class="form-control form-control-sm" name="customer_valid_id" id="customer_valid_id" type="file">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Barangay Clearance</label>
                                            <input required  class="form-control form-control-sm" name="purchase_form" id="purchase_form" type="file">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col">
                            <strong><label>Ebike Identification And Warranty</label></strong> 
                            <div class="row" id="select_unit_row">
            
                            </div>
                       </div>
                    </div>
                    <div class="row d-flex justify-content-end">
                       <div class="col col-4 shadow-lg">
                            <strong><label>Enter Amount</label></strong> 
                            <div class="form-group">
                                <input required onkeyup="computeChange()" class="form-control form-control-sm text-right" type="number" name="payment_amount_tentered" id="payment_amount_tentered">
                            </div>

                            <strong><label>Total Amount</label></strong> 
                            <div class="form-group">
                                <input readonly="" class="form-control form-control-sm text-right" value="0.00" type="text" name="paymentTamount" id="paymentTamount">
                            </div>

                            <strong><label>Change</label></strong> 
                            <div class="form-group">
                                <input readonly="" class="form-control form-control-sm text-right" type="number" name="payment_change" id="payment_change"> 
                            </div>
                       </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>

            </div>
            </div>
            </div>

            <!-- place order modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="placeOrderModal">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                <h4 class="modal-title">Place Order</h4>
                </div>

                <div class="modal-body">
                    <h4>Customer Information</h4>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">FirstName</label>
                                <input class="form-control" type="text" name="c_firstname" id="c_firstname">
                            </div>
                            <div class="form-group">
                                <label for="">Lastname</label>
                                <input class="form-control" type="text" name="c_lastname" id="c_lastname">
                            </div>
                            <div class="form-group">
                                <label for="">Contact Number</label>
                                <input class="form-control" type="text" name="c_contact" id="c_contact">
                            </div>
                        </div>     
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </div>
            </div>
            </div> 
            <!-- end modal -->
          </form>
             
            <!-- installment modal --> 
            <div class="modal fade" tabindex="-1" role="dialog" id="installmentModal">
                <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title"><strong>Installment</strong></h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                
                            </div>     
                        </div>
                    </div>

                    <div class="modal-footer">
                       <a class="btn btn-warning" id="receiptLink" target="_blank">Proceed</a>
                       <a class="btn btn-primary" href="<?php echo base_url('Admin_Pos') ?>">New Sales</a>
                    </div>
                </div>
                </div>
            </div> 

            <!-- receipt modal outside the form -->
            <div class="modal fade" tabindex="-1" role="dialog" id="receiptModal" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                    <h4 class="modal-title"><strong>Print Invoice</strong></h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                
                            </div>     
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-warning" id="receiptLink" target="_blank">Proceed</a>
                        <a class="btn btn-primary" href="<?php echo base_url('Admin_Pos') ?>">New Sales</a>
                    </div>
                </div>
                </div>
            </div> 
                            
                `
            );    
            newCustomer1()
        }

        function EbikeProduct(){
          
            var model = document.querySelector('#ebike_model');
            var color = document.querySelector('#ebike_color');

            if(!model.value == '' && !color.value == ''){
               getEbikeProduct(color.value, model.value);
            }

        }
        function getEbikeProduct(color , model){
             
            // reset to zero the quantity form
            document.getElementById('ebike_product_qty').value = '';

            $.ajax({
                url: '<?php echo base_url('Admin_Ebike/fetchAllEbikeByColorModel') ?>',
                type: 'post',
                data: {model_id : model, color_id : color},
                dataType: 'json',
                success:function(response){
                var ebikeDisplayPrice = document.querySelector('#ebikeDisplayPrice')
                var ebikeStock = document.querySelector('#ebikeStock')

                    
                    if(response.success === true){
                        // set the max qty
                        $('#ebike_product_qty').attr({
                            max: response.qty.qty
                        })
                        ebikeDisplayPrice.value = response.model.price;
                        ebikeStock.value = response.qty.qty;
                    }
                    else
                    {
                        $('#ebike_product_qty').attr({
                            max: 0
                        })
                        // reset display
                        ebikeDisplayPrice.value = '';
                        ebikeStock.value = '';
                    }

                }
                });
        }
        function addToList1(){
            // e.preventDefault();
            var table = document.getElementById("list_table1");
          
            var list = document.querySelectorAll('#prod_id');
             
            var color = document.getElementById('ebike_color');
            var model = document.getElementById('ebike_model');
            var prod_qty = document.getElementById('ebike_product_qty');
            var prod_stock = document.getElementById('ebike_stock');
            var prod_price = document.getElementById('ebikedisplayPrice');

            // console.log(model.options[model.selectedIndex])

            if(!model.options[model.selectedIndex].value == '' || !prod_qty.value == ''){ 
                if(model.options[model.selectedIndex].value == '' ){
                alert('please select product')   
                }
                else if(!prod_qty.value){
                alert('please input quantity')
                }
                else if(!color.value){
                alert('please select color')
                }
                else
                {
                    if(!list.length == 0){
                    for(var i=0;i<list.length;i++){
                        if(model.options[model.selectedIndex].value ==  list[i].value){
                            alert('This Item is Already in the list')
                            return false;
                        }
                    }
                    }

                    // success
                    var row = table.insertRow(1);
                    var cell0 = row.insertCell(0);
                    var cell1 = row.insertCell(1);
                    var cell2 = row.insertCell(2);
                    var cell3 = row.insertCell(3);
                    var cell4 = row.insertCell(4);
                    var cell5 = row.insertCell(5);
          
                    $.ajax({
                        url: '<?php echo base_url('Admin_Ebike/fetchAllEbikeByColorModel') ?>',
                        type: 'post',
                        data: {model_id : model.options[model.selectedIndex].value, color_id: color.options[color.selectedIndex].value},
                        dataType: 'json',
                        success:function(response) {
                        // compute total price in the table 
                        var total_amount = response.model.price * prod_qty.value;
                     
                        cell0.innerHTML = response.model.id + '<input type="hidden" name="prod_id[]" id="prod_id" value="'+response.model.id+'"> <input type="hidden" name="ebike_stock_id[]" id="ebike_stock_id" value="'+response.stock_id.id+'">';
                        cell1.innerHTML = response.model.name + '<input type="hidden" id="prod_name" name="prod_name[]" value="'+response.model.name+'">';
                        cell2.innerHTML = prod_qty.value + '<input type="hidden" id="prod_qty" name="prod_qty[]" value="'+prod_qty.value+'">';
                        cell3.innerHTML = response.model.price + '<input type="hidden" name="prod_price[]" value="'+response.model.price+'">';
                        cell4.innerHTML = total_amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '<input type="hidden" name="prod_total_amount[]" id="prod_total_amount" value="'+total_amount+'">';
                        cell5.innerHTML = '<input type="hidden" name="ecolor[]" value="'+response.ecolor+'"><button onclick="removeToList1(this)" class="btn btn-danger">Delete</button>'
                
                        // call the amount
                        totalAmount1();

                        // // reset select product
                        // model.selectedIndex = 0;
                        // prod_qty.value = '';
                        // prod_stock.value = '';
                        // prod_price.value = '';
                        // $("#product").select2('destroy').val("").select2();
                        }
                    });
                }
            }
            else 
            {
                alert('Please Select Product and Quantity')   
            }


        }
        // remove product to list
        function removeToList1(r){
         var i  = r.parentNode.parentNode.rowIndex;
         document.getElementById("list_table1").deleteRow(i)

            // call the amount
           totalAmount1();
        }
            // compute the total amount
        function totalAmount1(){
            

            var prod_total = document.querySelectorAll('#prod_total_amount');
            var tamount = document.querySelector('#tamount');
            var gross_amount = document.querySelector('#gross_amount');

            var vat_charge = document.querySelector('#vat_charge');
            var vat_charge_value = document.querySelector('#vat_charge_value');

            var vatable = document.querySelector('#vatable');

            var net_amount = document.querySelector('#net_amount');



            var sum = 0;
            for(var i = 0 ; i < prod_total.length; i++){
            sum = parseFloat(sum) + parseFloat(prod_total[i].value);
            }
            tamount.value = sum.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            
            // set gross amount  
            gross_amount.value = sum.toFixed(2);

            // vatable
            var vat_temp = ((vat_charge_value.value / parseFloat(100)) + parseFloat(1))
            var computed_vatable = parseFloat(sum) / parseFloat(vat_temp);
            vatable.value = computed_vatable.toFixed(2)

            // vat charge
            var vatTotal = computed_vatable * (vat_charge_value.value / 100);
            vat_charge.value = vatTotal.toFixed(2);
            
            var discount = document.querySelector('#discount');

            // net amount
            var netTotal = computed_vatable + vatTotal

            if(discount.value){
                netTotal = netTotal - discount.value;
            }
            net_amount.value = netTotal.toFixed(2);
            
            var paymentTamount = document.querySelector('#paymentTamount');
            paymentTamount.value = netTotal.toFixed(2);
        }

        function ebikeCheckList(){ 
            link = 'purchaseEbike'
            var ebike_stock_id = document.querySelectorAll('#ebike_stock_id');
            var list = document.querySelectorAll('#prod_id');
            var prod_qty = document.querySelectorAll('#prod_qty');
            var prod_name = document.querySelectorAll('#prod_name');
            var paymentBtn = document.querySelector('#paymentBtn');
        
            if(list.length == 0 ){
                alert('Please Add atleast one Item');
                $('#paymentBtn').attr({
                    'data-toggle': "",
                    'data-target': ""
                })
            }
            else 
            {
                // show modal
                $('#paymentBtn').attr({
                    'data-toggle': "modal",
                    'data-target': "#paymentModal"
                })
               
                computeChange();
            }

            var select = '';
            var war_month = '';
            var war_year = '';
            var war_select = '';
            var count = 0;
            
            for(var m=1;m<=9;m++){
                war_month += "<option value="+m+">"+m+"</option>"
            }
            for(var y=1;y<=9;y++){
                war_year += "<option value="+y+">"+y+"</option>"
            }

            for(var i=0;i<prod_qty.length;i++){
                var a = i;
                for(var j=0; j<prod_qty[i].value; j++){
                    var l;
                
                    select += `
                            <tr>
                                <td><input type="hidden" name="prod_name[]" value="`+prod_name[i].value+`">`+prod_name[i].value+`</td>
                                <td>
                                    <select required class="d-inline-block form-control w-100 my-1 stock_ebike_id" name="stock_ebike_id[]" id="select_unit`+count+`"></select>
                                </td>
                                <td style="width: 1rem">
                                    <select class="d-inline-block form-control my-1" name="motor_war_month[]"><option value="0">none</option> `+war_month+`</select> 
                                </td>
                                <td style="width: 1rem">
                                    <select class="d-inline-block form-control my-1" name="motor_war_year[]"><option value="0">none</option> `+war_year+`</select> 
                                </td>
                                <td style="width: 1rem">
                                    <select class="d-inline-block form-control my-1" name="service_war_month[]"><option value="0">none</option> `+war_month+`</select> 
                                </td>
                                <td style="width: 1rem">
                                    <select class="d-inline-block form-control my-1" name="service_war_year[]"><option value="0">none</option> `+war_year+`</select> 
                                </td>
                            </tr>
                      ` 

                    select_unit_populate(count, ebike_stock_id[i].value)
                    count++;
                }     
            }  
            $('#select_unit_row').html(
                `<div class="col" >   
                <table class="table table-responsive-sm table-bordered">
                   <tr>
                      <th>Unit</th>
                      <th>Ebike Number</th>
                      <th>Motor Warranty(Month)</th>
                      <th>Motor Warranty(Year)</th>
                      <th>Service Warranty(Month)</th>
                      <th>Service Warranty(Year)</th>
                   </tr>
                     `+select+`   
                </table>          
                </div>`
            )
        }


        function ebikeCheckList1(){ 
            link = 'installment'
            var ebike_stock_id = document.querySelectorAll('#ebike_stock_id');
            var list = document.querySelectorAll('#prod_id');
            var prod_qty = document.querySelectorAll('#prod_qty');
            var prod_name = document.querySelectorAll('#prod_name');
            var paymentBtn = document.querySelector('#paymentBtn');
        
            if(list.length == 0 ){
                alert('Please Add atleast one Item');
                $('#installmentBtn').attr({
                    'data-toggle': "",
                    'data-target': ""
                })
            }
            else 
            {
                // show modal
                $('#installmentBtn').attr({
                    'data-toggle': "modal",
                    'data-target': "#installmentModal"
                })
               
                // computeChange();
            }
 
        }
        
        function select_unit_populate(count, id){

            $.ajax({
                url: '<?php echo base_url('Admin_Ebike/getStockItems') ?>',
                type: 'post',
                data: {stock_id : id},
                dataType: 'json',
                success:function(response) {
                    if(response['success'] == true){
                        var opts
                        for(var j=0;j<response.data.length; j++){
                            opts += '<option hidden value=""></option><option value="'+response.data[j].id+'">'+ response.data[j].id +'</option>'
                        }
                        $('#select_unit'+count).html(opts)
                    }
                } 
            });
           }
           
        function newCustomer1(){
            var btnName = document.querySelector('#newcustbtn')
    
            if(btnName.innerHTML === 'Select Customer'){
                document.querySelector('#truecase').value = 1;
                document.querySelector('#customer_select_id').toggleAttribute('disabled', false)
                document.querySelector('#customer_firstname').toggleAttribute('disabled', true)
                document.querySelector('#customer_lastname').toggleAttribute('disabled', true)
                document.querySelector('#customer_contact').toggleAttribute('disabled', true)
                document.querySelector('#customer_email').toggleAttribute('disabled', true)
                document.querySelector('#customer_middle').toggleAttribute('disabled', true)
                document.querySelector('#customer_street').toggleAttribute('disabled', true)
                document.querySelector('#customer_subdivision').toggleAttribute('disabled', true)
                document.querySelector('#customer_barangay').toggleAttribute('disabled', true)
                document.querySelector('#customer_city').toggleAttribute('disabled', true)
                document.querySelector('#customer_province').toggleAttribute('disabled', true)
                document.querySelector('#customer_valid_id').toggleAttribute('disabled', true)
                document.querySelector('#purchase_form').toggleAttribute('disabled', true)
                   document.querySelector('#idList').toggleAttribute('disabled', true)
                document.querySelector('#purchase_form1').toggleAttribute('disabled', false)
                $('#purchase_div').show();
               
                btnName.innerHTML = 'New Customer';
            }
            else
            {
                document.querySelector('#truecase').value = 0;
                document.querySelector('#customer_select_id').toggleAttribute('disabled', true)
                document.querySelector('#customer_firstname').toggleAttribute('disabled', false)
                document.querySelector('#customer_lastname').toggleAttribute('disabled', false)
                document.querySelector('#customer_contact').toggleAttribute('disabled', false)
                document.querySelector('#customer_email').toggleAttribute('disabled', false)
                document.querySelector('#customer_middle').toggleAttribute('disabled', false)
                document.querySelector('#customer_street').toggleAttribute('disabled', false)
                document.querySelector('#customer_subdivision').toggleAttribute('disabled', false)
                document.querySelector('#customer_barangay').toggleAttribute('disabled', false)
                document.querySelector('#customer_city').toggleAttribute('disabled', false)
                document.querySelector('#customer_province').toggleAttribute('disabled', false)
                document.querySelector('#customer_valid_id').toggleAttribute('disabled', false)
                document.querySelector('#purchase_form').toggleAttribute('disabled', false)
                   document.querySelector('#idList').toggleAttribute('disabled', false)
                document.querySelector('#purchase_form1').toggleAttribute('disabled', true)
                $('#purchase_div').hide();
                btnName.innerHTML = 'Select Customer'
            
            //    remove text danger
                $(".text-danger").remove();
                var customer_select_id = document.querySelector('#customer_select_id');
                customer_select_id.selectedIndex = '';
            }
            $('#new_form_div').toggle();
        }

</script>