<?php
include "../dbconfig.php";

if(isset($_POST['state_select'])) 
{
	$state_select = $_POST['state_select'];

	$gettingdistrictfromstateres = $conn->query("select * from table_district where state_code = '$state_select' order by id asc");
	$num_rows = $gettingdistrictfromstateres->num_rows;
	if($num_rows > 0)
	{
		while($gettingdistrictfromstaterow=$gettingdistrictfromstateres->fetch_array())
		{								
		echo "<option value='".ucfirst($gettingdistrictfromstaterow['district_name'])."'>".ucfirst($gettingdistrictfromstaterow['district_name'])."</option>";
		}
	}
	else
	{
		echo "<option value=''>-No Cities-</option>";
	}
}
else 
{
  echo "<option value=''>-No Cities-</option>";
}
?>