<?php
session_start(); 

include '../dbconfig.php';

if (empty($_POST['recoveremail'])) {
   echo json_encode(array("status" => "0","message" => "Please fill all details"));
}
else
{
	
	$recoveremail=isset($_POST["recoveremail"]) ? $_POST["recoveremail"] : "";
		
	
	$adminemail = mysqli_real_escape_string($conn,$recoveremail);

	
	$sql = "select * from table_customers where customer_email='$adminemail'";
	$result = $conn->query($sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	
	if ($count == 1) {
		$adminemail1 = $row['customer_email'];
	    $adminname1 = $row['customer_first_name'];
		$email_encoded = rtrim(strtr(base64_encode($adminemail1), '+/', '-_'), '=');
		
	    $passwordresetlink = "https://yourdomain.com/resetpassword.php?recovery=".$email_encoded;
		
		
		
		$from1 = "Kalyanabrokers <noreply@kalyanabrokers.com>";
		$to1=$adminemail1;
		$subject1 = "Kalyanabrokers:Forgot password recovery";

		$message1 = "
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
															  <td style='padding:20px 50px 15px'><a href='https://yourdomain.com/' target='_blank'> 
															  <img width='250' style='display:inline;float:none;text-align:center;width:250px;height:35px' src='https://yourdomain.com/assets/images/kb_logo_big.png' alt='Kalyana brokers'>                            
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
									  <td style='padding-top:20px'><span style='font-family:&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:17px;color:#000000;line-height:24px;font-weight:500'>Hi $adminname1,</span>                            </td>
								   </tr>
								   <tr>
									  <td style='padding-top:5px;padding-bottom:20px'>                                <span style='font-family:&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:15px;color:#4a4a4a;font-weight:normal;line-height:21px'>Use the below link to reset your password<br> <a href='$passwordresetlink'>Click here to change your password</a> <br>for your kb account<br><br>  Please do not share this link with anyone for security reasons.  <br><br></span>                            </td>
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
						  <td style='padding-bottom:25px;padding-top:5px'>                                <a href='https://yourdomain.com/' style='font-family:&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:13px;color:rgb(68,138,255);line-height:16px;text-align:center;display:block;text-decoration:none' target='_blank'>www.yourdomain.com</a>                            </td>
					   </tr>
					</tbody>
				 </table>
			  </div>
			  <p> <br></p>
			 
		   </div>
		</div>
		";

		

		$headers = "MIME-Version: 1.0" . "\r\n";

		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= 'From:'.$from1."\r\n";

		mail($to1,$subject1,$message1,$headers);
		
		echo json_encode(array("status" => "1","message" => "Password reset link sent to your email"));
	}
	else {
		echo json_encode(array("status" => "1","message" => "Account not found"));
	}
}

 exit();


?>

