<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $servicename=$_POST["service_name"];
    $servicedes=$_POST["service_description"];
    $image=$_FILES['service_image']['name'];
    $category_id=$_POST["category_id"];
    $amount=$_POST["service_amount"];

    move_uploaded_file($_FILES["service_image"]["tmp_name"],"../uploads/".$image);
    $sqlquery="SELECT * FROM tbl_service where service_name='$servicename'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
      echo "<script>alert('Already Exist!!');window.location='service.php'</script>";
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_service(service_name,service_image,service_description,category_id,service_amount) VALUES('$servicename','$image','$servicedes','$category_id','$amount')";
        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
         echo "<script>alert('Registration Succesful!!');window.location='service.php'</script>";
    
        }
        else
        {
        echo "<script>alert('Registration Failed!!');window.location='service.php'</script>";
}
}
}
?>