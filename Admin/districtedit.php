<?php
include('header.php');
include('../dboperation.php');

$obj=new dboperation();
if (isset($_GET["district_id"]))
{
    $disid=$_GET["district_id"];
    $sql="SELECT * FROM tbl_district WHERE district_id='$disid'";
    $res=$obj->executequery($sql);
    $display=mysqli_fetch_array($res);
}
?>
<form action="" method="POST" enctype="multipart/form-data">
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
                          <label for="email2" >district Name</label>
                            <input type="text" class="form-control" id="district_name" name="district_name" value="<?php echo $display["district_name"];?>"  placeholder="Enter district" >

                          
                            
</td>
                                                  
                        </div>

                        
                                       <input type="text" class="form-control" id="" name="district_id" value="<?php echo $disid?>"  placeholder="Enter district" >

                      
                    <button class="btn btn-success" name="submit" >Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>

</form>
                <?php
include('footer.php');
?>