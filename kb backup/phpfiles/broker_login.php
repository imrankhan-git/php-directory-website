<?php
session_start();

include '../dbconfig.php';

if (empty($_POST['loginemail']) || empty($_POST['loginpassword'])) {
    echo json_encode(array(
        "status" => "0",
        "message" => "Please fill all details"
    ));
} else {
   
    $brokeremail    = isset($_POST["loginemail"]) ? $_POST["loginemail"] : "";
    $brokerpassword = isset($_POST["loginpassword"]) ? $_POST["loginpassword"] : "";
    
    
    $brokeremail     = mysqli_real_escape_string($conn, $brokeremail);
    $brokerpassword1 = mysqli_real_escape_string($conn, $brokerpassword);
    $brokerpassword1 = md5($brokerpassword1);
   
    $sql            = "select * from table_brokers where broker_email='$brokeremail' AND broker_password='$brokerpassword1'";
    $result         = $conn->query($sql);
    $row            = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count          = mysqli_num_rows($result);
	
	if($count == 1)
	{
		$brokeraccountstatus = $row['broker_account_status'];
		$brokerpaymentstatus = $row['broker_payment'];
		if (empty($brokeraccountstatus) || $brokeraccountstatus == 0) {
			echo json_encode(array(
				"status" => "0",
				"message" => "Please verify your email"
			));
			
		} elseif ($brokeraccountstatus == 1 && $count == 1) {
			$sessionbrokerusername  = $row['broker_first_name'];
			$sessionbrokeruseremail = $row['broker_email'];
			
			echo json_encode(array(
				"status" => "1",
				"message" => $sessionbrokerusername . " Login Successfully",
				
			));
			
			$_SESSION['kb_broker_name']  = $sessionbrokerusername;
			$_SESSION['kb_broker_email'] = $sessionbrokeruseremail;
			$_SESSION['kb_login_identify']  = "2"; /* This field is used by me to identify the login user is broker or customer */
		}
		else {
			echo json_encode(array(
				"status" => "0",
				"message" => "username or password is invalid"
			));
		}
	}
	else
	{
		echo json_encode(array(
				"status" => "0",
				"message" => "username or password is invalid"
		));
	}
}
exit();
?>