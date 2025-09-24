<?php
include('header.php');
include('../dboperation.php');

$obj=new dboperation();
if (isset($_GET["package_id"]))
{
    $packid=$_GET["package_id"];
    $sql="SELECT * FROM tbl_package WHERE package_id='$packid'";
    $res=$obj->executequery($sql);
    $display=mysqli_fetch_array($res);
}
?>
<form action="packageeditaction.php" method="POST" enctype="multipart/form-data">
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
                          <label for="email2" >Package Name</label>
                            <input type="text" class="form-control" id="package_name" name="package_name" value="<?php echo $display["package_name"];?>"  placeholder="Enter Package" >
                            <label for="email2" >Package Amount</label>
                            <input type="text" class="form-control" id="package_amount" name="package_amount" value="<?php echo $display["package_amount"];?>"  placeholder="Enter Package Amount" >
                            

                          <label for="email2" >Package Duration</label>
                            <input type="text" class="form-control" id="package_duration" name="package_duration" value="<?php echo $display["package_duration"];?>"  placeholder="Enter Package Duration" >
                            
                          <td>
                            <label class="" for="customFile">Package Image</label>
                            <input type="file"  class="form-control" name="package_image">


                            <img src="../uploads/<?php echo $display['package_image']; ?>" alt="image" style="width:120px; ">
</td>
                                                  
                        </div>

                        
                                       <input type="hidden" class="form-control" id="" name="package_id" value="<?php echo $packid?>"  placeholder="Enter Package" >

                      
                    <button class="btn btn-success" name="submit" >Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>

</form>
                <?php
include('footer.php');
?>