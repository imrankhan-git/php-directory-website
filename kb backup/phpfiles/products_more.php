<?php
include "../dbconfig.php";

$actionName = $_POST["action"];
if($actionName == "showPost"){

$showPostFrom = $_POST["showPostFrom"];
$showPostCount = $_POST["showPostCount"];

$sortby_val = isset($_POST["sortby_val"]) ? $_POST["sortby_val"] : 0;
$totalRecord = isset($_POST["totalRecord"]) ? $_POST["totalRecord"] : 0;

$country_val	= $_POST["country_id"];
$state_val	= $_POST["state_id"];
$district_val	= $_POST["district_id"];

$sessionvalue = $_POST["sessionvalue"];
$emailverifiedstatus = $_POST["emailverifiedstatus"];

$showPostTo = $showPostFrom + $showPostCount;

if($country_val == "" || $state_val == "")
{
	$query = "SELECT * FROM table_brokers WHERE status = 1 AND broker_account_status = 1 AND broker_payment = 1 AND original_or_dummy = 1";
}
else
{
	$query = "SELECT * FROM table_brokers WHERE status = 1 AND broker_country='$country_val' and broker_state='$state_val' AND broker_account_status = 1 AND broker_payment = 1 AND original_or_dummy = 1";
}



	
/* District Filter */
$district_option ="<option value=''>All Locations</option>";
if(!empty($district_val) && $district_val != 'all')
{
	/*$query .= " AND broker_managing_places IN('".$district_filter."')";*/
	$query .= " AND FIND_IN_SET('".$district_val."',broker_managing_places)";
}
	
	
if($sortby_val == 1)
{
	$query .= " ORDER BY broker_first_name ASC";
}
else if($sortby_val == 2){
	$query .= " ORDER BY broker_first_name DESC";
}
else
{
	$query .= " ORDER BY id DESC";
}

$product_total_res = mysqli_query($conn,$query);
$product_total_rows = $product_total_res->num_rows;
	
	
/* Set Limit */
$query .= " LIMIT ".$showPostFrom.",".$showPostCount;

$brokers_res = $conn->query($query);
$brokers_num_rows = $brokers_res->num_rows;
if($brokers_num_rows>0)
{
	while($brokers_row=$brokers_res->fetch_array())
	{
		$broker_id = $brokers_row['id'];
		$broker_first_name = $brokers_row['broker_first_name'];
		$broker_last_name = $brokers_row['broker_last_name'];
		$broker_email = $brokers_row['broker_email'];
		$broker_mobile = $brokers_row['broker_mobile'];
		$broker_success_marriage = $brokers_row['broker_success_marriage'];
		$broker_managing_places = $brokers_row['broker_managing_places'];
		$broker_address = $brokers_row['broker_address'];
		
		$string = strip_tags($broker_managing_places);
										
		if (strlen($string) > 50) {

			// truncate string
			$stringCut = substr($string, 0, 30);
			$endPoint = strrpos($stringCut, ' ');

			//if the string doesn't contain any space then it will cut without word basis.
			$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
			$string .= '... <a href="javascript:void(0)" onclick="edit_address('.$broker_id.');" data-original-title="Edit" data-toggle="tooltip" data-toggle="modal" style="color:red !important;">Read More</a>';
		}
		if($sessionvalue == 1)
		{
			if($emailverifiedstatus == 1)
			{
				$broker_mobile = '<a href="javascript:void(0)" onclick="broker_details('.$broker_id.');"  style="color:white !important;">View Details</a>';
				$broker_address = $brokers_row['broker_address'];
			}
			else
			{
				$broker_mobile = "Verify your email to view details";
				$broker_address = "Verify your email to view address";
			}
		}
		else
		{
			if($emailverifiedstatus == 1)
			{
				$broker_mobile = '<a href="javascript:void(0)" onclick="broker_details('.$broker_id.');"  style="color:white !important;">View Details</a>';
				$broker_address = $brokers_row['broker_address'];
			}
			else
			{
				$broker_mobile = "Verify your email to view details";
				$broker_address = "Verify your email to view address";
			}
		}
		if($sessionvalue != 1 && $sessionvalue != 2)
		{
				$broker_mobile = "Login to view details";
				$broker_address = "Login to view address";
		}
	
		$output .= '<div class="filter-result 01" class=" li-post-group">
							<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 pull-left">
							   <div class="company-left-info pull-left">
									<img src="assets/images/kb_logo_testimonial.png" alt=""/>
								</div>
								<div class="desig">
									<h3>'.$broker_name.' '.$broker_last_name.'</h3>
									<h4>'.$string.'</h4>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 pull-right">
								<div class="pull-right location">
									<h4>'.$broker_success_marriage.' successfull marriages!</h4>
								</div>
								<div class="data-job">
								   <span class="label job-type job-fulltime ">'.$broker_mobile.'</span>
								</div>
							</div>
						</div>
					';
	}
	echo json_encode(array("status" => "1","message" => "Rerieved Successfully", "data" => $output, "tot_rec" => $product_total_rows));
}
else
{
	$output = '<div class="text-center col-md-12" style="text-align: center;"><img src="assets/images/notfound.png"  class="img-responsive col-md-4 col-md-offset-4 text-center" alt="No Records!" style="text-align: center;"></div>';
	echo json_encode(array("status" => "0","message" => "No Data Found", "data" => $output,"tot_rec" => $product_total_rows));
	
}
}
