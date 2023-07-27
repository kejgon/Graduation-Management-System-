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

</head>

<style>
input[type=text],
input[type=email],
input[type=number],
input[type=select],
input[type=date],
input[type=select],
input[type=password],
input[type=tel] {
    width: 45%;
    padding: 12px;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;
}

textarea {
    width: 45%;
    padding: 12px;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;
}

input[type=radio],
input[type=checkbox] {
    width: 5%;
    padding-left: 0%;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;
}

h1 {
    font-family: Arial;
    font-size: medium;
    font-style: normal;
    font-weight: bold;
    color: brown;
    text-align: center;
    text-decoration: underline;
}

label {
    padding: 12px 12px 12px 0;
    display: inline-block;
    color: black;
}

input[type=submit] {
    border: 3px solid #7E0524;
    background-color: #F09910;
    padding: 12px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    margin: 0 auto;
    color: #fff;

}

input[type="submit"]:hover {
    background-color: #7E0524;

}

.clearance-form {
    border-radius: 5px;
    background-color: #f2f2f2;
    margin-bottom: 50px;
    border: 1px solid #000;
    padding: 50px;

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

.profile-tab td,
th {
    padding: 6px;
    border: 1px solid #ccc;
    text-align: left;
    font-size: 12px;
}



.profile-tab td:nth-child(2n+1) {
    /* your stuff here */
    font-weight: bold;
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


            <?php 
//! RETREIVING STUDENT AND CLEARANCE Details
            if (isset($_GET['id'])) {

                // Gets the student registration number from the URL
    $std_regNo = $_GET['id'];
    $_SESSION['studentId'] = $std_regNo;

    // Query the database to get the student's details
    $query = "SELECT * FROM students WHERE std_regNo = '$std_regNo'";
    $result = mysqli_query($connection, $query);
    // Fetch the data
    $stdrow = mysqli_fetch_assoc($result);
    $_SESSION['studentName'] =$stdrow['std_fullname'];
//? Retreiving Clearance details

                $query = "SELECT * FROM clearance WHERE std_regNo = '$std_regNo'";
                $result2 = mysqli_query($connection, $query);
                // Fetch the data
                $clrrow = mysqli_fetch_assoc($result2);
                // Close the connection
                mysqli_close($connection);
            }
   
?>

            <div class="right" style="background-color:#FFF;">

                <h3>Student Details</h3>
                <div class="clearance-form">
                    <p><a style="
                                background-color: #F09910;
                                color: white;
                                padding: 12px 20px;
                                margin-right:10px;
                                border: none;
                                border-radius: 10px;
                                float: left;
                                 text-decoration: none;" href="clearanceRequests.php">Back</a>
                    </p>
                    <p><a style="
                                background-color: #F09910;
                                color: white;
                                padding: 12px 20px;
                                margin-right:10px;
                                border: none;
                                border-radius: 10px;
                                float: left;
                                 text-decoration: none;"
                            href="feedback.php?id={$_SESSION['studentId']}&fulnames={$_SESSION['studentName']}">Feedback</a>
                    </p>
                    <div class="row">
                        <table class="profile-tab">
                            <tr>
                                <td>Student Fullname</td>
                                <td><?php echo $stdrow['std_fullname'];?></td>
                                <td>Student Registration No.</td>
                                <td><?php echo $stdrow['std_regNo'];?></td>
                            </tr>
                            <tr>
                                <td>Faculty</td>
                                <td><?php echo $stdrow['faculty'];?></td>
                                <td>Department</td>
                                <td><?php echo $stdrow['department'];?></td>
                            </tr>
                            <tr>
                                <td>Level </td>
                                <td><?php echo $stdrow['levels'];?></td>
                                <td>Program</td>
                                <td><?php echo $stdrow['programs'];?></td>
                            </tr>
                            <tr>
                                <td>Specialization </td>
                                <td><?php echo $stdrow['specialization'];?></td>
                                <td>Mode of Study</td>
                                <td><?php echo $stdrow['mode_of_study'];?></td>
                            </tr>
                            <tr>
                                <td>Campus </td>
                                <td><?php echo $clrrow['campus'];?></td>
                                <td>Reason for Clearance</td>
                                <td><?php echo $clrrow['reason_for_clearance'];?></td>
                            </tr>
                            <tr>
                                <td>Year </td>
                                <td><?php echo $stdrow['years'];?></td>
                                <td>Gender</td>
                                <td><?php echo $stdrow['gender'];?></td>
                            </tr>
                            <tr>
                                <td>Email </td>
                                <td><?php echo $stdrow['email'];?></td>
                                <td>Phone number</td>
                                <td><?php echo $stdrow['phone'];?></td>
                            </tr>
                            <tr>
                                <td>Date Of submission </td>
                                <td><?php echo $clrrow['date_of_submission'];?></td>

                            </tr>

                        </table>



                    </div>
                    <p>
                        <a style="background-color: #F09910;color: white;padding: 12px 20px;border: none;border-radius: 10px;text-align: center;
  text-decoration: none;
" href="clearanceRequests.php">Back</a>
                    </p>
                </div>
            </div>

        </div>




        <div class="footer">
            <p><strong>©Copyright CUEAGMS</strong></p>

        </div>

        <script src="../assets/js/clearanceVali.js"></script>
</body>

</html>