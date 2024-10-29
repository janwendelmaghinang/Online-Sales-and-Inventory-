
<style>
    .product-image{
        width: 100%;
    }
    .row-back{
        background:#b8b894;
    }
    .product-price-con{
        border-bottom: solid .3px gray;
    }
</style>
<div class="container">
    <div id="message"></div>
     <div class="container-fluid">
      <div class="container-fluid bg-light mt-4 p-0">
        <div class="row p-5 justify-content-center">

            <div class="col-md-12 col-lg-6 d-flex align-content-center justify-content-center">
                <div class="product-image-con" id="image_div">
                     <img id="product_image" class="product-image" src="<?php echo base_url($model['image']) ?>">
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="product-name">
                    <h1 class="product-name text-uppercase" id="product_name"><?php echo $model['name'] ?></h1>
                </div>
                <div class="product-price-con d-flex justify-content-between mb-3 ">
                    <div>
                        <h4 class="product-price" id="product_price">₱ <?php echo $this->cart->format_number($model['price'])?></h4>
                    </div>
                    <div>
                        <p class=""><strong>Available: </strong> <span id="results"><?php echo $qty ?></span></p>
                    </div>
                </div>          
                <div class="product-actions row mb-2">
                    <div class="col">
                        <strong class="text-secondary ">Color</strong>
                        <select class="form-control" name="" id="color_select" onchange=" index()">
                            <option value="">All</option>
                            <?php  foreach($colors as $row):?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['color_name'] ?></option>
                            <?php endforeach;?>
                        </select>`
                    </div>
                </div>
                <div class="product-buttons mb-4">
                    <a href="<?php echo base_url('Inquiry') ?>" class="btn btn-danger text-uppercase w-100">Inquire Now</a>
                </div>
                    <div class="product-desc">
                     <!-- <p><?php echo $specs['description']?></p> -->
                </div>
            </div>
        </div>
      </div>
      <div class="container-fluid bg-light mt-2 p-4">
          <div class="description1 p-1">
             <h5 class="title1"><strong>Product Description</strong></h5><br>
             <p><?php echo $specs['description']?></p>
          </div><br>
         <div class="description2 p-1">
            <h5 class="title2"><strong>Product Specification</strong></h5><br>
            <div class="d-flex flex-column">
                <div class="p-2">Motor Type: <?php echo $specs['motor_type']?></div>
                <div class="p-2">Rated Voltage: <?php echo $specs['rated_voltage']?></div>
                <div class="p-2">Max Speed: <?php echo $specs['max_speed']?></div>
                <div class="p-2">Distance Full: <?php echo $specs['distance_full']?></div>
                <div class="p-2">Charging Time: <?php echo $specs['charging_time']?></div>
                <div class="p-2">Max Load: <?php echo $specs['max_load']?></div>
            </div>
         </div>

      </div>
    </div>
</div>

<input type="hidden" id="id_model" value=" <?php echo $id?>">
<script>
    $(".ebikeNav").addClass('activeNav');

    index();
    function index(){
       var product_name = document.querySelector('#product_name');
       var results = document.querySelector('#results');
       var product_image = document.querySelector('#product_image');
       var product_price = document.querySelector('#product_price');
       var color_select = $('#color_select');
       var id = document.querySelector('#id_model');

        if(color_select.val() == 0 ){
         
            $.ajax({
                url: '<?php echo base_url('Ebike/fetchEbike1') ?>',
                data: {id: id.value},
                method: 'post',
                dataType: 'json',
                success:function(response){
                    product_image.src = `<?php echo (base_url());?>`+response.model.image+``;
                    results.innerText = response.qty
                }
            });
        return false;
        }
       else
        {
            $.ajax({
                url: '<?php echo base_url('Ebike/fetchEbike2') ?>',
                data: {id: id.value, color: color_select.val()},
                method: 'post',
                dataType: 'json',
                success:function(response){
                    if(response.success === true){
                        product_image.src = `<?php echo (base_url());?>`+response.ebike.image+``;
                        // image.value = response.ebike.image
                        results.innerText = response.qty
                    }
                    else
                    {
                        product_image.src = `<?php echo (base_url('uploads/extra/noimage.jpg'));?>`
                        results.innerText = 0;
                    }

                }
            });
        return false;
        }
    }

</script>
