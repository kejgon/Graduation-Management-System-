<?php

require_once("../config.php");

// Get the student's registration number from the session
$std_regNo = $_SESSION['username'];

// Get the information of the uploaded transcript and fee statement files
$transcript = $_FILES['transcript']['name'];
$transcript_type = $_FILES['transcript']['type'];
$transcript_size = $_FILES['transcript']['size'];
$transcript_tem_loc = $_FILES['transcript']['tmp_name'];
$transcript_store ="files/".$transcript;
$fee_statement = $_FILES['fee_statement']['name'];
$fee_statement_type = $_FILES['fee_statement']['type'];
$fee_statement_size = $_FILES['fee_statement']['size'];
$fee_statement_tem_loc = $_FILES['fee_statement']['tmp_name'];
$fee_statement_store ="files/".$fee_statement;

// Move the uploaded files to the desired directory
move_uploaded_file($transcript_tem_loc,$transcript_store);
move_uploaded_file($fee_statement_tem_loc,$fee_statement_store);

// Query the database to check if the student exists
$stdQuery = "SELECT * FROM students WHERE std_regNo = '{$std_regNo}'";
$result = mysqli_query($connection, $stdQuery);
$stdRow = mysqli_num_rows($result);




// If the student exists, proceed with the file upload
if ($stdRow > 0) {
 
        // Update the students table with the names of the uploaded files
        $sql = "UPDATE students SET transcript = '{$transcript}', fee_statement = '{$fee_statement}' WHERE std_regNo = '{$std_regNo}' ";

        // Check if the query was successful
        if (mysqli_query($connection, $sql)) {
            echo "Files successfully uploaded.";

            ////! User activiy
$role = $_SESSION['userRole'];
$activity="uploads transcript and fee statement";

$insert = "INSERT INTO useractivity(username, fullname, role, type_of_activity, activity_time)
           VALUES('$std_regNo', '{$stdRow['std_fullname']}', '$role', '$activity', NOW())";
mysqli_query($connection, $insert);

        }
    
}

// Close the database connection
mysqli_close($connection);

?>