
<style>
  .heading-homepage{
    font-family: sans-serif;
    font-size: 30px;
  }
  .ft-con{
    background: white;
  }
  .ft-img{
    width: 75%;
  }
  .ft-card{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .carousel-control-prev, .carousel-control-next{
    /* background: black; */
    /* height: 20px; */
    max-width: 4vh;
  }
  .carousel-title{
    font-family: michroma;
  }

</style>
<?php if($slider_active['active'] == 1): ?>
<div id="carouselExampleIndicators" class="carousel slide carousel-slide" data-ride="carousel">

  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>


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

  <div class="carousel-inner">

    <div class="carousel-item active">
       <div class="home-bg-con">
         <div class="home-caption">
          <h1 class="carousel-title"><span class="text-danger">HPZ</span> ECO-BIKE</h1>
          <p>Get Your Eco-Bike Now!</p>
          <a href="<?php echo base_url('ebike') ?>" class="btn btn-warning">Buy Now</a>
         </div>
          <img class="home-img" src="<?php echo base_url('img/slideshow/slide2.png')?>">
        </div>
    </div>

    <div class="carousel-item">
     <div class="home-bg-con">
        <div class="home-caption">
          <h1 class="carousel-title"><span class="text-danger">HPZ</span> ECO-BIKE</h1>
          <p>We have spareparts available, find it now!</p>
          <a href="<?php echo base_url('spareparts') ?>" class="btn btn-warning">Shop Now</a>
       </div>
      <img class="home-img" src="<?php echo base_url('img/slideshow/spareparts.png')?>">
     </div>
    </div>

  </div>

  <a class="carousel-control-prev float-left" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>

  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php endif; ?>
<!-- en carousel -->
<!-- <div class="container">

<div class="container-fluid mt-3 ft-con">
  <h2 class="heading-homepage text-uppercase text-center"><strong>Featured Products</strong></h2>
      <div class="row justify-content-center">
        <div class="ft-col col col-md-6">
           <div class="ft-card">
              <img class="ft-img" src="<?php echo base_url('img/slideshow/sample.png')?>" alt="">
              <div class="ft-body">
                 <h5>
                   <strong>Eco Bike</strong>
                 </h5>
              </div>
           </div>
        </div>
        <div class="ft-col col col-md-6">
        <div class="ft-card">
              <img class="ft-img" src="<?php echo base_url('img/slideshow/sample.png')?>" alt="">
              <div class="ft-body">
                 <h5>
                   <strong>Spareparts</strong>
                 </h5>
                 <p></p>
              </div>
           </div>
        </div>
    </div>
</div>

<div class="container-fluid">
  <h2 class="heading-homepage text-uppercase text-center"><strong>Our Products</strong></h2>
    <div class="row">
        <div class="col col-md-6 border p-3">
         content
        </div>
        <div class="col col-md-6 border p-3">
          content
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
  <h2 class="heading-homepage text-uppercase text-center"><strong>Offers</strong></h2>
      <div class="row">
        <div class="col col-md-6 border p-3">
          content
        </div>
        <div class="col col-md-6 border p-3">
          content
        </div>
    </div>
</div>

<div class="container-fluid">
  <h2 class="heading-homepage text-uppercase text-center"><strong>Our News</strong></h2>
      <div class="row">
        <div class="col col-md-6 border p-3">
          content
        </div>
        <div class="col col-md-6 border p-3">
          content
        </div>
    </div>
</div>

</div> -->


<script>

  $(".homeNav").addClass('activeNav');

</script>

