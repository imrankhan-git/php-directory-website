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


	
?>
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>KB - Join as Customer</title>
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
	<?php include 'header.php'; ?>
    
    <div class="container-fluid login_register header_area deximJobs_tabs">
    	<div class="row">
            <div class="container main-container-home">
                    <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-pills ">
                            <li class="active"><a data-toggle="tab" href="#register-account">Register</a></li>
                        </ul>
                    <div class="tab-content">
                        <div id="register-account">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                            	<p>Register your account.</p>
                                        <form name="customerregisterform" id="customerregisterform" class="contact_us">
											<div class="alert alert-primary" id="responsemessage" style="display:none;"><i class="ti-user"></i>
											   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>
                                            <div class="form-group">
                                                <label>Your First name</label>
                                                <input type="text" name="customerfirstname" id="customerfirstname" placeholder="Enter Your First Name here" required />
                                            </div>
											<div class="form-group">
                                                <label>Your Last name</label>
                                                <input type="text" name="customerlastname" id="customerlastname" placeholder="Enter Your Last Name here" required />
                                            </div>
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="text" name="customeremail" id="customeremail" placeholder="Enter Your Email here" required />
                                            </div>
											<div class="form-group">
                                                <label>Mobile</label>
                                                <input type="text" name="customermobile" id="customermobile" placeholder="Enter Your Mobile Number here" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="customerpassword" id="customerpassword" placeholder="Enter Your Password" required />
                                            </div>
                                             <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="customerconfirmpassword" id="customerconfirmpassword" placeholder="Enter Your Confirm Password" required />
                                            </div>
											<span id='message'></span>	
                                            <div class="form-group submit">
                                                <label>Submit</label>
                                                <input type="submit" name="submit" value="Register" class="register">
                                                <a  href="join_as_customer_login.php" class="lost_password">Have an account? Login</a>
                                            </div>
									</form>
                        	</div>
                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12  pull-right sidebar">
                            	<div class="widget">
                                	<h3>Why to have  an account in Kalyana Brokers? </h3>
                                    <ul>
                                    	<li><p><i class="fa fa-clock-o"></i>To find the best marriage brokers</p></li>
										<li><p><i class="fa fa-child"></i>Lifetime free</p></li>
										<li><p><i class="fa fa-check-circle-o"></i>No hidden charges for customers</p></li>
										<li><p><i class="fa fa-check-circle-o"></i>Have an account?</p></li>
										<li>
                                        <a href="join_as_customer_login.php" class="label job-type register">Login</a>
                                        
                                        </li>
                                    </ul>
                                   
                           		</div> 
                            </div>
                        </div>
                    </div>
                        
                        
                    </div>
                    
			</div>
       </div>
    </div> 
	
	<!-- Blue Area -->
   	<div class="container-fluid blue-banner">
                <div class="row">
                    <div class="container main-container">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- customer register -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5344954780416051"
     data-ad-slot="7785674180"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                        </div>
                    </div>
                </div>
            </div>
   
   <!-- Blue Area -->
	
	
  	 
<!--Footer Area-->
   	<?php include 'footer.php'; ?>
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
			$('#customerpassword, #customerconfirmpassword').on('keyup', function () {
			  if ($('#customerpassword').val() == $('#customerconfirmpassword').val()) {
				$('#message').html('Matched').css('color', 'green');
			  } else 
				$('#message').html('Passwords do not match').css('color', 'red');
			});
	</script>
	<script>
	$(document).ready(function() {
		var spinner = $('#loaderss');
		$('#customerregisterform').on('submit', function(e) {
			e.preventDefault();
			var inputfirstname = document.getElementById("customerfirstname").value;
			var inputlastname = document.getElementById("customerlastname").value;
			var inputemail = document.getElementById("customeremail").value;
			var inputmobile = document.getElementById("customermobile").value;
			var inputpassword = document.getElementById("customerpassword").value;
			var inputconfirmpassword = document.getElementById("customerconfirmpassword").value;
			
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
			else if(inputpassword == "" || inputpassword == null)
			{
				alert("Password cannot be empty");
			}
			else if(inputconfirmpassword == "" || inputconfirmpassword == null)
			{
				alert("Confirm password cannot be empty");
			}
			else
			{
				spinner.show();
				$.ajax({
					url: "phpfiles/signup.php",
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
							$('#message').hide();
							console.log(message);
							spinner.hide();
							$("#customerregisterform")[0].reset();
							window.setTimeout(function() {
								window.location.href = "index.php";
							}, 2000);
						}
						else
						{
							$('#responsemessage').html(message).css({"font-weight": "bold","display": "block"});
							$('#responsemessage').delay(10000).fadeOut(200);
							$('#message').hide();
							spinner.hide();
						}
					}
				});
			}
		});
	});
	</script>
    
  <!-- Scripts
================================================== -->
        
</body>
</html>
