<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }

    .notification {
  position: relative;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
</style>


<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Manage Walkin Order</h3>
    </div>
    <div class="col  mb-2">

    </div>
</div>


<ul class="nav my-3">
  <li class="nav-item">
    <a id="link1" class=" mx-1 text-light btn btn-outline-dark notification" href="<?php echo base_url('Admin_Ebike/pending') ?>"><span>Pending</span> <span class="badge">0 </span> </a>
  </li>
  <li class="nav-item">
    <a id="link2" class=" mx-1 text-dark btn btn-outline-dark" href="<?php echo base_url('Admin_Ebike/completed') ?>">Completed</a>
  </li>
  <li class="nav-item">
    <a id="link3" class=" mx-1 text-dark btn btn-outline-dark" href="<?php echo base_url('Admin_Ebike/cancelled') ?>">Cancelled</a>
  </li>
</ul>


<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Walkin</h5>
            </div>
            <table id="orderTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Total Products</th>
                        <th>Total Amount</th>
                        <!-- <th>Payment Method</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<script>

var orderTable;

$('#order').addClass('show');
$('#order_link2').addClass('bg-secondary');
$('#link1').addClass('text-white-50 bg-primary');

$(document).ready(function() {

orderTable = $('#orderTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Order/fetchAllWalkinOrderData')?>',
  'order': []
});

});
</script>