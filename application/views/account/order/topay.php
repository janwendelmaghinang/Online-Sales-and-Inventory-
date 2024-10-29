<?php $this->load->view('user/inc/sideheader');?>
<?php $this->load->view('user/inc/sidenav');?>
     
            <div class="col col-md-10 border bg-light">
                    <div class="table-con mt-3">
                        <table class="table table-bordered table-stripped m-2">
                            <tr class="table-primary">
                                <th>To Pay</th>
                                <th>Action</th>
                            </tr>    
                         <?php foreach($user_order_item as $orders): ?> 
                            <tr>
                                <td>Your Order<br> Order: <?php echo $orders['parts_name'] ?><br>Quantity:<?php echo $orders['order_quantity'] ?></td>
                              <form action="<?php echo base_url('user/to_pay') ?>" method="post">
                                  <input type="hidden" name="cancel_id" value="<?php echo $orders['order_id']?>">
                                  <td><button type="submit" name="cancel_order" class="btn btn-primary" >Cancel</button></td>
                              </form>
                            </tr>
                         <?php endforeach; ?>
                      
                        </table>
                    </div>
            </div>

<?php $this->load->view('user/inc/sidefooter');?>