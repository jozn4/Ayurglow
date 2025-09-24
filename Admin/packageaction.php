<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{
$cid=$_POST['category_id'];
$n=$_POST['package_name'];
$a=$_POST['package_amount'];
$image=$_FILES['package_image']['name'];

 $d=$_POST['package_duration'];
$des=$_POST['package_description'];
 
 
 move_uploaded_file($_FILES["package_image"]["tmp_name"],"../uploads/".$image);

$sql= "select * from  tbl_package where package_name='$n' ";
$res=$obj-> executequery($sql);
$rows=mysqli_num_rows($res);
if($rows > 0){
    echo"<script>alert('Already Exists');window.location='package.php'</script>";
}
else{
    $sql1="INSERT INTO tbl_package(package_name,package_amount,package_image,package_duration,package_description,category_id) VALUES('$n','$a','$image','$d','$des','$cid')";
    $result=$obj->executequery($sql1);
    
    if($result==1){
      echo "<script>alert('Registration Sucessfull');window.location='package.php' </script>";
}
else{
  echo "<script>alert('Registration failed!');window.location='package.php' </script>";
}

}
}
?>