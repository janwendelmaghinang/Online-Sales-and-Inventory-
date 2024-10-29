
<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Manage Product</h3>
    </div>
    <div class="col  mb-2">

    </div>
</div>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <div class="header-title">
                <h5>Update Product</h5>
            </div>
        </div>
    </div>
    <form action="<?php echo base_url('products/edit/'. $product['id'])?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <label for="product_image">Image</label>
            <div class="form-group mb-2">
                <input id="product_image" type="file" name="product_image">
            </div>
            <div class="form-group">
                <label class="form-lable">
                Product name
                </label>
                <input type="text"class="form-control"name="product_name"id="product_name" value="<?php echo $product['name'] ?>">
            </div>
            <div class="form-group">
                <label class="form-lable">
                 SKU
                </label>
                <input type="text" class="form-control"name="product_sku"id="product_sku" value="<?php echo $product['sku'] ?>">
            </div>
            <div class="form-group">
                <label class="form-lable">
                 Price
                 </label>
                <input type="text" class="form-control"name="product_price"id="product_price" value="<?php echo $product['price'] ?>">
            </div>
            <div class="form-group">
                <label class="form-lable">
                 Quantity
                 </label>
                <input type="text" class="form-control"name="product_quantity"id="product_quantity" value="<?php echo $product['qty'] ?>">
            </div>
            <div class="form-group">
                <label class="form-lable">
                 Description
                 </label>
                <input type="text" class="form-control"name="product_description"id="product_description">
            </div>
            <div class="form-group">
                <label class="form-lable">
                 Brand
                 </label>
               <select class="form-control" name="product_brand" id="product_brand">
                   <option value=""></option>
                <?php foreach($getActiveBrand as $brand): if($brand['active'] == 1 ):?>
                    <option value="<?php echo $brand['id'] ?>"><?php echo $brand['name'] ?></option>
                <?php endif; endforeach; ?>
               </select>
            </div>
            <div class="form-group">
                <label class="form-lable">
                 Category
                 </label>
               <select class="form-control" name="product_category" id="product_category">
                   <option value=""></option>
                <?php foreach($getActiveCategory as $category): if($category['active'] == 1 ): ?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                <?php endif; endforeach; ?>
               </select>
            </div>
            <div class="form-group">
                <label class="form-lable">
                 Availability
                 </label>
               <select class="form-control" name="product_availability" id="">
                   <option value="1">YES</option>
                   <option value="0">NO</option>
               </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    </form>
</div>
<script>


//  $(Document).ready(function(){
//     var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
//         'onclick="alert(\'Call your custom code here.\')">' +
//         '<i class="glyphicon glyphicon-tag"></i>' +
//         '</button>'; 
//     $("#product_image").fileinput({
//         overwriteInitial: true,
//         maxFileSize: 1500,
//         showClose: false,
//         showCaption: false,
//         browseLabel: '',
//         removeLabel: '',
//         browseIcon: '<i class="fas fa-folder-open"></i>',
//         removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
//         removeTitle: 'Cancel or reset changes',
//         elErrorContainer: '#kv-avatar-errors-1',
//         msgErrorClass: 'alert alert-block alert-danger',
//         // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
//         layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
//         allowedFileExtensions: ["jpg", "png", "gif"]
//     });

//  });

</script>