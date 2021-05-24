<?php
ob_start();
session_start();
unset($_SESSION['kb_customer_name']);
unset($_SESSION['kb_customer_email']);
unset($_SESSION['kb_login_identify']);

unset($_SESSION['kb_broker_name']);
unset($_SESSION['kb_broker_email']);
unset($_SESSION['kb_login_identify']);

session_destroy();
header("Location: https://www.kbs.com/");
exit;
?>