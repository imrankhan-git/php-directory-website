<?php
session_start();
include "../dbconfig.php";

if(empty($_POST['agentfirstname']) || empty($_POST['agentlastname']) || empty($_POST['agentemail']) || empty($_POST['agentpassword'])|| empty($_POST['agentmobile']) || empty($_POST['agentwhatsappnumber']) || empty($_POST['agentgender']) || empty($_POST['agentaddress']) || empty($_POST['agentsuccessfullmarriages']))
{
	echo json_encode(array( "status" => "0","message" => "Please fill all * fields"));
}
else
{
	 date_default_timezone_set('Indian/Maldives');
	 $agentfirstname = addslashes(isset($_POST["agentfirstname"]) ? $_POST["agentfirstname"] : "");
	 $agentlastname = addslashes(isset($_POST["agentlastname"]) ? $_POST["agentlastname"] : "");
	 $agentemail = addslashes(isset($_POST["agentemail"]) ? $_POST["agentemail"] : "");
	 $agentpassword = addslashes(isset($_POST["agentpassword"]) ? $_POST["agentpassword"] : "");
	  
     $agentpassword = md5($agentpassword);
     $agentpassword = trim($agentpassword);
	 
	 $agentmobile = addslashes(isset($_POST["agentmobile"]) ? $_POST["agentmobile"] : "");
	 $agentalternatemobile = addslashes(isset($_POST["agentalternatemobile"]) ? $_POST["agentalternatemobile"] : "");
	 $agentwhatsappnumber = addslashes(isset($_POST["agentwhatsappnumber"]) ? $_POST["agentwhatsappnumber"] : "");
	 
	 $agentgender = addslashes(isset($_POST["agentgender"]) ? $_POST["agentgender"] : "");
	 
	 $agentdob = addslashes(isset($_POST["agentdob"]) ? $_POST["agentdob"] : "");
	 $agentaddress = addslashes(isset($_POST["agentaddress"]) ? $_POST["agentaddress"] : "");
	 
	 
	 
	 
	 $agentsuccessfullmarriages = addslashes(isset($_POST["agentsuccessfullmarriages"]) ? $_POST["agentsuccessfullmarriages"] : "");
	 $agentmanaginglocation = addslashes(isset($_POST["hidden_agentmanaginglocation"]) ? $_POST["hidden_agentmanaginglocation"] : "");
	 
	 
	 $agentreferedby = addslashes(isset($_POST["agentreferedby"]) ? $_POST["agentreferedby"] : "");
	 
	 $countryselected = addslashes(isset($_POST["country_select1"]) ? $_POST["country_select1"] : "");
	 $stateselected = addslashes(isset($_POST["state_select1"]) ? $_POST["state_select1"] : "");
	 
	 $agentreferedby = str_replace(' ', '', $agentreferedby);
	 
	 $created_date = date('d/m/Y h:i:s a', time());
	 $created_by = addslashes(isset($_POST["agentfirstname"]) ? $_POST["agentfirstname"] : "");
	 $created_ip = getenv('REMOTE_ADDR');
	 $geo1 = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$created_ip"));
	 $city1= $geo1["geoplugin_city"];
	 $region1 = $geo1["geoplugin_regionName"];
	 $country1 = $geo1["geoplugin_countryName"];
	 $created_location="$city1, $region1, $country1";
	 $created_source="Web";
	 
	 $todaydate = date("d/m/Y");

     /*$expirydate = date('d/m/Y', strtotime('+1 years'));*/
	 
	 $expirydate = date('d/m/Y', strtotime('+ 31 days'));
	 
	 /*$expirydate = "31/05/2020";*/
	 
	 $usercheckres = $conn->query("SELECT * FROM table_brokers where broker_email = '$agentemail' order by id desc limit 1");
	 $usercheckrow = $usercheckres->fetch_assoc();
	 $usernum_rows = $usercheckres->num_rows;
	 if ($usernum_rows > 0)
	 {
		 echo json_encode(array("status" => "0","message" => "User already Exist"));
	 }
	 else
	 {
		 $brokernumres = $conn->query("SELECT * FROM table_brokers order by id desc limit 1");
		 $brokernumrow = $brokernumres->fetch_assoc();
		 $num_rows = $brokernumres->num_rows;
		 if ($num_rows > 0)
		 {
			 $id = $brokernumrow['id'];
			 $brokerid = $id + 1;
			 $brokernumid = "broker".$brokerid;
		 }
		 else
		 {
			 $brokernumid = "broker1";
		 }
		 
		 $referalcodeautogenerate = generateRandomString();
		 
		 $randomnumber = $brokernumid.'_'.rand(10000,99999);
		 
		 $sql = "insert into table_brokers(broker_id,broker_first_name,broker_last_name,broker_email,broker_password,broker_mobile,broker_whatsapp_number,broker_gender,broker_dob,broker_proof,broker_success_marriage,broker_managing_places,broker_payment,broker_referal_code,broker_invited_by,amount_refund_status,broker_address,broker_alternate_mobile,broker_account_status,broker_account_expiry_date,original_or_dummy,created_by,created_date,created_ip,created_location,status,created_source,broker_country,broker_state) values ('$brokernumid','$agentfirstname','$agentlastname','$agentemail','$agentpassword','$agentmobile','$agentwhatsappnumber','$agentgender','$agentdob','0','$agentsuccessfullmarriages','$agentmanaginglocation',1,'$referalcodeautogenerate','$agentreferedby',0,'$agentaddress','$agentalternatemobile',0,'$expirydate',1,'$created_by','$created_date','$created_ip','$created_location',1,'$created_source','$countryselected','$stateselected')";
			

			 if($conn->query($sql) === TRUE)
			 {
				$last_id = $conn->insert_id;
				$from = "kb <noreply@kb.com>";			
				$to="info@kb.com";		
				$subject = "Broker Signup Alert From kb Brokers";		
				$message = "			
				<html>			
				<head>			
				<title>kb</title>			
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
				<th style='border:1px solid black;'>Broker ID</th>
				<td style='border:1px solid black;'>$last_id</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Refered by</th>
				<td style='border:1px solid black;'>$agentreferedby</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Name</th>
				<td style='border:1px solid black;'>$agentfirstname $agentlastname</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Email</th>
				<td style='border:1px solid black;'>$agentemail</td>
				</tr>
				<tr>
				<th style='border:1px solid black;'>Mobile</th>
				<td style='border:1px solid black;'>$agentmobile</td>
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
				
				
				/* Email with Verification Link */
				
				
		$email_encoded = rtrim(strtr(base64_encode($agentemail), '+/', '-_'), '=');
		
	    $verificationlink = "https://yourdomain.com/broker_email_verification.php?email_verification_link=".$email_encoded;
		
		
		
		$from2 = "kb <noreply@kb.com>";
		$to2=$agentemail;
		$subject2 = "kb:Email Verification Link";

		$message2 = "
		<div dir='ltr'>
		   <br><br>
		   <div class='gmail_quote'>
			  <div>
				 <table bgcolor='' border='0' cellpadding='0' cellspacing='0' width='100%'>
					<tbody>
					   <tr>
						  <td bgcolor='' class='m_2114530173431233196section-padding'>
							 <table align='center' border='0' cellpadding='0' cellspacing='0' class='m_2114530173431233196wrapper'>
								<tbody>
								   <tr>
									  <td class='m_2114530173431233196header-mobile-wrapper'>
										 <table border='0' cellpadding='0' cellspacing='0' width='100%'>
											<tbody>
											   <tr>
												  <td width='100%'>
													 <table border='0' cellpadding='0' cellspacing='0' style='border-bottom:4px solid #ececec;margin:auto'>
														<tbody>
														   <tr>
															  <td style='padding:20px 50px 15px'><a href='https://kb.com/' target='_blank'> 
															  <img width='250' style='display:inline;float:none;text-align:center;width:250px;height:35px' src='https://kb.com/assets/images/kalyana_brokers_logo_big.png' alt='Kalyana Brokers'>                            
																 </a>                                                     
															  </td>
														   </tr>
														</tbody>
													 </table>
												  </td>
											   </tr>
											</tbody>
										 </table>
									  </td>
								   </tr>
								</tbody>
							 </table>
						  </td>
					   </tr>
					</tbody>
				 </table>
				 <table bgcolor='' border='0' cellpadding='0' cellspacing='0' width='100%'>
					<tbody>
					   <tr>
						  <td bgcolor='' class='m_2114530173431233196section-padding'>
							 <table align='center' border='0' cellpadding='0' cellspacing='0' class='m_2114530173431233196wrapper' style='width:70%;text-align:left'>
								<tbody>
								   <tr>
									  <td style='padding-top:20px'><span style='font-family:&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:17px;color:#000000;line-height:24px;font-weight:500'>Hi $agentfirstname,</span>                            </td>
								   </tr>
								   <tr>
									  <td style='padding-top:5px;padding-bottom:20px'>                                <span style='font-family:&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:15px;color:#4a4a4a;font-weight:normal;line-height:21px'>Use the below link to verify your email id<br> <a href='$verificationlink'>Click here to verify your email</a> <br>for your kb account<br><br>  Please do not share this link with anyone for security reasons.  <br><br></span>                            </td>
								   </tr>
								</tbody>
							 </table>
						  </td>
					   </tr>
					</tbody>
				 </table>
				 <table bgcolor='' border='0' cellpadding='0' cellspacing='0' width='100%'>
					<tbody>
					   <tr>
						  <td bgcolor='' class='m_2114530173431233196section-padding'><br>                 </td>
					   </tr>
					</tbody>
				 </table>
				 <table align='center' border='0' cellpadding='0' width='100%' cellspacing='0' style='background:rgb(238,238,238)'>
					<tbody>
					   <tr>
						  <td style='padding-top:25px'>                                <span style='font-family:&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:12px;color:rgb(131,131,131);line-height:16px;text-align:center;display:block'>©kb 2020</span>                            </td>
					   </tr>
					   <tr>
						  <td style='padding-bottom:25px;padding-top:5px'>                                <a href='https://kb.com/' style='font-family:&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:13px;color:rgb(68,138,255);line-height:16px;text-align:center;display:block;text-decoration:none' target='_blank'>www.kb.com</a>                            </td>
					   </tr>
					</tbody>
				 </table>
			  </div>
			  <p> <br></p>
			 
		   </div>
		</div>
		";

		

		$headers2 = "MIME-Version: 1.0" . "\r\n";

		$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers2 .= 'From:'.$from2."\r\n";

		mail($to2,$subject2,$message2,$headers2);
				
				/* Email with Verification Link */
		
		
		$from1 = "Kalyana Brokers <noreply@kb.com>";			
		$to1 = $agentemail;		
		$subject1 = "Ooh! You've got Referal Code!";		
		$message1 = "			
		<html><head></head><body><div class='ydp6289f87ayahoo-style-wrap' style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-size:16px;'><div></div>
        <div><br></div></div><div id='ydpb5e83d33yahoo_quoted_0760869874' class='ydpb5e83d33yahoo_quoted'><div style='font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:13px;color:#26282a;'><div><div id='ydpb5e83d33yiv6364514205'><div dir='ltr'><div class='ydpb5e83d33yiv6364514205gmail_quote'><div dir='ltr'><div class='ydpb5e83d33yiv6364514205gmail_quote'><br><u></u>

<div>
    <div>
	
	<div style='Margin:0px auto;max-width:600px;'>
            <table align='center' border='0' cellpadding='0' cellspacing='0' style='width:100%;'>
                <tbody>
                    <tr>
                        <td style='direction:ltr;font-size:0px;padding:0px 0;text-align:center;vertical-align:top;'>
                            
                            <div style='font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='vertical-align:top;' width='100%' bgcolor='#FFFFFF'>
                                    <tbody><tr>
                                        <td align='center' style='font-size:0px;padding:0px 0px;'>
                                            <table border='0' cellpadding='0' cellspacing='0'>
                                                <tbody>
                                                    <tr>
                                                        <td style='width:600px;'>
                                                            <a href='' rel='nofollow' target='_blank'> <img src='https://kb.com/offeremailheaders.jpg' style='border: 0px; display: block; outline: none; text-decoration: none; width: 600px; max-width: 600px;' data-inlineimagemanipulating='true' class=''> </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div style='Margin:0px auto;max-width:600px;'>
            <table align='center' border='0' cellpadding='0' cellspacing='0' style='width:100%;' bgcolor='#FFFFFF'>
                <tbody>
                    <tr>
                        <td style='direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;'>
                            
                            <div style='font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='vertical-align:top;' width='100%'>
                                    <tbody><tr>
                                        <td align='center' style='font-size:0px;padding:0px 0px;'>
                                            <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' bgcolor='#FFFFFF'>
                                                <tbody>
                                                    <tr>
                                                        <td style='width:600px;'>
                                                            <a href='' target='_blank'> <img src='https://kb.com/assets/emailimages/offeremailcenter.gif' style='border: 0px; display: block; outline: none; text-decoration: none; width: 600px; max-width: 600px;' data-inlineimagemanipulating='true' class=''> </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div style='Margin:0px auto;max-width:550px;'>
            <table align='center' border='0' cellpadding='0' cellspacing='0' style='width:100%;' bgcolor='#FFFFFF'>
                <tbody>
                    <tr>
                        <td style='direction:ltr;font-size:0px;padding:0px 0;padding-top:0;text-align:center;vertical-align:top;'>
                            
                            <div style='font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='vertical-align:top;' width='100%'>
                                    <tbody><tr>
                                        <td align='center' style='font-size:0px;padding:10px 0px;'>
                                            <div style='font-family:Verdana;font-size:16px;line-height:24px;text-align:center;color:#000000;'> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='center' style='font-size:0px;padding:10px 25px;'>
                                            <div style='font-family:Verdana;font-size:16px;line-height:24px;text-align:center;color:#000000;'> Hey $agentfirstname, Share your referal code to your friends and tell them to register by using your referal code in kb.com and get rewards.</div> <br> <br>
											<div style='font-family:Verdana;font-size:18px;line-height:24px;text-align:center;color:#ffffff;margin-top:50px;'> <span style='background-color:#12CD6A;padding:10px 10px 10px 10px;'>COUPON CODE: $referalcodeautogenerate </span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tbody></table>
                            </div>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div style='Margin:0px auto;max-width:600px;'>
            <table align='center' border='0' cellpadding='0' cellspacing='0' style='width:100%;'>
                <tbody>
                    <tr>
                        <td style='direction:ltr;font-size:0px;padding:0px 0;text-align:center;vertical-align:top;'>
                            
                            <div style='font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='vertical-align:top;' width='100%' bgcolor='#FFFFFF'>
                                    <tbody><tr>
                                        <td align='center' style='font-size:0px;padding:0px 0px;'>
                                            <table border='0' cellpadding='0' cellspacing='0'>
                                                <tbody>
                                                    <tr>
                                                        <td style='width:600px;'>
                                                            <a href='' rel='nofollow' target='_blank'> <img src='https://kb.com/assets/emailimages/offeremailfooter.jpg' style='border: 0px; display: block; outline: none; text-decoration: none; width: 600px; max-width: 600px;' data-inlineimagemanipulating='true' class=''> </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
       </div>


</div></div>
</div></div></div></div>
            </div>
        </div></body></html>
		";
		
		$headers1 = "MIME-Version: 1.0" . "\r\n";
		$headers1.= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers1.= 'From:'.$from."\r\n";
		mail($to1,$subject1,$message1,$headers1);
		
		
		
		 $inserteddatares = $conn->query("SELECT * FROM table_brokers where id = '$last_id' order by id desc limit 1");
		 $inserteddatarow = $inserteddatares->fetch_assoc();
		 $insertedtotalrow = $inserteddatares->num_rows;
		 if ($insertedtotalrow > 0)
		 {
			 $sessionbrokerusername  = $inserteddatarow['broker_first_name'];
			 $sessionbrokeruseremail = $inserteddatarow['broker_email'];
			 
			
			 
			 $_SESSION['kb_broker_name']  = $sessionbrokerusername;
			 $_SESSION['kb_broker_email'] = $sessionbrokeruseremail;
			 $_SESSION['kb_login_identify']  = "2"; /* This field is used by me to identify the login user is broker or customer */
			 
		 }
		
		
		 
			     if(!empty($agentreferedby))
				 {
					 $totalregistersfromrefercoderes = $conn->query("SELECT * FROM table_brokers where broker_referal_code = '$agentreferedby' order by id desc limit 1");
					 $totalregistersfromrefercoderow = $totalregistersfromrefercoderes->fetch_assoc();
					 $totalnum_rows = $totalregistersfromrefercoderes->num_rows;
					 if ($num_rows > 0)
					 {
						 $id = $totalregistersfromrefercoderow['id'];
						 $name = $totalregistersfromrefercoderow['broker_first_name'];
						 $totalinvite = $totalregistersfromrefercoderow['total_registers_from_broker_referal_code'];
						 
						 $totalinvitecount = $totalinvite + 1;
						 
						 $sqls = "UPDATE table_brokers SET total_registers_from_broker_referal_code='$totalinvitecount' WHERE id = '$id'";

						 if ($conn->query($sqls) === TRUE) {
							/*echo json_encode(array( "status" => "1","message" => "Registered Successfully","referalcode" => "Your referal code is ".$referalcodeautogenerate." Share your referal code to your friends and tell them to register by using your referal code in kb.com. By adding 10 brokers using your referal code then your full amount(₹99) will be refund to bank account." , "data" => $inserteddatarow ));*/
							
							echo json_encode(array( "status" => "1","message" => "Registered Successfully","referalcode" => "Your referal code is ".$referalcodeautogenerate." Share your referal code to your friends and tell them to register by using your referal code in kb.com. Your free trial expire on ".$expirydate."." , "data" => $inserteddatarow ));
							
						 } else {
							echo json_encode(array("status" => "0","message" => "Something went wrong. Please try again later!"));
						 }
					 }
				  }
				  else
				  {
					 /* echo json_encode(array( "status" => "1","message" => "Registered Successfully","referalcode" => "Your referal code is ".$referalcodeautogenerate." Share your referal code to your friends and tell them to register by using your referal code in kb.com. By adding 10 brokers using your referal code then your full amount(₹99) will be refund to bank account.","data" => $inserteddatarow ));*/
					 
					 echo json_encode(array( "status" => "1","message" => "Registered Successfully","referalcode" => "Your referal code is ".$referalcodeautogenerate." Share your referal code to your friends and tell them to register by using your referal code in kb.com. Your free trial expire on ".$expirydate.".","data" => $inserteddatarow ));
				  }
			   
				 
			 } 
			 else
			 {
				echo json_encode(array( "status" => "0","message" => "Something went wrong!"));
			 }
	 
	 
	
	 }
	 
	 

}

	

	function generateRandomString()  {
		
		$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$digits = '1234567890';
		$randomString = '';
		for ($i = 0; $i < 3; $i++) {
			$randomString .= $letters[rand(0, strlen($letters) - 1)];
		}
		for ($i = 0; $i < 3; $i++) {
			$randomString .= $digits[rand(0, strlen($digits) - 1)];
		}
		
		$testrandomstring = $randomString;
		
		$conn = mysqli_connect("linux80.hostguy.com", "kalyanab_kb", "Avuxeni@14", "kalyanab_kb");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sqlss = "SELECT * FROM table_brokers WHERE broker_referal_code = '$testrandomstring'";
		$result = mysqli_query($conn, $sqlss);

		if (mysqli_num_rows($result) > 0) {
			generateRandomString();
		} else {
			return $testrandomstring;
		}
	}
	

?>