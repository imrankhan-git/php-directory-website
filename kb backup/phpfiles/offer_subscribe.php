<?php
include "../dbconfig.php";

if(empty($_POST['offeremail']))
{
	echo json_encode(array( "status" => "0","message" => "Please fill all * fields"));
}
else
{
	 date_default_timezone_set('Indian/Maldives');
	 $offeremail	 = addslashes(isset($_POST["offeremail"]) ? $_POST["offeremail"] : "");
    
	 $created_date = date('d/m/Y h:i:s a', time());
	 $created_by = "Customer";
	 $created_ip = getenv('REMOTE_ADDR');
	 $geo1 = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$created_ip"));
	 $city1= $geo1["geoplugin_city"];
	 $region1 = $geo1["geoplugin_regionName"];
	 $country1 = $geo1["geoplugin_countryName"];
	 $created_location="$city1, $region1, $country1";
	 $created_source="Web";
	 
	 $sql = "insert into table_subscribe(customer_email,created_by,created_date,created_ip,created_location) values ('$offeremail','$created_by','$created_date','$created_ip','$created_location')";
			

	 if($conn->query($sql) === TRUE)
	 {
		$last_id = $conn->insert_id;
		$from = "KB <noreply@kb.com>";			
		$to="info@kb.com";		
		$subject = "KB - Subscribe email alert";		
		$message = "			
		<html>			
		<head>			
		<title>KB</title>			
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
		<p>Alert for Customer Sign up</p>
		<table style='border:1px solid black;'>
		
		<tr>
		<th style='border:1px solid black;'>Enquiry ID</th>
		<td style='border:1px solid black;'>$last_id</td>
		</tr>
		
		<tr>
		<th style='border:1px solid black;'>Email</th>
		<td style='border:1px solid black;'>$offeremail</td>
		</tr>
		
		<tr>
		<th style='border:1px solid black;'>Date and time</th>
		<td style='border:1px solid black;'>$created_date</td>
		</tr>
		<tr>
		<th style='border:1px solid black;'>Ip</th>
		<td style='border:1px solid black;'>$created_ip</td>
		</tr>
		<tr>
		<th style='border:1px solid black;'>Location</th>
		<td style='border:1px solid black;'>$created_location</td>
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
		
		
		
		echo json_encode(array( "status" => "1","message" => "Thank you for your free subscription.","messagetext" => "We will notify you when we have offers for you."));
	 }
	 
	
}

	



?>