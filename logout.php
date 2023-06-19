<?php

// is a PHP function that starts a new or resumes an existing session. 
// A session is a way to store data (variables) on the server 
// that can be used across multiple pages of a website.
session_start();
ob_start(); //turning on output buffer ////? To prevent header() errors

// Turn on output buffering
// This function will turn output buffering on. While output buffering is 
// active, no output is sent from the script (other than headers), instead the output is stored


// database connection details

$host="127.0.0.1";// server name or IP address where MySQL is running
$user="cueagmsAC"; // MySQL user name
$password="password";// MySQL password
$dbname="cueagms"; // MySQL database name

// create a new MySQL connection using the above details
$connection = mysqli_connect($host, $user, $password, $dbname);

// check if the connection was successful
if ($connection === false) {
    // if the connection failed, stop the script and display an error message
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 // Check if the user exists in the students table
 $stdQuery = "SELECT * FROM students WHERE std_regNo = '".$_SESSION['username']."'";
 $result = mysqli_query($connection, $stdQuery);
$stdRow = mysqli_num_rows($result);

$empQuery = "SELECT * FROM employees WHERE emp_number = '".$_SESSION['username']."' ";
$result = mysqli_query($connection, $empQuery);
$empRows = mysqli_fetch_array($result);

// Check if the user exists in the admin table
$adminQuery = "SELECT * FROM admin WHERE admin_number = '".$_SESSION['username']."'";
$result = mysqli_query($connection, $adminQuery);

$adminRows = mysqli_fetch_array($result);


$logsQuery = "SELECT * FROM login_logs";
$result = mysqli_query($connection, $logsQuery);
$logsRows = mysqli_fetch_array($result);


if ($adminRows>0) {
   $sql = "UPDATE login_logs SET logoutTime = NOW() WHERE session_id = '".$_SESSION['session_id']."' ";
mysqli_query($connection, $sql);
}
if ($stdRow>0) {
   $sql = "UPDATE login_logs SET logoutTime = NOW() WHERE session_id = '".$_SESSION['session_id']."' ";
mysqli_query($connection, $sql);
}
if ($empRows>0) {
   $sql = "UPDATE login_logs SET logoutTime = NOW() WHERE session_id = '".$_SESSION['session_id']."' ";
mysqli_query($connection, $sql);
}


session_destroy();
// Redirect to the login page:
header('Location: login.php');


// query("Update login_logs Set logoutTime = now() WHERE username = '".$_SESSION['username']."'");