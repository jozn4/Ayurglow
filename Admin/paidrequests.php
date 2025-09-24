<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

// Fetch booking requests with paid status, include package/service details
$s = "paid";
$sql = "SELECT p.payment_id, p.status, p.amount,p.date,
               r.request_id, r.psid, r.customer_id, r.type,
               c.customer_name,
               pk.package_name, pk.package_amount,
               s.service_name, s.service_amount
        FROM tbl_payment p
        INNER JOIN tbl_request r ON r.request_id = p.request_id
        INNER JOIN tbl_customer c ON c.customer_id = r.customer_id
        LEFT JOIN tbl_package pk ON (r.type = 'package' AND r.psid = pk.package_id)
        LEFT JOIN tbl_service s ON (r.type = 'service' AND r.psid = s.service_id)
        WHERE p.status = '$s'";
$res = $obj->executequery($sql);

include("header.php");
?>
<br><br><br>
<div class="container mt-5">
    <h2 class="text-center mb-4">Paid Booking Requests</h2>
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Type</th>
                <th>Package/Service Name</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_array($res)) {
            // Choose name and amount dynamically
            $name   = ($row["type"] == "package") ? $row["package_name"]   : $row["service_name"];
            $amount = ($row["type"] == "package") ? $row["package_amount"] : $row["service_amount"];

            echo "<tr>
                    <td>{$i}</td>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['type']}</td>
                    <td>{$name}</td>
                    <td>{$row['date']}</td>
                    <td>{$amount}</td>
                    <td><span class='badge bg-" . 
                        ($row['status']=='paid' ? 'warning' : ($row['status']=='accepted' ? 'success' : 'danger')) . 
                        "'>{$row['status']}</span></td>
                  </tr>";
            $i++;
        }
        ?>
        </tbody>
    </table>
</div>

<?php include("footer.php"); ?>
