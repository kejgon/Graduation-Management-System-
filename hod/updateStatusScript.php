<?php require_once("../config.php");
$stdNo = $_SESSION["std_regNo"];
$empFullName = $_SESSION['fullname'];
$status = $_POST['status'];

// Retrieving Student details
$query = "SELECT * FROM hod_clearance_request WHERE std_regNo =$stdNo ";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

if ($row > 0) {
    $sql = "UPDATE hod_clearance_request SET stdStatus = ' $status ', emp_fullname = '$empFullName' WHERE std_regNo =$stdNo ";
    if (mysqli_query($connection, $sql)) {
        echo "The clearance status updated successfully";
    } else {
        echo "Could not update record: " . mysqli_error($connection);
    }
}

mysqli_close($connection);