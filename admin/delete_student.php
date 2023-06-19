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


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete student record from the database
    $query = "DELETE FROM students WHERE std_id = $id";
    mysqli_query($connection, $query);

      // User activity tracker
      $role = $_SESSION['userRole'];
      $activity = "Deleted a Student. for (Student No. " . $id. ")";
      // Inserting into user activities table
      $insert = "INSERT INTO useractivity(username, fullname, role, type_of_activity, activity_time)
                 VALUES('{$_SESSION['username']}', '{$_SESSION['fullname']}', '$role', '$activity', NOW())";
      mysqli_query($connection, $insert);

    // Display an alert message to the user using JavaScript
    echo '<script>';
    echo 'alert("Student has been deleted successfully!");';
    echo 'window.location.href = "viewStudents.php";';
    echo '</script>';
} else {
    // If no student ID is provided, redirect to the viewStudents page
    redirect("viewStudents.php");
}