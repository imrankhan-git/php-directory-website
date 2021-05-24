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
    <title>KB - Contact us</title>
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
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
	

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
    
    <!--header section -->
    	<div class="container-fluid page-title">
			<div class="row blue-banner">
            	<div class="container main-container">
                	<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                		<h3 class="white-heading">Contact us </h3>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    	<h5>Say hi, drop a letter, and follow us in social media websites.</h5>
                    </div>
                </div>
            </div> 
        </div> 
  	 <!--header section -->
    
    
   <!-- full width section forms -->
    	<div class="container-fluid  contact_us">
        	<div class="row">
            	<div class="container main-container" id="form-style-2">
                	<div class="col-lg-12 col-lg-push-1">
                    	<form  name="contact_us" id="contact_us_form" method="post">
                        	<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Name:</label></div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><input type="text" name="contactpersonname" id="contactpersonname" placeholder="Your Name"></div>
                            </div>
                            <div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Email:</label></div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><input type="text" name="contactpersonemail" id="contactpersonemail" placeholder="Your Email"/></div>
                            </div>
							 <div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Subject:</label></div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><input type="text" name="contactpersonsubject" id="contactpersonsubject" placeholder="Short Message"/></div>
                            </div>
                            <div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Message:</label></div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><textarea rows="5" name="contactpersonmessage" id="contactpersonmessage" placeholder="Message in detail"></textarea></div>
                            </div>
                              <div class="form-group submit">
                              	
                            	<div class="col-lg-10 col-lg-push-2 col-md-10 col-md-push-2 col-sm-10 col-sm-push-2 col-xs-12"><input type="submit" name="submit" value="Send message"/></div>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
   <!-- full width section forms -->
   
    <!-- full width section Map 
   	<div class="container-fluid white-bg">
    	<div class="row">
        	<div class="container main-container">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- contact us page side ad 
						<ins class="adsbygoogle"
							 style="display:block"
							 data-ad-client="ca-pub-5344954780416051"
							 data-ad-slot="1276299672"
							 data-ad-format="auto"
							 data-full-width-responsive="true"></ins>
						<script>
							 (adsbygoogle = window.adsbygoogle || []).push({});
						</script>
                </div>
            </div>
        </div>
    </div>
   <!-- full width section Map-->
   
   <!-- full width section Map -->
   	<div class="container-fluid white-bg">
    	<div class="row">
        	<div class="container main-container">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.9837616664963!2d-74.12643088386947!3d40.78437114112046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c255d7fcd1b351%3A0x3fb8678fe924225a!2sGeraldine%20Rd%2C%20North%20Arlington%2C%20NJ%2007031%2C%20USA!5e0!3m2!1sen!2smv!4v1580561255513!5m2!1sen!2smv" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
   <!-- full width section Map-->
   
   <!-- full width section about us-->
 	<div class="container-fluid white-bg about_section">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                	<h3>Information</h3>
                    <p><strong>kbs</strong><br />
                            4468  Geraldine Lane, <br />
                            New York, NY 10013<br /> 
                     </p>
                  
                  	<ul class="contacts">
                    	<li><i class="fa fa-phone"></i>+1 646-270-3401</li>
                        <li><i class="fa fa-phone"></i>+1 646-778-0756</li>
                        <li><i class="fa fa-phone"></i>info@kbs.com</li>
                    </ul>
                    
                    <ul class="social">
                    	<li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                       
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				
				<h3>About us</h3>
				
				<p style="text-align: justify;text-justify: inter-word;">Now a days its hard to find the kalyana brokers or marriage brokers contact number to contact them for your daughters or son's marriage. Don't worry Because kbs.com is here to help you for finding the trusted and verified marriage broker details. Login and get all the broker details at free of cost.</p>
				
				<p style="text-align: justify;text-justify: inter-word;">Welcome to Kalyana Brokers, your number one source for searching the kalyana brokers or marriage brokers details. We're dedicated to giving you the very best search results, with a focus on Marriage broker address, Marriage broker details including email, whatsapp number and mobile number to easily contact the marriage brokers.</p>
				
                </div>
            </div>
        </div>
    </div>
   <!-- full width section about us-->
 	
<!--Footer Area-->
   		<?php include 'footer.php'; ?>
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
	<script type="text/javascript" src="assets/js/sweetalert.js"></script>
  	<script type="text/javascript" src="assets/counter/jquery.counterup.min.js"></script> 
    <!--Site JS-->
	<script src="assets/js/webjs.js"></script>
        <!-- Scripts
================================================== -->

<script>
	$(document).ready(function() {
		var spinner = $('#loaderss');
		$('#contact_us_form').on('submit', function(e) {
			e.preventDefault();
			var inputname = document.getElementById("contactpersonname").value;
			var inputemail = document.getElementById("contactpersonemail").value;
			var inputsubject = document.getElementById("contactpersonsubject").value;
			var inputmessage = document.getElementById("contactpersonmessage").value;
			
			if(inputname == "" || inputname == null)
			{
				alert("Your name cannot be empty");
			}
			else if(inputemail == "" || inputemail == null)
			{
				alert("Email cannot be empty");
			}
			else if(inputsubject == "" || inputsubject == null)
			{
				alert("Subject cannot be empty");
			}
			else if(inputmessage == "" || inputmessage == null)
			{
				alert("Message cannot be empty");
			}
			else
			{
				spinner.show();
				$.ajax({
					url: "phpfiles/contactus.php",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(response) {
						var message = response.message;
						var status = response.status;
						var messagetext = response.messagetext;
						if(status == 1)
						{
							spinner.hide();
							setTimeout(function () { 
							swal({
							  title: message,
							  text: messagetext,
							  type: "success",
							  confirmButtonText: "OK"
							},
							function(isConfirm){
							  if (isConfirm) {
								window.location.href = "index.php";
							  }
							}); }, 1000);
						}
						else
						{
							spinner.hide();
							setTimeout(function () { 
							swal({
							  title: message,
							  text: "",
							  type: "success",
							  confirmButtonText: "OK"
							},
							function(isConfirm){
							  if (isConfirm) {
								//window.location.href = "index.php";
							  }
							}); }, 1000);
							//spinner.hide();
						}
					}
				});
			}
		});
	});
	</script>
        
</body>
</html>
