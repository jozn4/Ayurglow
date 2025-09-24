<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{
$n=$_POST['category_name'];
 $image=$_FILES['category_image']['name'];
 move_uploaded_file($_FILES["category_image"]["tmp_name"],"../uploads/".$image);

$sql= "select * from  tbl_category where category_name='$n'";
$res=$obj-> executequery($sql);
$rows=mysqli_num_rows($res);
if($rows > 0){
     echo"<script>alert('Already Exists');window.location='category.php'</script>";
}else{
       $sql="INSERT INTO tbl_category (category_name,category_image) VALUES('$n','$image')";
    $result=$obj->executequery($sql);
    
    if($result==1){
      echo "<script>alert('Registration Sucessfull');window.location='category.php' </script>";
}
else{
     echo "<script>alert('Registration failed!');window.location='category.php' </script>";
}

}
}
?>