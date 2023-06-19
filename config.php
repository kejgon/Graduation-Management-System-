<?php
session_start();
ob_start(); //turning on output buffer ////! its send alot of request at the same time



$host="127.0.0.1";
$user="cueagmsAC";
$password="password";
$dbname="cueagms";


$connection = mysqli_connect($host, $user, $password, $dbname);
if ($connection === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



?>