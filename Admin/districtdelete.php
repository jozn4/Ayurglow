<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET["district_id"])) {
  $disid=$_GET["district_id"];

   $sql="select * from tbl_district where district_id=$disid";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);


   //Store the image filenames in an array
  //$imageFiles = ["../uploads/" . $display["district_image"]];


   //Delete each image file from the array
 // foreach ($imageFiles as $file) 
  {
    if (file_exists($file)) {
        unlink($file);
    }
  }
  
  $sql="delete from tbl_district where district_id=$disid";
  $res=$obj->executequery($sql);
 
  
  }

  echo "<script>alert('Deleted Successfully!!');window.location='districtview.php'</script>";

?>
