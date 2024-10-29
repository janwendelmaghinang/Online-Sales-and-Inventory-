
<div class="container-fluid">
<h3 class="text-center">Order Details</h3>
    <div class="row">
        <div class="col">
            <table class="table table-sm table-bordered">
                <tr>
                    <td><strong>Order Id</strong></td><td><?php echo $order['id'] ?></td>
                </tr>
                <tr>
                    <td><strong>Customer Name</strong></td> <td><?php echo $order['customer_name'] ?></td>
                    </tr>
                <tr>
                    <td><strong>Customer Email</strong>  </td><td><?php echo $order['customer_email'] ?></td>
                    </tr>
                <tr>
                    <td><strong>Store</strong>  </td><td><?php echo $order['store_id'] ?></td>
                    </tr>
                <tr>
                    <td><strong>Total Products</strong>  </td> <td><?php echo $order['total_products'] ?></td>
                    </tr>
                <tr>
                    <td><strong>Order Date</strong> </td> <td> <?php echo $order['order_date'] ?></td>
                    </tr>
                <tr>
                    <td><strong>Total Amount</strong>  </td> <td><?php echo $this->cart->format_number($order['order_total']) ?></td>
                    </tr>
                <tr>
                    <td><strong>Payment Method</strong> </td> <td> <?php echo $order['payment_method'] ?></td>
                </tr>
                <?php if($order['payment_receipt']): ?>
                <tr>
                    <td><strong>Payment Receipt</strong> </td> <td> <img style="max-height: 250px;" src="<?php echo base_url($order['payment_receipt'])?>" alt="cash on pickup"></td>
                </tr>
                <?php endif; ?>
            </table>
        
        </div>
    </div>
    
    <div class="row">
        <div class="col">
         <h3 class="text-center">Products Ordered</h3>
        <table id="orderTable" class="table table-bordered table-striped ">
                <thead>
                    <tr> 
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
var orderTable;
$(document).ready(function() {

orderTable = $('#orderTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Order/viewOrder/')?>'+<?php echo $order['id'] ?>,
  'order': []
});

});
</script>