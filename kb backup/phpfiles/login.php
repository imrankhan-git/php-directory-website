<?php
session_start();

include '../dbconfig.php';

if (empty($_POST['loginemail']) || empty($_POST['loginpassword'])) {
    echo json_encode(array(
        "status" => "0",
        "message" => "Please fill all details"
    ));
} else {
   
    $adminemail    = isset($_POST["loginemail"]) ? $_POST["loginemail"] : "";
    $adminpassword = isset($_POST["loginpassword"]) ? $_POST["loginpassword"] : "";
    
    
    $adminemail     = mysqli_real_escape_string($conn, $adminemail);
    $adminpassword1 = mysqli_real_escape_string($conn, $adminpassword);
    $adminpassword1 = md5($adminpassword1);
   
    $sql            = "select * from table_customers where customer_email='$adminemail' AND customer_password='$adminpassword1'";
    $result         = $conn->query($sql);
    $row            = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count          = mysqli_num_rows($result);
	
	if($count == 1)
	{
		$customeraccountstatus = $row['customer_account_status'];
		if (empty($customeraccountstatus) || $customeraccountstatus == 0) {
			echo json_encode(array(
				"status" => "0",
				"message" => "Please verify your email to get brokers contact number"
			));
			
		} elseif ($customeraccountstatus == 1 && $count == 1) {
			$sessioncustomerusername  = $row['customer_first_name'];
			$sessioncustomeruseremail = $row['customer_email'];
			
			echo json_encode(array(
				"status" => "1",
				"message" => $sessioncustomerusername . " Login Successfully",
				
			));
			$_SESSION['kb_customer_name']  = $sessioncustomerusername;
			$_SESSION['kb_customer_email'] = $sessioncustomeruseremail;
			$_SESSION['kb_login_identify']  = "1"; /* This field is used by me to identify the login user is broker or customer */
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