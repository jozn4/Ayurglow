<?php
session_start(); 
include_once("../dboperation.php"); 
$obj = new dboperation();

// Check if user is logged in and form submitted
if(isset($_POST['submit']) && isset($_SESSION['loginid'])) {

    $description = $_POST['description'];
    $customer_id = $_SESSION['loginid']; 
    $psid = $_POST['psid']; // package/service id
$date=date('y-m-d');
    // Insert feedback into database
    $sql = "INSERT INTO tbl_feedback (description, customer_id, psid,regdate) 
            VALUES ('$description', '$customer_id', '$psid','$date')";
    $result = $obj->executequery($sql);

    if($result == 1){
       echo "<script>alert('Thank you for your feedback!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Failed to submit feedback. Please try again.'); window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('Please submit the form properly.'); window.location='index.php';</script>";
}
?>
