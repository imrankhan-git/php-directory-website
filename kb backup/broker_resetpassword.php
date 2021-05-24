<?php
session_start(); // Starting Session
include 'dbconfig.php';
$adminemail = $_GET['recovery'];


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
    <title>KB - Reset password</title>
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
	@media only screen and (max-width: 767px) and (min-width: 100px)  {
				
		.needgapclass
		{
			margin-top:20px !important;
		}
		
	}
	</style>
  </head>

<body class="title-image">
	<?php include 'header.php'; ?>
    
    <div class="container-fluid login_register header_area deximJobs_tabs">
    	<div class="row">
            <div class="container main-container-home">
                    <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-pills ">
                            <li class="active"><a data-toggle="tab" href="#register-account" style="font-size:30px;">Reset your Password for Brokers</a></li>
                        </ul>
                    <div class="tab-content">
                        <div id="login" class="tab-pane fade in active white-text">
                        	
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                            	<p>Reset password to your account.</p>
                                <form name="resetpasswordform" id="resetpasswordform" class="contact_us">
								<div class="alert alert-primary" id="responsemessage1" style="display:none;"><i class="ti-user"></i>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								</div>
								<div class="alert alert-danger" id="errormessage1" style="display:none;"><i class="ti-user"></i>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: Red !important;font-weight:600 !important;"><span aria-hidden="true">×</span></button>
								</div>
                        	<div class="form-group">
                            	<label>New Password</label>
                            	<input type="password" id="newpassword" name="newpassword" placeholder="Enter Password here" required>
                            </div>
                           
                            <div class="form-group">
                            	<label>Confirm Password</label>
                            	<input type="password" id="newconfirmpassword" name="newconfirmpassword" placeholder="Re type Password here" required />
                            </div>
                            <span id='message'></span>	
							<input type="hidden" id="recovery" name="recovery" value="<?php echo $adminemail; ?>" />                          
                          
                            <div class="form-group submit needgapclass">
                            	<label>Submit</label>
                            	<input type="submit" name="submit" value="Change Password" class="signin" id="signin">
                                <a href="join_as_broker_login.php" class="lost_password">Remember Password?</a>
                            </div>
                           
                        
                        	</form>
                        	</div>
                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12  pull-right sidebar">
                            	<div class="widget">
                                	<h3>Don't have an account?</h3>
                                    <ul>
                                    	<li>
                                        <p> If you'd like to find out more marriage brokers, please complete this enquiry form.</p></li>
										<li><p>A member of our Sales team will contact you shortly.</p></li>
										<li>
                                        <a href="join_as_broker.php" class="label job-type register">Register</a>
                                        
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
			$('#newpassword, #newconfirmpassword').on('keyup', function () {
			  if ($('#newpassword').val() == $('#newconfirmpassword').val()) {
				$('#message').html('Matched').css('color', 'green');
			  } else 
				$('#message').html('Passwords do not match').css('color', 'red');
			});
		</script>
		<script>
			$(document).ready(function() {
				var spinner = $('#loaderss');
				$('#resetpasswordform').on('submit', function(e) {
					e.preventDefault();
					var newpassword = document.getElementById("newpassword").value;
					var newconfirmpassword = document.getElementById("newconfirmpassword").value;
					var newrecovery = document.getElementById("recovery").value;
					
					if(newpassword == "" || newpassword == null)
					{
						alert("Password cannot be empty");
					}
					else if(newconfirmpassword == "" || newconfirmpassword == null)
					{
						alert("Confirm Password cannot be empty");
					}
					else
					{
						spinner.show();
						$.ajax({
							url: "phpfiles/brokerresetpassword.php",
							type: "POST",
							data: {password:newpassword,confirmpassword:newconfirmpassword,recovery:newrecovery},
							dataType: "json",
							success: function(response) {
								var message = response.message;
								var status = response.status;
								if(status == 1)
								{
									$('#responsemessage').html(message).css({"font-weight": "bold","display": "block"});
									$('#responsemessage').delay(2000).fadeOut(400);
									$('#message').hide();
									console.log(message);
									spinner.hide();
									$("#resetpasswordform")[0].reset();
									window.location.href = "join_as_broker_login.php";
								}
								else
								{
									$('#responsemessage').html(message).css({"font-weight": "bold","display": "block"});
									$('#responsemessage').delay(2000).fadeOut(400);
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
