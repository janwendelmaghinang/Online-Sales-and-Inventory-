<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }

    #modelFilter{
    display: inline;
    margin-left: 25px;
  }
</style>

<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Manage Spareparts</h3>
        <a class="btn btn-primary" href="<?php echo base_url('Admin_Spareparts/create')?>">Add Spareparts</a>
    </div>
    <div class="col  mb-2">
   
</div>
</div>

<?php if($this->session->flashdata('messages_success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('messages_success') ?>
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


   <div id="filter">
      <select class="form-control form-control-sm m-0"id="modelFilter" style="  width: 200px;">
        <option value="">All</option>
        <option value="Generic">Generic</option>
        <?php foreach($models as $model ): ?>
        <option value="<?php echo $model['name'] ?>"><?php echo $model['name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Spareparts</h5>
            </div>
            <table id="sparepartsTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                    <!-- <th>Image</th> -->
                    <th>Product Name</th>
                    <th>Selling Price</th>
                    <th>Supplier's Price</th>
                    <th>Mark up</th>
                    <th>Model</th>
                    <!-- <th>Color</th> -->
                    <th>Availability</th>
                    <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- modal -->

<!-- remove Parts -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteSparepartsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove Parts</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Spareparts/delete') ?>" method="post" id="deleteSparepartsForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->
<script>
var sparepartsTable;
$(document).ready(function() {

  $('#spareparts_link').addClass('bg-secondary');

sparepartsTable = $('#sparepartsTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Spareparts/fetchAllSparepartsData')?>',
  'spareparts': [],
});

$("#sparepartsTable_filter.dataTables_filter").append( '<label class="ml-3">Filter</label>:',$("#modelFilter"));
      
var modelIndex = 0;
$("#sparepartsTable th").each(function (i) {
  if ($($(this)).html() == "Model") {
    modelIndex = i; return false;
  }
});

//Use the built in datatables API to filter the existing rows by the Category column
$.fn.dataTable.ext.search.push(
  function (settings, data, dataIndex) {
    var selectedItem = $('#modelFilter').val()
    var category = data[modelIndex];
    if (selectedItem === "" || category.includes(selectedItem)) {
      return true;
    }
    return false;
  }
);

//Set the change event for the Category Filter dropdown to redraw the datatable each time
//a user selects a new filter.
$("#modelFilter").change(function (e) {
  sparepartsTable.draw();
});
sparepartsTable.draw();

});

// delete ajax
function deleteSpareparts(id)
{
  if(id) {
    $("#deleteSparepartsForm").on('submit', function() {
      var form = $(this);
     
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
      
           sparepartsTable.ajax.reload(null, false); 

          if(response.success === true) 
          {
            //   message :)
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal :) 
            $("#deleteSparepartsModal").modal('hide');

          }
          if(response.success === false) 
           {
           
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
            
            $("#deleteSparepartsModal").modal('hide');
          }
        }
      }); 

      return false;
    });
  }
}

</script>