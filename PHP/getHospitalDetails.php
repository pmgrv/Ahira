<?php 
include('dbconfig.php');
$rowData = json_decode($_POST['DATA']);

if(empty($rowData)){
	$rowData = json_decode($HTTP_RAW_POST_DATA);
}
?>

<div class="form-group" id="doctorlListSelection">Please select a doctor from the list:<br>
<?php
// var_dump($rowData);
$hospitalidtosend = $rowData->hospitalidtosend;
$queryGetsDoctors = "SELECT * FROM `doctorarea` as da, `doctorhospital` as dh WHERE da.doctor_ID=dh.doctor_ID and dh.hospital_ID='".$hospitalidtosend."'";
// print_r($queryGets);
$result = $mysqli->query($queryGetsDoctors);
while($row = $result->fetch_assoc()){
	$doctor_FirstName = $row['doctor_FirstName'];
	$doctor_LastName = $row['doctor_LastName'];
	$doctorFullName= $doctor_FirstName.' '.$doctor_LastName;
?>
	<input type="radio" name="doctorName" id="<?php echo$row['doctor_ID'] ?>" checked="" value="<?php echo $row['doctor_ID']; ?>"><?php echo "Dr. ".$doctorFullName; ?></input><br>
<?php 
}
//END While
?>
</div>