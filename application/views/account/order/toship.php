<?php $this->load->view('user/inc/sideheader');?>
<?php $this->load->view('user/inc/sidenav');?>
            <div class="col col-md-10 border bg-light">
                    <div class="table-con mt-3">
                        <table class="table table-bordered table-stripped m-2">
                            <tr class="table-primary">
                                <th>To Ship</th>
                            </tr>
                            <?php foreach($order_toship as $orders): ?> 
                            <tr>
                                <td>Your Order Ready To Ship <br> Order: <?php echo $orders['parts_name'] ?><br>Quantity:<?php echo $orders['order_quantity'] ?></td>
                            </tr>
                         <?php endforeach; ?>
                        </table>
                    </div>
            </div>
<?php $this->load->view('user/inc/sidefooter');?>