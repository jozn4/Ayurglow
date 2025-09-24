<?php
include_once('../dboperation.php');
$obj = new dboperation();
if (isset($_POST['request_id'], $_POST['amount'])) {
    $bid = intval($_POST['request_id']);
    $amount = floatval($_POST['amount']);
    $status = "paid";
    $date=date('y-m-d');

    $sql = "INSERT INTO tbl_payment (request_id, amount, status,date) 
            VALUES ('$bid', '$amount', '$status','$date')";
    $res = $obj->executequery($sql);

    if ($res) {
        $update = "UPDATE tbl_request SET status = 'paid' WHERE request_id = '$bid'";
        $obj->executequery($update);

        echo "<script>alert('Payment successful'); window.location='myrequests.php';</script>";
    } else {
        echo "<script>alert('Payment failed'); window.location='myrequests.php';</script>";
    }
}

?>