<?php
include_once("header.php"); 
include_once("../dboperation.php"); 
$obj = new dboperation();

// Fetch all feedbacks with package/service names
$sql = "SELECT f.*, c.customer_name, r.type,
               p.package_name, s.service_name
        FROM tbl_feedback f
        INNER JOIN tbl_customer c ON f.customer_id = c.customer_id
        INNER JOIN tbl_request r ON f.psid = r.psid
        LEFT JOIN tbl_package p ON r.psid = p.package_id AND r.type='package'
        LEFT JOIN tbl_service s ON r.psid = s.service_id AND r.type='service'
        ORDER BY f.regdate DESC";

$results = $obj->executequery($sql);
?>

<br><br><br><br>

<!DOCTYPE html>
<html>
<head>
    <title>Feedbacks</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            padding: 20px; 
            background-color: #f0f2f5; 
        }
        h2 {
            text-align: center; 
            color: #007bff; 
            margin-bottom: 30px;
        }
        .feedback { 
            border: 1px solid #ddd; 
            padding: 15px; 
            margin-bottom: 15px; 
            border-radius: 10px; 
            background: linear-gradient(135deg, #ffffff, #e6f0ff);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .feedback:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .feedback h4 { 
            margin: 0 0 5px; 
            color: #333; 
        }
        .feedback p { 
            margin: 5px 0; 
            color: #555; 
        }
        .feedback span { 
            font-size: 0.85em; 
            color: #888; 
        }
        .feedback .ps-name {
            font-weight: bold;
            color: #007bff;
        }
        .feedback .ps-type {
            font-weight: bold;
            color: #ff5733;
            margin-left: 5px;
        }
    </style>
</head>
<body>

<h2>Feedbacks</h2>

<?php if(mysqli_num_rows($results) > 0): ?>
    <?php while($row = mysqli_fetch_assoc($results)): ?>
        <div class="feedback">
            <h4>
                <?php echo $row['customer_name']; ?> 
                <span class="ps-name">
                    <?php echo $row['type']=='package' ? $row['package_name'] : $row['service_name']; ?>
                </span>
                <span class="ps-type">
                    [<?php echo ucfirst($row['type']); ?>]
                </span>
            </h4>
            <p><?php echo $row['description']; ?></p>
            <span><?php echo $row['regdate']; ?></span>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="text-align:center; color:#555;">No feedbacks available.</p>
<?php endif; ?>

</body>
</html>

<?php
include_once("footer.php"); 
?>
