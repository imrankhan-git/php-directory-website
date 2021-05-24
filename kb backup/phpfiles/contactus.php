<?php
include "../dbconfig.php";

if(empty($_POST['contactpersonname']) || empty($_POST['contactpersonemail']) || empty($_POST['contactpersonsubject'])|| empty($_POST['contactpersonmessage']))
{
	echo json_encode(array( "status" => "0","message" => "Please fill all * fields"));
}
else
{
	 date_default_timezone_set('Indian/Maldives');
	 $contactpersonname	 = addslashes(isset($_POST["contactpersonname"]) ? $_POST["contactpersonname"] : "");
	 $contactpersonemail = addslashes(isset($_POST["contactpersonemail"]) ? $_POST["contactpersonemail"] : "");
	 $contactpersonsubject = addslashes(isset($_POST["contactpersonsubject"]) ? $_POST["contactpersonsubject"] : "");
	 $contactpersonmessage = addslashes(isset($_POST["contactpersonmessage"]) ? $_POST["contactpersonmessage"] : "");
    
	 $created_date = date('d/m/Y h:i:s a', time());
	 $created_by = addslashes(isset($_POST["contactpersonname"]) ? $_POST["contactpersonname"] : "");
	 $created_ip = getenv('REMOTE_ADDR');
	 $geo1 = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$created_ip"));
	 $city1= $geo1["geoplugin_city"];
	 $region1 = $geo1["geoplugin_regionName"];
	 $country1 = $geo1["geoplugin_countryName"];
	 $created_location="$city1, $region1, $country1";
	 $created_source="Web";
	 
	 $sql = "insert into table_contactus(enquiry_person_name,enquiry_person_email,enquiry_person_subject,enquiry_person_message,created_by,created_date,created_ip,created_location,enquiry_solved_status,enquiry_source) values ('$contactpersonname','$contactpersonemail','$contactpersonsubject','$contactpersonmessage','$created_by','$created_date','$created_ip','$created_location',0,'$created_source')";
			

	 if($conn->query($sql) === TRUE)
	 {
		$last_id = $conn->insert_id;
		$from = "kb <noreply@kb.com>";			
		$to="info@kb.com";		
		$subject = "kb - Enquiry Received from contactus";		
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
		<p>Alert for Customer Sign up</p>
		<table style='border:1px solid black;'>
		<tr>
		<th style='border:1px solid black;'>Signup Source</th>
		<td style='border:1px solid black;'>$created_source</td>
		</tr>
		<tr>
		<th style='border:1px solid black;'>Enquiry ID</th>
		<td style='border:1px solid black;'>$last_id</td>
		</tr>
		<tr>
		<th style='border:1px solid black;'>Name</th>
		<td style='border:1px solid black;'>$contactpersonname</td>
		</tr>
		<tr>
		<th style='border:1px solid black;'>Email</th>
		<td style='border:1px solid black;'>$contactpersonemail</td>
		</tr>
		<tr>
		<th style='border:1px solid black;'>Subject</th>
		<td style='border:1px solid black;'>$contactpersonsubject</td>
		</tr>
		<tr>
		<th style='border:1px solid black;'>Message</th>
		<td style='border:1px solid black;'>$contactpersonmessage</td>
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
		
		
		
		echo json_encode(array( "status" => "1","message" => "Thank you for Contacting us.","messagetext" => "We have received your enquiry and we will get back to you soon."));
	 }
	 
	
}

	



?>