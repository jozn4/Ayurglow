<?php
include('header.php');
include('../dboperation.php');

$obj=new dboperation();
if (isset($_GET["location_id"]))
{
    $locationid=$_GET["location_id"];
    $sql="SELECT * FROM tbl_location WHERE location_id='$locationid'";
    $res=$obj->executequery($sql);
    $display=mysqli_fetch_array($res);
}
?>
<form action="locationeditaction.php" method="POST" enctype="multipart/form-data">
<div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Form Elements</div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2" >Location Name</label>
                            <input type="text" class="form-control" id="location_name" name="location_name" value="<?php echo $display["location_name"];?>"  placeholder="Enter Location" >
                           
                         
                        </div>

                        
                                       <input type="hidden" class="form-control" id="" name="location_id" value="<?php echo $locationid?>"  placeholder="Enter Location" >

                      
                    <button class="btn btn-success" name="submit" >Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>

</form>
                <?php
include('footer.php');
?>