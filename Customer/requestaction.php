<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

$psid = $_POST['psid'];
$type = $_POST['type'];
$required_date = $_POST['date'];
$regdate = date('Y-m-d'); // ✅ 4-digit year

// Ensure customer is logged in
if (!isset($_SESSION['loginid'])) {
    echo "<script>alert('Please login first!'); window.location='login.php';</script>";
    exit();
}

$customer_id = $_SESSION['loginid'];
$status = "pending";

// ✅ Correct duplicate check
$s = "SELECT * FROM tbl_request 
      WHERE psid='$psid' and customer_id='$customer_id'";
$res = $obj->executequery($s);

if ($res && mysqli_num_rows($res) > 0) {
   if ($type == "service") {
        echo "<script>alert('You have already booked!'); window.location='service.php';</script>";
    } elseif ($type == "package") {
        echo "<script>alert('You have already booked!'); window.location='package.php';</script>";
    }
    exit();
} else {
    // Insert query
    $sql = "INSERT INTO tbl_request (psid, customer_id, type, status, required_date, regdate)
            VALUES ('$psid', '$customer_id', '$type', '$status', '$required_date', '$regdate')";
    $result = $obj->executequery($sql);

    if ($result) {
        if ($type == "service") {
            echo "<script>alert('Booking request submitted successfully!'); window.location='service.php';</script>";
        } elseif ($type == "package") {
            echo "<script>alert('Booking request submitted successfully!'); window.location='package.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.location='request.php';</script>";
        }
    } else {
        echo "<script>alert('Error saving booking.'); window.location='request.php';</script>";
    }
}
?>
