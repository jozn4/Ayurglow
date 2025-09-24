<?php
include('header.php');
include('../dboperation.php');

$obj=new dboperation();
if (isset($_GET["service_id"]))
{
    $serviceid=$_GET["service_id"];
    $sql="SELECT * FROM tbl_service WHERE service_id='$serviceid'";
    $res=$obj->executequery($sql);
    $display=mysqli_fetch_array($res);
    $row=$display["service_description"];
}
?>
<form action="serviceeditaction.php" method="POST" enctype="multipart/form-data">
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
                          <label for="email2" >Service Name</label>
                            <input type="text" class="form-control" id="service_name" name="service_name" value="<?php echo $display["service_name"];?>"  placeholder="Enter Service" >
                           
                            

                          <label class="" for="customFile">Service Image</label>
                          
                          <input type="file"  class="form-control" name="service_image">

                            <img src="../uploads/<?php echo $display["service_image"]; ?>" alt="image" style="width:120px; ">
<br>


                          <label for="email2" >Description</label>
                          <textarea class="form-control"  name="service_description" id="service_description" value="comment"> <?php echo htmlspecialchars($row);?> </textarea>
                           <label for="email2" >Service Name</label>
                            <input type="text" class="form-control" id="service_amount" name="service_amount" value="<?php echo $display["service_amount"];?>"  placeholder="Enter Service Amount" >
                            
                                                  
                        </div>

                        
                                       <input type="hidden" class="form-control" id="" name="service_id" value="<?php echo $serviceid?>"  placeholder="Enter Service" >

                      
                    <button class="btn btn-success" name="submit" >Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>

</form>
                <?php
include('footer.php');
?>