<?php $this->load->view('account/inc/sideheader');?>
<?php $this->load->view('account/inc/sidenav');?>
            <div class="col col-md-9 border">
                <div class="container">
                    <div class="row">
                        <div class="col">
                          <p class="text-uppercase"><strong>Manage Profile</strong></p> 
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            <table class="table-bordered table-striped w-100">
                               <body> 
                                  <tr><td><strong>First name</strong></td>  <td><?php echo $user['customer_firstname']?></td>  </tr>
                                  <tr><td><strong>last name</strong></td> <td><?php echo $user['customer_lastname']?></td> </tr>
                                  <tr><td><strong>Email</strong></td> <td><?php echo $user['customer_email']?></td> </tr>
                                  <tr><td><strong>Phone</strong></td> <td><?php echo $user['customer_contact']?></td> </tr>
                                  <!-- <tr><td><strong>Password</strong></td> <td><?php echo $user['customer_password']?></td> </tr> -->
                               </body>
                            </table>
                            <br>
                            <a href="<?php echo base_url('account/update') ?>" class="btn btn-primary">Update</a>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('account/inc/sidefooter');?>