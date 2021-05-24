<?php

session_start();
ob_start();


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
		
		$brokernumres = $conn->query("SELECT * FROM table_brokers where broker_email = '$brokerloginemail' order by id desc limit 1");
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
			$broker_bank_account_number = $brokernumrow['broker_bank_account_number'];
			$expiry_date = $brokernumrow['broker_account_expiry_date'];
			
		 
		}
		else
		{
			$customerid = "";
			$brokermobile = "Not Found";
		}
	}
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
    <title>KB - Pricing</title>
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
	
	<script data-ad-client="ca-pub-5344954780416051" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
		<!-- Global site tag (gtag.js) - Google Ads: 663626797 -->

  </head>

<body class="title-image">
	<?php include 'header.php'; ?>
     
    <!-- Page Title-->
    	<div class="container-fluid  page-title bg-image pricing">
			<div class="row section-title">
            	<div class="container main-container">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<h3 class="price-heading text-center">Price for Brokers</h3>
                        <p>Great exposure for your job. <strong>Start with 1 month free trial</strong>. Trusted by marriage brokers around the globe.</p>
                    </div>
                    
                </div>
            </div>  
        </div>
    <!-- Page Title-->
  
    
    <!-- Priing Table -->
  		<div class="container-fluid main-container-home price-tags">
            <div class="container main-container priceing_tables">
            	<!--Colg-12 for Pricing Tables-->	
                	<div class="col-lg-12">
				<h2 class="text-center">Ramadan offer price</h2>
             <!---Price table free--->
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 price_table no-padding startup free">
               		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- pricing page box ad 1 -->
					<ins class="adsbygoogle"
						 style="display:block"
						 data-ad-client="ca-pub-5344954780416051"
						 data-ad-slot="3961751307"
						 data-ad-format="auto"
						 data-full-width-responsive="true"></ins>
					<script>
						 (adsbygoogle = window.adsbygoogle || []).push({});
					</script>
                </div>
                <!---Price table pro--->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 price_table border pro">
               		<div class="header">Enterprise<span>Best Choice</span></div> 
					<?php 
					  if($sessionvalue == 2)
					  {
						 if($broker_payment_status == 1)
						 {								 
					?>
							<div class="price"><small>Activated</small></div>
					<?php
						 }
						 else
						 {
					 ?>
					       <div class="price"><i>₹</i>365<strike><small>₹500</small></strike></div>
					 <?php
								 
						 }
					  }
					  else
					  {
					?>
						   <div class="price">Free</div>
					<?php
					  }
					?>
					
                        <ul class="list-items">
						    <li>Free 1 month trial</li>
                            <li>Unlimited broker profiles</li>
                            <li>improve your business online</li>
                            <li>Unlimited Customers</li>
                            <li>No hidden cost</li>
							<li>Quick support</li>
                        </ul>
                        <div class="purchase-now">
						<?php 
						  if($sessionvalue == 2)
						  {
							 if($broker_payment_status == 1)
							 {								 
						?>
								<a href="javascript:void(0);">Expire on :- <?php echo $expiry_date; ?></a>
						<?php
							 }
							 else
							 {
						 ?>
								<a href="kalyana_brokers_broker_details_for_payment.php?broker_id=<?php echo $brokerid; ?>&broker_name=<?php echo $brokerfirstname; ?>">Purchase Now</a>
						 <?php
								 
							 }
					      }
						  else
						  {
					    ?>
						<a href="join_as_broker.php">Join as Broker</a>
						<?php
						  }
						?>
                        </div>
                </div>
                <!---Price table enterprices--->

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 price_table no-padding startup">
               		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- pricing page box ad 2 -->
					<ins class="adsbygoogle"
						 style="display:block"
						 data-ad-client="ca-pub-5344954780416051"
						 data-ad-slot="9022506294"
						 data-ad-format="auto"
						 data-full-width-responsive="true"></ins>
					<script>
						 (adsbygoogle = window.adsbygoogle || []).push({});
					</script>
                </div>
                </div>           
           		<!--Colg-12 for Pricing Tables-->	
            </div>
        </div>
    <!-- Priing Table-->
    
	<!--Recuriting Section -->
    <div class="container-fluid" style="background:#fff;">
    	<div class="row">
        	<div class="container main-container">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center lighttext">
                    <!--<h3>Money Refund Guarantee(Only for Brokers)</h3>
                    <p>By adding 10 brokers using your referal code then your full amount(₹99) will be refund to bank account</p>-->
					<h3>Free trial(Only for Brokers)</h3>
                    <p>Use Kalyana brokers.com Free 1 month trial</p>
                </div>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center lighttext">
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- pricing page bottom ad -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5344954780416051"
     data-ad-slot="7841708022"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                </div>
            </div>
        </div>
    </div>
    
    
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
                             <a href="mailto:support@kbs.com" class="btn btn-getstarted bg-red">Send Email Now</a>
                        </div>
                    </div>
                </div>
            </div>
   
   <!-- Blue Area -->
    
	<!--Footer Area-->
   		<?php include 'footer.php'; ?>
<!-- Scripts
================================================== -->
    <!--Last Footer Area----> 

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
