<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET["service_id"])) {
  $serviceid=$_GET["service_id"];

   $sql="select * from tbl_service where service_id=$serviceid";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);


  //Store the image filenames in an array
  $imageFiles = ["../uploads/" . $display["service_image"]];


   // Delete each image file from the array
  foreach ($imageFiles as $file) 
  {
    if (file_exists($file)) {
        unlink($file);
    }
  }
  
  $sql="delete  from tbl_service where service_id=$serviceid";
  $res=$obj->executequery($sql);
 
  
  }

  echo "<script>alert('Deleted Successfully!!');window.location='serviceview.php'</script>";

?>