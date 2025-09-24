getlocation.php:: <?php
include_once("../../dboperation.php");
$obj = new dboperation();
$districtid = $_POST['district_id'];
$sql = "SELECT * FROM tbl_location  l inner join tbl_district d on l.district_id=d.district_id  where l.district_id='$districtid'";
$result = $obj->executequery($sql);
?>
<div class="form-group">
  <label for="exampleSelectGender">location</label>
  <select class="form-control" id="location_id" name='location_id'>
    <option value='' selected disabled>-----Choose your Location-----</option>
    <?php
    while ($display = mysqli_fetch_array($result)) {
      ?>
      <option value="<?php echo $display['location_id']; ?>"><?php echo $display['location_name']; ?></option>
      <?php
    }
    ?>
  </select>
</div>