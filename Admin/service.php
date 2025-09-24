<?php
include_once('header.php');
include_once("../dboperation.php");
$obj=new dboperation();
$sql="select * from tbl_category";
$res = $obj->executequery($sql);
?>
<form action="serviceaction.php" method="POST" enctype="multipart/form-data">
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
                          <label for="email2" >Select Category</label>
                          <select class="form-control" name="category_id"
                    id="selpackageid" onchange="this.form.submit()">

                    <option>--------Select Category-----------</option>
                  <?php

while($display= mysqli_fetch_array($res))
{ 

?>
<option value="<?php echo $display["category_id"]?>"> <?php echo $display["category_name"]?> </option> <?php
}
?>
</select>
                          
                   
                          <label for="email2" >Service Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="service_name" name="service_name"
                            placeholder="Enter Service" required
                          >
                          

                          <label class="" for="customFile">Service Image</label>
                          <input type="file"  class="form-control" name="service_image" required>
                          <label for="email2" >Description</label>
                          <textarea class="form-control"  name="service_description" id="comment" rows="5" required>  </textarea>
                           <label for="email2" >Amount</label>
                          <input
                            type="text"
                            class="form-control"
                             name="service_amount"
                            placeholder="Enter Amount Rs.." required
                          >                   

                    </div>
                    
                   
                    <button type="submit"  name="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-danger">Cancel</button>


</form>
                </div>
              </div>
            </div>
            </div>
              
<br><br><br><br><br><br><br><br><br>



               
        <!-- content-wrapper ends -->
      <?php
      include_once('footer.php');
      ?>


                      <label for="exampleInputUsername1">location name</label>
                      <input type="text" class="form-control"  name="location_name" id="location_name" placeholder="Location name">
                    </div>
                    
                   
                    <button type="submit"  name="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-danger">Cancel</button>





                          
                                                  
                        </div>

                        
           
                      
                    <button class="btn btn-success" name="submit" >Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>

</form>
                <?php
include('footer.php');
?>