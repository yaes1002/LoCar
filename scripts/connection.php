<?php

error_reporting(0);

$server = "localhost";
$user = "root";
$pass = "";
$db = "locar";

if ( !$conn = mysqli_connect($server,$user,$pass,$db)) 
{
    die("Connection failed: " .mysqli_connect_error());
}



?>