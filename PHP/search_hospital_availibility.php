<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS');

header('Content-type:application/json');

include('dbconfig.php');
// $DB = new Database();

$rowData = json_decode($_POST['DATA']);
if(empty($rowData)){
$rowData = json_decode($HTTP_RAW_POST_DATA);
}

$searchPatient = $rowData->searchPatientText;

if(!empty($searchPatient))
{
$queryToFindPatient = "SELECT * FROM `patientarea` WHERE patient_FirstName like ('%$searchPatient%') or  patient_LastName like ('%$searchPatient%') or  patient_ContactNu like ('%$searchPatient%')";
	$result = $mysqli->query($queryToFindPatient);

//printf("Select returned %d rows.\n", $result->num_rows);
	if($result->num_rows>=0){
		$result = $mysqli->query("SELECT * FROM `hospitalarea`");
		while($row = $result->fetch_assoc()){
			$hospitalName = $row['hospitalName'];
		}

		echo deliver_response("success","Subscribed Successfully","{$searchPatient}");
	}
	else
	{
		echo deliver_response("failure","Searched result not found.","{$searchPatient}");
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