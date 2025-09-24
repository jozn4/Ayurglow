<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Package / Service</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    /* Custom green theme */
    .bg-green {
      background-color: #108b07ff !important; /* Bootstrap success green */
    }
    .btn-green {
      background-color: #108b07ff !important;
      border: none !important;
      color: #fff !important;
      font-weight: 600;
      width: 100%;
      padding: 12px;
      border-radius: 6px;
      transition: all 0.3s ease;
    }
    .btn-green:hover {
      background-color: #146c43 !important;
      color: #fff !important;
    }
    .form-label {
      color: #198754; /* green labels */
      font-weight: 600;
    }
    .form-control:focus, .form-select:focus {
      border-color: #198754;
      box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
  </style>
</head>
<body>
<?php
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$psid=$_GET['psid'];
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="card shadow-lg rounded-3 border-success">
        <div class="card-header bg-green text-white text-center">
          <h4 style="color:white">Book Now</h4>
        </div>
        <div class="card-body">
          <form action="requestaction.php" method="POST">

            <!-- Booking Type -->
            <div class="mb-3">
              <label for="booking_type" class="form-label">Booking Type</label>
              <select name="type" id="booking_type" class="form-select" required>
                <option value="">-- Select Type --</option>
                <option value="package">Package</option>
                <option value="service">Service</option>
              </select>
            </div>

            <!-- Required Date -->
            <div class="mb-3">
              <label for="required_date" class="form-label">Required Date</label>
              <input type="date" id="required_date" name="date" class="form-control" required>
            </div>

            <!-- Submit -->
            <div class="d-grid">
              <button type="submit" class="btn-green btn-lg">Confirm Booking</button>
            </div>
              <input type="hidden"  name="psid" value="<?php echo $psid ?>" >

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<br><br><br>
<?php include_once("footer.php"); ?>
</body>
</html>
