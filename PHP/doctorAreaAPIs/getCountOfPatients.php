<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS');

header('Content-type:application/json');

include('../dbconfig.php');
// $DB = new Database();

$rowData = json_decode($_POST['DATA']);
if(empty($rowData)){
$rowData = json_decode($HTTP_RAW_POST_DATA);
}

$daydistribution = $rowData->daydistribution;

if(!empty($daydistribution))
{
	date_default_timezone_set('Asia/Kolkata');
	// $aweek=strtotime("-11520 Minutes"); //60 min x 24 hours x 7 days
	// $aday=strtotime("-2880 Minutes"); //60 min x 24 hours
	// $expectedResult= date("Y-m-d H:i:s", $aday);

	//New DateTime object representing today's date.
	$currentDate = new DateTime();
	//Use the sub function to subtract a DateInterval
	$yesterdayDT = $currentDate->sub(new DateInterval('P1D'));
	//Get yesterday's date in a YYYY-MM-DD format.
	$expectedResult = $yesterdayDT->format('Y-m-d h:s:i');

	echo deliver_response("success","Searched result not found.","{$expectedResult}");
	/*$queryToFindDoctor = "SELECT * FROM `doctorarea` WHERE doctor_FirstName like ('%$searchdoctor%') or  doctor_LastName like ('%$searchdoctor%') or  doctor_ContactNu like ('%$searchdoctor%')";
	$result = $mysqli->query($queryToFindDoctor);
	//printf("Select returned %d rows.\n", $result->num_rows);
	if($result->num_rows>0){
		$result = $mysqli->query($queryToFindDoctor);
		while($row = $result->fetch_assoc()){
			$firstName = $row['doctor_FirstName'];
			$lastName = $row['doctor_LastName'];
			$fullName = $firstName.' '.$lastName;
			$doctorContactNumber = $row['doctor_ContactNu'];
		}

		echo deliver_response("success","Subscribed Successfully","{$doctorContactNumber}");
	}
	else
	{
		echo deliver_response("failure","Searched result not found.","{$searchdoctor}");
	}*/
}
function deliver_response($status,$status_msg,$data){
//	header("HTTP/1.1 $status %status_message");
	$response['status'] = $status;
	$response['massage'] = $status_msg;
	$response['data'] = $data;
	
$json_response=json_encode($response);
return  $json_response;
}



?>