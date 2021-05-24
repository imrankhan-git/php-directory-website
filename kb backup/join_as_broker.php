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
			$broker_payment = $brokernumrow['broker_payment'];
			$broker_bank_account_number = $brokernumrow['broker_bank_account_number'];
			$expiry_date = $brokernumrow['broker_account_expiry_date'];
			
			
			if($broker_payment == 1)
			{
			
			echo '<script language="javascript">';
			echo 'alert("You are already a member")';
			echo '</script>';
			
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
<html lang="en"><meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>KB - Join as Broker</title>
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
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
     
	<link rel="stylesheet" type="text/css" href="assets/css/pikaday.css">
	
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
	
	<!--Select 2-->
    <link rel="stylesheet" type="text/css" href="assets/webcss/select2.css"/>
    <link rel="stylesheet" type="text/css" href="assets/webcss/select2-bootstrap.css"/>
  
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
	.bs-searchbox
	{
		border:1px solid #D8D8D8 !important;
		border-radius:10px !important;
	}
	.bootstrap-select .dropdown-toggle .filter-option
	{
		background-color: white !important;
		height: 50px !important;
		border: 1px solid #D8D8D8 !important;
	}
	@media only screen and (max-width: 767px) and (min-width: 100px)  {
				
		.needgapclass
		{
			margin-top:20px !important;
		}
		.page-title .white-heading
		{
			font-size:20px !important;
		}
		
		
	}
	.colorred
	{
		color:red !important;
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
			<div class="row green-banner">
            	<div class="container main-container">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 needgapandsmall">
                		<h3 class="white-heading text-center">Join with us Now and get more marriage deals</h3>
                    </div>
                </div>
            </div> 
        </div> 
  	 <!--header section -->

    
   <!-- full width section forms -->
    	<div class="container-fluid  contact_us">
        	<form  method="post" id="form-style-2" name="brokersignupform" enctype="multipart/form-data">
				<div class="alert alert-primary" id="responsemessage1" style="display:none;"><i class="ti-user"></i>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="alert alert-danger" id="errormessage1" style="display:none;"><i class="ti-user"></i>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: Red !important;font-weight:600 !important;"><span aria-hidden="true">×</span></button>
				</div>
            	<div class="row user-information">
            	<div class="container main-container-home">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="colorred">* Fields are mandatory</p>
                        	<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Your First name<span class="colorred">*</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            		<input type="text" name="agentfirstname" id="agentfirstname" placeholder="Your First Name" required />
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Your Last name<span class="colorred">*</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            		<input type="text" name="agentlastname" id="agentlastname" placeholder="Your Last Name" required />
                            	</div>
                            </div>
                            <div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Your Email<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="text" name="agentemail" id="agentemail" placeholder="Your Email" required />
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Password<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="password" name="agentpassword" id="agentpassword" placeholder="Your Password" required />
                            	</div>
                            </div>
							
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Confirm Password<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="password" name="agentconfirmpassword" id="agentconfirmpassword" placeholder="Confirm password" required />
                            	</div>
                            </div>
							<span id='message'></span>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Mobile<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="text" name="agentmobile" id="agentmobile" placeholder="Your mobile number" required />
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Alternate Mobile(optional)</label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="text" name="agentalternatemobile" id="agentalternatemobile" placeholder="Alternate Mobile Number"/>
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Whatsapp Number<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="text" name="agentwhatsappnumber" id="agentwhatsappnumber" placeholder="Agent Whatsapp Number" required />
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Gender<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<select class="form-control" id="tagPicker" name="agentgender" required>
									  <option value="">Select</option>
                                      <option value="1">Male</option>
                                      <option value="2">Female</option>
                                    </select>
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Date of Birth<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="text" name="agentdob" id="agentdob" placeholder="Date of Birth" readonly="readonly"/>
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Your Address<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<textarea class="form-control" name="agentaddress" id="agentaddress" placeholder="Your Address" required></textarea>
                            	</div>
                            </div>
							 <!--<div class="form-group file-type">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label class="default">Proof document<span class="colorred">*</span> <br /><span></span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="file" name="agentproofdocument[]" id="agentproofdocument" placeholder="Voter id, Aadhar, Any goverment proof...." class="inputfile" multiple required />
                                
                                <div class="upload">
                                    <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse Document </div>
                                   <i>Upload your identity card to get more customers</i>
                                </div>
                                </div>
                            </div>-->
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Number of Successfull marriage's<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="text" name="agentsuccessfullmarriages" id="agentsuccessfullmarriages" placeholder="Number of Successfull Marriage's" required />
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Country<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<select class="form-control" id="location" name="country_select1" required>
									  <option style="font-size:14px !important;" id="country_select2" value="">-Select Country-</option>
										<?php
											$selectcountryres=$conn->query("SELECT * FROM table_country where status = 1");
											while($selectcountryrow=$selectcountryres->fetch_array())
											{
										?>
												<option value="<?php echo $selectcountryrow['id']; ?>"><?php echo ucfirst($selectcountryrow['country_name']); ?></option>
										<?php
											}
										?>
                                    </select>
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>State<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<select class="form-control" id="job-type" name="state_select1" required>
									  <option style="font-size:14px !important;" id="state_select2" value="">-Select State-</option>
                                    </select>
                            	</div>
                            </div>
							<div class="form-group">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Places you are managing<span class="colorred">*</span></label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <select class="form-control" id="skills" name="district_select1" multiple="multiple" required>
                                     <option style="font-size:14px !important;" id="district_select2" value="">-Select Districts-</option>
                                    </select>
                            	</div>
                            </div>
							
							<div class="form-group needgapclass">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<label>Invite Code(Your friend referal code who is inviting you)</label>
                            	</div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                	<input type="text" name="agentreferedby" id="agentreferedby" placeholder="Referal code"/>
                            	</div>
                            </div>
							
							
                            <input type="hidden" name="hidden_agentmanaginglocation" id="hidden_agentmanaginglocation" />
                            	
							 
							
							<div class="form-group submit needgapclass" >
                              	
                            	<div class="col-lg-10 col-lg-push-2 col-md-10 col-md-push-2 col-sm-10 col-sm-push-2 col-xs-12"><input type="submit" name="submit" value="SUBMIT DETAILS"/></div>
                            </div>
							
							
                     </div>
                </div>
            </div>
			
             </form>
        </div>
   <!-- full width section forms -->
   
    <!-- Blue Area -->
   	<div class="container-fluid blue-banner">
                <div class="row">
                    <div class="container main-container">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                            <h3 class="white-heading">Already have an account?</h3>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                             <a href="join_as_broker_login.php" class="btn btn-getstarted bg-red">Login</a>
                        </div>
                    </div>
                </div>
            </div>
   
   <!-- Blue Area -->
   
    <!-- Blue Area -->
   	<div class="container-fluid blue-banner" style="background-color:white !important;">
                <div class="row">
                    <div class="container main-container">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- join as broker register bottom ad -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5344954780416051"
     data-ad-slot="8995007595"
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
   
    <!--  jQuery 1.7+  -->
   <!--  jQuery 1.7+  -->
    <script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
     <!--Select 2-->
    <script type="text/javascript" src="assets/js/select2.min.js"></script>
    <!-- Html Editor -->
    <script src="assets/tinymce/tinymce.min.js"></script>
    <script>
		 tinymce.init({
		  selector: '.textarea',
		   templates: "modern",
		  menubar: false,
		 
		  toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | fontselect | bullist numlist outdent indent | link image',
		});
	</script>
 
   
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
	
	<script type="application/javascript" src="assets/js/moment.js"></script>
	<script type="application/javascript" src="assets/js/pikaday.js"></script>
	
    <!--Site JS-->
    <script src="assets/js/webjs.js"></script>
	<script>
	var spinner = $('#loaderss');
			$('#agentpassword, #agentconfirmpassword').on('keyup', function () {
			  if ($('#agentpassword').val() == $('#agentconfirmpassword').val()) {
				$('#message').html('Matched').css('color', 'green');
			  } else 
				$('#message').html('Passwords do not match').css('color', 'red');
			});
			 $('#skills').change(function(){
			  $('#hidden_agentmanaginglocation').val($('#skills').val());
			 });
			
	</script>
    <script>
    var picker = new Pikaday(
	{
		field: document.getElementById('agentdob'),
		format : "DD/MM/YYYY",
		firstDay: 1,
		maxDate: moment().toDate(),
		yearRange: [1900,2050]
	});
	</script>
	<script>
	
	$('#location').change(function()
    {
		spinner.show();
        var selectedcountry = $('#location').val();        
		if(selectedcountry != "") {
		  $.ajax({
			url:"phpfiles/getstates.php",
			data:{country_id:selectedcountry},
			type:'POST',
			success:function(response) {
			  var resp = $.trim(response);
			  $("#job-type").html(resp);
			  spinner.hide();
			}
		  });
		} else {
		  $("#job-type").html("<option value=''>------- No states --------</option>");
		  spinner.hide();
		}
    });
	
	$('#job-type').change(function()
    {
        var state_select = $('#job-type').val();
        spinner.show();
		if(state_select != "") {
		  $.ajax({
			url:"phpfiles/get_district_for_broker_signup.php",
			data:{state_select:state_select},
			type:'POST',
			success:function(response) {
			  var respe = $.trim(response);
			  $("#skills").html(respe);
			  spinner.hide();
			}
		  });
		} else {
			$("#skills").html("<option value=''>------- No Districts --------</option>");
			spinner.hide();
		}
    });
	
	
	
		/* Profile form submit function */

	$(document).ready(function() {
		
		var spinner = $('#loaderss');
		$('#form-style-2').on('submit', function(e) {
			e.preventDefault();
			var testlocation = $('#hidden_agentmanaginglocation').val();
			var agentemail = $('#agentemail').val();
			console.log(testlocation);
			if(agentemail == "" || agentemail == null)
			{
				alert("Email cannot be empty");
			}
			else
			{
				spinner.show();
				$.ajax({
					url: "phpfiles/brokersignup.php",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(response) {
						var message = response.message;
						var status = response.status;
						var refercode1 = response.referalcode;
						var inserteddata = response.data;
						
						if(status == 1)
						{
							spinner.hide();
							setTimeout(function () { 
							swal({
							  title: message,
							  text: refercode1,
							  type: "success",
							  confirmButtonText: "OK"
							},
							function(isConfirm){
							  if (isConfirm) {
								 /* console.log("broker" + inserteddata.id);
								  console.log("broker" + inserteddata.broker_name);
								  window.location.href = "kalyana_brokers_broker_details_for_payment.php?broker_id=" + inserteddata.id + "&broker_name=" + inserteddata.broker_name;*/
								  window.location.href = "index.php"
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
							  type: "error",
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
    
    <!-- Scripts
================================================== -->
        
</body>
</html>
