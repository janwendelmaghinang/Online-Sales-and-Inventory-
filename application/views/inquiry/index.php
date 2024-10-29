<style>
@media (min-width: 1200px) and (max-width: 1399.98px) { 
    .con-app{
        width: 800px;
    }
}
</style>


<?php if(!$this->session->userdata('customer_logged_in')):?>
<form action="<?php echo base_url('Inquiry/submit') ?>" method="post" id="inquiryForm">

<div class="container-fluid p-4">
    <div id="messages"></div>
   <div class="container con-app ">
       <div class="row mb-4">
           <h3>Purchase Inquiry Form</h3>
       </div>
    </div>
    <div class="container con-app shadow-sm border bg-light">
        <div class="wrapper">
            <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
            <label class="form-label font-weight-bold" for="">Name:</label>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="form-label" for="">First name</label>
                        <input value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname']; } ?>" class=" form-control-sm form-control" type="text" name="firstname" id="firstname">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label" for="">Middle name</label>
                        <input value="<?php if(isset($_POST['middlename'])){echo $_POST['middlename']; } ?>" class=" form-control-sm form-control" type="text" name="middlename" id="middlename">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label" for="">Last name</label>
                        <input value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname']; } ?>"  class=" form-control-sm form-control" type="text" name="lastname" id="lastname">
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
        <label class="form-label font-weight-bold" for="">Address:</label>
            <div class="row">
                <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">Street</label>
                        <input value="<?php if(isset($_POST['street'])){echo $_POST['street']; } ?>"  class=" form-control-sm form-control" type="text" name="street" id="street">
                    </div>
                </div>
                <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">Subdivision</label>
                        <input value="<?php if(isset($_POST['subdivision'])){echo $_POST['subdivision']; } ?>"  class=" form-control-sm form-control" type="text" name="subdivision" id="subdivision">
                    </div>
                </div>
                <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">Barangay</label>
                        <input value="<?php if(isset($_POST['barangay'])){echo $_POST['barangay']; } ?>"  class=" form-control-sm form-control" type="text" name="barangay" id="barangay">
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">City</label>
                        <input value="<?php if(isset($_POST['city'])){echo $_POST['city']; } ?>"  class=" form-control-sm form-control" type="text" name="city" id="city">
                    </div>
                </div>
                <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">Province</label>
                        <input value="<?php if(isset($_POST['province'])){echo $_POST['province']; } ?>"  class=" form-control-sm form-control" type="text" name="province" id="province">
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
        <label class="form-label font-weight-bold" for="">Contact:</label>
            <div class="row">
                <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">Email Address</label>
                        <input value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>" class=" form-control-sm form-control" type="text" name="email" id="email">
                    </div>
                </div>
                <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">Contact Number</label>
                        <input value="<?php if(isset($_POST['contact'])){echo $_POST['contact']; } ?>" class=" form-control-sm form-control" type="number" name="contact" id="contact">
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
        <label class="form-label font-weight-bold" for="">Select Branch:</label>
            <div class="row">
                <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">Branch</label>
                        <select class=" form-control-sm form-control" name="store" id="store">
                            <option hidden></option>
                            <?php foreach($store_branch as $store): ?>
                              <option value="<?php echo $store['store_id']?>"><?php echo $store['store_name']?></option>
                            <?php endforeach;  ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
        <label class="form-label font-weight-bold" for="">Payment Option:</label>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                            <select class=" form-control-sm form-control" name="payment" id="payment">
                                <option hidden></option>
                                <option value="1">Cash</option>
                                <option value="2">Installment</option>
                            </select>
                        </div>
                    </div>
            </div>
        </div>
        <div class="wrapper">
        <label class="form-label font-weight-bold" for="">Select Model:</label>
            <div class="row">
               <div class="col">
                  <div class="form-group">
                      <label class="form-label" for="">Model</label>
                        <select class=" form-control-sm form-control" name="model" id="model">
                            <option hidden></option> 
                            <?php foreach($models as $model): ?>
                              <option value="<?php echo $model['id']?>"><?php echo $model['name']?></option>
                            <?php endforeach;  ?>
                        </select>
                   </div>
               </div>
               <div class="col">
                  <div class="form-group">
                      <label class="form-label" for="">Color</label>
                        <select class=" form-control-sm form-control" name="color" id="color">
                            <option hidden></option>
                            <?php foreach($colors as $color): ?>
                              <option value="<?php echo $color['id']?>"><?php echo $color['color_name']?></option>
                            <?php endforeach;  ?>
                        </select>
                   </div>
               </div>
               <!-- <div class="col">
                  <div class="form-group">
                      <label class="form-label" for="">Voltage</label>
                        <select class="form-control" name="voltage" id="">
                            <option value=""></option>
                            <option value="48v">48 volts</option>
                            <option value="60v">60 volts</option>
                        </select>
                   </div>
               </div> -->
              </div>
            </div>
            <div class="row">
                <div class="col">
                    <button name="online_form_btn" class="btn btn-primary w-100 mb-4" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

</form>
<?php else: ?>
<form action="<?php echo base_url('Inquiry/submit1') ?>" method="post" id="inquiryForm1">
<div class="container p-4">
    <div id="messages1"></div>
   <div class="container con-app ">
       <div class="row mb-4">
           <h3>Purchase Inquiry Form</h3>
       </div>
    </div>
    <div class="container con-app shadow-sm border bg-light">
        <div class="wrapper">
        <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>

        <div class="wrapper">
        <label class="form-label font-weight-bold" for="">Select Branch:</label>
            <div class="row">
                <div class="col">
                <div class="form-group">
                        <label class="form-label" for="">Branch</label>
                        <select class=" form-control-sm form-control" name="store" id="store">
                            <option hidden></option>
                            <?php foreach($store_branch as $store): ?>
                              <option value="<?php echo $store['store_id']?>"><?php echo $store['store_name']?></option>
                            <?php endforeach;  ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
        <label class="form-label font-weight-bold" for="">Payment Option:</label>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                            <select class=" form-control-sm form-control" name="payment" id="payment">
                                <option hidden></option>
                                <option value="1">Cash</option>
                                <option value="2">Installment</option>
                            </select>
                        </div>
                    </div>
            </div>
        </div>
        <div class="wrapper">
        <label class="form-label font-weight-bold" for="">Select Model:</label>
            <div class="row">
               <div class="col">
                  <div class="form-group">
                      <label class="form-label" for="">Model</label>
                        <select class=" form-control-sm form-control" name="model" id="model">
                            <option hidden></option> 
                            <?php foreach($models as $model): ?>
                              <option value="<?php echo $model['id']?>"><?php echo $model['name']?></option>
                            <?php endforeach;  ?>
                        </select>
                   </div>
               </div>
               <div class="col">
                  <div class="form-group">
                      <label class="form-label" for="">Color</label>
                        <select class=" form-control-sm form-control" name="color" id="color">
                            <option hidden></option>
                            <?php foreach($colors as $color): ?>
                              <option value="<?php echo $color['id']?>"><?php echo $color['color_name']?></option>
                            <?php endforeach;  ?>
                        </select>
                   </div>
               </div>
               <!-- <div class="col">
                  <div class="form-group">
                      <label class="form-label" for="">Voltage</label>
                        <select class="form-control" name="voltage" id="">
                            <option value=""></option>
                            <option value="48v">48 volts</option>
                            <option value="60v">60 volts</option>
                        </select>
                   </div>
               </div> -->
              </div>
            </div>
            <div class="row">
                <div class="col">
                    <button name="online_form_btn" class="btn btn-primary w-100 mb-4" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php endif;?>






<script>

$("#inquiryForm").unbind('submit').on('submit', function(){
  var form = $(this);
  
//   $(".text-danger").remove();

  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success:function(response) {
       
        if(response.success === true) {
          // $("#spin").hide();
        //   $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
        //     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
        //     '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
        //   '</div>');
 
        // $("#inquiryForm")[0].reset();
        // $("#inquiryForm .form-group").removeClass('has-error').removeClass('has-success');
        window.location.assign('<?php echo base_url('Inquiry/success') ?>')
        }
        else
        {
          // form error
          if(response.messages instanceof Object){
                $.each(response.messages, function(index, value)
                {
                  var id = $("#"+index);  
                  id.after(value);
                });
              }
               else 
              {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
           }
        }


    }
  }); 
  return false;
 });

 $("#inquiryForm1").unbind('submit').on('submit', function(){
  var form = $(this);
  
//   $(".text-danger").remove();

  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success:function(response) {
       
        if(response.success === true) {
          // $("#spin").hide();
        //   $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
        //     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
        //     '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
        //   '</div>');
 
        // $("#inquiryForm")[0].reset();
        // $("#inquiryForm .form-group").removeClass('has-error').removeClass('has-success');
        window.location.assign('<?php echo base_url('Inquiry/success') ?>')
        }
        else
        {
          // form error
          if(response.messages instanceof Object){
                $.each(response.messages, function(index, value)
                {
                  var id = $("#"+index);  
                  id.after(value);
                });
              }
               else 
              {
                $("#messages1").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
           }
        }


    }
  }); 
  return false;
 });
</script>