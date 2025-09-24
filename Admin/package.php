<?php
include_once('../dboperation.php');
$obj = new dboperation();
$sql="select * from tbl_category";
$res = $obj->executequery($sql);
include('header.php');
?>
<form action="packageaction.php" method="POST" enctype="multipart/form-data">
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
                          <!--<input
                            type="text"
                            class="form-control"
                            id="package_name" name="package_name"
                            placeholder="Select Category"
                          >-->
                          <label  >Package Name</label>
                          <input
                            type="text"
                            class="form-control"
                             name="package_name"
                            placeholder="Enter Package" required
                          >
                          
                          <label  >Amount</label>
                          <input
                            type="text"
                            class="form-control"
                             name="package_amount"
                            placeholder="Enter Amount"  required
                          >

                          <label >Package Image</label>
                          <input type="file"  class="form-control" name="package_image">
                          <label >Duration</label>
                          <input
                            type="text"
                            class="form-control"
                           name="package_duration"
                            placeholder="Enter Duration" required
                          >
                       <label >Package Description</label>
  <textarea
                            type="text"
                            class="form-control"
                           name="package_description"
                            placeholder="Enter Package Description" required>
</textarea>
                        </div>

                        
           
                      
                    <button class="btn btn-success" name="submit" >Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>

</form>
                <?php
include('footer.php');
?>