<?php

include 'dbconfig.php';

 date_default_timezone_set("America/Denver");
 $todaydate = date("d/m/Y");
 echo $todaydate;
 $brokerarray = [];

 
 $accountexpiryres=$conn->query("select * from table_brokers where broker_account_expiry_date = '$todaydate'");
 $accountexpirynumrows = $accountexpiryres->num_rows;
    if ($accountexpirynumrows > 0)
    {
		while($accountexpiryrow=$accountexpiryres->fetch_array())
		{
			$brokerid = $accountexpiryrow['id'];
				
			array_push($brokerarray, $brokerid);
		}
	}
	
	if(count($brokerarray)>0)
	{	
		$imagesstring = '';
		
		foreach($brokerarray as $filesName)
		{
			if(empty($imagesstring))
			{
				$imagesstring = $filesName;
			}
			else
			{
				$imagesstring = $imagesstring.','.$filesName;
			}
		}
		 $allbrokerid = $imagesstring;
		 
		$from = "kb <noreply@kbs.com>";			
		$to="info@kbs.com";		
		$subject = "Account expired broker ids";		
		$message = "			
		<html>			
		<head>			
		<title>Kalyana Brokers</title>			
		<style>			
		table, th, tr 
		{				
		padding:10px;
		text-align:left;
		border-collapse:collapse;
		font-family:Arial,Helvetica, sans-serif;
		font-size:14px;			
		}			
		th
		{
			background-color:#148F77;
			color:white;
			font-weight:normal;
			width:200px;
		}
		</style>
		</head>
		<body>
		<p>Hello Sir,</p>
		<p>Account expired broker ids</p>
		<table style='border:1px solid black;'>
		<tr>
		<th style='border:1px solid black;'>Signup Source</th>
		<td style='border:1px solid black;'>Daily running cron</td>
		</tr>
		<tr>
		<th style='border:1px solid black;'>Broker ID</th>
		<td style='border:1px solid black;'>$allbrokerid</td>
		</tr>
		</table>
		<p>Thank you</p>
		</body>	
		</html>	
		";
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers.= 'From:'.$from."\r\n";
		mail($to,$subject,$message,$headers);
		
		$myString = $allbrokerid;
		$myArray = explode(',', $myString);
		foreach($myArray as $my_Array)
		{
			$sqls = "UPDATE table_brokers SET broker_payment='0' WHERE id = '$my_Array'";

			if ($conn->query($sqls) === TRUE)
			{
				echo json_encode(array("status" => "1","message" => "Expired account set successfully"));
			} 
			else 
			{
				echo json_encode(array("status" => "0","message" => "Something went wrong. Please try again later!"));
			}
			echo $my_Array.'<br>';  
		}
	}
			 
			 
			
 
	
?>