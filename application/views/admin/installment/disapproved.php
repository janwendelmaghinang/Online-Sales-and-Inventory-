
<style>
th{
    font-size: 11px;
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


<div class="row">
    <div class="col border-bottom my-1">
        <h4>Ebike Loan</h4>
        <!-- <button type="button" onclick="newCustomer()" class="btn btn-primary mb-1" data-toggle="modal" data-target="#applicantModal">New Applicant</button> -->
    </div>
</div>

<?php if($this->session->flashdata('messages')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('messages') ?>
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

<ul class="nav nav-tabs my-3">
  <li class="nav-item">
    <a id="link1" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment') ?>">Customer Investigation <span class="badge"><?php if(!$pending == 0){echo $pending;}?></span></a>
  </li>
  <li class="nav-item">
    <a id="link2" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/approved') ?>">Approved <span class="badge"><?php if(!$approved == 0){echo $approved;} ?></a>
  </li>
  <li class="nav-item">
    <a id="link3" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/disapproved') ?>">Disapproved <span class="badge"><?php if(!$disapproved == 0 ){echo $disapproved;}?></a>
  </li>
  <li class="nav-item">
    <a id="link4" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/released') ?>">Released <span class="badge"><?php if(!$released == 0 ){echo $released;}?></a>
  </li>
  <li class="nav-item">
    <a id="link5" class="mx-2 text-dark btn btn-outline-dark notification" href="<?php echo base_url('Admin_Installment/cancelled') ?>">Cancelled <span class="badge"><?php if(!$cancelled == 0 ){echo $cancelled;}?></a>
  </li>
</ul>

<div id="messages"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col mt-2">
            <table id="disapprovedTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ebike</th>
                        <th>Color</th>
                        <th>Customer</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
$('#link3').addClass('btn-primary');
$('#loan').addClass('show');
$('#loan_link1').addClass('btn-secondary');

var approvedTable;
$(document).ready(function() {

approvedTable = $('#disapprovedTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Installment/fetchDisapproved')?>',
  'order': []
});

});
</script>