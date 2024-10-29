
</section>
<style>
  .main-footer{
    background: #212121;
    color: white;
  }
  .item-wrap{
    text-decoration: none;
    list-style: none;
  }
  .footer-logo{
    max-width: 100%;
  }
  .footer-links-icon{
     text-decoration: none;
     font-size: 30px ;

  }
</style>
<footer class="container-fluid main-footer">
    <div class="container">
     <div class="row p-5 border-bottom">
        <div class="col-12 col-md-4 ">
            <img class="footer-logo"src="<?php echo (base_url());?>uploads/logo/Logo.png" alt=""><br><br><br>
            <h5 class="mb-2 display-7">
                  <strong>Our Social Media</strong>
            </h5>
            <a class="footer-links-icon text-white" href="">
               <i class="fab fa-facebook"></i>
            </a>
            <a class="footer-links-icon text-white" href="">
               <i class="fab fa-google"></i>
            </a>
            <a class="footer-links-icon text-white" href="">
               <i class="fab fa-instagram"></i>
            </a>
        </div>
        <div class="col col-md-2"></div>
        <div class="col-12 col-md-3 display-7">
              <h5 class="mb-2 display-7">
                  <strong>Address</strong>
              </h5>
              <p class="display-7">
                  Head Office: Patubig Marilao<br>
                  Bulacan
              </p> <br>
              <h5 class="mb-2 mt-4 display-7">
                  <strong>Contacts</strong>
              </h5>
              <p class="mb-4 display-7">
                  Email: hpzecobike@gmail.com <br>
                  Phone: +1 (0) 000 0000 001 <br>
              </p>
          </div>
          
          <div class="col-12 col-md-3 display-7">
                <h5 class="mb-2 display-7">
                    <strong>Services</strong>
                </h5>
                <ul class="list">
                    <li class="item-wrap">
                        <!-- <a class="text-primary footer-links" href="https://mobirise.co/">Account</a> -->
                    </li>
                    <li class="item-wrap">
                        <a class="text-primary footer-links" href="<?php echo base_url('contact') ?>">Contact Us</a>
                    </li>
                    <li class="item-wrap">
                        <a class="text-primary footer-links" href="<?php echo base_url('about') ?>">About us</a>
                    </li>
                </ul>
                <h5 class="mb-2 mt-5 display-7">
                    <strong>Feedback</strong>
                </h5>
                <p class=" display-7">
                    Please send us your ideas, bug reports, suggestions! Any feedback would be appreciated.
                </p>
            </div>

     </div> 
              
<?php if($footer_active['active'] == 1): ?>
     <div class="row p-4">
        <div class="col-sm-12 copyright pl-0">
          <p class="text-center display-7">
              <?php
                echo $footer_text['text'];
              ?>
          </p>
        </div>
     </div>
  <?php endif; ?>

     </div>  
</footer>
 </div>
 
 
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->


<script src="<?php echo base_url()?>/assets/popper/popper.min.js"></script>
<script src="<?php echo base_url()?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>/assets/smoothscroll/smooth-scroll.js"></script>
<script src="<?php echo base_url()?>/assets/js/app.js"></script>

<script>
    cartCount();
    function cartCount(){
    $.ajax({
        url: '<?php echo base_url('cart/cartCount')?>',
        method:'GET',
        dataType: 'json',
        success:function(response) {
            console.log(response)
        $('#cartCount').html('<span>'+response+'</span>');
        }
    });
}
</script>


</body>
</html>