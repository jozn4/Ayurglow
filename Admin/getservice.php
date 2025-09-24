<?php
	if(isset($_POST["catid"])) 
	{
		$categoryid = $_POST["catid"];

		// You can replace this code with a database query to retrieve the states for the selected country
		include_once("../dboperation.php");
        $sql="select * from tbl_service where category_id=$categoryid";
        $obj=new dboperation();
        $result=$obj->executequery($sql);
        $s=1;
?>

 <option value="">--------Select Service-----------</option>

	<?php 
	while ($display = mysqli_fetch_array($result)) { ?>
		<option value="<?php echo $display["service_id"] ?>"> <?php echo $display["service_name"] ?> </option>
		 <?php
	}

      
      
      
    
}

?>

		
	
