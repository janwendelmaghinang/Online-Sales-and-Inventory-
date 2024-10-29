<?php $this->load->view('account/inc/sideheader');?>
<?php $this->load->view('account/inc/sidenav');?>
            <div class="col col-md-9 border">
                <div class="container">
                    <div class="row">
                        <div class="col">
                          <p class="text-uppercase"><strong>Update Personal Information</strong></p> 
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input class="form-control" type="text" name="firstname" id="" value="<?php echo $user['customer_firstname'] ?>" >
                            </div>
                            <div class="form-group">
                                <label for="lastname">lastname</label>
                                <input class="form-control" type="text" name="firstname" id="" value="<?php echo $user['customer_lastname'] ?>" >
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input class="form-control" type="text" name="" id="" value="<?php echo $user['customer_email'] ?>" >
                            </div>
                            <div class="form-group">
                                <label for="phone">phone</label>
                                <input class="form-control" type="text" name="" id="" value="<?php echo $user['customer_contact'] ?>" >
                            </div>
       
                            <div class="form-group">
                                <button class="btn btn-danger">Save Changes</button>
                                <button class="btn btn-warning">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('account/inc/sidefooter');?>