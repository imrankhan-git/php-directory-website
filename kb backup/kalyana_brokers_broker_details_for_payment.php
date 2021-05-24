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
			$broker_bank_account_number = $brokernumrow['broker_bank_account_number'];
			
		 
		}
		else
		{
			$customerid = "";
			$brokermobile = "Not Found";
		}
		
		$brokerredirectid = $_GET[broker_id];
		
		if($brokerredirectid == "" || $brokerredirectid == null)
		{
			echo '<script language="javascript">';
			echo 'alert("You are not authorized to view this page")';
			echo '</script>';
		}
		else
		{
			$prd_name = "Plan Enterprise";
			$price = 365;
			$instamojopercent = 3; /* 3 percent of price */
			$instamojoamount = 3;  /* 3 rupees of price */
			$gsttax = 18; /* 18 percent of totalprice */
			
			/* price calculation with tax and fee */
			
			$instamojofeepercent = ($price / 100) * $instamojopercent;
			$instamojofeerupees = $instamojofeepercent + $instamojoamount;
			$tax = ($instamojofeerupees / 100) * $gsttax;
			$finalprice = $price + $instamojofeerupees + $tax;
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
    <title>KB - Payment page</title>
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
	<style>
	.sidelabel { width: 200px; float: left; margin: 0 20px 0 0; }
	.sidespan { display: block; margin: 0 0 3px; font-size: 1.2em; font-weight: bold; }
	.sideinput { width: 200px; border: 1px solid #000; padding: 5px; }
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

<body class="">
	<?php include 'header.php'; ?>
     
      <!--header section -->
    	<div class="container-fluid page-title">
			<div class="row blue-banner">
            	<div class="container main-container">
                	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                		<h3 class="white-heading">Checkout</h3>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-6 colxs-12 capital">
                    	<h5>“Enterprise plan” has been added to your cart.</h5>
                    </div>
                </div>
            </div> 
        </div> 
  	 <!--header section -->
	 
	 <!-- Job Data -->
  		<div class="container-fluid jpd-data white-bg">
        	<div class="row">
            	<div class="container main-container-job">
                	<div class="col-lg-9 col-md-9 col-sm-8">
                    	
                        <div class="content">
								<form name="contact_us" id="form-style-2" action="phpfiles/kbspay.php" method="POST" accept-charset="utf-8">
									<div class="form-group">
										<label class="heading">Billing Details</label>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-lg-xs-12">
											<label>First Name *</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="fullname" id="fullname" placeholder="First Name" value="<?php echo $brokerfirstname.' '.$brokerlastname; ?>" readonly />
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-lg-xs-12">
											<label>Email Address *</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="email" name="fullemail" id="fullemail" placeholder="your@email"  value="<?php echo $brokeremail; ?>" readonly />
										</div>
									</div>
									 <div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-lg-xs-12">
											<label>Phone *</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="fullmobile" id="fullmobile" placeholder="eg.+91998877665544" value="<?php echo $brokermobile; ?>"  />
										</div>
									</div>
									<input type="hidden" id="product_name" name="product_name" value="<?php echo $prd_name; ?>"> 
									<input type="hidden" id="product_price" name="product_price" value="<?php echo round($price, 2); ?>"> 
									
									
								</form>
                         </div>

                         
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-4 sidebar">
					
										
									
                        <div class="widget w2">
                        	<div class="subscribe">										
                                <form>
									<h3>Price Details in INR(₹) </h3>
									
									<div class="row">
										<div class="col-xs-6">
											<p style="text-align:left !important;font-size:15px !important;">Price :</p>
											<p style="text-align:left !important;font-size:15px !important;">Bank fee :</p>
											<p style="text-align:left !important;font-size:15px !important;">GST :</p>
											<p style="text-align:left !important;font-size:15px !important;">---------</p>
											<p style="text-align:left !important;font-size:15px !important;">Total :</p>
										</div>
										<div class="col-xs-6">
											<p style="text-align:right !important;font-size:15px !important;"><?php echo round($price, 2).'.00'; ?></p>
											<p style="text-align:right !important;font-size:15px !important;"><?php echo round($instamojofeerupees, 2); ?></p>
											<p style="text-align:right !important;font-size:15px !important;"><?php echo round($tax, 2); ?></p>
											<p style="text-align:right !important;font-size:15px !important;">---------</p>
											<p style="text-align:right !important;font-size:15px !important;"><?php echo round($finalprice, 2); ?></p>
										</div>
									</div>
									<br/>
									<div class="row">
										<div class="col-xs-12">
											<button type="button" class="btn btn-print bg-blue" id="buttonid" name="buttonid"> Pay ₹: <?php echo round($finalprice, 2); ?></button>
										</div>
									</div>
                                </form>
                            </div>
                        </div>           
                    </div>
                </div>
            </div>
        
        </div>
    <!--Job Data-->
    
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
	
	<script>
        tinymce.init({
          selector: 'textarea',
           templates: "modern",
          menubar: false,
         
          toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | fontselect | bullist numlist outdent indent | link image',
          content_css: '//www.tinymce.com/css/codepen.min.css'
        });
		
		var sessionvalue = '<?php echo $sessionvalue; ?>';
		console.log("session"+sessionvalue);
     </script>
	 
	 <script>
	 
	 $(function() {
		  $("#buttonid").click( function()
			   {
				 $('#form-style-2')[0].submit();
			   }
		  );
	});

	 function paymentfunction()
	 {
		var inputname = document.getElementById("fullname").value;
		var inputemail = document.getElementById("fullemail").value;
		var inputmobile = document.getElementById("fullmobile").value;
		
		var product_name = document.getElementById("product_name").value;
		var product_price = document.getElementById("product_price").value;
		
		$.ajax({
			url: "phpfiles/kbspay.php",
			type: "POST",
			data: {
			brokername:inputname,
			brokeremail:inputemail,
			brokermobile:inputmobile,
			product_name:product_name,
			product_price:product_price
			},
			dataType: "json",
			success: function(response) {
				var message = response.message;
				var status = response.status;
				if(status == 1)
				{
					alert(message);
				}
				else
				{
					alert(message);
				}
			}
		});
	 }
	</script>
	
	 <script>
	 
	 $(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
});

	 </script>
	 
	 <script type="text/javascript">
if (document.layers) {
        //Capture the MouseDown event.
    document.captureEvents(Event.MOUSEDOWN);
 
    //Disable the OnMouseDown event handler.
    $(document).mousedown(function () {
        return false;
    });
}
else {
    //Disable the OnMouseUp event handler.
    $(document).mouseup(function (e) {
        if (e != null && e.type == "mouseup") {
            //Check the Mouse Button which is clicked.
            if (e.which == 2 || e.which == 3) {
                //If the Button is middle or right then disable.
                return false;
            }
        }
    });
}
 
//Disable the Context Menu event.
$(document).contextmenu(function () {
    return false;
});
</script>

  <!-- Scripts
================================================== -->
        
</body>
</html>
