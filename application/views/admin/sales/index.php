<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }
</style>

<div class="row border-bottom">
    <div class="col mb-2">
         <h3>Manage Sales</h3>
    </div>
</div>

<ul class="nav nav-tabs my-3">
  <li class="nav-item">
    <a id="link1" class="mx-1 btn btn-outline-dark text-light btn " href="<?php echo base_url('Admin_Sales') ?>">Cash</a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-1 btn btn-outline-dark text-dark btn " href="<?php echo base_url('Admin_Sales/loan') ?>">Ebike Loan</a>
  </li>
  <li class="nav-item">
    <a id="link3" class="mx-1 btn btn-outline-dark text-dark btn " href="<?php echo base_url('Admin_Sales/service') ?>">Service</a>
  </li>
</ul>


<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Sales</h5>
            </div>
            <table id="salesTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Reference number</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<!-- end of modal -->


<script>
var salesTable;

$(document).ready(function() {

$('#link1').addClass('bg-primary');
$('#sales_link').addClass('bg-secondary');


salesTable = $('#salesTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Sales/fetchAllSales')?>',
  'color': []
});

});

function refresh(){
  salesTable.ajax.reload(null, false); 
$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+'Table Refreshed'+
'</div>');
}
</script>