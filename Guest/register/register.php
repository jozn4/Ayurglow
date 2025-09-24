
<?php
 include("../../dboperation.php");
 $obj=new dboperation();

 $s=1;
 $sql="select * from tbl_district";
 $res=$obj->executequery($sql);
 ?>
<script src="../../jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    //alert("a")
    $("#district_id").change(function () {
      // alert("a")
      var district_id = $(this).val();

      // alert(district_id)


      $.ajax({
        url: "getlocation.php",
        method: "POST",
        data: { district_id: district_id },
        success: function (response) {
          $("#location_id").html(response);
        },
        error: function () {
          $("#location_id").html("Error occurred while getting location!");
        }
      });
    });
  });
</script>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Sign Up #2</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/pexels-alesiakozik-7796752.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 py-5">
            <h3>Register</h3>
            <form action="registeraction.php" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="fname">Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" placeholder="" id="fname" required>
                  </div>    
                </div>
               
               
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="" id="email" required>
                  </div>    
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lname">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="lname" required>
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lname">Username</label>
                    <input type="text" class="form-control" name="username" id="lname" required>
                  </div>    
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
              
                  <div class="form-group last mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Your Password" id="password" required  pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" title="Password must be at least 6 characters, include 1 letter, 1 number, 1 special character, and no spaces">
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lname">Gender</label>
                    Male<input type="radio" value="male" name="gender" checked>
                                        Female<input type="radio" value="female"name="gender" required>

                  </div>    
                </div>
                <div class="col-md-6">
              
                  <div class="form-group last mb-3">
                    <label for="re-password">Re-type Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Your Password" id="re-password" required  pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" title="Password must be at least 6 characters, include 1 letter, 1 number, 1 special character, and no spaces">
                  </div>
                </div>

            <div class="col-md-6">
                  <div class="form-group last mb-3">
                    <label for="password">District</label>
                    
                    <select class="form-control" name="district_id" id="district_id">
          <option>--------Select District-----------</option>
          <?php
          $sqlquery = "select * from tbl_district";
          $result = $obj->executequery($sqlquery);
          while ($display = mysqli_fetch_array($result)) { ?>
            <option value="<?php echo $display["district_id"] ?>"> <?php echo $display["district_name"] ?> </option>
            <?php
          }
          ?>
        </select>
                  </div>
                </div>
 <div class="col-md-6">
              
                  <div class="form-group last mb-3">
                     
                    <label for="password">Location</label>
                    
                  
<select class="form-control" name="location_id" id="location_id" placeholder="Location">
        </select> 
             </div>
                  </div>
              </div>

              
              <div class="d-flex mb-5 mt-4 align-items-center">
                <div class="d-flex align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Creating an account means you're okay with our <a href="#">Terms and Conditions</a> and our <a href="#">Privacy Policy</a>.</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
              </div>
              </div>

              <input type="submit" value="Register"  name="submit" class="btn px-5 btn-primary">

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

  </body>
</html>