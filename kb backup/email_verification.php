<?php
session_start(); 
include 'dbconfig.php';

if (!isset($_SESSION['kb_login_identify']))
{
	$sessionvalue = 0;
	$customerlogintext = "Join as Customer";
	$brokerlogintext = "Join as Broker";
	
	$customerloginemail = "";
	$brokerloginemail = "";
	
	$customerloginurl = "join_as_customer_login.php";
	$brokerloginurl = "join_as_broker_login.php";
	
	
	
}
else
{
	$login_identification = $_SESSION['kb_login_identify'];
	
	if($login_identification == 1)
	{
		$sessionvalue = 1;
		$customerlogintext = $_SESSION['kb_customer_name'];
		$brokerlogintext = "Logout";
		
		$customerloginemail = $_SESSION['kb_customer_email'];
		$brokerloginemail = "";
		
		$customerloginurl = "customer_profile.php";
		$brokerloginurl = "logout.php";
		
		
	}
	else
	{
		$sessionvalue = 2;
		$customerlogintext = "Logout";
		$brokerlogintext = $_SESSION['kb_broker_name'];
		
		$customerloginemail = "";
		$brokerloginemail = $_SESSION['kb_broker_email'];
		
		$customerloginurl = "logout.php";
		$brokerloginurl = "broker_profile.php";
		
		
	}
}

$adminemail = $_GET['email_verification_link'];
$adminemail = mysqli_real_escape_string($conn,$adminemail);
$adminemail = base64_decode($adminemail);
$sql = "select * from table_customers where customer_email='$adminemail'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1)
{
	$customeraccountstatus = $row['customer_account_status'];
	if($customeraccountstatus == 1)
	{
		$verificationmessage = 1;
		$alreadyverified = 1;
	}
	else
	{
		$verificationmessage = 1;
		$alreadyverified = 0;
		$sql = "UPDATE table_customers SET customer_account_status = 1 WHERE customer_email = '$adminemail'";

		if ($conn->query($sql) === TRUE) {
			 /*echo json_encode(array("status" => "1","message" => "Account verified Successfully"));*/
		} else {
			/*echo json_encode(array("status" => "0","message" => "Something went wrong. Please try again later!"));*/
		}
	}
	
	
}
else
{
	$verificationmessage = 0;
}




	
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>KB - Email Verification</title>
<meta name="description" content="Kalyana Brokers is helping marriage brokers to improve their business and helping customers to find out the marriage brokers details easily at free of a cost lifetime">
<meta name="keywords" content="Kalyana Brokers, Marriage Brokers, Tamilnadu Marriage Brokers, India Marriage Brokers, Top Marriage Brokers,All Marriage Brokers, Ariyalur Marriage Brokers,Chengalpet Marriage Brokers,Chennai Marriage Brokers,Coimbatore Marriage Brokers,Cuddalore Marriage Brokers,Dharmapuri Marriage Brokers,Dindigul Marriage Brokers,Erode Marriage Brokers,Kallakurichi Marriage Brokers,Kancheepuram Marriage Brokers,Karur Marriage Brokers,Krishnagiri Marriage Brokers,Madurai Marriage Brokers,Nagapattinam Marriage Brokers,Kanyakumari Marriage Brokers,Namakkal Marriage Brokers,Perambalur Marriage Brokers,Pudukottai Marriage Brokers,Ramanathapuram Marriage Brokers,Ranipet Marriage Brokers,Salem Marriage Brokers,Sivagangai Marriage Brokers,Tenkasi Marriage Brokers,Thanjavur Marriage Brokers,Theni Marriage Brokers,Thiruvallur Marriage Brokers,Thiruvarur Marriage Brokers,Tuticorin Marriage Brokers,Trichirappalli Marriage Brokers,Thirunelveli Marriage Brokers,Tirupattur Marriage Brokers,Tiruppur Marriage Brokers,Thiruvannamalai Marriage Brokers,The Nilgiris Marriage Brokers,Vellore Marriage Brokers,Viluppuram Marriage Brokers,Virudhunagar Marriage Brokers">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="English">
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="assets/favicon//apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="assets/favicon//apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/favicon//apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="assets/favicon//apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/favicon//apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="assets/favicon//apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/favicon//apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/favicon//apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="assets/favicon//android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon//favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="assets/favicon//favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/favicon//favicon-16x16.png">
<link rel="manifest" href="assets/favicon//manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="assets/favicon//ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--Custom template CSS-->
     <link href="style.css" rel="stylesheet" />
      <!--Custom template CSS Responsive-->
      <link href="assets/webcss/site-responsive.css" rel="stylesheet" />
     <!--Owsome Fonts -->
     <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
      <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="assets/owlslider/owl-carousel/owl.carousel.css" />
     
    <!-- Default template -->
    <link rel="stylesheet" href="assets/owlslider/owl-carousel/owl.template.css" />
     

	<!--Select 2-->
    <link rel="stylesheet" type="text/css" href="assets/webcss/select2.css"/>
    <link rel="stylesheet" type="text/css" href="assets/webcss/select2-bootstrap.css"/>
    <!--Select 2-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body class="">
	<?php include 'header.php'; ?>
    
    <!--header section -->
	<?php
	if($verificationmessage == 1 && $alreadyverified == 1)
	{
	?>
	<div class="container-fluid page-title dashboard ">
			<div class="row blue-banner">
            	<div class="container main-container">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<h3 class="white-heading">Your Account is Already Verified</h3>
						<div class="post-image text-center">
                        	<img src="assets/images/emailverifysuccess.gif" alt=""/>
                       </div>
                    </div>
                </div>
            </div> 
           <div class="row">
            	<div class="container main-container gery-bg">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding user-data">
                      <h3>Now you are able to see all the broker details at free of cost / Life time</h3>   
                </div>
            </div>
            </div>
			<div class="row text-center">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- customer email verification -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5344954780416051"
     data-ad-slot="6935626942"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
        </div> 
	<?php
	}
	elseif($verificationmessage == 1 && $alreadyverified == 0)
	{
	?>
	<div class="container-fluid page-title dashboard ">
		<div class="row blue-banner">
			<div class="container main-container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 class="white-heading">Your Account Verification Is Completed.</h3>
				</div>
			</div>
		</div> 
	    <div class="row">
            	<div class="container main-container gery-bg">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding user-data">
                      <h3>Now you are able to see all the broker details at free of cost / Life time</h3> 
<div class="post-image text-center">
                        	<img src="assets/images/emailverifysuccess.gif" alt=""/>
                       </div>					  
                </div>
            </div>
            </div>
			<div class="row text-center">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- customer email verification -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5344954780416051"
     data-ad-slot="6935626942"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
	</div> 
	<?php
	}
	else
	{
	?>
	<div class="container-fluid page-title dashboard ">
		<div class="row blue-banner">
			<div class="container main-container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 class="white-heading">Your Account Does not Exist. Please Register with us.</h3>
				</div>
			</div>
		</div> 
	    <div class="row">
            	<div class="container main-container gery-bg">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding user-data">
                      <h3></h3>   
                </div>
            </div>
            </div>.
			<div class="row text-center">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- customer email verification -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5344954780416051"
     data-ad-slot="6935626942"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
	</div> 
	<?php
	}
	?>
  	 <!--header section -->
   
 <!--Footer Area-->
   		<?php include 'footer.php'; ?>
    <!--Last Footer Area--> 
    
        <!-- Scripts
================================================== -->
   
	<!--  jQuery 1.7+  -->
    <script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
     <!--Select 2-->
    <script type="text/javascript" src="assets/js/select2.min.js"></script>
    <!-- Html Editor -->
    <script src="assets/tinymce/tinymce.min.js"></script>
	<!--  parallax.js-1.4.2  -->
    <script type="text/javascript" src="assets/parallax.js-1.4.2/parallax.js"></script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
   	<!-- Include js plugin -->
    <script type="text/javascript" src="assets/owlslider/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="assets/js/waypoints.min.js"></script> 
  	<script type="text/javascript" src="assets/counter/jquery.counterup.min.js"></script> 
    <!--Site JS-->
     <script src="assets/js/webjs.js"></script>

  <!-- Scripts
================================================== -->
        
</body>
</html>
