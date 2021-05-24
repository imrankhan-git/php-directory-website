<?php
include "../dbconfig.php";

if(isset($_POST['row_id'])) 
{
	$brokerid = $_POST['row_id'];

	$increasingpeoplecountres = $conn->query("select * from table_brokers where id = '$brokerid' order by id asc");
	$num_rows = $increasingpeoplecountres->num_rows;
	if($num_rows > 0)
	{
		$increasingpeoplecountrow = $increasingpeoplecountres->fetch_assoc();
		
		$id = $increasingpeoplecountrow['id'];
		$totalcount = $increasingpeoplecountrow['people_visit_count'];
		
		$totalcount = $totalcount + 1;
		
		 $sqls = "UPDATE table_brokers SET people_visit_count='$totalcount' where id = '$brokerid'";

		 if ($conn->query($sqls) === TRUE) 
		 {
			echo json_encode(array("status" => "1"));
		 }
		
	}
	else
	{
		echo json_encode(array("status" => "1"));
	}
}
else 
{
  echo json_encode(array("status" => "1"));
}
?>