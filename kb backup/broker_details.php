<?php
session_start();
include 'dbconfig.php';

$brokeridfrompage = $_GET['key_id'];

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
		
		$customernumres = $conn->query("SELECT * FROM table_customers where customer_email = '$customerloginemail' order by id desc limit 1");
		$customernumrow = $customernumres->fetch_assoc();
		$customernum_rows = $customernumres->num_rows;
		if ($customernum_rows > 0)
		{
			$customerid = $customernumrow['id'];
			$customerfirstname = $customernumrow['customer_first_name'];
			$customerlastname = $customernumrow['customer_last_name'];
			$customeremail = $customernumrow['customer_email'];
			$customermobile = $customernumrow['customer_mobile'];
			$customer_account_status = $customernumrow['customer_account_status'];
			
			if($customer_account_status == 0)
			{
				$emailverifiedstatus = 0;
			}
			else
			{
				$emailverifiedstatus = 1;
			}
			
		 
		}
		else
		{
			$customerid = "";
			$customermobile = "Not Found";
		}
		
		$brokernumres = $conn->query("SELECT * FROM table_brokers where id = '$brokeridfrompage' order by id desc limit 1");
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
			
			if($broker_account_status == 0)
			{
				$emailverifiedstatus = 0;
			}
			else
			{
				$emailverifiedstatus = 1;
			}
		}
		else
		{
			$customerid = "";
			$brokermobile = "Not Found";
		}
		
		
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
		
		$brokernumres = $conn->query("SELECT * FROM table_brokers where id = '$brokeridfrompage' order by id desc limit 1");
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
			
			if($broker_account_status == 0)
			{
				$emailverifiedstatus = 0;
			}
			else
			{
				$emailverifiedstatus = 1;
			}
			
		 
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

<!-- Mirrored from deximlabs.com/dexjobs/light/job-style-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Jan 2020 10:37:59 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <title>KB - Broker Details</title>
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
    <link rel="icon" href="assets/images/favicon.png">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--Custom template CSS-->
    <link href="style.css" rel="stylesheet">
    <!--Custom template CSS Responsive-->
    <link href="assets/webcss/site-responsive.css" rel="stylesheet">
    <!--Owsome Fonts -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
      <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="assets/owlslider/owl-carousel/owl.carousel.css">
     
    <!-- Default template -->
    <link rel="stylesheet" href="assets/owlslider/owl-carousel/owl.template.css">
     
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	#loaderss 
	{
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		width: 100%;
		background: rgba(0, 0, 0, 0.75) url(assets/images/loading.gif) no-repeat center center;
		z-index: 10000;
	}
	#loading2
	{
		text-align:center; 
		background: url('assets/images/searching.gif') no-repeat center; 
		height: 200px;
		object-fit:contain;
	}	

	.show-more {
		background: #DAF7A6;
		width: 100%;
		text-align: center;
		padding: 10px;
		border-radius: 5px;
		margin: 5px;
		color: #930000;
		cursor: pointer;
		font-size: 20px;
		display: none;
	}
	.ui-selectmenu-menu .ui-menu {
	  height: 150px;
	}
	.load_more {
		width: 100%;
		text-align: center;
		padding: 10px;
		border-radius: 5px;
		margin: 5px;
		color: #930000;
		cursor: pointer;
		font-size: 20px;
	}
	.loadmore_button{
		background: #930000;
		color: white;
		padding: 12px;
		border-radius: 3px;
	}
	#showingmorerecordsbtn {
    text-align: center;
    display: block;
    margin: 0 auto;
    color: #333;
    padding: 12px 47px;
    font-family: OpenSansBold;
    position: relative;
    text-transform: uppercase;
    margin: 55px auto 28px;
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: 2px solid #12cd6a;
    border-radius: 26px;
}
</style>
	<!-- Global site tag (gtag.js) - Google Ads: 663626797 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-663626797"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-663626797');
</script>
<!-- Event snippet for Website lead (1) conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-663626797/H0DVCLHJhc0BEK3IuLwC'});
</script>
  </head>

<body>
	<!-- Header Image Or May be Slider-->
    	<?php include 'header.php'; ?>
	<!-- Header Image Or May be Slider-->
     
    <!-- Page Title-->
    	<div class="container-fluid page-title">
			<div class="row green-banner">
            	<div class="container main-container">
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                		<h3 class="white-heading"><?php echo $brokerfirstname.' '.$brokerlastname; ?></h3>
                    </div>
                </div>
            </div> 
            
            <div class="row dashboard">
            	<div class="container main-container gery-bg">
            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding user-data">
                        <div class="seprator ">
                            <div class="no-padding user-image"><img src="assets/images/kb_profile_logo.png" alt=""/></div>
                            <div class="user-tag"><?php echo $brokerfirstname; ?><span><?php echo $brokerlastname; ?></span></div>
                        </div>
                        <div class="seprator">
                            <div class="user-tag"><label>Email<span><?php echo $brokeremail; ?></span></label></div>
                       	</div>
                         <div class="seprator">
                            <div class="user-tag"><label>Mobile<span><?php echo $brokermobile; ?></span></label></div>
                       	</div>
						 <div class="seprator">
                            <div class="user-tag"><label>Whatsapp<span><?php echo $broker_whatsapp_number; ?></span></label></div>
                       	</div>
                	</div>
            </div>
            </div>        
        </div>
    <!--Page Title-->
    
    <!-- Job Data -->
  		<div class="container-fluid jpd-data white-bg">
        	<div class="row">
            	<div class="container main-container-job">
                	<div class="col-lg-9 col-md-9 col-sm-8">
                    	<div class="post-image">
                        	<img src="assets/images/kbdetails.png" alt=""/>
                        </div>
                        <div class="content">
                        	<h3>Address Details</h3>
                            <p>Address: <?php echo $broker_address; ?></p>
                            <p>Managing places: <?php echo $broker_managing_places; ?></p>
							<p>Successfull marriages: <?php echo $broker_success_marriage; ?></p>
                         </div>

                         
                    </div>
                    
                     <div class="col-lg-3 col-md-3 col-sm-4 sidebar">
						<div class="widget w1" id="brokerdetailspagead1">
							<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- brokerdetailspagead2 -->
							<ins class="adsbygoogle"
								 style="display:block"
								 data-ad-client="ca-pub-5344954780416051"
								 data-ad-slot="3154547037"
								 data-ad-format="auto"
								 data-full-width-responsive="true"></ins>
							<script>
								 (adsbygoogle = window.adsbygoogle || []).push({});
							</script>              
                        </div>
                          <!-- Modal -->
  
                        <div class="widget w2">
                        	<div class="subscribe" id="brokerdetailspagead2">
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
								<!-- brokerdetailspagead1 -->
								<ins class="adsbygoogle"
									 style="display:block"
									 data-ad-client="ca-pub-5344954780416051"
									 data-ad-slot="2224608742"
									 data-ad-format="auto"
									 data-full-width-responsive="true"></ins>
								<script>
									 (adsbygoogle = window.adsbygoogle || []).push({});
								</script>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
			
			<div class="row">
		<div class="container">
			<div class="col-md-offset-1 col-md-10" id="brokerdetailspagead3">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- brokerdetailspagead3 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5344954780416051"
     data-ad-slot="4005143019"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
		</div>
	</div>
	
	
        </div>
    <!--Job Data-->
<!--Footer Area-->
   		<?php include 'footer.php'; ?>
    <!--Footer Area--> 
   
    
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
<script>
  $( document ).ready(function() {
    console.log('document loaded');
    function areAdsBlocked(callback) {
      var URL = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';
      fetch(URL, {
        method: 'HEAD', 
        mode: 'no-cors'
      })
      .then(response => callback(false)) //Response was received --> ads are NOT blocked
      .catch(error => callback(true));   //No response           --> ads are blocked
    }
    function checkAdBlocker() {
      areAdsBlocked(function(isBlocked){
        if(isBlocked){
          $('#brokerdetailspagead3').text('Do you want 1 month free trial? Please disable the ad blocker.');
          $('#brokerdetailspagead3').css({"color": "red", "text-align": "center"});
		  
        } 
      })
    }
    checkAdBlocker();
  });

</script>
</html>
