<?php
    include_once("../../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $name=$_POST['customer_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $district=$_POST['district_id'];
    $location=$_POST['location_id'];
    $gender=$_POST['gender'];
    

$date=date('y-m-d');


    //move_uploaded_file($_FILES['image']['tmp_name'],"../upload/" .$image);
   // move_uploaded_file($_FILES['proof']['tmp_name'],"../upload/" .$image2);

    $sqlquery="SELECT * FROM tbl_customer where username='$username'";
    $result=$obj-> executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
          echo "<script>alert('Already Exist!!');window.location='Guestindex.php'</script>";
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_customer(customer_name,email,phone,username,password,district_id,location_id,reg_date,gender) VALUES('$name','$email','$phone','$username','$password','$district','$location','$date','$gender')";
        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
          echo "<script>alert('Registration Succesfully!!');window.location='../index.php'</script>";
    
        }
        else
        {
       echo "<script>alert('Registration Failed!!');window.location='../index.php'</script>";
}
}
}
?>