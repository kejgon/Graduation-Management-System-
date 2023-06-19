<?php

require_once("../config.php");
// Get the student's registration number from the session
$std_regNo = $_SESSION['username'];
// Trim and sanitize inputs using mysqli_real_escape_string()
$gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
$mode_of_study = mysqli_real_escape_string($connection, trim($_POST['mode_of_study']));
$email = mysqli_real_escape_string($connection, trim($_POST['email']));
$phone = mysqli_real_escape_string($connection, trim($_POST['phone_num']));
$address = mysqli_real_escape_string($connection, trim($_POST['address']));
$date = mysqli_real_escape_string($connection, trim($_POST['date']));



// Check if the student has already submitted the clearance form
$sql = "SELECT * FROM students WHERE std_regNo = '$std_regNo'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    // Update the student's information
    $sql = "UPDATE students SET gender = '$gender', mode_of_study = '$mode_of_study', email = '$email', phone = '$phone', std_address = '$address', updated_at = '$date' WHERE std_regNo = '$std_regNo'";

    if (mysqli_query($connection, $sql)) {
        echo "Record have been updated successfully";
    } else {
        echo "Could not update record: " . mysqli_error($connection);
    }
} else {
    echo "Student not found";
}

// Close database connection
mysqli_close($connection);

?>