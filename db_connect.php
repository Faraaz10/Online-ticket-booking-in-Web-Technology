<?php
$servername = "localhost";
$dbusername = "db_username";
$dbpassword = "db_password"; 
$dbname = "database name";
$port ="port_number";


$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname, $port);

if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
?>