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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Kalyana Brokers - Terms & Conditions</title>
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
  </head>

<body>
	<?php include 'header.php'; ?>
     
    <!-- Page Title-->
    	<div class="container-fluid page-title">
			<div class="row green-banner">
            	<div class="container main-container">
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                		<h3 class="white-heading">Terms & Conditions</h3>
                    </div>
                </div>
            </div> 
        </div>
    <!--Page Title-->
    
    <!-- Job Data -->
  		<div class="container-fluid jpd-data white-bg">
        	<div class="row">
            	<div class="container main-container-job">
                	<div class="col-lg-12 col-md-12 col-sm-12">
                    	
                        <div class="content">
                        	<h2><strong>Terms and Conditions</strong></h2>

							<p>Welcome to Kalyana Brokers!</p>

							<p>These terms and conditions outline the rules and regulations for the use of Kalyana Brokers's Website, located at https://kbs.com/.</p>

							<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use Kalyana Brokers if you do not agree to take all of the terms and conditions stated on this page. Our Terms and Conditions were created with the help of the <a href="https://www.termsandconditionsgenerator.com">Terms And Conditions Generator</a> and the <a href="https://www.termsconditionsgenerator.com">Terms & Conditions Generator</a>.</p>

							<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>

							<h3><strong>Cookies</strong></h3>

							<p>We employ the use of cookies. By accessing Kalyana Brokers, you agreed to use cookies in agreement with the Kalyana Brokers's Privacy Policy.</p>

							<p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>

							<h3><strong>License</strong></h3>

							<p>Unless otherwise stated, Kalyana Brokers and/or its licensors own the intellectual property rights for all material on Kalyana Brokers. All intellectual property rights are reserved. You may access this from Kalyana Brokers for your own personal use subjected to restrictions set in these terms and conditions.</p>

							<p>You must not:</p>
							<ul>
								<li>Republish material from Kalyana Brokers</li>
								<li>Sell, rent or sub-license material from Kalyana Brokers</li>
								<li>Reproduce, duplicate or copy material from Kalyana Brokers</li>
								<li>Redistribute content from Kalyana Brokers</li>
							</ul>

							<p>This Agreement shall begin on the date hereof.</p>

							<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Kalyana Brokers does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Kalyana Brokers,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Kalyana Brokers shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>

							<p>Kalyana Brokers reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>

							<p>You warrant and represent that:</p>

							<ul>
								<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
								<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
								<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
								<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
							</ul>

							<p>You hereby grant Kalyana Brokers a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>

							<h3><strong>Hyperlinking to our Content</strong></h3>

							<p>The following organizations may link to our Website without prior written approval:</p>

							<ul>
								<li>Government agencies;</li>
								<li>Search engines;</li>
								<li>News organizations;</li>
								<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
								<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
							</ul>

							<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>

							<p>We may consider and approve other link requests from the following types of organizations:</p>

							<ul>
								<li>commonly-known consumer and/or business information sources;</li>
								<li>dot.com community sites;</li>
								<li>associations or other groups representing charities;</li>
								<li>online directory distributors;</li>
								<li>internet portals;</li>
								<li>accounting, law and consulting firms; and</li>
								<li>educational institutions and trade associations.</li>
							</ul>

							<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Kalyana Brokers; and (d) the link is in the context of general resource information.</p>

							<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>

							<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Kalyana Brokers. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>

							<p>Approved organizations may hyperlink to our Website as follows:</p>

							<ul>
								<li>By use of our corporate name; or</li>
								<li>By use of the uniform resource locator being linked to; or</li>
								<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>
							</ul>

							<p>No use of Kalyana Brokers's logo or other artwork will be allowed for linking absent a trademark license agreement.</p>

							<h3><strong>iFrames</strong></h3>

							<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>

							<h3><strong>Content Liability</strong></h3>

							<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>

							<h3><strong>Your Privacy</strong></h3>

							<p>Please read Privacy Policy</p>

							<h3><strong>Reservation of Rights</strong></h3>

							<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>

							<h3><strong>Removal of links from our website</strong></h3>

							<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>

							<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>
							
							<p>We are providing only the broker informations to the peoples. We are not responsible for the broker activities like money dealing or any other related with broker.</p>
							
							<p>We are not responsible for the customers or related with the customers who contact the brokers by taking the details from kbs.com, Money dealing or any other activities related with customer and broker we are not responsible.</p>
							
							<p>Amount can't be refunded to the brokers if the customer is not contacting them.</p>
							
							<p>Amount is collected from the brokers are only used to show the information to the customers</p>
							
							<p>All the informations are given by the customers and brokers are own by kbs.com</p>

							<h3><strong>Disclaimer</strong></h3>

							<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>

							<ul>
								<li>limit or exclude our or your liability for death or personal injury;</li>
								<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
								<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
								<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
							</ul>

							<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>

							<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>
                       
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
    
<?php include 'footer.php'; ?>
    
    
    
    <!-- Scripts
================================================== -->
    <div id="loaderss"></div>
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
   
</body>


</html>
