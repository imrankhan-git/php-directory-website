<?php
include "../dbconfig.php";

if(isset($_POST['country_id'])) 
{
	$countryid = $_POST['country_id'];

	$gettingstateforcountryres = $conn->query("select * from table_state where country_code = '$countryid' order by id asc");
	$num_rows = $gettingstateforcountryres->num_rows;
	if($num_rows > 0)
	{
		echo "<option value=''>-Select State-</option>";
		while($gettingstateforcountryrow=$gettingstateforcountryres->fetch_array())
		{								
		echo "<option value='".$gettingstateforcountryrow['id']."'>".ucfirst($gettingstateforcountryrow['state_name'])."</option>";
		}
	}
	else
	{
		echo "<option value=''>-No States-</option>";
	}
}
else 
{
  echo "<option value=''>-No States-</option>";
}
?>