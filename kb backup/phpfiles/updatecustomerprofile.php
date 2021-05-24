<?php
session_start(); 

include '../dbconfig.php';

if (empty($_POST['customerfirstname']) || empty($_POST['customerlastname']) || empty($_POST['customeremail']) || empty($_POST['customermobile']) ) {
   echo json_encode(array("status" => "0","message" => "Please fill all details"));
}
else
{
	$customerfirstname=isset($_POST["customerfirstname"]) ? $_POST["customerfirstname"] : "";
	$customerlastname=isset($_POST["customerlastname"]) ? $_POST["customerlastname"] : "";
	$customeremail=isset($_POST["customeremail"]) ? $_POST["customeremail"] : "";
	$customermobile=isset($_POST["customermobile"]) ? $_POST["customermobile"] : "";
	$customerid=isset($_POST["customerid"]) ? $_POST["customerid"] : "";
	
	$sql = "UPDATE table_customers SET customer_first_name='$customerfirstname',customer_last_name='$customerlastname',customer_mobile='$customermobile' WHERE customer_email = '$customeremail' and id = '$customerid'";

	if ($conn->query($sql) === TRUE) {
		echo json_encode(array("status" => "1","message" => "Profile updated Successfully"));
	} else {
		echo json_encode(array("status" => "0","message" => "Something went wrong. Please try again later!"));
	}

	$conn->close();
	
}


?>

