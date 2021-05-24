<?php	session_start(); // Starting Session
   include "../dbconfig.php";
   
   if(empty($_POST["customerfirstname"]) || empty($_POST["customerlastname"]) || empty($_POST["customeremail"]) || empty($_POST["customerpassword"]))   {
      echo json_encode(array("status" => "0","message" => "Please fill all details"));
   }  
   else
   {  
     date_default_timezone_set('Indian/Maldives');
     $signup_datetime = date('d/m/Y h:i:s a', time());
     $adminfirstname = isset($_POST["customerfirstname"]) ? $_POST["customerfirstname"] : "";
	 $adminlastname = isset($_POST["customerlastname"]) ? $_POST["customerlastname"] : "";
     $adminemail = isset($_POST["customeremail"]) ? $_POST["customeremail"] : "";
	 $adminmobile = isset($_POST["customermobile"]) ? $_POST["customermobile"] : "";
     $adminpassword = isset($_POST["customerpassword"]) ? $_POST["customerpassword"] : "";
     $adminpassword = md5($adminpassword);
     $adminpassword = trim($adminpassword);
     $admin_ip = getenv('REMOTE_ADDR');
     $admin_client= $_SERVER['HTTP_USER_AGENT'];
     $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$admin_ip"));
     $city = $geo["geoplugin_city"];
     $region = $geo["geoplugin_regionName"];
     $country = $geo["geoplugin_countryName"];
     $adminlocation="$city, $region, $country";
     $admin_signup_source = "WEB";	
	 
	 $customernumres = $conn->query("SELECT * FROM table_customers order by id desc limit 1");
	 $customernumrow = $customernumres->fetch_assoc();
	 $num_rows = $customernumres->num_rows;
	 if ($num_rows > 0)
	 {
		 $id = $customernumrow['id'];
		 $customerid = $id + 1;
		 $customernumid = "customer".$customerid;
	 }
	 else
	 {
		 $customernumid = "customer1";
	 }
		 
	 $sql = "select * from table_customers where customer_email='$adminemail'";
	 $result = $conn->query($sql);
	 if ($result->num_rows > 0) 
	 {
	   echo json_encode(array("status" => "1","message" => "User already exists"));
	 }
	 else
	 {
	  		 $sql2 = "insert into table_customers(customer_id,customer_first_name,customer_last_name,customer_email,customer_mobile,customer_password,customer_account_status,created_by,created_date,created_ip,created_location,status,created_source) values ('$customernumid','$adminfirstname','$adminlastname','$adminemail','$adminmobile','$adminpassword',0,'$adminfirstname','$signup_datetime','$admin_ip','$adminlocation',1,'$admin_signup_source')";
				
			 if($conn->query($sql2) === true)		  
			 {			
				$last_id = $conn->insert_id;		 
				$from = "KB <noreply@kb.com>";			
				$to="info@kb.com";		
				$subject = "User Signup Alert From KB";		
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
				<th style='border:1px solid black;'>Signup Source</th>
				<td style='border:1px solid black;'>$admin_signup_source</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Name</th>
				<td style='border:1px solid black;'>$adminfirstname $adminlastname</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Email</th>
				<td style='border:1px solid black;'>$adminemail</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Date and time</th>
				<td style='border:1px solid black;'>$signup_datetime</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Ip</th>
				<td style='border:1px solid black;'>$admin_ip</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Location</th>
				<td style='border:1px solid black;'>$adminlocation</td>
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
				
				
		
		     $inserteddatares = $conn->query("SELECT * FROM table_customers where id = '$last_id' order by id desc limit 1");
			 $inserteddatarow = $inserteddatares->fetch_assoc();
			 $insertedtotalrow = $inserteddatares->num_rows;
			 if ($insertedtotalrow > 0)
			 {
				 echo json_encode(array("status" => "1","message" => "Registered Successfully"));
				 
				 $sessioncustomerusername  = $inserteddatarow['customer_first_name'];
				 $sessioncustomeruseremail = $inserteddatarow['customer_email'];
				
				$_SESSION['kb_customer_name']  = $sessioncustomerusername;
			    $_SESSION['kb_customer_email'] = $sessioncustomeruseremail;
			    $_SESSION['kb_login_identify']  = "1"; /* This field is used by me to identify the login user is broker or customer */
				
				
			}
			else
			{
				echo json_encode(array("status" => "0","message" => "Something went wrong please try again"));
			}
	 }          
   }
   }
?>
