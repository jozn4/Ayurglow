<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $locationid = $_POST['location_id'];
    $locationname = $_POST['location_name'];
    
    $sql = "UPDATE tbl_location SET location_name='$locationname' WHERE location_id=$locationid";
    $result = $obj->executequery($sql);

    if ($result == 1) {
        echo "<script>alert('Saved Successfully');window.location='locationview.php'</script>";
    } else {
        echo "<script>alert('Update failed');window.location='locationview.php'</script>";
    }
}
?>
