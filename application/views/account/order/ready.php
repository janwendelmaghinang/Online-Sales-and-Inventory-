<?php $this->load->view('account/inc/sideheader');?>
<?php $this->load->view('account/inc/sidenav');?>

<div class="col col-md-9">
      <table class="table table-bordered table-sm">
         <tr>
               <th>Image</th>
               <th>Name</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Subtotal</th>
         </tr>
     
         <?php foreach($orders as $order): ?>  
            <?php if($order['order']['status'] == 1)
                  {
                        $status = 'Preparing';
                  }
                  if($order['order']['status'] == 2)
                  {
                        $status = 'Ready';
                  }
                  if($order['order']['status'] == 3)
                  {
                        $status = 'Completed';
                  }
                  if($order['order']['status'] == 4)
                  {
                        $status = 'Cancelled';
                  }
            ?>
            <?php foreach($order['items'] as $item): ?>
              <tr>
                  <td >
                        <img class="parts-img" src="<?php echo base_url($item['image'])?>" alt=""></img>
                  </td>
                  <td>
                        <h5><?php echo $item['product_name'];?></h5>
                  </td>
                  <td>
                        <div class="badge badge-success"><?php echo $item['price'] ?></div>
                  </td>
                  <td >
                        <small>Quantity: <?php echo $item['order_quantity'];?></small>
                  </td>
                  <td>
                        <h5>₱ <?php echo $this->cart->format_number($item['order_subtotal']) ?></h5>
                  </td>
              </tr>
            <?php endforeach; ?>  
            <tr>
                  <th class="text-right" colspan="4">Order Total:</th><th>₱ <?php echo $this->cart->format_number($order['order']['order_total']) ?></th>
            </tr>
            <tr>
                  <th class="text-right" colspan="4">Status:</th><th><?php echo $status ?></th>
            </tr>
            <tr>
                  <th class="text-right" colspan="4">Order ID:</th><th><?php echo $order['order']['id'] ?></th>
            </tr>          
         <?php endforeach; ?>
      </table>

</div>
<script>
      $('#link2').addClass('btnMenu')
</script>
<?php $this->load->view('account/inc/sidefooter');?>