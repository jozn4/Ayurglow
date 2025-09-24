<?php
include ('header.php');
include ("../dboperation.php");
$obj=new dboperation();
$s=1;
$sql="select * from tbl_package";
$res=$obj->executequery($sql);

?>
<div class="row">
              <div class="col-md-15">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Basic Table</div>
                  </div>
                  <div class="card-body">
                    <div class="card-sub">
                      This is the basic table view of the ready dashboard :
                    </div>
                    <table id="multi-filter-select" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="multi-filter-select_info">
                      <thead>
                        <tr>
                          <th scope="col">Sl no.</th>
                          <th scope="col">package_name</th>
                          <th scope="col">package_amount</th>
                          <th scope="col">package_image</th>
                          <th scope="col">package_duration</th>
                          

                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($display=mysqli_fetch_array($res))
                        {


                      
                        ?>

                        <tr>
                          <td><?php echo $s++; ?></td>
                          <td><?php echo $display["package_name"]?></td>
                          <td><?php echo $display["package_amount"]?></td>
                          <td><img src="../uploads/<?php echo $display["package_image"];?>" alt="image" style="width:120px" ></td>
                          <td><?php echo $display["package_duration"]?></td>
                          <td><a href="packagedelete.php?package_id=<?php echo $display["package_id"];?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                            <a href="packageedit.php?package_id=<?php echo $display["package_id"];?>" class="btn btn-primary">Edit</a>
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