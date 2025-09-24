<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{
$n=$_POST['district_name'];
 //$image=$_FILES['category_image']['name'];
 //move_uploaded_file($_FILES["category_image"]["tmp_name"],"../uploads/".$image);

$sql= "select * from  tbl_district where district_name='$n'";
$res=$obj-> executequery($sql);
$rows=mysqli_num_rows($res);
if($rows > 0){
     echo"<script>alert('Already Exists');window.location='district.php'</script>";
}else{
       $sql="INSERT INTO tbl_district (district_name) VALUES('$n')";
    $result=$obj->executequery($sql);
    
    if($result==1){
      echo "<script>alert('Registration Sucessfull');window.location='district.php' </script>";
}
else{
     echo "<script>alert('Registration failed!');window.location='district.php' </script>";
}

}
}
?>