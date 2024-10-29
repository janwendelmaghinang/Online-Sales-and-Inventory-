<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }
    /* #spin{
      position: absolute;
    left: 40%;
    top: 30%;
    z-index: 1000;
    } */
</style>

<div class="row border-bottom">
    <div class="col mb-2">
         <h3>Manage Bank Accounts</h3>
         <button class="btn btn-primary" data-toggle="modal" data-target="#addBankModal">Add Bank</button>
    </div>
    <div class="col">
       <!-- <button onclick="refresh()" class="btn btn-primary float-right">Refresh</button> -->
    </div>
</div>

<?php if($this->session->flashdata('messages_success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('messages_success') ?>
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

<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>Color</h5>
            </div>
            <table id="bankTable" class="table table-bordered table-sm table-striped ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Bank Name</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>Qr Code (Picture)</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- <div class="spinner-border" id="spin" role="status">
  <span class="sr-only">Loading...</span>
</div> -->

<!-- add bank  -->
<div class="modal fade" tabindex="-1" role="dialog" id="addBankModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">Add Bank</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Bank/create') ?>" method="post" id="createBankForm" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <label for="bank_name">Bank Name</label>
            <input type="text" class="form-control form-control-sm" id="bank_name" name="bank_name" placeholder="Enter Bank name" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="account_name">Account Name</label>
            <input type="text" class="form-control form-control-sm" id="account_name" name="account_name" placeholder="Enter account name" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" class="form-control form-control-sm" id="account_number" name="account_number" placeholder="Enter account number" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="qrcode">Qr Code (Picture)</label>
            <input type="file" class="form-control form-control-sm" id="qrcode" name="qrcode">
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control form-control-sm" id="active" name="active">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>


<!-- edit bank  -->
<div class="modal fade" tabindex="-1" role="dialog" id="editBankModal" aria-labelledby="modal_title" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">Edit Bank</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Bank/edit') ?>" method="post" id="editBankForm" enctype="multipart/form-data">
        <div class="modal-body">
        
          <div class="form-group">
            <label for="bank_name">Bank Name</label>
            <input type="text" class="form-control form-control-sm" id="edit_bank_name" name="edit_bank_name" placeholder="Enter Bank name" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="account_name">Account Name</label>
            <input type="text" class="form-control form-control-sm" id="edit_account_name" name="edit_account_name" placeholder="Enter account name" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" class="form-control form-control-sm" id="edit_account_number" name="edit_account_number" placeholder="Enter account number" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="qrcode">Qr Code (Picture)</label>
            <input type="file" class="form-control form-control-sm" id="edit_qrcode" name="edit_qrcode">
            <input type="hidden" class="form-control form-control-sm" id="edit_qr_hidden"  name="edit_qr_hidden">
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control form-control-sm" id="active" name="active">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>
        <input type="hidden" name="bank_id" id="bank_id" >
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- update Color -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteBankModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Admin_Bank/delete') ?>" method="post" id="updateColorForm">

        <div class="modal-body">
             Are you sure to Delete?
        </div>
        <input type="hidden" name="del_bank_id" id="del_bank_id" >
        <div class="modal-footer" >
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!-- end of modal -->

<script>
var bankTable;
$(document).ready(function() {

// $("#spin").show();   
$('#bank_link').addClass('bg-secondary');

bankTable = $('#bankTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Bank/fetchAllBankData')?>',
  'color': []
});

});

function editBank(id){
   
    $.ajax({
    url: '<?php echo base_url('Admin_Bank/getBankById')?>',
    type: 'post',
    data: { id: id }, 
    dataType: 'json',
    success:function(response) {
      console.log(response)
      document.querySelector('#edit_bank_name').value = response.data.bank_name
      document.querySelector('#edit_account_name').value = response.data.account_name
      document.querySelector('#edit_account_number').value = response.data.account_number
      document.querySelector('#edit_qr_hidden').value = response.data.qrcode

    }
  });

   var bank_id = document.querySelector('#bank_id');
   bank_id.value = id
}

function deletebank(id){
 console.log(id)
  var bank_id = document.querySelector('#del_bank_id');
  bank_id.value = id
}

</script>