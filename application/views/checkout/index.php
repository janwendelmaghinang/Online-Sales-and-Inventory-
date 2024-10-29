<style>
     .parts-img{
     max-height: 80px;
 }
 .cart-col-items{
     background: white;
     padding: 1rem;
     display: flex;
     /* justify-content: center; */
     align-items: center;
 }
.checkout-col{
    background: white;
}
.qr-div{
    outline: black 1px solid;
    width: 250px;
    height: 250px;
}
.qr-image{

    width: 250px;
    height: 250px;
}

</style>

<?php if($this->cart->contents()): ?>

<?php if($this->session->flashdata('please')): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  <div>Please choose branch</div>
</div>
<?php endif; ?>


<div class="container mt-3">
   <h3>Your Order</h3> 
   <?php foreach ($this->cart->contents() as $items): ?>
        <div class="row my-1 justify-content-center cart-row">
            <div class="cart-col-items col-12 col-sm-12 col-md-3 col-lg-3">
                <img class="parts-img" src="<?php echo base_url()?>/<?php echo $items['image'] ?>" alt=""></img>
            </div>
                <div class="cart-col-items col-12 col-sm-12 col-md-3 col-lg-3">
                <h5><?php echo $items['name'];?></h5>
            </div>
            <div class="cart-col-items col-12 col-sm-12 col-md-2 col-lg-2">
                <small>Quantity: <?php echo $items['qty'];?></small>
            </div>
                <div class="cart-col-items col-12 col-sm-12 col-md-3 col-lg-3">
                <h5>₱ <?php echo $this->cart->format_number($items['subtotal']) ?></h5>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="row my-2 mb-2 justify-content-center">
        <div class="checkout-col col col-md-11 mr-1">
            <form action="<?php echo base_url('Checkout/insert')?>" method="post" enctype="multipart/form-data" > 
           <div class="row">
               <div class="col col-4">
                  <div class="form-group">
                      <label for="">Choose Payment Method</label>
                      <select class="form-control form-control-sm " name="payment_method" id="payment_method" required onchange="payment()">
                          <option hidden></option>
                          <option value="0">Cash On Pickup</option>
                          <?php foreach($banks as $bank):?>
                            <option value="<?php echo $bank['bank_name'] ?>"><?php echo $bank['bank_name'] ?></option>
                          <?php endforeach;?>
                      </select>
                  </div>
               </div>
               <div class="col">
                  <div class="form-group">
                      <label for="">Select store where you prefer to pickup your item.</label>
                      <select class="form-control form-control-sm" name="store_id" id="store" required>
                          <option hidden></option>
                          <?php foreach($stores as $store):?>
                            <option value="<?php echo $store['store_id'] ?>"><?php echo $store['store_name'] ?></option>
                          <?php endforeach;?>
                      </select>
                  </div>
               </div>
           </div>
           <div id="receipt_div"></div>
            <div class="form-group  mb-4">
                <button type="submit" class="btn btn-warning">Place Order</button>
            </div>
            </form> 
       </div>   
    </div>

<?php else:?>
    <h1 class="text-center">No items to checkout</h1>
<?php endif; ?>

<script>
  
  function payment(){
      var base_url = '<?php echo base_url()?>';
      var payment = document.querySelector('#payment_method');
    //   var receipt_div = document.querySelector('#receipt_div');
      if(payment.value == 0){
        //  receipt_div.innerHtml = 'hello';
        $('#receipt_div').html('');
      }
      else
      {
        $.ajax({
        url: '<?php echo base_url('Checkout/getBank') ?>',
        type: 'post',
        data: {id: payment.value }, 
        dataType: 'json',
        success:function(response) {
        //    console.log(response.data[0].account_name)
            $('#receipt_div').html(
            `<div class="row">
                <div class="col">
                    <div>
                        <p>Instruction : Please send the exact amount to proceed your purchase. Scan the QR Code or Enter the Account Number and/or Account Name to send the payment. Make sure to input the correct information.</p>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="">Account Number</label>
                    <input type="text" class="form-control form-control-sm" value="`+response.data[0].account_number+`" readonly>
                </div>
                <div class="col">
                    <label for="">Account Name</label>
                    <input type="text" class="form-control form-control-sm" value="`+response.data[0].account_name+`" readonly>
                </div>

                <div class="col">
                    <label for="">Qr Code</label>

                     <div class="qr-div">
                       <img class="qr-image" src="`+ base_url + response.data[0].qrcode+`">
                     </div>

                </div>

            </div>
            <div class="row">
                <div class="col mb-4">
                    <label for="">Upload Screenshot of your Payment Receipt.</label>
                    <input class="form-control form-control-sm" type="file" name="payment_receipt" id="" required>
                </div>
            </div>`
            );
          }
        }); 
      }
  }

</script>
