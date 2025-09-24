<?php
include_once('header.php');

include_once("../dboperation.php");
$obj=new dboperation();
$sql="select * from tbl_package";
$res = $obj->executequery($sql);
$s="select * from tbl_category";
$r= $obj->executequery($s);
?>

<script src="../jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
            //alert("a")
			$("#catid").change(function() {
               // alert("a")
				var categoryid = $(this).val();
                // alert(district_id)     
				$.ajax({
					url: "getpackage.php",
					method: "POST",
					data: { 
            cid: categoryid },
					success: function(response) 
                    {
						$("#pid").html(response);
					},
					error: function() 
                    {
						$("#pid").html("Error occurred while getting location!");
					}
				});
			});
        });
</script>

<script>
   
		$(document).ready(function() {
            //alert("a")
			$("#catid").change(function() {
               // alert("a")
				var category_id = $(this).val();

                // alert(district_id)

                
				$.ajax({
					url: "getservice.php",
					method: "POST",
					data: { catid: category_id },
					success: function(response) 
                    {
						$("#sid").html(response);
					},
					error: function() 
                    {
						$("#sid").html("Error occurred while getting location!");
					}
				});
			});
        });
</script>




<div class="main-panel">   <br><br>     
        <div class="content-wrapper">
          <br><br>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
               <br><br>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Package Service Registration</h4>
                  <p class="card-description">
                    
                  </p>
                 
                  <form  action="packserviceaction.php" class="forms-sample" method="post">
                    <div class="form-group">

<!------------------------------------------------------------------------->

                    <label>select category</label>
                    <select class="form-control" name="category"
                    id="catid" onchange="this.form.submit()">

                    <option>--------Select Category-----------</option>
                  <?php
                     while($dis= mysqli_fetch_array($r))
                    { ?>

                    <option value="<?php echo $dis["category_id"]?>"> <?php echo $dis["category_name"]?> </option> <?php
                      }
                      ?>
                      </select>

<!------------------------------------------------------------------------>


                    <label>select a package</label>

                    <select class="form-control" name="package"
                    id="pid" onchange="this.form.submit()">

                    <option>--------Select Package-----------</option>
                 
                    </select>


<!---------------------------------------------------------------------------->


                     <label>select a service</label>

                    <select class="form-control" name="service" id="sid"
                     onchange="this.form.submit()">
                    
                    <option>--------Select service-----------</option>
                
                  </select>

<!--------------------------------------------------------------------------------------------------------------------->            
                    
                   <br><br>
                    <button type="submit"  name="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-danger">Cancel</button>



                  </form>
                </div>
              </div>
            </div>
            </div>
              



</div></div>
