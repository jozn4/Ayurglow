<!DOCTYPE html>
<html lang="en">
<?php
include_once("../dboperation.php");
include_once('header.php');

$obj = new dboperation();
$psid =$_GET['packageid'];

$sql = "SELECT * FROM tbl_packageservice c
        INNER JOIN tbl_service p ON p.service_id = c.service_id
        WHERE c.package_id = '$psid'";

$res = $obj->executequery($sql);
?>
  <main class="main">

    <!-- Page Title -->
    <div class="page-title accent-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Services</h1>
       
      </div>
    </div><!-- End Page Title -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">
      <div class="container">
        <div class="row gy-4">

          <?php
          // check result and loop — each service gets its own column
          
            while ($s = mysqli_fetch_array($res)) {
          ?>
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                <div class="service-item item-cyan position-relative">
                  <div class="post-img position-relative overflow-hidden">
                    <img src="../uploads/<?php echo $s['service_image']; ?>"
                         style="height:300px; width:100%; object-fit:cover;"
                         alt="<?php echo $s['service_name']; ?>">
                  </div>

                  <a href="service-details.php?service_id=<?php echo $s['service_id']; ?>" class="stretched-link">
                    <h3><?php echo $s['service_name']; ?></h3>
                  </a>

                  <p><?php echo $s['service_description']; ?></p>
<br>
                   <a href="serviceviewmore.php?serviceid=<?php echo $s['service_id']; ?>" class="readmore stretched-link">
                  <span>View More</span><i class="bi bi-arrow-right"></i>
                </a>
                </div>
              </div>
          <?php
          }
          ?>

        </div>
      </div>
    </section><!-- /Services Section -->
  </main>
<!-- Feedback Button -->

<div class="row mt-4">
  <div class="col-12 text-center">
    <a href="request.php?psid=<?php echo $psid; ?>" class="btn btn-primary btn-lg">
      Book Package
    </a>

    <!-- Feedback Button next to Book Package -->
    <a href="feedback.php?psid=<?php echo $psid; ?>" class="btn btn-warning btn-lg ms-3">
      Feedback
    </a>
  </div>
</div>

<br><br>

<?php
include_once('feedbackview.php');

include_once('footer.php');
?>
</html>
