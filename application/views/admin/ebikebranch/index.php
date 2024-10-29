<style>
    th{
        font-size: 12px;
    }
    td{
        font-size: 13px;
    }
</style>

<div class="row border-bottom">
    <div class="col mb-2">
         <h3>Manage Ebike</h3>
         <a class="btn btn-primary text-light" href="<?php echo base_url('Admin_Ebike_Branch/create') ?>">Add Ebike</a>
    </div>
</div>

<div id="messages"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">

            <table id="ebikeTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>stock critical</th>
                        <th>Color</th>
                        <th>Store</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>

$('#ebike_units').addClass('show');

var ebikeTable;
$(document).ready(function(){

ebikeTable = $('#ebikeTable').DataTable({
  'ajax': '<?php echo base_url('Admin_Ebike_Branch/fetchAllEbikeBranchData')?>',
  'order': []
});

});

function ebikeProduction(id){
    $.ajax({
        url: '<?php echo base_url('Admin_Ebike/getEbikeById')?>',
        type: 'post',
        data: { id: id }, 
        dataType: 'json',
        success:function(response){
            console.log(response)
            $("#model").val(response.units.name);
            $("#color").val(response.color.color_name);
            $("#voltage").val(response.specs.rated_voltage);
            $("#store").val(response.store.store_name);

            $("#h_id").val(response.units.id);
            $("#h_model").val(response.units.model_id);
            $("#h_color").val(response.color.id);
            $("#h_store").val(response.store.store_id);
    
            $("#productionForm").unbind('submit').bind('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response){
                    console.log(response)
             
                    }
                });
            })
        }
    });
}

</script>