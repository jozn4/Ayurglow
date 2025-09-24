<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{

 $a=$_POST['package'];
 $d=$_POST['service'];
 

$sql= "select * from  tbl_packageservice where package_id='$a' and service_id='$d'";
$res=$obj-> executequery($sql);
$rows=mysqli_num_rows($res);
if($rows > 0){
    echo"<script>alert('Already Exists');window.location='packservice.php'</script>";
}
else{
       $sql="INSERT INTO tbl_packageservice (package_id,service_id) VALUES('$a','$d')";
    $result=$obj->executequery($sql);
    
    if($result==1){
      echo "<script>alert('Registration Sucessfull');window.location='packservice.php' </script>";
}
else{
     echo "<script>alert('Registration failed!');window.location='packservice.php' </script>";
}

}
}
?>