<?php
  include("header.php");
  ?>
	<script>
		$(document).ready(function() {
            //alert("a")
			$("#packageid").change(function() {
               // alert("a")
				var packageid = $(this).val();

                // alert(district_id)

                
				$.ajax({
					url: "getservice.php",
					method: "POST",
					data: { pid: packageid },
					success: function(response) 
                    {
						$("#serviceid").html(response);
					},
					error: function() 
                    {
						$("#serviceid").html("Error occurred while getting location!");
					}
				});
			});
		});
	</script>

</head>
<body>
   
        <?php
        include_once("../dboperation.php");
                $obj=new dboperation();

       
       
        ?>


<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">View Service</h4>
      <p class="card-description">Select a package to view services</p>
     
        <div class="form-group">
          <label>Select a Package</label>
          <select class="form-control" name="packageid" id="packageid" onchange="this.form.submit()">
            <option value="">--------Select Package-----------</option>
            <?php
         $sql="select * from tbl_package";
         $result=$obj->executequery($sql);
            while ($r = mysqli_fetch_array($result)) 
            { ?>
              <option value="<?php echo $r["package_id"]; ?>">
                <?php echo $r["package_name"]; ?>
              </option>
            <?php } ?>


          </select>
        </div>
      
   

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Sl.No</th>
        <th>Services</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="serviceid">
     
      
     
    </tbody>
  </table>




  </div>
  </div>
</body>
</html>