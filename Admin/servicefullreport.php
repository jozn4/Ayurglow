<?php


include_once("../dboperation.php");
$obj = new dboperation();

// Initialize variables
$startDate = '';
$endDate = '';
$reportHeading = '';

// Check if export button was clicked
$export = isset($_POST['export']);

// Base SQL: fetch all service requests with customer info
$sql = "SELECT r.request_id, r.regdate, r.status, 
               c.customer_name AS customer_name, 
               s.service_name, s.service_amount
        FROM tbl_request r
        INNER JOIN tbl_service s ON r.psid = s.service_id AND r.type='service'
        INNER JOIN tbl_customer c ON r.customer_id = c.customer_id
        ORDER BY r.regdate ASC";

if(isset($_POST['filter']) || $export){
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $startMonth = date("F", strtotime($startDate));
    $endMonth = date("F", strtotime($endDate));
    $year = date("Y", strtotime($startDate));
    $reportHeading = "$startMonth to $endMonth Service Detailed Report $year";

    $sql = "SELECT r.request_id, r.regdate, r.status, 
                   c.customer_name AS customer_name, 
                   s.service_name, s.service_amount
            FROM tbl_request r
            INNER JOIN tbl_service s ON r.psid = s.service_id AND r.type='service'
            INNER JOIN tbl_customer c ON r.customer_id = c.customer_id
            WHERE r.regdate BETWEEN '$startDate' AND '$endDate'
            ORDER BY r.regdate ASC";
}

$results = $obj->executequery($sql);

// Export to Excel
if($export){
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=service_detailed_report.xls");
    echo "Request ID\tDate\tCustomer Name\tService Name\tAmount\tStatus\n";

    $grandTotal = 0;
    while($row = mysqli_fetch_assoc($results)){
        $amount = $row['status'] == 'paid' ? $row['service_amount'] : 0;
        $grandTotal += $amount;
        echo "{$row['request_id']}\t{$row['regdate']}\t{$row['customer_name']}\t{$row['service_name']}\t{$amount}\t{$row['status']}\n";
    }
    echo "\t\t\t\tGrand Total\t$grandTotal\n";
    exit;
    
}
include_once('header.php');
?><br><br><br><br><br>

<!DOCTYPE html>
<html>
<head>
    <title>Service Report</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2, h3 { text-align: center; margin-bottom: 10px; }
        .date-filters { display: flex; justify-content: center; align-items: center; gap: 10px; flex-wrap: wrap; margin-bottom: 15px; }
        input[type="date"], input[type="submit"] { padding: 8px 12px; border-radius: 5px; outline: none; transition: 0.3s; }
        input[type="date"] { border: 1px solid #ccc; }
        input[type="date"]:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
        input[type="submit"] { background-color: #007bff; color: #fff; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #0056b3; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        tr:hover { background-color: #f9f9f9; }
        .export-btn { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>Service Detailed Report</h2>

<form method="POST" action="">
    <div class="date-filters">
        <label>From: </label>
        <input type="date" name="start_date" value="<?= $startDate ?>">
        <label>To: </label>
        <input type="date" name="end_date" value="<?= $endDate ?>">
        <input type="submit" name="filter" value="Filter">
    </div>
</form>

<?php if($reportHeading) { ?>
    <h3><?= $reportHeading ?></h3>
<?php } ?>

<?php if(mysqli_num_rows($results) > 0) { ?>

    <div class="export-btn">
        <form method="POST" action="">
            <input type="hidden" name="start_date" value="<?= $startDate ?>">
            <input type="hidden" name="end_date" value="<?= $endDate ?>">
            <input type="submit" name="export" value="Download Excel">
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Service Name</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grandTotal = 0;
            while($row = mysqli_fetch_assoc($results)) {
                $amount = $row['status'] == 'paid' ? $row['service_amount'] : 0;
                $grandTotal += $amount;
            ?>
            <tr>
                <td><?= $row['request_id'] ?></td>
                <td><?= $row['regdate'] ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td><?= $row['service_name'] ?></td>
                <td><?= $amount ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
            <?php } ?>
            <tr>
                <th colspan="4">Grand Total</th>
                <th colspan="2"><?= $grandTotal ?></th>
            </tr>
        </tbody>
    </table>

<?php } else { ?>
    <p style="text-align:center;">No service requests found for selected date range.</p>
<?php } ?>

</body>
</html>
<br><br><br><br><br><br>
<?php
include_once('footer.php');
?>