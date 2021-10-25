<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS');

header('Content-type:application/json');

include('../dbconfig.php');
// $DB = new Database();

// $rowData = json_decode($_POST);
// if(empty($rowData)){
// $rowData = json_decode($HTTP_RAW_POST_DATA);
// }
$testing=$_POST['patientList'];

print_r($testing);
print_r($testing[0]);
foreach ($testing[0] as $key => $value) {
	# code...
	echo $key."==>".$value."\n";
}
// if (is_array($testing) || is_object($testing))
// {
// 	// foreach ($testing as $key=>$val){ 
// 	foreach($testing as $testValue){
// 	    // echo $key."==>".$val."\n";
// 	    // echo sizeof($val);
// 	    echo $testValue.'<br>';
// 	foreach($testValue as $tes){
// 	    echo $tes.'<br>';

// 	}
// 	}
// 	echo sizeof($testing);
// }
/*$countofApprovedPatient = $rowData->countofApprovedPatient;

if(!empty($countofApprovedPatient))
{
$queryToFindDoctor = "SELECT * FROM `patienthospital` as ph, `patientarea` as pa WHERE ph.doctor_ID='".$doctorID."' and ph.book_flag=1 and pa.patient_ID=ph.patient_ID ORDER BY token_no DESC";
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
*/


?>