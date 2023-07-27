<?php

// Start a new PHP session and buffer the output
session_start();
ob_start();

// Database connection details
$host = "127.0.0.1";   // Server name or IP address where MySQL is running
$user = "cueagmsAC";   // MySQL user name
$password = "password";   // MySQL password
$dbname = "cueagms";   // MySQL database name

// Create a new MySQL connection using the above details
$connection = mysqli_connect($host, $user, $password, $dbname);

// Check if the connection was successful
if ($connection === false) {
    // If the connection failed, stop the script and display an error message
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Check if the user exists in the students table
$stdQuery = "SELECT * FROM students WHERE std_regNo = '" . $_SESSION['username'] . "'";
$result = mysqli_query($connection, $stdQuery);
$stdRow = mysqli_num_rows($result);

// Check if the user exists in the employees table
$empQuery = "SELECT * FROM employees WHERE emp_number = '" . $_SESSION['username'] . "'";
$result = mysqli_query($connection, $empQuery);
$empRows = mysqli_fetch_array($result);

// Check if the user exists in the admin table
$adminQuery = "SELECT * FROM admin WHERE admin_number = '" . $_SESSION['username'] . "'";
$result = mysqli_query($connection, $adminQuery);
$adminRows = mysqli_fetch_array($result);

// Retrieve login logs from the database
$logsQuery = "SELECT * FROM login_logs";
$result = mysqli_query($connection, $logsQuery);
$logsRows = mysqli_fetch_array($result);

// Update logout time in the login_logs table for the respective user type (admin, student, employee)
if ($adminRows > 0) {
    $sql = "UPDATE login_logs SET logoutTime = NOW() WHERE session_id = '" . $_SESSION['session_id'] . "'";
    mysqli_query($connection, $sql);
}
if ($stdRow > 0) {
    $sql = "UPDATE login_logs SET logoutTime = NOW() WHERE session_id = '" . $_SESSION['session_id'] . "'";
    mysqli_query($connection, $sql);
}
if ($empRows > 0) {
    $sql = "UPDATE login_logs SET logoutTime = NOW() WHERE session_id = '" . $_SESSION['session_id'] . "'";
    mysqli_query($connection, $sql);
}

// Destroy the current session to log out the user
session_destroy();

// Redirect to the login page
header('Location: login.php');