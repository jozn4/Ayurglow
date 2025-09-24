<?php
session_start();
include_once("../dboperation.php");
include_once("header.php");

$obj = new dboperation();

// 1. Count total packages
$sql_packages = "SELECT COUNT(*) AS total_packages FROM tbl_package";
$res_packages = $obj->executequery($sql_packages);
$row_packages = mysqli_fetch_assoc($res_packages);
$total_packages = $row_packages['total_packages'];

// 2. Count total services
$sql_services = "SELECT COUNT(*) AS total_services FROM tbl_service";
$res_services = $obj->executequery($sql_services);
$row_services = mysqli_fetch_assoc($res_services);
$total_services = $row_services['total_services'];

// 3. Count total customers
$sql_customers = "SELECT COUNT(*) AS total_customers FROM tbl_customer";
$res_customers = $obj->executequery($sql_customers);
$row_customers = mysqli_fetch_assoc($res_customers);
$total_customers = $row_customers['total_customers'];

// 4. Count paid bookings (package + service)
$sql_paid = "SELECT COUNT(*) AS paid_bookings FROM tbl_payment WHERE status='Paid'";
$res_paid = $obj->executequery($sql_paid);
$row_paid = mysqli_fetch_assoc($res_paid);
$paid_bookings = $row_paid['paid_bookings'];

// 5. Total income
$sql_income = "SELECT SUM(amount) AS total_income FROM tbl_payment WHERE status='Paid'";
$res_income = $obj->executequery($sql_income);
$row_income = mysqli_fetch_assoc($res_income);
$total_income = $row_income['total_income'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reports - Ayurglow</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style>
    .card-container {
      display: flex;
      justify-content: space-around;
      margin: 20px 0;
    }
    .report-card {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
      text-align: center;
      width: 220px;
    }
    .report-card h2 {
      font-size: 32px;
      margin: 10px 0;
      color: #008037;
    }
    .report-card p {
      font-size: 16px;
      color: #333;
    }
    .chart-container {
      width: 1000px;
      margin: 40px auto;
    }
  </style>
</head>
<body>
  <div class="container">

    <h1 style="text-align:center; margin-top:20px;">📊Reports</h1>

    <!-- Summary Cards -->
    <div class="card-container">
      <div class="report-card">
        <h2><?php echo $total_packages; ?></h2>
        <p>Total Packages</p>
      </div>
      <div class="report-card">
        <h2><?php echo $total_services; ?></h2>
        <p>Total Services</p>
      </div>
      <div class="report-card">
        <h2><?php echo $total_customers; ?></h2>
        <p>Total Customers</p>
      </div>
      <div class="report-card">
        <h2><?php echo $paid_bookings; ?></h2>
        <p>Paid Bookings</p>
      </div>
      <div class="report-card">
        <h2>₹<?php echo number_format($total_income, 2); ?></h2>
        <p>Total Income</p>
      </div>
    </div>

    <!-- Charts -->
    <div class="chart-container">
      <div id="piechart" style="height: 500px;"></div>
      <div id="barchart" style="height: 500px; margin-top:40px;"></div>
    </div>
  </div>

  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
      // Pie Chart (Distribution)
      var pieData = google.visualization.arrayToDataTable([
        ['Category', 'Count'],
        ['Packages', <?php echo $total_packages; ?>],
        ['Services', <?php echo $total_services; ?>],
        ['Customers', <?php echo $total_customers; ?>],
        ['Paid Bookings', <?php echo $paid_bookings; ?>]
      ]);

      var pieOptions = {
        title: 'Distribution of Records',
        pieHole: 0.4
      };

      var pieChart = new google.visualization.PieChart(document.getElementById('piechart'));
      pieChart.draw(pieData, pieOptions);

      // Bar Chart (Income vs Bookings)
      var barData = google.visualization.arrayToDataTable([
        ['Metric', 'Value'],
        ['Paid Bookings', <?php echo $paid_bookings; ?>],
        ['Total Income', <?php echo $total_income; ?>]
      ]);

      var barOptions = {
        title: 'Income and Bookings Overview',
        hAxis: {title: 'Value'},
        vAxis: {title: 'Metric'},
        legend: 'none'
      };

      var barChart = new google.visualization.BarChart(document.getElementById('barchart'));
      barChart.draw(barData, barOptions);
    }
  </script>
</body>
</html>

<?php include_once("footer.php"); ?>



