



<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST["submit"]))
{
  $pid=$_POST['package_id'];
    $pname=$_POST['package_name'];
    $pd =$_POST['package_description'];
    $photo=$_FILES["package_image"]["name"];
    $amount=$_POST['package_amount'];
$pduration=$_POST['package_duration'];
    
    if($photo=="")
    {
         $sql="UPDATE tbl_package SET package_name='$pname',package_amount='$amount',package_description='$pd',package_duration='$pduration' WHERE package_id='$pid'";
    $result= $obj->executequery($sql);
    }

      else
    {

         move_uploaded_file($_FILES["package_image"]["tmp_name"],"../uploads/".$photo);
         $sql1="UPDATE tbl_package SET package_name='$pname',package_amount='$amount',package_description='$pd',package_duration='$pduration',package_image='$photo' WHERE package_id='$pid'";
         $result= $obj->executequery($sql1);
    }

    if($result == 1)    
    {
       echo "<script>alert('Update Successfully!');window.location='packageview.php'</script>";
    }
    else
    {
          echo "<script>alert('Update Failed!');window.location='packageview.php'</script>";
    
    }
}
?>