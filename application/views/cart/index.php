
<style>

 .parts-img{
     max-height: 120px;
 }
 .cart-col-items{
     background: white;
     padding: 1rem;
     display: flex;
     /* justify-content: center; */
     align-items: center;
 }
 .total-col{
     background: white;
 }
 .summary-col{
     background: white;
     margin-top: 1rem;
 }
</style>

    <div id="message"></div>

    <div class="container main-cart-con">   
        <?php if($this->cart->contents()) : ?>
          <h1 class="my-2">Shopping Cart</h1>
          <?php foreach ($this->cart->contents() as $items): ?>
             <div class="row justify-content-center cart-row">
                    <div class="cart-col-items col">
                       <img class="parts-img" src="<?php echo base_url()?>/<?php echo $items['image'] ?>" alt=""></img>
                    </div>
                     <div class="cart-col-items col">
                        <h5><?php echo $items['name'];?></h5>
                    </div>
                    <div class="cart-col-items col">
                        <small>Quantity: <?php echo $items['qty'];?></small>
                    </div>
                     <div class="cart-col-items col">
                        <h5>₱ <?php echo $this->cart->format_number($items['subtotal']) ?></h5>
                    </div>
                     <div class="cart-col-items col">
                        <button class="btn btn-danger" onclick="removeCart('<?php echo $items['rowid']?>')"> remove</button>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="row">
                <div class="total-col col border-top">
                        <h5 class="mt-2">Total: ₱<?php echo $this->cart->format_number($this->cart->total());?></h5>
                </div>
            </div>
            
            <div class="row justify-content-end">
                <div class="summary-col col col-md-4 p-3 my-3">
                  <div class="border-bottom">
                    <a class="btn btn-warning w-100 mt-2" href="<?php echo base_url('checkout') ?>">Proceed To Checkout</a>
                  </div>
                </div>
    
                <?php else: ?>
                    <p class="text-center">There are no items in your cart</p>

                <?php endif; ?>
            </div>

<script>
     $(document).ready(function() {
       $("#btn-all").on('click', function () {  
            var el = $(this);
            setTimeout(function(){el.prop('disabled', true); }, 0.01);
            setTimeout(function(){el.prop('disabled', false); }, 5000);
        });
     });
   
     function removeCart(rowid){
         $.ajax({
            url: '<?php echo base_url('cart/remove')?>',
            method:'post',
            data: {row_id: rowid},
            dataType: 'json',
            success:function(response){
              cartCount();
              if(response.success === true){
                  $("#message").html( '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                            '<span aria-hidden="true">&times;</span>'+
                                        '</button>'+response.message+
                                      '</div>');
            window.location.reload();
              }
            }
        });
     }
</script>