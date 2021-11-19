<?php 
include('../dbconfig.php');
$rowData = json_decode($_POST['DATA']);

if(empty($rowData)){
	$rowData = json_decode($HTTP_RAW_POST_DATA);
}
?>

<div class="form-group" id="patientlListSelection">Please select a patient from the list:<br>
<table id="hospital" >
  <tr>
    <th style="font-weight: 20px; color:#fff;">PATIENT NAME</th>
    <th style="font-weight: 20px; color:#fff;">AGE</th>
    <th style="font-weight: 20px; color:#fff;">GENDER</th>					    
    <th style="font-weight: 20px; color:#fff;">CONTACT ON</th>					    
    <th style="font-weight: 20px; color:#fff;">ADDRRESS</th>
    <th style="font-weight: 20px; color:#fff;">BOOK HERE</th>	
  </tr>
<?php
// var_dump($rowData);
//====================Variables Declaration =========================
	$searchPatient = $rowData->searchPatientText;
	$receptionistID = $rowData->receptionistID;
	$hospitalIDToGetTotalPatient = $rowData->hospitalIDToGetTotalPatient;
	$selectedDoctorID = $rowData->selectedDoctorID;
//====================END Variables Declaration =========================

//====================Get ALlot Time =========================
	$queryToCalTotalPatient = "SELECT * FROM `patienthospital` WHERE `hospitalID` = '".$hospitalIDToGetTotalPatient."' and `doctor_ID`='".$selectedDoctorID."' and`book_flag` = '1' ORDER by allowedTime DESC";
	//echo $queryToCalTotalPatient;
	$resultPatientCount = $mysqli->query($queryToCalTotalPatient);
	if($resultPatientCount->num_rows>0){
		while($rowPatients = $resultPatientCount->fetch_assoc()){
			$latestPatientExpectedTime = $rowPatients['allowedTime'];
		}
	}
	else{
		date_default_timezone_set('Asia/Kolkata');
		$latestPatientExpectedTime = date("Y-m-d H:i:s");
	}
	$averageTime = 15;
	$time = new DateTime($latestPatientExpectedTime);
	$time->add(new DateInterval('PT' . $averageTime . 'M'));

	$expectedTimeToVisitOffice  = $time->format('Y-m-d H:i:s');
//====================END Get ALlot Time =========================

//====================Get Hospital Name =========================
	$queryToGetHosName = "SELECT * FROM `hospitalarea` WHERE `hospitalID` = '".$hospitalIDToGetTotalPatient."'
	";

	//echo $queryToGetHosName;
	$resultHospName = $mysqli->query($queryToGetHosName);
	if($resultHospName->num_rows>0){
		while($rowHospitalName = $resultHospName->fetch_assoc()){
			$HospName = $rowHospitalName['hospitalName'];
		}
	}
//====================END Get Hospital Name =========================

//====================Get Doctor Name =========================
	$queryToGetDocName = "SELECT * FROM `doctorarea` WHERE `doctor_ID` = '".$selectedDoctorID."'
	";
	//echo $queryToGetHosName;
	$resultDocName = $mysqli->query($queryToGetDocName);
	if($resultDocName->num_rows>0){
		while($rowDocName = $resultDocName->fetch_assoc()){
			$doctor_FirstName = $rowDocName['doctor_FirstName'];
			$doctor_LastName = $rowDocName['doctor_LastName'];
			$docFullName = 'Dr. '.$doctor_FirstName.' '.$doctor_LastName;
		}
	}
//====================END Get Doctor Name =========================



$queryToFindPatient = "SELECT * FROM `patientarea` as pa WHERE (pa.patient_ID) NOT IN ( SELECT ph.patient_ID FROM `patienthospital` as ph WHERE `book_flag` = 1) and ( pa.patient_FirstName like ('%$searchPatient%') or pa.patient_LastName like ('%$searchPatient%') or pa.patient_ContactNu like ('%$searchPatient%') )";
//print_r($queryToFindPatient);
$result = $mysqli->query($queryToFindPatient);
while($row = $result->fetch_assoc()){
	$patient_ContactNu = $row['patient_ContactNu'];
	$patient_FirstName = $row['patient_FirstName'];
	$patient_LastName = $row['patient_LastName'];
	$patientFullName= $patient_FirstName.' '.$patient_LastName;
	$patient_ID = $row['patient_ID'] ;
?>

  <tr>
    <!-- <td><input type="radio" name="patientName" id="<?php echo $patient_ID ?>" checked="" value="<?php echo $patient_ID ; ?>"><?php echo $patientFullName; ?></input></td> -->
    <td><?php echo $patientFullName; ?></td>
    <td><?php 
		$dob=$row['patient_DOB'];//date of Birth
		// echo $dob;
		// $dob='2021-9-8'; //date of Birth
		$condate=Date('y-m-d'); //Certain fix Date of Age 
		// $ageOfpatient = getAge($dob,$condate);
		echo $ageOfpatient=dateDifference($dob , $condate , $differenceFormat ='%y Year %m Month %d Day'  );
    ?></td>
    <td><?php echo $gender = $row['patient_Gender'];//print_r($rowHospital['fees']); ?></td>
    <td><?php echo $row['patient_ContactNu']; //$countPatient;?></td>
    <td><?php echo $address = $row['patient_houseNo'].','.$row['patient_At'].','.$row['patient_Post'].','.$row['patient_Tah'].','.$row['patient_Dist'].','.$row['patient_pinCode'];//print_r($rowHospital['fees']); ?></td>

    <td>
    	<a id="registerFromReceptionist" 
    	class="btn btn-success" 
    	data-toggle="modal" 
    	data-target="#hospitalBooking" 
    	data-hospitalnametosend="<?=$HospName?>"  
    	data-patientagetosend="<?=$ageOfpatient?>" 
    	data-patientnametosend="<?=$patientFullName?>" 
    	data-patientcontacttosend="<?=$patient_ContactNu?>"  
    	data-patientaddresstosend="<?=$address?>" 
    	data-patientgendertosend="<?=$gender?>" 
    	data-hospitalidtosend="<?=$hospitalIDToGetTotalPatient?>" 
    	data-patientidtosend="<?=$patient_ID?>" 
    	data-doctoridtosend="<?=$selectedDoctorID?>" 
    	data-doctornametosend="<?=$docFullName?>" 
    	data-receptionistID="<?=$receptionistID ?>" 
    	data-totalpatienttosend="<?=$resultPatientCount->num_rows+1?>" 
    	data-totalestimatedtime="<?=$expectedTimeToVisitOffice?>">BOOK</a>
    </td>
  </tr>
<?php 
}
//END While

function dateDifference($date_1 , $date_2 , $differenceFormat  )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}

?>
</div>