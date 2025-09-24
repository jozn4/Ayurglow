
<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST["submit"]))
{$service_id=$_POST['service_id'];
    $sname=$_POST['service_name'];
    $sd =$_POST['service_description'];
    $photo=$_FILES["service_image"]["name"];
    $amount=$_POST['service_amount'];

    
    if($photo=="")
    {
         $sql="UPDATE tbl_service SET service_name='$sname',service_amount='$amount',service_description='$sd' WHERE service_id='$service_id'";
    $result= $obj->executequery($sql);
    }

      else
    {

         move_uploaded_file($_FILES["service_image"]["tmp_name"],"../uploads/".$photo);
         $sql1="UPDATE tbl_service SET service_name='$sname',service_amount='$amount',service_description='$sd',service_image='$photo' WHERE service_id='$service_id'";
         $result= $obj->executequery($sql1);
    }

    if($result == 1)    
    {
       echo "<script>alert('Update Successfully!');window.location='serviceview.php'</script>";
    }
    else
    {
          echo "<script>alert('Update Failed!');window.location='serviceview.php'</script>";
    
    }
}
?>