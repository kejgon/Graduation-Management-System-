<?php require_once("../config.php");
$stdNo = $_SESSION["std_regNo"];
$empFullName = $_SESSION['fullname'];
$stdFullName = $_SESSION['stdfulnames'];
$status = $_POST['status'];

$sql = "SELECT * FROM dean_clearance_request WHERE std_regNo = $stdNo AND (stdStatus ='Pending' OR stdStatus ='Rejected')";

// Check for errors in executing the SQL query
if (!$result = mysqli_query($connection, $sql)) {
    die("Error in executing the SQL statement: " . mysqli_error($connection));
}

if (mysqli_num_rows($result) > 0) {
    echo "Sorry! the student must be cleared by Dean of Students  first! ";

} else {
    // Retrieving Student details
    $query = "SELECT * FROM reg_clearance_request WHERE std_regNo = $stdNo";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if ($row > 0) {
        $sql = "UPDATE reg_clearance_request SET stdStatus = '$status' , emp_fullname = '$empFullName' WHERE std_regNo = $stdNo";

        

        if (mysqli_query($connection, $sql)) {
            $sql = "SELECT * from clearance WHERE std_regNo = '$stdNo'";
            $result = $connection->query($sql);
            $clRow = $result->fetch_assoc();
            
            // If it's true pass the clearance to different departments 
            if ($clRow > 0) {
                $sql = "SELECT COUNT(*) as count FROM fin_clearance_request WHERE std_regNO = '$stdNo'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if ($row["count"] > 0) {
    echo "Sorry: you've already submitted your request. You can't submit more than one request.";
}else{
 // Insert the clearance request into hod_clearance_request, library_clearance_request, dean_clearance_request, and reg_clearance_request tables
 $fin_cl_query = "INSERT INTO fin_clearance_request(clr_id, std_fullnames, std_regNo) VALUES('{$clRow['clr_id']}', '$stdFullName', '$stdNo')";
 mysqli_query($connection, $fin_cl_query);

echo "The clearance status was updated successfully, and it had been sent to finance for clearance.";
}

               
        } else {
            echo "Could not update record: " . mysqli_error($connection);
        }
    }
}
}

mysqli_close($connection);