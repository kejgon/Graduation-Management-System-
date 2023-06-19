<?php
require_once("../config.php");


//***************************** AddEmployee  ******************************** ??*/



// Trim and sanitize inputs using mysqli_real_escape_string()
$emp_No = mysqli_real_escape_string($conn, trim($_POST['emp_No']));
$fullname = mysqli_real_escape_string($conn, trim($_POST['emp_fullname']));
$faculty = mysqli_real_escape_string($conn, trim($_POST['faculty']));
$department = mysqli_real_escape_string($conn, trim($_POST['department']));
$position = mysqli_real_escape_string($conn, trim($_POST['position']));
$gender = mysqli_real_escape_string($conn, trim($_POST['gender']));
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$phone_num = mysqli_real_escape_string($conn, trim($_POST['phone_num']));
$address = mysqli_real_escape_string($conn, trim($_POST['address']));
$date = mysqli_real_escape_string($conn, trim($_POST['date']));
$password = mysqli_real_escape_string($conn, trim($_POST['password']));
$role = mysqli_real_escape_string($conn, trim($_POST['role']));



        
// Check if an employee with the same employee number already exists in the database
$sql = "SELECT COUNT(*) as count FROM employees WHERE emp_number = '{$emp_No}'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if ($row["count"] > 0) {
    echo "Sorry: An employee with the same details already exists.";
} else {
    // Insert the new employee's information into the database
    $query = "INSERT INTO employees (emp_number, emp_fullname, faculty, department, position, gender, email, phone, emp_address, date_created, password, role)
    VALUES ('{$emp_No}', '{$fullname}', '{$faculty}', '{$department}', '{$position}', '{$gender}', '{$email}', '{$phone_num}', '{$address}', '{$date}', '{$password}', '{$role}')";
    if (mysqli_query($connection, $query)) {
        echo "Record inserted successfully";
    } else {
        echo "Could not insert record: " . mysqli_error($connection);
    }
}
// Close the database connection
mysqli_close($connection);