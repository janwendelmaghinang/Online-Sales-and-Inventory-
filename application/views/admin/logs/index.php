<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }
</style>

<div class="row border-bottom">
    <div class="col  mb-2">
         <h3>Manage System Logs</h3>
    </div>
    <div class="col  mb-2">

    </div>
</div>

<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="table-title d-flex flex-column">
                <h5>System Logs</h5>
            </div>
            <table id="logsTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Logs Id</th>
                        <th>Username</th>
                        <th>Activity</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<script>
var logsTable;
$(document).ready(function() {

logsTable = $('#logsTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Logs/fetchLogs')?>',
  'order': []
});

setInterval(function(){
    logsTable.ajax.reload(null, false); 
}, 2000) 

});
</script>