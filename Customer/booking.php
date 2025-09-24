<?php
include_once("../dboperation.php");
include_once('header.php');
$obj = new dboperation();
$psid=$_GET['psid'];


?>
  <main class="main">

    <!-- Page Title -->
    <div class="page-title accent-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Booking</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="mb-5">
      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade">

        
          <div class="col-lg-8">
            <form action="bookingaction.php" method="post" >
              <div class="row">
                
              </div>
              <div class="new">
              <div class="form-group mt-3">
                <label for="type">Select Type</label>
                <select class="form-control" name="type" required="">
                  <option value="" selected disabled>-- Select Type --</option>
                  <option >  package</option>
                  <option >Service</option>
                  
                  </select>
              </div>
              <div class="form-group mt-3">
                <label for="date">Select Required Date</label>
                <input type="date" class="form-control" name="date"  placeholder="required date" required="">
              </div>
              
           <br>
           <input type="hidden" name="psid" value="<?php echo $psid ?>">
              <div class="text"><button type="submit" name="submit" style=" background-color:green; border-radius:7px; border:1px solid green;width:150px; height:40px;">Send Message</button></div>
            </form>
          </div><!-- End Contact Form -->
</div>
        </div>

      </div>

    </section><!-- /Contact Section -->
    <style>
      .new{
        background-color: #f7f9fc;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 1px solid #076314;
      }
     
      </style>

  </main>
<?php

include_once('footer.php');

?>