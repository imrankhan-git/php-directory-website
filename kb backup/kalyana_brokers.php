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
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
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
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     
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

<body class="title-image">
<?php include 'header.php'; ?>
     
    <!-- Page Title-->
    	<div class="container-fluid green-banner page-title bg-image">
			<div class="row section-title">
            	<div class="container main-container">
                	<div class="col-lg-8 col-md-8 col-sm-8">
                		<h3 class="image-heading">Kalyana Brokers</h3>
                    </div>
                </div>
            </div> 
        </div>
    <!-- Page Title-->
  
  	<!-- Job Categories Filters -->
        <div class="jobs_filters">
           
            <div class="container">
                    	<form method="post">
                    	<!--col-lg-3 filter_width -->
						
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="form-group">
										<select class="selectpicker form-control filters_feilds" id="country_select" name="country_select">
											<option style="font-size:14px !important;" id="country_select1" selected="selected" value="">-Select Country-</option>
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
							
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="form-group">
										<select class="selectpicker form-control filters_feilds" id="state_select" name="state_select">
											<option style="font-size:14px !important;" id="state_select1" selected="selected" value="">-Select State-</option>
										</select>
								</div>
							</div>
							
							<!-- District Filter -->
							
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="form-group">
										<select class="selectpicker form-control filters_feilds" id="district_select" name="district_select">
										<option style="font-size:14px !important;" id="district_select1" selected="selected" value="">-Select District-</option>
										</select>
								</div>
							</div>
                         
                         <!-- col-lg-5 filter_width -->
                         
							<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
								<div class="form-group">
										<select class="selectpicker form-control filters_feilds" id="sort_select" name="sort_select">
											<option value="0">Default Sort</option>
											<option value="1">Name: Ascending</option>
											<option value="2">Name: Descending</option>
										</select>
								</div>
							</div>
							
							
                            <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12 filter_width bgicon submit">
                                <div class="form-group">
                                   <a href="javascript:void(0);" onclick="Go_Filter();"><input type="button" class="customsubmit" name="submit" value="Search"/></a>
                                   <span class="glyphicon fa fa-search" aria-hidden="true"></span>
                                </div>
                            </div>
                            </form>
            </div>
        </div>
  	<!-- Job Categories Filters -->
   <!--maine container Section -->
        <div class="container main-container-home">
           <div class="jobs_results">
		  <?php
		   if($sessionvalue == 2)
		   {
		   if($broker_payment_status == 0)
			{
		   ?>
		  <div class="alert alert-danger" role="alert">
			  Please pay to show your profile to customers
		  </div>
		  <?php
			}
			elseif($broker_account_status == 0)
			{
		  ?>
		  <div class="alert alert-danger" role="alert">
			  Please verify your email to show your profile to customers
		  </div>
		  <?php
			}
			else
			{
			}
		   }
		  ?>
				<div class="jobs-result"> 
				   <!--Search Result 01-->
					<div class="col-lg-12">
					<div class="filter-result 01">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="kbpagead1">
						   <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<ins class="adsbygoogle"
								 style="display:block"
								 data-ad-format="fluid"
								 data-ad-layout-key="-hk-f-24-ge+17h"
								 data-ad-client="ca-pub-5344954780416051"
								 data-ad-slot="5932969210"></ins>
							<script>
								 (adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
					</div>
						<div id="loading_gif">
							<div id="loading2" style="" ></div>
						</div>
						<div class="post-data-list" id="product_data"></div>
						<div class="filter-result 02">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="kbpagead2">
						   <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<ins class="adsbygoogle"
								 style="display:block"
								 data-ad-format="fluid"
								 data-ad-layout-key="-hk-f-24-ge+17h"
								 data-ad-client="ca-pub-5344954780416051"
								 data-ad-slot="5929439091"></ins>
							<script>
								 (adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
					</div>
						<div class="show-more load-post" title="More posts" id="loadmorepostsdiv"><i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Loading...</div>
					 </div> 
				</div>
				 <!--Filters Category -->
                 <div class="tab_filters text-center">
					<div class="col-lg-12 showmorebuttons text-center" id="showmorebutton">
						
					</div>
                 </div>
              	<!-- Filters Category --> 
           </div>
        </div>
    <!--main container Section --> 
    
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
	
	 <!-- Job Data -->
  		<div id="dialog" title="Managing Places">
		  <p id="brokermanagingplacestext" style="font-size:15px !important;"></p>
		</div>
    <!--Job Data-->

    
<!--Footer Area-->
   		<?php include 'footer.php'; ?>
        <!-- Scripts
================================================== -->
    <!--  jQuery 1.7+  -->
     <script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
	 
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
  

</script>
<script>
	var spinner = $('#loaderss');
	$('#country_select').change(function()
    {
        var selectedcountry = $('#country_select').val();
		
        spinner.show();
		if(selectedcountry != "") {
		  $.ajax({
			url:"phpfiles/getstates.php",
			data:{country_id:selectedcountry},
			type:'POST',
			success:function(response) {
			  var resp = $.trim(response);
			  $("#state_select").html(resp);
			  spinner.hide();
			}
		  });
		} else {
		  $("#state_select").html("<option value=''>------- No states --------</option>");
		  spinner.hide();
		}
    });
	
	$('#state_select').change(function()
    {
        var state_select = $('#state_select').val();
        spinner.show();
		if(state_select != "") {
		  $.ajax({
			url:"phpfiles/get_district.php",
			data:{state_select:state_select},
			type:'POST',
			success:function(response) {
			  var respe = $.trim(response);
			 $("#district_select").html(respe);
			 spinner.hide();
			}
		  });
		} else {
		  $("#district_select").html("<option value=''>------- No Districts --------</option>");
		  spinner.hide();
		}
    });
	
	$('#district_select').change(function()
    {
        var district_select = $('#district_select').val();
       
		if(district_select != "") {
		  $.ajax({
			url:"phpfiles/get_people_visit_count_for_district.php",
			data:{district_select:district_select},
			type:'POST',
			success:function(response) {
			  var respes = $.trim(response);
			  if(respes == "1")
			  {
				  
			  }
			  else
			  {
				  
			  }
			}
		  });
		} else {
		  alert('District value cannot be empty');
		}
    });

$(document).ready(function() {

    product_filters();

});

var showPostFrom = 0;
var defaultPostTo = 8; /* Default Record Count on First Load or Filter Click*/
var showPostCount = 8; /* Load More Record Count */
var totalRecord = 0;
var state_selected;
var district_selected;
var sortby_val;
var sessionvalue = '<?php echo $sessionvalue; ?>';
var emailverifiedstatus = '<?php echo $emailverifiedstatus; ?>';
var countryselected;

function product_filters()
{
	var postCount =0;
	$('#product_data').html('').show('slow');
	$('#showmorebutton').hide();
	$('#loading_gif').html('<div id="loading2" style="" ></div>');
	
	$.ajax({
		url: "phpfiles/product_filters.php",
		type: "POST",
		data: {
			showPostFrom:showPostFrom,
			showPostTo:defaultPostTo,
			country_id:countryselected,
			state_id:state_selected,
			district_id:district_selected,
			sortby_val:sortby_val,
			sessionvalue:sessionvalue,
			emailverifiedstatus:emailverifiedstatus
			},
		type:'POST',
		dataType: "json",
		success: function(response) {
			var message = response.message;
			var status = response.status;
			var product_data = response.data;
			totalRecord = response.tot_rec;
			console.log("filterTotalRecord:"+totalRecord);
			console.log(postCount);
			
			if(status == 1)
			{
				$('#loading_gif').html('');
				showPostFrom = 0;

				$('#product_data').html(product_data).show('slow');

			}else{
				$('#loading_gif').html('');
				$('#product_data').html(product_data).show('slow');
			}
			postCount = $('.li-post-group:last').index() + 1;
				if(postCount < totalRecord){
					if(showPostCount <= totalRecord )
					{
					$('#showmorebutton').show();
					$('#showmorebutton').html('<a href="javascript:void(0);" onclick="showmorerecordsclick()" id="showingmorerecordsbtn" class="btn btn-default dropdown-toggle">Show More Records <span class="glyphicon glyphicon-menu-down"></span></a>');
					}
					else
					{
						$('#showmorebutton').hide();
					}
				}else
				{
					$('#showmorebutton').hide();
				}
			
		}
	});
}


</script>
<script>
function showmorerecordsclick() {
	var postCount =0;
	postCount = $('.li-post-group:last').index() + 1;
	console.log("ScrollPostCount:"+postCount);
	console.log("ScrollTotalRecord:"+totalRecord);
	if(postCount < totalRecord){
		
		showPostFrom = +showPostFrom + +showPostCount;
		console.log("showPostFrom:"+showPostFrom);
		$('#showmorebutton').hide();
		$('#loadmorepostsdiv').show();
		$.ajax({
			type:'POST',
			dataType: "json",
			url:'phpfiles/products_more.php',
			data:{
				'action':'showPost',
				'showPostFrom':showPostFrom,
				'showPostCount':showPostCount,
				'totalRecord':totalRecord,
				'country_id':countryselected,
				'state_id':state_selected,
				'district_id':district_selected,
				'sortby_val':sortby_val,
				'sessionvalue':sessionvalue,
				'emailverifiedstatus':emailverifiedstatus
				},
			success:function(response){
				var message = response.message;
				var status = response.status;
				var product_data = response.data;
				
				if(status == 1)
				{
					$('#loadmorepostsdiv').hide();
					$('#product_data').append(product_data).show('slow');
				}else{
					$('#loadmorepostsdiv').hide();
				}
				postCount = $('.li-post-group:last').index() + 1;
				if(postCount < totalRecord){
					if(showPostCount <= totalRecord )
					{
					$('#showmorebutton').show();
					$('#showmorebutton').html('<a href="javascript:void(0);" onclick="showmorerecordsclick()" id="showingmorerecordsbtn" class="btn btn-default dropdown-toggle">Show More Records <span class="glyphicon glyphicon-menu-down"></span></a>');
					}
					else
					{
						$('#showmorebutton').hide();
					}
				}else
				{
					$('#showmorebutton').hide();
				}
			}
		});
	}
}
</script>
<script>
function Go_Filter()
{
	countryselected = $('#country_select').val();
	state_selected = $('#state_select').val();
	district_selected = $('#district_select').val();
	sortby_val = $('#sort_select').val();
	product_filters();
	
}

/*Edit shipping address function */
		
	function edit_address(id)
	{
		var spinner = $('#loaderss');
		
		spinner.show();
		
		 $.ajax({
			url:"phpfiles/get_managingplaces.php",
			data:{row_id:id},
			type:'POST',
			dataType: "json",
			success:function(response) 
			{
				var message = response.message;
				var status = response.status;
				var str = response.data.broker_managing_places;
				var htmlfoo = str.match(/.{1,45}/g).join("<br/>");
				if(status == 1)
				{
					
					$('#brokermanagingplacestext').html(htmlfoo);
					$( "#dialog" ).dialog();
					spinner.hide();
				}
				else
				{
					alert('Failed');
					//toastr.error(message, "Failed!", {timeOut: 5e3});
					spinner.hide();
				}
			}
		});
	}

	/* Shipping address change function */
	
	function broker_details(id)
	{
		var id = id;
		var spinner = $('#loaderss');
		
		spinner.show();
		
		 $.ajax({
			url:"phpfiles/get_people_visit_count_for_brokers.php",
			data:{row_id:id},
			type:'POST',
			dataType: "json",
			success:function(response) 
			{
				var status = response.status;
				if(status == 1)
				{
					spinner.hide();
					window.location.href = "broker_details.php?key_id="+id+"&key_value=2qoNtyN3GiQzVzP8WKdewAZzkJxuCBW7L8JORc2idkMcRsTsYjf1gc0KaTox&broker_value=mzuFWcZliAcjNDb2IYj6xthMP9gSe6Ge2B2ruvoggE7FnVUk6kinpBiw7eA7&passing_details=9kL0riZKDjTiPIL9fVHw3BBQDvp3eqRiqnOg1bh6fRLis1yNSsaBxRKkErMi61HyqZbNQA6aWgMTxtj2";
				}
				else
				{
					spinner.hide();
					window.location.href = "broker_details.php?key_id="+id+"&key_value=2qoNtyN3GiQzVzP8WKdewAZzkJxuCBW7L8JORc2idkMcRsTsYjf1gc0KaTox&broker_value=mzuFWcZliAcjNDb2IYj6xthMP9gSe6Ge2B2ruvoggE7FnVUk6kinpBiw7eA7&passing_details=9kL0riZKDjTiPIL9fVHw3BBQDvp3eqRiqnOg1bh6fRLis1yNSsaBxRKkErMi61HyqZbNQA6aWgMTxtj2";
					
				}
			}
		});
	}
	
	
</script>

        
</body>


</html>
