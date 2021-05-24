<?php
 session_start();
 $hostname = "localhost";
 $username = "yourusername";
 $password = "your password";
 $dbname = "your dp name";
 
 $conn = mysqli_connect($hostname,$username,$password);
 
 if(!$conn)
 {
	 die('Could not connect:'.mysqli_error());
 }

 mysqli_select_db($conn,$dbname);
?>

