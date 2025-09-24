<?php

include_once("../dboperation.php"); 
$obj = new dboperation();

// Fetch all feedbacks
$sql = "SELECT f.*, c.customer_name 
        FROM tbl_feedback f 
        INNER JOIN tbl_customer c ON f.customer_id = c.customer_id  where psid='$psid'
        ORDER BY f.regdate DESC";

$results = $obj->executequery($sql);
?>

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
            margin: 0 0 8px; 
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
    </style>
</head>
<body>

<h2>Feedbacks</h2>

<?php if(mysqli_num_rows($results) > 0): ?>
    <?php while($row = mysqli_fetch_assoc($results)): ?>
        <div class="feedback">
            <h4><?php echo $row['customer_name']; ?></h4>
            <p><?php echo $row['description']; ?></p>
            <span><?php echo $row['regdate']; ?></span>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="text-align:center; color:#555;">No feedbacks available.</p>
<?php endif; ?>

</body>
</html>
