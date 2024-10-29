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
         <h3>Set Model</h3>
    </div>
</div>

<?php if($this->session->flashdata('already_set')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        Already set. <a href="<?php echo base_url('Admin_Model/model') ?>">Back To Model</a>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <form action="<?php echo base_url('Admin_Model/set_model/'.$model['id']) ?>" method="post">
                <h3>Spareparts For <?php echo $model['name'] ?> </h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Parts Name</th>
                        <th>Quantity Per Ebike</th>
                    </tr>
                    <?php if($parts):?>
                    <?php foreach($parts as $part): ?>
                     
                        <tr>
                            <input type="hidden" name="parts_id[]" value="<?php echo $part['id']?>">
                            <td><?php echo $part['name']?></td>
                            <td><?php echo $part['qty_per_ebike'] ?></td>
                        </tr>
                     
                    <?php endforeach; ?>
                    <?php else: ?>
                       <tr>
                           <td></td>
                           <td>No Parts Available</td>
                       </tr>
                    <?php endif; ?>  
                </table>
            
                <h3>Generic Parts</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Parts Name</th>
                        <th>Quantity Per Ebike</th>
                    </tr>
                    <?php foreach($generic as $part): ?>
                    <?php if($part['model_id'] == 0):?>
                        <tr>
                            <input type="hidden" name="parts_id[]" value="<?php echo $part['id']?>">
                            <td><?php echo $part['name']?></td>
                            <td><?php echo $part['qty_per_ebike'] ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </table>

                <div class="form-group">
                    <button class="btn btn-primary">Yes</button>
                    <a href="javascript:history.go(-1)" class="btn btn-warning">No</a>
                </div>
                <input type="hidden" name="yes" value="1" readonly>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col">
             
        </div>
    </div>
</div>


<script>

    var parts_box = document.querySelectorAll('#parts_box');
    var qty = document.querySelectorAll('#qty');
    var i;
  
function selected_box(){
    var selected = [];
    for(i = 0; i < parts_box.length; i++){
           if(parts_box[i].checked == true){
             qty[i].toggleAttribute("disabled", false);
             if(qty[i].value){
                
             }
             else 
             {
               qty[i].value = '1';
             }
           }
           else 
           {
            qty[i].toggleAttribute("disabled", true);
            qty[i].value = null;
           }
    }
}



</script>
