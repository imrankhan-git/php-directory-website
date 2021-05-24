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
		
		
		
		 $customernumres = $conn->query("SELECT * FROM table_customers where customer_email = '$customerloginemail' order by id desc limit 1");
		 $customernumrow = $customernumres->fetch_assoc();
		 $num_rows = $customernumres->num_rows;
		 if ($num_rows > 0)
		 {
			 $customerid = $customernumrow['id'];
			 $customermobile = $customernumrow['customer_mobile'];
			 
		 }
		 else
		 {
			 $customerid = "";
			 $customermobile = "Not Found";
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
			$broker_account_status = $brokernumrow['broker_account_status'];
			$broker_bank_account_number = $brokernumrow['broker_bank_account_number'];
			
		 
		}
	}
}


	
?>

<!DOCTYPE html>
<html lang="en"><meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>KB - Brokers Profile</title>
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
	
	<script data-ad-client="ca-pub-5344954780416051" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
     
  
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

<body class="title-image">
	<!-- Header Image Or May be Slider-->
    <?php include 'header.php'; ?>
	<!-- Header Image Or May be Slider-->
     
    <!-- Page Title-->
    	<div class="container-fluid blue-banner page-title bg-image">
			<div class="row section-title">
            	<div class="container main-container">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<h3 class="image-heading"><?php echo $brokerfirstname.' '.$brokerlastname; ?> Profile</h3>
                    </div>
                </div>
            </div>  
            <div class="row dashboard green-banner" style="background:#12cd6a">
            	<div class="container main-container gery-bg">
            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding user-data">
                        <div class="seprator ">
                            <div class="no-padding user-image"><img src="assets/images/kb_profile_logo.png" alt=""/></div>
                            <div class="user-tag"><?php echo $brokerfirstname.' '.$brokerlastname; ?><span> Broker</span></div>
                        </div>
						<div class="seprator">
                            <div class="user-tag"><label>Email<span><?php echo $brokeremail; ?></span></label></div>
                       	</div>
                        <div class="seprator">
                            <div class="user-tag"><label>Mobile<span><?php echo $brokermobile; ?></span></label></div>
                       	</div>
                	</div>
            </div>
            </div>       
        </div>
    <!-- Page Title-->
  
    
    <!-- Job Data -->
  		<div class="container-fluid jpd-data white-bg">
        	<div class="row">
            	<div class="container main-container-job">
                	<div class="col-lg-9 col-md-9 col-sm-8">
                      <div class="content">
                        	 <div class="widget w2">
                        	<div class="subscribe">
                                <form id="brokerprofileform" name="brokerprofileform" method="post" >
                                <h3>Update your profile</h3><br/>
								<div class="alert alert-primary" id="responsemessage" style="display:none;"><i class="ti-user"></i>
								   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								</div>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $brokerfirstname; ?>" name="brokerfirstname" id="brokerfirstname" placeholder="Broker First name"/><br/>
										<input type="text" value="<?php echo $brokerlastname; ?>" name="brokerlastname" id="brokerlastname" placeholder="Broker Last name"/><br/>
										<input type="text" value="<?php echo $brokermobile; ?>" name="brokermobile" id="brokermobile" placeholder="Broker Mobile"/><br/>
										<input type="text" value="<?php echo $broker_whatsapp_number; ?>" name="brokerwhatsappnumber" id="brokerwhatsappnumber" placeholder="Broker Whatsapp number"/><br/>
										<input type="text" value="<?php echo $broker_success_marriage; ?>" name="brokersuccessmarriage" id="brokersuccessmarriage" placeholder="Broker Successfull marriage"/><br/>
										<textarea rows="4" cols="50" name="brokeraddress" id="brokeraddress" placeholder="Broker Address"><?php echo $broker_address; ?></textarea><br/>
										
										 <input type="hidden" value="<?php echo $brokeremail; ?>" name="brokeremail" id="brokeremail"/><br/>
										 <input type="hidden" value="<?php echo $brokerid; ?>" name="brokerid" id="brokerid"/><br/>
										 
                                        <button type="submit" class="btn btn-print bg-blue">Update Profile</button>
                                    </div>
                                </form>
								<p><a href="broker_forgot_password.php">Click here to Change your password?</a></p>
                            </div>
                        </div>
                         </div>
                    </div>
                </div>
            </div>
        
        </div>
    <!-- Job Data-->
    

    
 	
    
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

<script>
	$(document).ready(function() {
		var spinner = $('#loaderss');
		$('#brokerprofileform').on('submit', function(e) {
			e.preventDefault();
			var inputfirstname = document.getElementById("brokerfirstname").value;
			var inputlastname = document.getElementById("brokerlastname").value;
			var inputemail = document.getElementById("brokeremail").value;
			var inputmobile = document.getElementById("brokermobile").value;
			var inputwhatsappnumber = document.getElementById("brokerwhatsappnumber").value;
			var inputsuccessmarriage = document.getElementById("brokersuccessmarriage").value;
			var inputaddress = document.getElementById("brokeraddress").value;
			
			if(inputfirstname == "" || inputfirstname == null)
			{
				alert("Your First name cannot be empty");
			}
			if(inputlastname == "" || inputlastname == null)
			{
				alert("Your Last name cannot be empty");
			}
			else if(inputemail == "" || inputemail == null)
			{
				alert("Email cannot be empty");
			}
			else if(inputmobile == "" || inputmobile == null)
			{
				alert("Mobile cannot be empty");
			}
			else if(inputwhatsappnumber == "" || inputwhatsappnumber == null)
			{
				alert("Mobile cannot be empty");
			}
			else if(inputsuccessmarriage == "" || inputsuccessmarriage == null)
			{
				alert("Mobile cannot be empty");
			}
			else if(inputaddress == "" || inputaddress == null)
			{
				alert("Mobile cannot be empty");
			}
			else
			{
				spinner.show();
				$.ajax({
					url: "phpfiles/updatebrokerprofile.php",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(response) {
						var message = response.message;
						var status = response.status;
						if(status == 1)
						{
							$('#responsemessage').html(message).css({"font-weight": "bold","display": "block"});
							$('#responsemessage').delay(10000).fadeOut(200);
							
							spinner.hide();
							
						}
						else
						{
							$('#responsemessage').html(message).css({"font-weight": "bold","display": "block"});
							$('#responsemessage').delay(10000).fadeOut(200);
							
							spinner.hide();
						}
					}
				});
			}
		});
	});
	</script>
      
</body>
</html>
