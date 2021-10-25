<?php

/*$hospitalID = 5;
$test = '+'.$hospitalID;
echo date_default_timezone_set('Asia/Kolkata');
// $d=strtotime("+5 Minutes");
$d=strtotime("$test Minutes");
echo date("Y-m-d h:i:sa", $d) . "<br>";
echo date_default_timezone_get();*/

$hospitalID = 5;
$averageTime = 15;
$totalPatient = $hospitalID + 1 ; //Buffer average time for doctor.
$numberAllotTime = $totalPatient * $averageTime;
$test = '+'.$numberAllotTime;
date_default_timezone_set('Asia/Kolkata');
$d=strtotime("$test Minutes");
echo date("Y-m-d h:i:sa", $d) . "<br>";
?>