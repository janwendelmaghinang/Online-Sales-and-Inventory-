<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Manage Product</h3>
         <a href="<?php echo base_url('products/create') ?>" class="btn btn-primary">Add Product</a>
    </div>
    <div class="col  mb-2">

    </div>
</div>
<?php if($this->session->flashdata('inserted')): ?>
   <div class="alert alert-success">
       <?php echo $this->session->flashdata('inserted') ?>
   </div>
<?php endif;?>
<?php if($this->session->flashdata('updated')): ?>
   <div class="alert alert-success">
       <?php echo $this->session->flashdata('updated') ?>
   </div>
<?php endif;?>
<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Product</h5>
            </div>
            <table id="productTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Image</th>
                <th>SKU</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <!-- <th>Store</th> -->
                <th>Availability</th>
                <th>Action</th>
              </tr>
              </thead>

            </table>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="productDeleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Product</h4>
      </div>

      <form role="form" action="<?php echo base_url('products/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
var productTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

//   $("#mainProductNav").addClass('active');

  // initialize the datatable 
  productTable = $('#productTable').DataTable({
    'ajax': base_url + 'products/fetchAllProducts',
    'order': []
  });

});

function removeProduct(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { product_id:id }, 
        dataType: 'json',
        success:function(response) {

          productTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#productDeleteModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}

</script>