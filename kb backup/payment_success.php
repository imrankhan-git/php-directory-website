<?php
session_start();

include 'dbconfig.php';

include 'src/instamojo.php';

/*$api = new Instamojo\Instamojo('test_a6949951078ceb4d35601d266e7', 'test_76ad94f13b219f520efe2dcb224','https://test.instamojo.com/api/1.1/');*/

$api = new Instamojo\Instamojo('your key', 'your token','https://www.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];


try {
	$response = $api->paymentRequestStatus($payid);
	
	$paymentid = $response['payments'][0]['payment_id'];
	$paymentname = $response['payments'][0]['buyer_name'];
	$paymentemail =  $response['payments'][0]['buyer_email'];
	
	$brokernumres = $conn->query("SELECT * FROM table_brokers where broker_email = '$paymentemail' order by id desc limit 1");
	$brokernumrow = $brokernumres->fetch_assoc();
	$brokernum_rows = $brokernumres->num_rows;
	if ($brokernum_rows > 0)
	{
		$brokerid = $brokernumrow['id'];
		$brokerfirstname = $brokernumrow['broker_first_name'];
		$brokerlastname = $brokernumrow['broker_last_name'];
		$brokeremail = $brokernumrow['broker_email'];
		$brokermobile = $brokernumrow['broker_mobile'];	
		$broker_whatsapp_number = $brokernumrow['broker_whatsapp_number'];
		$broker_success_marriage = $brokernumrow['broker_success_marriage'];
		$broker_managing_places = $brokernumrow['broker_managing_places'];
		$broker_address = $brokernumrow['broker_address'];
		$broker_alternate_mobile = $brokernumrow['broker_alternate_mobile'];
		$broker_payment_status = $brokernumrow['broker_payment'];
		$broker_account_status = $brokernumrow['broker_account_status'];
		$broker_bank_account_number = $brokernumrow['broker_bank_account_number'];
		
	}
	
	 $todaydate = date("d/m/Y");

     $expirydate = date('d/m/Y', strtotime('+1 years'));
	
	 $sqls = "UPDATE table_brokers SET broker_account_expiry_date='$expirydate', broker_payment='1',payment_id_instamojo='$paymentid' WHERE broker_email = '$paymentemail' and id='$brokerid'";

	 if ($conn->query($sqls) === TRUE)
	 {
		$paymentsuccessid = 1;
		$sessionvalue = 2;
		$customerlogintext = "Logout";
		$brokerlogintext = $paymentname;
		
		$customerloginemail = "";
		$brokerloginemail = $paymentemail;
		
		$customerloginurl = "logout.php";
		$brokerloginurl = "broker_profile.php";
		
		$_SESSION['kalyanabroker_broker_name']  = $brokerfirstname;
	    $_SESSION['kalyanabroker_broker_email'] = $brokeremail;
	    $_SESSION['kalyanabroker_login_identify']  = "2"; /* This field is used by me to identify the login user is broker or customer */
		
		sleep(5);
 
		//Redirect using the Location header.
		header('Location: index.php');
		
		
		
	 } 
	 else {
		$paymentsuccessid = 2;
		
	 }
}
catch (Exception $e) {
	$paymentsuccessid = 2;
	$errormessage = $e->getMessage();
	//print('Error: ' . $e->getMessage());
	
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
    <title>KB - Payment Success</title>
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

<body class="page-blog">
	<!-- Header Image Or May be Slider-->
    	<?php include 'header.php'; ?>
	<!-- Header Image Or May be Slider-->
    
    <!--header section -->
    	<div class="container-fluid page-title dashboard ">
		<?php 
		if($paymentsuccessid == 1)
		{
		?>
			<div class="row blue-banner">
            	<div class="container main-container">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<h3 class="white-heading">Thank you for your payment!!</h3>
                    </div>
                </div>
            </div>
		<?php
		}
		else
		{
		?>
			<div class="row blue-banner" style="background-color:#af0e0e  !important;">
            	<div class="container main-container">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<h3 class="white-heading" style="color:white !important;">Payment Failure !! - Please contact administrator</h3>
                    </div>
                </div>
            </div>
		<?php
		}
		?>
			
        </div> 
  	 <!--header section -->
	 
	     <!--blog Lists--> 
     <div class="container-fluid blog-posts">
    	<div class="row">
        	<div class="container main-container">
            	
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 post white-bg" id="blog-sidebar">
				<?php 
				if($paymentsuccessid == 1)
				{
				?>
				<div class="widget">
					<h3 class="widget-title">Payment Details</h3>
					<div class="table-responsive">
					  <table class="table">
						<thead>
						<tr>
						  <th scope="col">Payment Status</th>
						  <th scope="col">Success</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <th scope="row">Payment ID</th>
						  <td><?php echo $paymentid; ?></td>
						</tr>
						<tr>
						  <th scope="row">Name</th>
						  <td><?php echo $paymentname; ?></td>
						</tr>
						<tr>
						  <th scope="row">Email</th>
						  <td><?php echo $paymentemail; ?></td>
						</tr>
					  </tbody>
					  </table>
					</div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="widget">
					<h3 class="widget-title">Payment Details</h3>
					<div class="table-responsive">
					  <table class="table">
						<thead>
						<tr>
						  <th scope="col">Payment Status</th>
						  <th scope="col" style="color:red !important;">Failure</th>
						</tr>
					   </thead>
					  <tbody>
						<tr>
						  <th scope="row" colspan="2" style="text-align:center !important;color:red !important;">Please Contact Administrator</th>
						</tr>
					  </tbody>
					  </table>
					</div>
				</div>
				<?php
				}
				?>
                </div>
            </div>
        </div>
    </div>
    <!--blog Lists--> 
	 

    
    
    <!--Recuriting Section -->

   
    <!-- Blue Area -->
   	<div class="container-fluid blue-banner">
                <div class="row">
                    <div class="container main-container">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                            <h3 class="white-heading">Got a question?</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><span class="call-us">send us an email</span></div>
                        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                             <a href="mailto:support@kb.com" class="btn btn-getstarted bg-red">Send Email Now</a>
                        </div>
                    </div>
                </div>
            </div>
   
   <!-- Blue Area -->
   
   
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
	 
	 
<script>

var paymentsuccessid = '<?php echo $paymentsuccessid; ?>';
if(paymentsuccessid == 1)
{
	setTimeout(function () {
   window.location.href= 'index.php';
	}, 5000);
}


</script>
	 
	

  <!-- Scripts
================================================== -->
        
</body>

</html>
