<?php
session_start();
include_once("../dboperation.php");
include_once('header.php');
$obj = new dboperation();

// Get selected category (if any)
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

if ($selectedCategory != '') {
    $sql = "SELECT * FROM tbl_package WHERE category_id = '$selectedCategory'";   
} else {
    $sql = "SELECT * FROM tbl_package";
}
$res = $obj->executequery($sql);

$rid = $_SESSION['loginid'];
?>

<body class="blog-page">
<main class="main">
   <link href="css/dropdown.css" rel="stylesheet">

  <!-- Page Title -->
  <div class="page-title accent-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0">Packages</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="index.php">Home</a></li>
          <li class="current">Packages</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Dropdown for categories -->
  <div class="center-container">
    <head>
  <!-- Other head content -->
</head>

    <?php
    $sql1 = "SELECT * FROM tbl_category";
    $res1 = $obj->executequery($sql1);
    ?>
    <div class="dropdown-group">
      
      <form method="GET" action="">
        <select name="category" id="category" onchange="this.form.submit()">
          
          <option value="">-------Choose Category-------</option>
          <?php while ($dis = mysqli_fetch_array($res1)) { ?>
            <option value="<?php echo $dis['category_id']; ?>" 
              <?php if ($selectedCategory == $dis['category_id']) echo "selected"; ?>>
              <?php echo $dis['category_name']; ?>
            </option>
          <?php } ?>
        </select>
        
      </form>
    </div>
  </div>

  <!-- Packages Section -->
  <section id="blog-posts" class="blog-posts section">
    <div class="container">
      <div class="row gy-4">
        
        <?php while ($row = mysqli_fetch_array($res)) { ?>
          <div class="col-lg-4 col-md-6"> 
            <article class="position-relative h-100">

              <div class="post-img position-relative overflow-hidden">
                <img src="../uploads/<?php echo $row['package_image']; ?>" 
                     style="height:300px; width:100%; object-fit:cover;" 
                     alt="Package Image">
                <span class="post-date"><?php echo $row['package_duration']; ?></span>
              </div>

              <div class="post-content d-flex flex-column">
                <h3 class="post-title"><?php echo $row['package_name']; ?></h3>

                <div class="meta d-flex align-items-center">
                  <div class="d-flex align-items-center">
                    <i class="bi bi-cash-stack"></i> 
                    <span class="ps-2">$<?php echo $row['package_amount']; ?></span>
                  </div>
                </div>

                <p><?php echo $row['package_description']; ?></p>

                <hr>

                <a href="packageservice.php?packageid=<?php echo $row['package_id']; ?>" 
                   class="readmore stretched-link">
                  <span>View Services</span><i class="bi bi-arrow-right"></i>
                </a>
              </div>

            </article>
          </div>
        <?php } ?>

      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>
</main>
