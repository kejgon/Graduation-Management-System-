<?php
// is a PHP function that starts a new or resumes an existing session. 
// A session is a way to store data (variables) on the server 
// that can be used across multiple pages of a website.
session_start();
ob_start(); //turning on output buffer ////? To prevent header() errors


// database connection details
$host = "localhost"; // server name or IP address where MySQL is running
$user = "cueagmsac"; // MySQL user name
$password = "password"; // MySQL password
$dbname = "cueagms"; // MySQL database name

// create a new MySQL connection using the above details
$connection = mysqli_connect($host, $user, $password, $dbname);

// check if the connection was successful
if ($connection === false) {
    // if the connection failed, stop the script and display an error message
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//! SETTING USERS ACCORDING TO CONDITIONS
if (isset($_SESSION['userRole']) != "Student") {
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

</head>

<style>
label {
    display: inline-block;
    color: black;
}


.clearance-form {
    border-radius: 5px;
    background-color: #f2f2f2;
    margin-bottom: 50px;
    border: 1px solid #000;
}

.col-10 {
    float: left;
    width: 50%;
    margin-top: 6px;
}

.col-90 {
    float: left;
    width: 50%;
    margin-top: 6px;
}

.row:after {
    content: "";
    display: table;
    clear: both;
}

@media screen and (max-width: 600px) {

    .col-10,
    .col-90,
    input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}

table {
    width: 100%;
    border-collapse: collapse;
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
                            <td>Programme:</td>
                            <td><?php echo $_SESSION['programs'];?></td>
                        </tr>
                    </table>
                </div>
                <nav class="vertical">
                    <ul>
                        <li><a href="student.php">Dashboard</a></li>
                        <li><a href="transcript_feeState.php">Transcript & fee Statement</a></li>

                        <li><a href="#">Request</a>
                            <ul>
                                <li><a href="studentClearanceReq.php">Clearance request</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Reports</a>
                            <ul>
                                <li><a href="clearancestatus.php">Clearance Status</a></li>
                            </ul>
                        </li>

                        <li><a href="viewprofile.php">Profile</a></li>
                        <li><a href="feedbacks.php">Feedbacks</a></li>

                    </ul>
                </nav>
            </div>


            <div class="right" style="background-color:#FFF;">
                <h3> Student Details</h3>
                <div class="clearance-form">
                    <div class="row">
                        <div class="col-10">
                            <label for="fname">First Name:</label>

                        </div>
                        <div class="col-90">
                            <label for="fname">Middle Name:</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <label for="fname">Last Name:</label>


                        </div>
                        <div class="col-90">
                            <label for="lname">Username:</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <label for="compus">Registration number:</label>


                        </div>
                        <div class="col-90">
                            <label for="std_reg">Phone number:</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <label for="faculty">Email address:</label>

                        </div>
                        <div class="col-90">
                            <label for="deptartment">Department:</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <label for="year">Current program:</label>

                        </div>
                        <div class="col-90">
                            <label for="mode_of_study">Gender:</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <label for="year">Faculty:</label>

                        </div>
                        <div class="col-90">
                            <label for="dob">Date of birth:</label>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-10">
                            <label for="year"> Year:</label>

                        </div>
                        <div class="col-90">
                            <label for="address">Address:</label>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-10">

                            <a href="studentupdates.php">updates</a>
                        </div>
                        <div class="col-90">

                        </div>
                    </div>


                </div>


            </div>
        </div>

    </div>




    <div class="footer">
        <p><strong>©Copyright CUEAGMS</strong></p>

    </div>
</body>

</html>