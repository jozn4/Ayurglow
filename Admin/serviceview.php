<?php
include ('header.php');
include ("../dboperation.php");
$obj=new dboperation();
$s=1;
$sql="select * from tbl_service";
$res=$obj->executequery($sql);

?>
<div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Basic Table</div>
                  </div>
                  <div class="card-body">
                   
                                        <table class="table table-striped mt-3">
                      <thead>
                        <tr>
                          <th scope="col">Sl no.</th>
                          <th scope="col">service_name</th>
                          
                          <th scope="col">service_image</th>
                          <th scope="col">service_description</th>
                          <th scope="col">service_amount</th>

                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($display=mysqli_fetch_array($res))
                        {


                      
                        ?>

                        <tr>
                          <td><?php echo $s++; ?></td>
                          <td><?php echo $display["service_name"]?></td>
                          
                          <td><img src="../uploads/<?php echo $display["service_image"];?>" alt="image" style="width:120px" ></td>
                          <td><?php echo $display["service_description"]?></td>
                          <td><?php echo $display["service_amount"]?></td>
                          <td>
                            <a href="servicedelete.php?service_id=<?php echo $display["service_id"];?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                            <a href="serviceedit.php?service_id=<?php echo $display["service_id"];?>" class="btn btn-primary">Edit</a>
                        </td>
                          
                        </tr>
                        <?php
                        }
                        ?>
                          
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php
                include('footer.php');
                ?>