<?php
include "../dbconfig.php";

if(isset($_POST['district_select'])) 
{
	$district_select = $_POST['district_select'];

	$increasingpeoplecountres = $conn->query("select * from table_district where district_name = '$district_select' order by id asc");
	$num_rows = $increasingpeoplecountres->num_rows;
	if($num_rows > 0)
	{
		$increasingpeoplecountrow = $increasingpeoplecountres->fetch_assoc();
		
		$id = $increasingpeoplecountrow['id'];
		$totalcount = $increasingpeoplecountrow['people_visit_count'];
		
		$totalcount = $totalcount + 1;
		
		 $sqls = "UPDATE table_district SET people_visit_count='$totalcount' where district_name = '$district_select' and id='$id'";

		 if ($conn->query($sqls) === TRUE) 
		 {
			 echo "1";
		 }
		
	}
	else
	{
		echo "0";
	}
}
else 
{
  echo "0";
}
?>