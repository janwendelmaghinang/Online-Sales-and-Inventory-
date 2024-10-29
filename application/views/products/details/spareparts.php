<style>
/*.prod-image{*/
/*   justify-content: center;*/

/*}*/
.parts-img{
    max-height: 400px;
    max-width: 500px;
}

   /*@media (min-width: 300px) and (max-width: 767.98px) { */
        
   /* }*/
   /*@media (min-width: 768px) and (max-width: 1000px) { */
        
   /*   }*/
   /*@media (min-width: 1002px) and (max-width: 1200px) { */
    
   /*}*/

</style>

<?php foreach($products as $row)
// print_r($row);
?>

<?php if ($this->session->flashdata('already')) : ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('already'); ?>
        </div>
  <?php endif; ?>
  <?php if ($this->session->flashdata('exceed')) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
           <?php echo $this->session->flashdata('exceed'); ?>
        </div>
  <?php endif; ?>

<div class="container">
    <div class="row">
      <div class="col p-0">
				<div class="row main-row">

					<div class="prod-image col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
						  <div class=""><img class="parts-img" src="<?php echo base_url()?>/<?php echo $row['parts_image'] ?>" /></div>
                    </div>

					<div class="desc-con col-md-5 col-sm-12 py-5">

            <div class="row">
               <div class="col col-md-9">
                  <h1 class="text-uppercase"><?php echo $row['parts_name'];?></h1>
                  <h5 class="text-secondary"><span class ="price-number">₱<?php echo number_format($row['parts_price'], 2 ,'.',',');?></span></h5>
                  <div class="border-bottom my-3"></div>
               </div>
            </div>

            <div class="row">
              <div class="col col-md-9">
                  <label class="text-uppercase" for="">colors</label><br>
                  <button class="btn border">RED</button>
                  <button class="btn border">BLUE</button>
                  <button class="btn border">GREEN</button>
                  <button class="btn border">WHITE</button>
              </div>
            </div>
            <div class="row">
              <div class="col col-md-4">
                  <small class="text-uppercase">Available</small>
                  <p class="text-secondary"><?php echo $row['stock_quantity'];?> pcs</p>
              </div>
              <div class="col col-md-5">
                   Quantity
                   <button id="negative" class="negative btn border">-</button><input class="text-center" id="quantity_display"   type="text"name="parts_qty"value="1" style="width: 30px;" ><button id="positive" class="positive btn border" >+</button>
              </div>
              </div>
              <input type="hidden" id="param" value="<?php echo str_replace(' ','-', $row['parts_name']);?>" >

            <div class="row">
              <div class="col col-md-9">
                <form action="<?php echo base_url()?>products/spareparts/<?php echo str_replace(' ','-', $row['parts_name']);?> " method="POST">
                  <input id="quantity" type="hidden"name="parts_qty"value="1">
                  <input type="hidden" name="parts_id" value="<?php echo $row['parts_id'];?>">
                  <input type="hidden" name="stock_color" value="<?php echo $row['stock_color'];?>">
                  <input type="hidden" name="stock_model" value="<?php echo $row['stock_model'];?>">
                  <input type="hidden" name="stock_name" value="<?php echo $row['stock_name'];?>">
                  <input type="hidden" name="parts_model" value="<?php echo $row['parts_model'];?>">
                  <input type="hidden" name="parts_name" value="<?php echo $row['parts_name'];?>">
                  <input type="hidden" name="parts_price" value="<?php echo $row['parts_price'] ?>">
                   <input type="hidden" name="parts_image" value="<?php echo $row['parts_image'] ?>">
                  <input type="hidden" name="stock" value="<?php echo $row['stock_quantity'] ?>">
                <?php if(!$row['stock_quantity'] <= 0): ?>
                  <button class="add-to-cart btn btn-secondary w-100" type="submit"name="addtocart">ADD TO CART</button>
                <?php else: ?>
                  <button class="add-to-cart btn btn-secondary w-100" type="button"name="sold">SOLD OUT</button>
                <?php endif; ?>
               </form>
              </div>
            </div>
            
          </div>
				</div>
    </div>
  </div>
</div>
<script>
    // quantity button
     var qty_display = document.getElementById('quantity_display');
     var cart_qty = document.getElementById('quantity');
     document.getElementById('negative').addEventListener('click', negative);
     document.getElementById('positive').addEventListener('click', positive);
     function positive(e){
       e.preventDefault();
       cart_qty.value++;
       qty_display.value = cart_qty.value;
     }
     function negative(e){
       e.preventDefault();
       if(qty_display.value < 0){
         alert('quantity must be 1');
       }
       if(cart_qty.value < 2 ){
           cart_qty.value = 1;
           qty_display.value = cart_qty.value;
       }
       else{
           cart_qty.value--;
           qty_display.value = cart_qty.value;
       }
     }
  </script>