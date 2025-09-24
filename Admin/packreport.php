<?php
include_once("../dboperation.php");
$obj = new dboperation();

// Initialize variables
$startDate = '';
$endDate = '';
$reportHeading = '';

// Check if export button was clicked
if (isset($_POST['export'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $sql = "SELECT r.request_id, r.regdate, r.status, 
                   c.customer_name AS customer_name, 
                   p.package_name, p.package_amount
            FROM tbl_request r
            INNER JOIN tbl_package p ON r.psid = p.package_id AND r.type='package'
            INNER JOIN tbl_customer c ON r.customer_id = c.customer_id
            WHERE r.regdate BETWEEN '$startDate' AND '$endDate'
            ORDER BY r.regdate ASC";

    $results = $obj->executequery($sql);

    // Export to Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=package_detailed_report.xls");
    echo "Request ID\tDate\tCustomer Name\tPackage Name\tAmount\tStatus\n";

    $grandTotal = 0;
    while ($row = mysqli_fetch_assoc($results)) {
        $amount = $row['status'] == 'paid' ? $row['package_amount'] : 0;
        $grandTotal += $amount;
        echo "{$row['request_id']}\t{$row['regdate']}\t{$row['customer_name']}\t{$row['package_name']}\t{$amount}\t{$row['status']}\n";
    }
    echo "\t\t\t\tGrand Total\t$grandTotal\n";
    exit;
}

// If filter applied
if (isset($_POST['filter'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $startMonth = date("F", strtotime($startDate));
    $endMonth = date("F", strtotime($endDate));
    $year = date("Y", strtotime($startDate));
    $reportHeading = "$startMonth to $endMonth Package Detailed Report $year";

    $sql = "SELECT r.request_id, r.regdate, r.status, 
                   c.customer_name AS customer_name, 
                   p.package_name, p.package_amount
            FROM tbl_request r
            INNER JOIN tbl_package p ON r.psid = p.package_id AND r.type='package'
            INNER JOIN tbl_customer c ON r.customer_id = c.customer_id
            WHERE r.regdate BETWEEN '$startDate' AND '$endDate'
            ORDER BY r.regdate ASC";
} else {
    // Default: all requests
    $sql = "SELECT r.request_id, r.regdate, r.status, 
                   c.customer_name AS customer_name, 
                   p.package_name, p.package_amount
            FROM tbl_request r
            INNER JOIN tbl_package p ON r.psid = p.package_id AND r.type='package'
            INNER JOIN tbl_customer c ON r.customer_id = c.customer_id
            ORDER BY r.regdate ASC";
}

$results = $obj->executequery($sql);

include('header.php'); // HTML output starts here
?>
<br><br><br>
<!DOCTYPE html>
<html>
<head>
    <title>Package Detailed Report</title>
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

<h2>Package Report</h2>

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
                <th>Package Name</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grandTotal = 0;
            while($row = mysqli_fetch_assoc($results)) {
                $amount = $row['status'] == 'paid' ? $row['package_amount'] : 0;
                $grandTotal += $amount;
            ?>
            <tr>
                <td><?= $row['request_id'] ?></td>
                <td><?= $row['regdate'] ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td><?= $row['package_name'] ?></td>
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
    <p style="text-align:center;">No package requests found for selected date range.</p>
<?php } ?>

</body>
</html>
<br><br><br><br><br>
<?php
include('footer.php');
?>
