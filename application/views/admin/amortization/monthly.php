
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

th{
    font-size: 10px;
}
td{
    font-size: 12px; 
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

.tLabel, .tData{
 font-size:small 
}
.tdWidth{
    max-width: 3.5rem;
}


</style>

<?php
$principal_price =  ($application['price'] - $application['downpayment']);
$total_interest = ($principal_price * $application['interest_percentage'])/100;
$total_price = ($principal_price + $total_interest);

$principal_month =  ($principal_price / $application['terms']);
$interest_month = ($principal_month * $application['interest_percentage'])/100;
$monthly = ($principal_month + $interest_month);

$total_monthly_amount = ($application['monthly']);
?>

<div class="row">
    <div class="col border-bottom my-1">
        <h4>Monthly Payment Schedule</h4>
        <a class="btn btn-warning float-right" href="<?php echo base_url('Admin_Amortization') ?>">Back</a>
    </div>

</div>

<div class="row border-bottom">
    <div class="col col-sm-12 col-md-6 col-lg-4">
         <table class="table table-sm table-borderless">

             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Customer</p></td><td class=" tData text-capitalize"><?php echo $customer['customer_firstname'].' '.$customer['customer_lastname'] ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Contact Number</p></td><td class=" tData text-capitalize"><?php echo $customer['customer_contact'] ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Email</p></td><td class=" tData text-capitalize"><?php echo $customer['customer_email'] ?></td>
             </tr>
         </table>
    </div>
    <div class="col col-sm-12 col-md-6 col-lg-4 ">
         <table class="table table-sm table-borderless">
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Model</p></td><td class=" tData text-capitalize"><?php echo $application['ebike_name'] ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Color</p></td><td class=" tData text-capitalize"><?php echo $application['ebike_color'] ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Motor Number</p></td><td class=" tData text-capitalize"><?php echo $application['motor_number'] ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Chassis Number</p></td><td class=" tData text-capitalize"><?php echo $application['chasis_number'] ?></td>
             </tr>

         </table>
    </div>
    <div class="col col-sm-12 col-md-6 col-lg-4"></div>
</div>
<div class="row">
    <div class="col col-sm-12 col-md-6 col-lg-4 ">
        <table class="table table-sm table-borderless">
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Date Released</p></td><td class=" tData text-capitalize"><?php echo $application['warranty_start'] ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Terms</p></td><td class=" tData text-capitalize"><?php echo $application['terms'] ?> Months</td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Interest Rate</p></td><td class=" tData text-capitalize"><?php echo $application['interest_percentage'] ?> %</td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Downpayment</p></td><td class=" tData text-capitalize"><?php echo '₱ '. number_format(($application['downpayment']), 2, '.', ',') ?></td>
             </tr>
         </table>
    </div>
    <div class="col col-sm-12 col-md-6 col-lg-4">
         <label for="">Total</label>
         <table class="table table-sm table-borderless">
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Principal Price</p></td><td class=" tData text-capitalize"><?php echo '₱ '. number_format(($principal_price), 2, '.', ',') ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Total Interest</p></td><td class=" tData text-capitalize"><?php echo '₱ '. number_format(($total_interest), 2, '.', ',') ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Total Price</p></td><td class=" tData text-capitalize"><?php echo '₱ '. number_format(($total_price), 2, '.', ',') ?></td>
             </tr>
         </table>
    </div>
    <div class="col col-sm-12 col-md-6 col-lg-4">
         <label for="">Monthly</label>
         <table class="table table-sm table-borderless">
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Principal</p></td><td class=" tData text-capitalize"><?php echo '₱ '. number_format(($principal_month), 2, '.', ',')?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Interest</p></td><td class=" tData text-capitalize"><?php echo '₱ '. number_format(($interest_month), 2, '.', ',') ?></td>
             </tr>
             <tr>
                <td class="tdWidth"><p class=" tLabel font-weight-bold">Monthly Payment Amount</p></td><td class=" tData text-capitalize"><?php echo '₱ '. number_format(($monthly), 2, '.', ',') ?></td>
             </tr>
         </table>
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
            <table id="amortizationTable" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Terms</th>
                        <th>Due Date</th>
                        <th>Beginning Balanced</th>
                        <th>Principal Due</th>
                        <th>Interest Due</th>
                        <th>Penalty</th>
                        <th>Total Due</th>
                        <th>Total Payment</th>
                        <th>Ending Balanced</th>
                        <th>Date Paid</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="paymentModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Amortization/payment_update/') ?>" method="post" id="paymentForm">
        <div class="modal-body">
           <div class="row">
               <div class="col">
                   <div class="form-group">
                       <label for="amount_tendered">Enter Amount</label>
                       <input class="form-control form-control-sm" type="number" name="amount_tendered" id="amount_tendered" step="any" oninput="inputVal()" onkeyup="compute()" required>
                   </div>
                   <div class="form-group">
                        <label for="">Monthly Payment Amount</label>
                        <input class="form-control form-control-sm" type="number" name="paymentValue" id="paymentValue" step="any" onkeyup="compute()" readonly>
                        <input type="hidden" name="paymentValueHidden" id="paymentValueHidden" value="<?php echo $application['monthly'] ?>">
                        <!-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cBox" onclick="editVal()" >
                            <label class="form-check-label" for="cBox">
                                Custom amount
                            </label>
                        </div> -->
                   </div>

                   <div class="form-group">
                       <label for="change">Change</label>
                       <input class="form-control form-control-sm" type="number" name="change" id="change" readonly>
                   </div>

                   <div class="form-group">
                       <label for="bBalanced">Beginning balanced</label>
                       <input class="form-control form-control-sm" type="number" name="beginning_balanced" id="bBalanced" value="<?php echo $sched['beginning_balance'] ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label for="eBalanced">Ending balanced</label>
                       <input class="form-control form-control-sm" type="number" name="ending_balanced" id="eBalanced" readonly>
                   </div>
               </div>
           </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_hidden" value="<?php echo $sched['application_id'] ?>">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel </button>
          <button disabled type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>


<!-- end modal -->

<input id="application_id" type="hidden" value="<?php echo $application['id']?>">
<script>
// $('#link3').addClass('btn-primary');

var application_id = document.querySelector('#application_id').value
$('#loan').addClass('show');
$('#loan_link2').addClass('btn-secondary');

var amortizationTable;
$(document).ready(function(){

amortizationTable = $('#amortizationTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Amortization/fetchSched/')?>'+ application_id,
  'order': []
});

$.ajax({
    url: '<?php echo base_url('Admin_Amortization/update_due') ?>',
    type: 'post',
    dataType: 'json',
    success:function(response) {
        amortizationTable.ajax.reload(null, false); 
    }
    }); 
return false;

});

function paynow(id){
    if(id){

        $.ajax({
                url: '<?php echo base_url('Admin_Amortization/getLoanSchedById') ?>',
                type: 'post',
                data: {id: id}, 
                dataType: 'json',
                success:function(response) {
                    // console.log(response)
                 var paymentValueHidden = document.querySelector('#paymentValueHidden');
                 var total = (parseFloat(paymentValueHidden.value) + parseFloat(response.penalty));
                 document.querySelector('#paymentValue').value = total.toFixed(2);
                }
            }); 

        $("#paymentForm").on('submit', function() {
            var form = $(this);
            $('#paymentModal').hide();
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action')+id,
                type: form.attr('method'),
                data: form.serialize(), 
                dataType: 'json',
                success:function(response) {
                window.location.reload();
                }
            }); 
            return false;
            });
    }
    // compute();
}

// extra
function compute(){
    var amount_tendered = document.querySelector('#amount_tendered');
    var change = document.querySelector('#change');
    var paymentVal = document.querySelector('#paymentValue');
    var paymentValHidden = document.querySelector('#paymentValueHidden');
    var bBalanced = document.querySelector('#bBalanced');
    var eBalanced = document.querySelector('#eBalanced');
    var submitBtn = document.querySelector('#submitBtn');
    
  
    var total  = (bBalanced.value - paymentValHidden.value );
    if(total < 0){
        eBalanced.value = 0
    }
    else
    {
        eBalanced.value = (total.toFixed(2))
    }
    
    if(!amount_tendered.value == '0'){
        var totalChange = (amount_tendered.value - paymentVal.value);
        change.value = totalChange.toFixed(2);
    }
    else
    {
        change.value = '0.00';
    }

    if(parseFloat(paymentVal.value) > parseFloat(amount_tendered.value)){
        submitBtn.toggleAttribute('disabled', true);
    }
    if(parseFloat(paymentVal.value) < parseFloat(amount_tendered.value))
    {
        submitBtn.toggleAttribute('disabled', false);
    }
    if(parseFloat(paymentVal.value) == parseFloat(amount_tendered.value))
    {
        submitBtn.toggleAttribute('disabled', false);
    }
    
 
}

function editVal(){
    var paymentVal = document.querySelector('#paymentValue');
    var paymentValHidden = document.querySelector('#paymentValueHidden');
    
    var cBox = document.querySelector('#cBox');
   
    if(cBox.checked == true){
       paymentVal.toggleAttribute("readonly")  
       compute();
    }
    else
    {
        paymentVal.toggleAttribute("readonly")
        paymentVal.value = paymentValHidden.value 
        compute();
    }
}

// update due date

var delayTimer;
function inputVal(ele) {
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
       ele.value = parseFloat(ele.value).toFixed(2).toString();
    }, 3000); 
}

</script>
