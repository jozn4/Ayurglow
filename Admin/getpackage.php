<?php
	if(isset($_POST["cid"])) 
	{
		$categoryid = $_POST["cid"];

		// You can replace this code with a database query to retrieve the states for the selected country
		include_once("../dboperation.php");
        $sql="select * from tbl_package where category_id=$categoryid";
        $obj=new dboperation();
        $result=$obj->executequery($sql);
        $s=1;
?>

 <option value="">--------Select Package-----------</option>

	<?php 
	while ($display = mysqli_fetch_array($result)) { ?>
		<option value="<?php echo $display["package_id"] ?>"> <?php echo $display["package_name"] ?> </option>
		 <?php
	}

      
      
      
    
}

?>

		
	
