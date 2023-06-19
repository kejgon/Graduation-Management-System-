<?php require_once("../config.php");
$stdNo = $_SESSION["std_regNo"];
$empFullName = $_SESSION['fullname'];
$status = $_POST['status'];

$sql = "SELECT * FROM library_clearance_request WHERE std_regNo = $stdNo AND (stdStatus ='Pending' OR stdStatus ='Rejected')";

// Check for errors in executing the SQL query
if (!$result = mysqli_query($connection, $sql)) {
    die("Error in executing the SQL statement: " . mysqli_error($connection));
}

if (mysqli_num_rows($result) > 0) {
    echo "Sorry! the student must be cleared by Librarian  first! ";

} else {
    // Retrieving Student details
    $query = "SELECT * FROM dean_clearance_request WHERE std_regNo = $stdNo";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if ($row > 0) {
        $sql = "UPDATE dean_clearance_request SET stdStatus = '$status', emp_fullname = '$empFullName' WHERE std_regNo = $stdNo";
        if (mysqli_query($connection, $sql)) {
            echo "The clearance status updated successfully";
        } else {
            echo "Could not update record: " . mysqli_error($connection);
        }
    }
}


mysqli_close($connection);