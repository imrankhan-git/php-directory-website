<?php
session_start(); 

include '../dbconfig.php';

if (empty($_POST['brokerfirstname']) || empty($_POST['brokerlastname']) || empty($_POST['brokeremail']) || empty($_POST['brokermobile']) || empty($_POST['brokerwhatsappnumber']) || empty($_POST['brokersuccessmarriage']) || empty($_POST['brokeraddress'])) {
   echo json_encode(array("status" => "0","message" => "Please fill all details"));
}
else
{
	$brokerfirstname=isset($_POST["brokerfirstname"]) ? $_POST["brokerfirstname"] : "";
	$brokerlastname=isset($_POST["brokerlastname"]) ? $_POST["brokerlastname"] : "";
	$brokeremail=isset($_POST["brokeremail"]) ? $_POST["brokeremail"] : "";
	$brokermobile=isset($_POST["brokermobile"]) ? $_POST["brokermobile"] : "";
	$brokerwhatsappnumber=isset($_POST["brokerwhatsappnumber"]) ? $_POST["brokerwhatsappnumber"] : "";
	$brokersuccessmarriage=isset($_POST["brokersuccessmarriage"]) ? $_POST["brokersuccessmarriage"] : "";
	$brokeraddress=isset($_POST["brokeraddress"]) ? $_POST["brokeraddress"] : "";
	$brokerid=isset($_POST["brokerid"]) ? $_POST["brokerid"] : "";
	
	$sql = "UPDATE table_brokers SET broker_first_name='$brokerfirstname',broker_last_name='$brokerlastname',broker_mobile='$brokermobile',broker_whatsapp_number='$brokerwhatsappnumber',broker_success_marriage='$brokersuccessmarriage',broker_address='$brokeraddress' WHERE broker_email = '$brokeremail' and id = '$brokerid'";

	if ($conn->query($sql) === TRUE) {
		echo json_encode(array("status" => "1","message" => "Profile updated Successfully"));
	} else {
		echo json_encode(array("status" => "0","message" => "Something went wrong. Please try again later!"));
	}

	$conn->close();
	
}


?>

