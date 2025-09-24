<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

// Ensure customer is logged in
if (!isset($_SESSION['loginid'])) {
    echo "<script>alert('Please login first!'); window.location='login.php';</script>";
    exit();
}

$customer_id = $_SESSION['loginid'];

// Fetch all requests for the logged-in customer
$sql = "SELECT 
    r.request_id,
    r.psid,
    r.type,
    r.status,
    r.required_date,
    p.package_name,
    p.package_description,p.package_amount,
    s.service_name,
    s.service_description,s.service_amount
FROM tbl_request r
LEFT JOIN tbl_package p  
       ON p.package_id = r.psid 
       AND r.type = 'package'
LEFT JOIN tbl_service s 
       ON s.service_id = r.psid 
       AND r.type = 'service'
WHERE r.customer_id = '$customer_id'
ORDER BY r.request_id DESC;
";
$res = $obj->executequery($sql);

include("header.php");
?>
<br>
<div class="container mt-5">
    <h2 class="text-center mb-4">My Booking Requests</h2>
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                
                <th>Package/Service Name</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Required Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_array($res)) {
        ?>
            <tr>
                <td><?php echo $i; ?></td>
             

                
               <td>  <?php
                        echo ($row["type"] == "package") ? $row["package_name"] : $row["service_name"];
                      ?></td>
                      <td><?php echo $row['type']; ?></td>
                       <td>
                      <?php
                        echo ($row["type"] == "package") ? $row["package_amount"] : $row["service_amount"];
                      ?>
                    </td>
                <td><?php echo $row['required_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <?php if ($row["status"] == 'accepted') { ?>
                        <a href="payment.php?request_id=<?php echo $row['request_id']; ?>" class="btn btn-warning btn-sm">Pay Now</a>
                    <?php } else { echo "-"; } ?>
                </td>
            </tr>
        <?php
            $i++;
        }
        ?>
        </tbody>
    </table>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php include("footer.php"); ?>
