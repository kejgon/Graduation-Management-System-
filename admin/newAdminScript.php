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




//***************************** AddADMIN  ******************************** ??*/


// Trim and sanitize inputs using mysqli_real_escape_string()
$fullname = mysqli_real_escape_string($connection, trim($_POST['fullname']));
$adminNo = mysqli_real_escape_string($connection, trim($_POST['adminNo']));
$gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
$email = mysqli_real_escape_string($connection, trim($_POST['email']));
$phone_num = mysqli_real_escape_string($connection, trim($_POST['phone_num']));
$address = mysqli_real_escape_string($connection, trim($_POST['address']));
$date = mysqli_real_escape_string($connection, trim($_POST['date']));
$role = mysqli_real_escape_string($connection, trim($_POST['role']));
$password = mysqli_real_escape_string($connection, trim($_POST['password']));

        


        $sql = "SELECT COUNT(*) as count FROM admin WHERE admin_number = '$adminNo'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        
        if ($row["count"] > 0) {
            echo "Sorry: An Admin with the same details already exists.";
        } else {
        
        
            $query = "INSERT INTO admin(admin_number, admin_fullname, gender, email, phone, admin_address, date_created, role,password)
            VALUES('{$adminNo}','{$fullname}','{$gender}','{$email}','{$phone_num}','{$address}','{$date}','{$role}','{$password}')";
            if (mysqli_query($connection, $query)) {
        
                echo "Record inserted successfully";
        
            } else {
        
                echo "Could not insert record: " . mysqli_error($connection);
        
            }
        
        }
        
        mysqli_close($connection);
                    
            
          