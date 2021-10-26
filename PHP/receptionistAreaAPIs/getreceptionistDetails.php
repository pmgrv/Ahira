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

$searchreceptionist = $rowData->searchreceptionist;

if(!empty($searchreceptionist))
{
$queryToFindreceptionist = "SELECT * FROM `receptionistarea` WHERE receptionist_FirstName like ('%$searchreceptionist%') or  receptionist_LastName like ('%$searchreceptionist%') or  receptionist_ContactNu like ('%$searchreceptionist%')";
	$result = $mysqli->query($queryToFindreceptionist);

//printf("Select returned %d rows.\n", $result->num_rows);
	if($result->num_rows>0){
		$result = $mysqli->query($queryToFindreceptionist);
		while($row = $result->fetch_assoc()){
			$firstName = $row['receptionist_FirstName'];
			$lastName = $row['receptionist_LastName'];
			$fullName = $firstName.' '.$lastName;
			$receptionistContactNumber = $row['receptionist_ContactNu'];
		}

		echo deliver_response("success","Subscribed Successfully","{$receptionistContactNumber}");
	}
	else
	{
		echo deliver_response("failure","Searched result not found.","{$searchreceptionist}");
	}
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