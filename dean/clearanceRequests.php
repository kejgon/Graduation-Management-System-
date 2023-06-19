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


//! SETTING USERS ACCORDING TO CONDITIONS
if (isset($_SESSION['userRole']) != "Dean") {
    header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUEAGMS</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/css/statusColor.css?v=<?php echo time(); ?>">


</head>

<style>
.clearance-form {
    border-radius: 5px;
    background-color: #f2f2f2;
    margin-bottom: 50px;
    border: 1px solid #000;
    padding: 20px;
}




.table th {
    text-align: center;
    border-top: 2px solid #009578;
    border-bottom: 2px solid #009578;
}

.table td,
.search-input {
    font-size: 1em;
    padding: 0.6em 1em;
    text-align: center;
}

.search-input {
    border: none;
    outline: none;
    font-family: "Fira Sans", sans-serif;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}

/* Zebra striping */
tr:nth-of-type(odd) {
    background: none;
}

th {
    background: #333;
    color: white;
    font-weight: bold;
}

td,
th {
    padding: 6px;
    border: 1px solid #ccc;
    text-align: left;
    font-size: 12px;
}

.btn-v,
.btn-a {
    margin-left: 5px;
    background-color: #F09910;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 10px;
    text-align: center;
    text-decoration: none;

}

.btns {
    margin-left: 5px;
    margin-top: 10px;
    background-color: #F09910;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 10px;
    text-align: center;
    text-decoration: none;

}

.btn-a {
    background-color: #FF5858
}
</style>

<body>


    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <img src="../assets/images/logo/CUEA-logo.png" width="100">
            <p>Catholic University of Eastern Africa Graduation Management System</p>
        </div>
    </div>



    <!-- NAVBAR -->
    <div class="navbar">

        <ul>

            <li style="float:right"><a href="../logout.php">logout</a></li>
        </ul>
    </div>

    <!------------------------Main Menu------------------------>
    <!-------------------------------------------------------->
    <div class="section">
        <div class="row">
            <div class="left" style="background-color:#7E0524; ">
                <div class="row">
                    <table style="color:#fff; text-align:left; padding-left:10px;">
                        <tr>
                            <td>Username:</td>
                            <td><?php echo $_SESSION['username'];?></td>
                        </tr>
                        <tr>
                            <td>Full Name:</td>
                            <td><?php echo $_SESSION['fullname'];?></td>
                        </tr>
                        <tr>
                            <td>User Role:</td>
                            <td><?php echo $_SESSION['userRole'];?></td>
                        </tr>
                        <tr>
                            <td>Position:</td>
                            <td><?php echo $_SESSION['position'];?></td>
                        </tr>
                        <tr>
                            <td>Faculty:</td>
                            <td><?php echo $_SESSION['faculty'];?></td>
                        </tr>
                    </table>
                </div>
                <nav class="vertical">
                    <ul>
                        <li><a href="dean.php">Dashboard</a></li>
                        <li><a href="#">Request</a>
                            <ul>
                                <li><a href="clearanceRequests.php">Clearance request</a></li>
                            </ul>
                        </li>
                        <li><a href="viewprofile.php">Profile</a></li>
                    </ul>
                </nav>
            </div>


            <div class="right" style="background-color:#FFF;">
                <h3> Clearance Status</h3>

                <button onclick="window.print()"
                    style="padding: 10px 20px; float: right; margin: 5px 10px; background-color: #47B5FF; border: none; border-radius:10px">Print</button>
                <div class="clearance-form">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Student fullnames
                                </th>
                                <th>
                                    Registration number </th>
                                <th>
                                    Clearance status
                                </th>
                                <th>
                                    Cleared by
                                </th>

                                <th>
                                    Date of submission </th>
                                <th>
                                    Updated on </th>

                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
// Retrieve employee information based on the username stored in the session variable
$query = "SELECT * FROM employees WHERE emp_number = '{$_SESSION['username']}'";
$empResult = $connection->query($query);
$empRow = mysqli_fetch_array($empResult);

// Retrieve dean clearance requests submitted by students from the same faculty and department as the employee
$query = "SELECT DISTINCT dcr.*
          FROM dean_clearance_request dcr
          INNER JOIN students s ON dcr.std_regNo = s.std_regNo
          INNER JOIN employees e ON s.faculty = '{$empRow['faculty']}'
          WHERE dcr.std_regNo = s.std_regNo";
$result = $connection->query($query);

// Display the results in an HTML table
$countRow = 1;
while ($row = mysqli_fetch_array($result)) {
    if($row['emp_fullname']==NULL){
        $row['emp_fullname'] = "Pending";
    }
    // Create a string that contains the HTML for each row in the table
    $display = <<<HEREDOC
    <tr>
       <td>{$row['dean_req_id']}</td>
       <td>{$row['std_fullnames']}</td>
       <td>{$row['std_regNo']}</td>
       <td class='status'>{$row['stdStatus']}</td>
       <td class='status'>{$row['emp_fullname']}</td>
       <td>{$row['created_at']}</td>
       <td>{$row['updated_at']}</td>
       <td><a class="btn-v"  href="std_details.php?id={$row['std_regNo']}">View details</a><a class="btn-a" href="updateStatus.php?id={$row['std_regNo']}&fulnames={$row['std_fullnames']}">Action</a></td>

    </tr>
    HEREDOC;

    // Display the HTML for this row
    echo $display;
    $countRow++;
}
?>

                        </tbody>
                    </table>
                    <div id="pagination">
                        <button class="btns" id="previous">Previous</button>
                        <button class="btns" id="next">Next</button>
                        <span id="pageNumber">1</span> of <span id="totalPages">1</span>
                    </div>
                </div>
            </div>


        </div>




        <div class="footer">
            <p><strong>©Copyright CUEAGMS</strong></p>

        </div>

        <script src="../assets/js/statusColor.js"></script>

</body>

</html>