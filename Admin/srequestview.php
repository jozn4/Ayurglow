<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

// Fetch only SERVICE booking requests with pending or accepted status
$sql = "SELECT r.request_id, r.psid, r.customer_id, r.type, r.status, r.required_date,
               c.customer_name,
               s.service_name
        FROM tbl_request r
        INNER JOIN tbl_customer c ON r.customer_id = c.customer_id
        INNER JOIN tbl_service s ON r.psid = s.service_id
        WHERE r.type = 'service' 
          AND r.status IN ('pending','accepted')
        ORDER BY r.request_id DESC";
$res = $obj->executequery($sql);

include("header.php");
?>
<br><br><br>
<div class="container mt-5">
    <h2 class="text-center mb-4">Service Booking Requests</h2>
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Service Name</th>
                <th>Required Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>
                    <td>{$i}</td>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['service_name']}</td>
                    <td>{$row['required_date']}</td>
                    <td><span class='badge bg-" . 
                        ($row['status']=='pending' ? 'warning' : 'success') . 
                        "'>{$row['status']}</span></td>
                    <td>
                        <a href='acceptrequest.php?id={$row['request_id']}&status=accepted' class='btn btn-success btn-sm'>Accept</a>
                        <a href='acceptrequest.php?id={$row['request_id']}&status=rejected' class='btn btn-danger btn-sm'>Reject</a>
                    </td>
                  </tr>";
            $i++;
        }
        ?>
        </tbody>
    </table>
</div>

<?php include("footer.php"); ?>
