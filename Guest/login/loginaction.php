<?php
session_start();
include_once("../../dboperation.php");
$obj = new dboperation();
$username = $_POST["username"];
$password = $_POST["passsword"];


$sqlquery = "select * from tbl_adminlogin where username='$username' and password='$password'";
$result = $obj->executequery($sqlquery);
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION["User_name"] = $username;
    $_SESSION["loginid"] = $row["login_id"];


    header("location:..\..\Admin\adminindex.php");
} 
$sqlquery = "select * from tbl_customer where username='$username' and password='$password'";
$result = $obj->executequery($sqlquery);
    if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION["User_name"] = $username;
    $_SESSION["loginid"] = $row["customer_id"];


    header("location:..\..\Customer\index.php");
} 
else {

        // Invalid login, display an error message
        echo "<script>alert('Invalid Username/Password!!'); window.location='login.php'</script>";
    }




?>