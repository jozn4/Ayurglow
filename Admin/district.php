<?php
include_once('header.php');
?>
<form action="districtaction.php" method="POST" enctype="multipart/form-data">
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
                          <label for="email2" >District Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="district_name" name="district_name"
                            placeholder="Enter name" required
                          />
                          
                                                  
                        </div>
                        
           
                      
                    <button class="btn btn-success" name="submit" >Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>
</form>
                <?php
include('footer.php');
?>