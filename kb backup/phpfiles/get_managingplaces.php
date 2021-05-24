<?php
include "../dbconfig.php";

	if(isset($_POST['row_id']))
	{
		$row_id=$_POST['row_id'];
		
		$address_res=$conn->query("SELECT * FROM table_brokers where id='$row_id' order by id asc");
		$address_num_rows = $address_res->num_rows;
		if ($address_num_rows > 0)
		{
			while($address_row=$address_res->fetch_array())
			{
						
				echo json_encode(array( "status" => "1","message" => "Customer Details Retrieved!" , "data" => $address_row) );
			}
		}
		else
		{
			echo json_encode(array( "status" => "0","message" => "Value Not Found!" ) );
		}
	}
	else
	{
		echo json_encode(array( "status" => "0","message" => "ID Not Found!" ) );
	}

?>