<?php $this->load->view('account/inc/sideheader');?>
<?php $this->load->view('account/inc/sidenav');?>
            <div class="col col-md-10 border bg-light">
                    <div class="table-con mt-3">
                        <table class="table table-bordered table-stripped m-2">
                            <tr class="table-primary">
                                <th>My Account</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach($users as $user)?>
                            <tr>
                                <td><h5>First Name</h5><br><?php echo $user['user_firstname'] ?></td><td><button class="btn btn-primary">Edit</button></td>
                            </tr>
                            <tr>
                                <td><h5>Last Name</h5><br><?php echo $user['user_lastname'] ?></td><td><button class="btn btn-primary">Edit</button></td>
                            </tr>
                            <tr>
                                <td><h5>Email</h5><br><?php echo $user['user_email'] ?></td><td><button class="btn btn-primary">Edit</button></td>
                            </tr>
                            <tr>
                                <td><h5>Contact</h5><br><?php echo $user['user_contact'] ?></td><td><button class="btn btn-primary">Edit</button></td>
                            </tr>
                            
                        </table>
                    </div>
            </div>
            
<?php $this->load->view('account/inc/sidefooter');?>