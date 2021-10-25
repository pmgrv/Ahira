<?php 
$database = "hb_healthiswealth"; 
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$mysqli = new mysqli($servername , $username , $password , $database );
// Check connection
if (!$mysqli) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>