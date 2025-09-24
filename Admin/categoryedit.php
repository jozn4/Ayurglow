<?php
include('header.php');
include('../dboperation.php');

$obj=new dboperation();
if (isset($_GET["category_id"]))
{
    $catid=$_GET["category_id"];
    $sql="SELECT * FROM tbl_category WHERE category_id='$catid'";
    $res=$obj->executequery($sql);
    $display=mysqli_fetch_array($res);
}
?>
<form action="categoryeditaction.php" method="POST" enctype="multipart/form-data">
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
                          <label for="email2" >Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $display["category_name"];?>"  placeholder="Enter Category" >

                          <label class="" for="customFile">Category Image</label>
                          <input type="file"  class="form-control" name="category_image">
                          <td>
                            <img src="../uploads/<?php echo $display['category_image']; ?>" alt="image" style="width:120px; ">
</td>
                                                  
                        </div>

                        
                                       <input type="hidden" class="form-control" id="" name="category_id" value="<?php echo $catid?>"  placeholder="Enter Category" >

                      
                    <button class="btn btn-success" name="submit" >Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>

</form>
                <?php
include('footer.php');
?>