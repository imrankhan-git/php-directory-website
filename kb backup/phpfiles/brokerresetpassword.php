<?php
session_start(); 

include '../dbconfig.php';

if (empty($_POST['password']) || empty($_POST['confirmpassword']) || empty($_POST['recovery']) ) {
   echo json_encode(array("status" => "0","message" => "Please fill all details"));
}
else
{
	
	$adminemail=isset($_POST["recovery"]) ? $_POST["recovery"] : "";
	$adminpassword=isset($_POST["password"]) ? $_POST["password"] : "";
		
	
	$adminemail = mysqli_real_escape_string($conn,$adminemail);
	$adminemail = base64_decode($adminemail);
	
	$adminpassword1 = mysqli_real_escape_string($conn,$adminpassword);
	$adminpassword1 = md5($adminpassword1);
	
	$sql = "UPDATE table_brokers SET broker_password='$adminpassword1' WHERE broker_email = '$adminemail'";

	if ($conn->query($sql) === TRUE) {
		echo json_encode(array("status" => "1","message" => "Password changed Successfully"));
	} else {
		echo json_encode(array("status" => "0","message" => "Something went wrong. Please try again later!"));
	}

	$conn->close();
	
}


?>

