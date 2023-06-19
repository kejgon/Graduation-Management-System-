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



// Trim and sanitize inputs using mysqli_real_escape_string()
$fullname = mysqli_real_escape_string($connection, trim($_POST['fullname']));
$regNo = mysqli_real_escape_string($connection, trim($_POST['regNo']));
$faculties = mysqli_real_escape_string($connection, trim($_POST['faculties']));
$departments = mysqli_real_escape_string($connection, trim($_POST['departments']));
$level = mysqli_real_escape_string($connection, trim($_POST['levels']));
$program = mysqli_real_escape_string($connection, trim($_POST['programs']));
$specialization = mysqli_real_escape_string($connection, trim($_POST['specializations']));
$year = mysqli_real_escape_string($connection, trim($_POST['year']));
$mode_of_study = mysqli_real_escape_string($connection, trim($_POST['mode_of_study']));
$compus = mysqli_real_escape_string($connection, trim($_POST['compus']));
$cl_reason = mysqli_real_escape_string($connection, trim($_POST['cl_reason']));
$date = mysqli_real_escape_string($connection, trim($_POST['date']));

// Check if the student has already submitted the clearance form
$sql = "SELECT COUNT(*) as count FROM clearance WHERE std_regNO = '$regNo'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if ($row["count"] > 0) {
    echo "Sorry: you've already submitted your request. You can't submit more than one request.";
} else {
    // Insert the clearance request into the clearance table
    $insert_requests = "INSERT INTO clearance(std_fullname, std_regNo, faculty, department, levels, programs, specialization, years, mode_of_study, campus, reason_for_clearance, date_of_submission)
                        VALUES('$fullname', '$regNo', '$faculties', '$departments', '$level', '$program', '$specialization', '$year', '$mode_of_study', '$compus', '$cl_reason', '$date')";

    if (mysqli_query($connection, $insert_requests)) {
        // Retrive the clearance request details for the current student who has submitted
        $sql = "SELECT * from clearance WHERE std_regNo = '$regNo'";
        $result = $connection->query($sql);
        $clRow = $result->fetch_assoc();
        
        // If it's true pass the clearance to different departments 
        if ($clRow > 0) {
            // Insert the clearance request into hod_clearance_request, library_clearance_request, dean_clearance_request, and reg_clearance_request tables


            
            $hod_cl_query = "INSERT INTO hod_clearance_request(clr_id, std_fullnames, std_regNo) VALUES('{$clRow['clr_id']}', '$fullname', '$regNo')";
            mysqli_query($connection, $hod_cl_query);
            
            $library_cl_query = "INSERT INTO library_clearance_request(clr_id, std_fullnames, std_regNo) VALUES('{$clRow['clr_id']}', '$fullname', '$regNo')";
            mysqli_query($connection, $library_cl_query);
            
            $dean_cl_query = "INSERT INTO dean_clearance_request(clr_id, std_fullnames, std_regNo) VALUES('{$clRow['clr_id']}', '$fullname', '$regNo')";
            mysqli_query($connection, $dean_cl_query);
            
            $reg_cl_query = "INSERT INTO reg_clearance_request(clr_id,std_fullnames,std_regNo) VALUES('{$clRow['clr_id']}','{$fullname}','{$regNo}')";
            mysqli_query($connection, $reg_cl_query);
    
    
            echo "The clearance Request have been made. Come back later for feedback.";
    
        } else {
    
            echo "Could not insert record: " . mysqli_error($connection);
    
        }
    
}



}


mysqli_close($connection);
?>