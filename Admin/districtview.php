<?php
 include_once('header.php');
 include("../dboperation.php");
 $obj=new dboperation();

 $s=1;
 $sql="select * from tbl_district";
 $res=$obj->executequery($sql);
 ?>

            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Basic Table</div>
                  </div>
                  <div class="card-body">
                    <div class="card-sub">
                      This is the basic table view of the ready dashboard :
                    </div>
                    <table class="table mt-3">
                      <thead>
                        <tr>
                          <th scope="col">sl.no</th>
                          <th scope="col">district_name</th>
                    
                        
                        </tr>
                      </thead>
                      <tr>
                      <body>
                        <?php
                        while($display=mysqli_fetch_array($res))
                        {



                        
                          ?>

                        <tr>
                          <td><?php echo $s++;?></td>
                          <td><?php echo $display["district_name"]?></td>
                        
                
                        <td>
                        <a href="districtdelete.php?district_id=<?php echo $display["district_id"];?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                        <a href="districtedit.php?district_id=<?php echo $display["district_id"];?>" class="btn btn-primary">Edit</a>
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
 include_once('footer.php');
 
 ?>