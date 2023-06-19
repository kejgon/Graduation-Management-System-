<?php
session_start();
ob_start(); //turning on output buffer ////! its send alot of request at the same time



$host="localhost";
$user="cueagmsac";
$password="password";
$dbname="cueagms";


$connection = mysqli_connect($host, $user, $password, $dbname);
if ($connection === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}




//***************************** AddStudents  ******************************** ??*/



   // Trim and sanitize inputs
$fullname = mysqli_real_escape_string($connection, trim($_POST['fullname']));
$regNo = mysqli_real_escape_string($connection, trim($_POST['regNo']));
$faculties = mysqli_real_escape_string($connection, trim($_POST['faculties']));
$departments = mysqli_real_escape_string($connection, trim($_POST['departments']));
$level = mysqli_real_escape_string($connection, trim($_POST['levels']));
$program = mysqli_real_escape_string($connection, trim($_POST['programs']));
$specialization = mysqli_real_escape_string($connection, trim($_POST['specializations']));
$mode_of_study = mysqli_real_escape_string($connection, trim($_POST['mode_of_study']));
$year = mysqli_real_escape_string($connection, trim($_POST['year']));
$gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
$email = mysqli_real_escape_string($connection, trim($_POST['email']));
$phone_num = mysqli_real_escape_string($connection, trim($_POST['phone_num']));
$address = mysqli_real_escape_string($connection, trim($_POST['address']));
$date = mysqli_real_escape_string($connection, trim($_POST['date']));
$password = mysqli_real_escape_string($connection, trim($_POST['password']));
$role = mysqli_real_escape_string($connection, trim($_POST['role']));

        

$sql = "SELECT COUNT(*) as count FROM students WHERE std_regNO = '$regNo'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if ($row["count"] > 0) {
    echo "Sorry: A student with the same details already exists.";
} else {


    $query = "INSERT INTO students(std_regNo,std_fullname,faculty,department,levels,programs,specialization,mode_of_study,years,gender,email,phone,std_address,date_created,password, role) 
    VALUES('{$regNo}','{$fullname}','{$faculties}','{$departments}','{$level}','{$program}','{$specialization}','{$mode_of_study}',{$year},'{$gender}','{$email}',{$phone_num},'{$address}','{$date}','{$password}','{$role}')";
if (mysqli_query($connection, $query)) {

echo "Record inserted successfully";


            ////! User activiy
            $role = $_SESSION['userRole'];
            $username = $_SESSION['username'];
            $activity="Added new student";
            
            $insert = "INSERT INTO useractivity(username, fullname, role, type_of_activity, activity_time)
                       VALUES('$username', '{$stdRow['std_fullname']}', '$role', '$activity', NOW())";
            mysqli_query($connection, $insert);

} else {

echo "Could not insert record: " . mysqli_error($connection);

}

}

mysqli_close($connection);
            
          