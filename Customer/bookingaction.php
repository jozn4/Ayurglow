<?php
session_start();
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{
    $psid=$_POST['psid'];
    $customer_id=$_SESSION['loginid'];
$n=$_POST['type'];
$requesteddate=date('Y-m-d');
$requireddate=$_POST['date'];
 $status="Pending";

$sql= "select * from  tbl_booking where psid='$psid'";
$res=$obj-> executequery($sql);
$rows=mysqli_num_rows($res);
if($rows > 0){
     echo"<script>alert('Already Exists');window.location='index.php'</script>";
}

else{
       $sql="INSERT INTO tbl_booking (psid,customer_id,type,requested_date,required_date,status) VALUES('$psid','$customer_id','$n','$requesteddate','$requireddate','$status')";
    $result=$obj->executequery($sql);
    
    if($result==1){
      echo "<script>alert('Registration Sucessfull');window.location='index.php' </script>";
}
else{
     echo "<script>alert('Registration failed!');window.location='index.php' </script>";
}

}
}

?>