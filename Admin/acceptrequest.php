<?php
include_once("../dboperation.php");
$obj = new dboperation();

// Check if request ID and status are set
if (isset($_GET['id']) && isset($_GET['status'])) {
    $request_id = intval($_GET['id']);
    $status = $_GET['status'];

    // First get the type (service/package) for this request
    $sql1 = "SELECT type FROM tbl_request WHERE request_id='$request_id'";
    $res= $obj->executequery($sql1);
    $display= mysqli_fetch_array($res);
    $type = $display['type'];

    // Update the request status
    $sql = "UPDATE tbl_request SET status='$status' WHERE request_id='$request_id'";
    $result = $obj->executequery($sql);

    if ($result == 1) {
        if ($type == "service") {
            echo "<script>alert('Request has been $status successfully!'); window.location='srequestview.php';</script>";
            exit();
        } elseif ($type == "package") {
            echo "<script>alert('Request has been $status successfully!'); window.location='prequestview.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Something went wrong. Please try again.'); window.location='adminindex.php';</script>";
        exit();
    }
}
?>
