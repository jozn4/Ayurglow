<?php
include_once("../dboperation.php");
$obj=new dboperation();
if (isset($_POST['submit']))
{
    $id=$_POST['category_id'];
    $Category_name=$_POST['category_name'];
    $Categoryimg=$_FILES["category_image"]["name"];
    move_uploaded_file($_FILES["category_image"]["tmp_name"], "../Uploads/".$Categoryimg);
    if($Categoryimg=='')
    {
    $sql1="UPDATE tbl_category set category_name='$Category_name' where category_id=$id";
    $result=$obj->executequery($sql1);
    }
    else{
        $sql="UPDATE tbl_category set category_name='$Category_name', category_image='$Categoryimg' WHERE category_id='$id' ";
    $result=$obj->executequery($sql);
    }
    if ($result == 1){
     echo "<script>alert('Saved Succesfully');window.location='categoryview.php' </script>";
    }
    else{
     echo "<script>alert('Registration failed');window.location='categoryview.php' </script>";
    }
}
?>