
<style>

  .badge
{
  position: absolute; 
  top: 50;
}
.ebike-list-con{
  background: white;
}

.e_s-card-image
{
 max-width: 75%;
  height: auto;
}

.e_s-img-con{
display: flex;
justify-content: center;
align-items: center;
height: 200px;
}

.e_s-card-body{
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
}

.grid-items:hover{
background: lightgray;
}
.e_s-card{
background: none;
}

.loader {
  left: 50%;
  margin-left: -4em;
}
 
</style>
<!-- Messages -->
<?php if ($this->session->flashdata('correct_account')) : ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('correct_account'); ?>
        </div>
<?php endif; ?>

<?php if ($this->session->flashdata('registered')) : ?>
        <div class="alert alert-success">
              <?php echo $this->session->flashdata('registered'); ?>
        </div>
<?php endif; ?>

<div class="text-center mt-1">
<div class="spinner-border" id="spin" role="status">
  <span class="sr-only">Loading...</span>
</div>
</div>

<div class="container my-5">
         <div class="row justify-content-between align-items-center ">
           <div class="col">
              <h1 class="text-uppercase"><strong>Spareparts</strong></h1>
           </div>
           <div class="col">
              <p class="float-right" >Results: <strong id="resultcount"></strong></p>
           </div>
         </div>
     
  <div class="container-fluid ebike-list-con ">

         <div class="row p-2">
          <div class="side-col col-md-4 col-lg-3 border-right">
            
                  <div class="form-group">
                    <label for=""><strong>Search</strong></label>
                      <input class="form-control" type="text" id="search"placeholder="Search Products"><br>
                      <button class="btn btn-warning w-100" onclick="fetch()">Search</button>
                  </div>
          
                  <div class="form-group">
                    <label for=""><strong>Model</strong></label>
                    <select id="filterModel" class="form-control border-0" onchange="fetch()">
                      <option value="" selected>All</option>
                      <?php foreach($models as $model) :?>
                        <option value="<?php echo 'WHERE model_id ='. $model['id'] ?>"><?php echo $model['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <br>
                    <label for="filterSort"><strong>Sort</strong></label>
                    <select id="filterSort" class="form-control border-0" onchange="fetch()">
                      <option value=""selected>None</option>
                      <option value="ORDER BY name asc">Alphabetically A to Z</option>
                      <option value="ORDER BY name desc">Alphabetically Z to A</option>
                      <option value="ORDER BY price asc">Price: low to high</option>
                      <option value="ORDER BY price desc">Price: high to low</option>
                    </select>
                  </div>
          </div>

          <div class="prod-col col-md-8 col-lg-9">
        
             <div class="row" id="row_div">

             </div>

          </div>
        </div>
      </div>
   </div>    



<script>
  $(".sparepartsNav").addClass('activeNav');

   
fetch();
function fetch(){
    
    var delay = 1000;
    var filterModel = document.querySelector('#filterModel').value;
    var filterSort = document.querySelector('#filterSort').value;
    var resultcount = document.querySelector('#resultcount');
    var search = document.querySelector('#search');
    var squery;
    if(search.value == '' ){
        squery = ''
    }
    if(!search.value == '' && filterModel == '' ){
        squery = 'WHERE name LIKE '+"'"+'%'+search.value+'%'+"'"+' ';
    }
    if(!search.value == '' && !filterModel == '' ){
        squery = 'AND name LIKE '+"'"+'%'+search.value+'%'+"'"+' ';
    }
   
    $.ajax({
      url: '<?php echo base_url('Spareparts/fetchSpareparts') ?>',
      data: {fModel: filterModel, sQuery: squery, fSort: filterSort},
      method: 'post',
      dataType: 'json',
      beforeSend: function() {
        $('#spin').show();
      },
      success:function(response){

      setTimeout(function() {
  
      $('#spin').hide();

        // resultcount.innerHTML = response.data.length;
        var content = '';
        var mod='';
        var badge = '';
        var res = 0;
        for(var i = 0; i < response.data.length; i++){
          if(response.data[i].serial_number == 2){
           
            if(response.qty[i]==0){
               badge = '  <span class="badge badge-danger"><h5>SOLD OUT</h5></span>'
            }
            else
            {
              badge = '';
            }
           content += `
           <div class="grid-items col-6 col-md-4 col-lg-3 my-1 p-0">
                 <a href="<?php echo (base_url('spareparts/details/'))?>`+response.data[i].id+`">
                  <div class="e_s-card">
                    <div class="e_s-img-con">
                          `+badge+`
                          <img src="<?php echo (base_url());?>`+response.data[i].image+`" class="e_s-card-image">
                    </div>
                    <div class="e_s-card-body">
                      <h5 class="e_s-card-title text-dark">`+response.data[i].name+`</h5>
                      <p class="text-dark" id="small" >
                      `+response.model[i]+`
                      </p>
                       <p class="e_s-card-text text-warning">₱ `+response.data[i].price+` </p>
                    </div>
                  </div>
                  </a>  
                </div>
           `;
          res++;
          }
        }
        resultcount.innerHTML = res;
        $('#row_div').html(content);
        
      }, delay);
      }
    });
}
</script>

