
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
                     <img id="product_image" class="product-image" src="<?php echo base_url($parts['image']) ?>">
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                    <div class="product-name">
                        <h1 class="product-name text-uppercase" id="product_name"><?php echo $parts['name'] ?></h1>
                    </div>
                    <div class="product-price-con d-flex justify-content-between mb-3 ">
                        <div>
                            <h4 class="product-price" id="product_price">₱ <?php echo $this->cart->format_number($parts['price'])?></h4>
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
                                    <option value="0">generic</option>
                                 <?php  foreach($color as $row):?>
                                    <option value="<?php echo $row[0]['id'] ?>"><?php echo $row[0]['color_name'] ?></option>
                                 <?php endforeach;?>
                              </select>`
                        </div>
                        <div class="col">
                            <strong class="text-secondary ">Quantity</strong>
                            <input class="form-control" name="quantity" type="number" id="quantity" value="1" min=0 max="" oninput="validity.valid||(value='');">
                        </div>
                    </div>

                    <div class="product-buttons mb-4">
                        <input type="hidden" id="id" value="<?php echo $temp_id ?>">
                        <input type="hidden" id="name" value="<?php echo $parts['name'] ?>">
                        <input type="hidden" id="price" value="<?php echo $parts['price'] ?>">
                        <input type="hidden" id="model_id" value="<?php echo $parts['model_id'] ?>">
                        <input type="hidden" id="image" value="<?php echo $parts['image'] ?>">
                        <button <?php if($qty == 0): ?>disabled<?php endif;?> class="btn btn-danger text-uppercase w-100" onclick="addToCart()">Add To Cart</button>
                    </div>
     
                     <div class="product-desc">
                        <p><?php echo $parts['description'] ?></p>
                    </div>
                    
            </div>
        </div>
      </div>
    </div>
</div>

<!-- hidden -->
<input type="hidden" id="colorcount" value="<?php echo count($color) ?>">
<!-- hidden -->


<input type="hidden" id="id_parts" value="<?php echo $id ?>">

<script>
    var id_parts = document.querySelector('#id_parts')
    var id = document.querySelector('#id')
    var names = document.querySelector('#name')
    var quantity = document.querySelector('#quantity')
    var price = document.querySelector('#price')
    var model_id = document.querySelector('#model_id')
    var image = document.querySelector('#image')

    $(".sparepartsNav").addClass('activeNav');

    index();
    function index(){
       var product_name = document.querySelector('#product_name');
       var results = document.querySelector('#results');
       var product_image = document.querySelector('#product_image');
       var product_price = document.querySelector('#product_price');
       var color_select = $('#color_select');
    //    var id = document.querySelector('#id_parts');
       
        if(color_select.val() == '' ){
            $.ajax({
                url: '<?php echo base_url('Spareparts/fetchSingleParts1') ?>',
                data: {id: id_parts.value},
                method: 'post',
                dataType: 'json',
                success:function(response){
                    product_image.src = `<?php echo (base_url());?>`+response.parts.image+``;
                    results.innerText = response.qty

                    // id.value = response.parts.id
                    // name.value = response.parts.name
                    model_id.value = response.parts.model_id
                    image.value = response.parts.image
                }
            });
        return false;
        }
       else
        {
            $.ajax({
                url: '<?php echo base_url('Spareparts/fetchSingleParts2') ?>',
                data: {id: id_parts.value, color: color_select.val()},
                method: 'post',
                dataType: 'json',
                success:function(response){

                    if(response.success === true){
                        if(response.stock.image == ''){
                            product_image.src = `<?php echo (base_url());?>`+response.parts.image+``;
                            image.value = response.parts.image
                        }
                        else
                        {
                            product_image.src = `<?php echo (base_url());?>`+response.stock.image+``;
                            image.value = response.stock.image
                        }
                        id.value = response.stock.id
                        names.value = response.parts.name
                        model_id.value = response.parts.model_id
                        image.value = response.parts.image
                        results.innerText = response.stock.qty
                    }
                    else
                    {
                        // product_image.src = `<?php echo (base_url());?>`+response.stock.image+``;
                        id.value = '';
                        names.value = '';
                        model_id.value = '';
                        image.value = '';
                        results.innerText = 0;
                    }
        
                }
            });
        return false;
        }
    }

    function addToCart(){
       
        var col;
        var color_select = $('#color_select');
        var count = document.querySelector('#colorcount');
        if(color_select.val() == '' || color_select.val() == 0 ){
          col = 0;
        }
        else
        {
          col = color_select.val();
        }
        var info = {
            id: id.value,
            name: names.value,
            quantity: quantity.value,
            price: price.value,
            model: model_id.value,
            color_id: col,
            image: image.value
            }
            console.log(info)
            if(!parseInt(count.value) == 0 && color_select.val() == ''){
                alert('Please Choose Color')                 
            }
            else
            {
                $.ajax({
                    url: '<?php echo base_url('Cart/addtocart') ?>',
                    data: info,
                    method: 'post',
                    dataType: 'json',
                    success:function(response){
                    cartCount();
                    if(response.success === true)
                    {
                    $("#message").html( '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                            '<span aria-hidden="true">&times;</span>'+
                                        '</button>'+
                                        ' Item Added In Cart.<a href="<?php echo base_url('cart')?>">View Cart</a>'+
                                        '</div>');
                    } 
                    }
                });
            return false;
            }

    }
</script>
