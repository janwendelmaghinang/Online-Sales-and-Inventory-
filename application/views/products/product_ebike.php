<style>

</style>

<!-- Messages -->
<?php if ($this->session->flashdata('correct_account')) : ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('correct_account'); ?>
        </div>
<?php endif; ?>
    
<?php if ($this->session->flashdata('registered')) : ?>
        <div class="alert alert-success">
              <?php echo $this->session->flashdata('registered'); ?>
        </div>
<?php endif; ?>

<!-- Ebike Module -->
<div class="product-module">
  <div class="container-fluid">
      <div class="row">
        <div class="col">
           <h2 class="text-center m-3">Eco Bike</h2>
        </div>
      </div>
         <div class="row">
  
          <div class="side-col-sm col-md-4 col-lg-3 border">
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                  <div class="container">
                      <div class="form-group">
                         <label class="form-label font-weight-bold" for="">Search</label>
                         <input class="form-control" type="text" name="search" id="" placeholder="Search Products"><br>
                         <button class="btn btn-secondary w-100">Search</button>
                      </div>
                      <br>
                      <div class="form-group">
                         <label class="form-label font-weight-bold" for="">EBIKE MODEL</label>
                         <select class="form-control" name="" id="">
                              <option value="">AMORE</option>
                              <option value="">HEROINE</option>
                              <option value="">SOLITARY</option>
                              <option value="">STELLAR</option>
                              <option value="">THUNDER</option>
                         </select>
                      </div>
                  </div>
              </form>
          </div>

          <div class="prod-col-sm-12 col-md-8 col-lg-9">
             <div class="row">
               <div class="col">
                 <!-- <h5 class="font-weight-normal text-right">Showing Results: 5</h5> -->
               </div>
             </div>
             <div class="row border bg-light p-2">
               <?php foreach($products as $row):?>
                <?php $strr = str_replace(' ','-', $row['unit_model']);?> 
                 <div class="product-col col-12 col-sm-6 col-md-4 col-lg-3 my-1 p-0 border">
                  <div class="card">
                      <div class="img-size">
                        <a href="<?php echo (base_url('products/ebike/'))?><?= $strr ?>"><img src="<?php echo (base_url()); ?>/<?php echo $row['unit_image']; ?>" class="card-img-top" alt="" ></a>  
                      </div>
                    <div class="card-body bg-light">
                      <h5 class="card-title"><?= $row['unit_model'];?></h5>
                       <p class="card-text">₱<?= number_format($row['unit_price'], 2 ,'.',',');?></p>
                         <input type="hidden" id="unit_id" value="<?php echo $row['unit_id'] ?>" name="unit_id">
                         <input type="hidden" name="" id="url"value="<?= $strr ?>">
                         <a class="btn-details" href="<?php echo (base_url('products/ebike/'))?><?= $strr ?>"></a>
                    </div>
                  </div>
                </div>
                <?php endforeach;?>
             </div>
          </div>
        </div>
      </div>
   </div>    

<script>

  $(document).ready(function(){
    $(".product-col").click(function(){
      console.log('helo')
      var unit = $('#unit_id').val();
      var url = $('#url').val();
      $.post("<?php echo base_url('products/ebike/')?>", {product: unit}, function(data){

      })
    })
  })

</script>