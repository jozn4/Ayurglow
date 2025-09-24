
<?php
session_start();
include_once('../dboperation.php');
$obj = new dboperation();
$rid = $_SESSION['loginid']; // Logged-in customer ID
$bid = isset($_GET['request_id']) ? $_GET['request_id'] : 0;

$sql = "SELECT b.*, 
               p.package_name, 
               p.package_amount, 
               s.service_name, 
               s.service_amount 
        FROM tbl_request b
        LEFT JOIN tbl_package p ON p.package_id = b.psid AND b.type = 'package'
        LEFT JOIN tbl_service s ON s.service_id = b.psid AND b.type = 'service'
        WHERE b.request_id = '$bid' AND b.customer_id = '$rid'";

$res = $obj->executequery($sql);
$display = mysqli_fetch_array($res);

if (!$display) {
    echo "<script>alert('No booking found!'); window.location='myrequests.php';</script>";
    exit;
}

$type = $display['type'];
$name = ($type == 'package') ? $display['package_name'] : $display['service_name'];
$amount = ($type == 'package') ? $display['package_amount'] : $display['service_amount'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Modern Payment Page</title>
   <link rel="stylesheet" type="text/css" href="css/payment.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <div class="card">
    <div class="header">
      <span>Payment</span>

      <div class="icons">
        <img src="https://img.icons8.com/color/48/000000/visa.png"/>
        <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png"/>
        <img src="https://img.icons8.com/color/48/000000/maestro.png"/>
      </div>
      
    </div>
       <p class="lead"><strong><?php echo $type . " - " . $name; ?></strong></p>
       <p class="lead"><strong>Amount: $<?php echo $amount ?></strong></p>

<form autocomplete="off" method="post" action="paymentaction.php">
  <span>Cardholder's name:</span>
  <input placeholder="John Doe" required>
  <span>Your CNumber:</span>
  <input placeholder="0000 1111 2222 3333" required maxlength="16">
  <div class="row flex">
    <div class="col">
      <span>Expiry:</span>
      <input placeholder="MM/YY" required>
    </div>
    <div class="col">
      <span>C V V:</span>
      <input placeholder="***" pattern="[0-9]{3,4}"  title="Enter a valid 3 or 4 digit CVV" required>
    </div>
    </div>
     <input type="hidden" name="request_id" value="<?php echo $bid; ?>">
     <input type="hidden" name="amount" value="<?php echo $amount; ?>">

  <button type="submit" class="btn">Pay Now</button>
</form>
</div>
</body>
</html>
