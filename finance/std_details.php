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
if (isset($_SESSION['userRole']) != "Finance") {
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

</head>

<style>
/* applies to all elements,
making sure that any padding or borders added to an element are included in its total width and height. */
* {
    box-sizing: border-box;
}

body {
    font-family: 'Work Sans', sans-serif;
    text-align: center;
    margin: 0;
}

/* these elements will be floated to the left side of their container */
.header,
.navbar,
.section,
.footer {
    float: left;
    width: 100%;
    /* The width is 100%, by default */
}

.header {
    height: 100;
    background-color: #fff;
}

.header .logo img {
    float: left;
}

.header .logo p {
    float: left;
    width: 25%;
    font-size: 20px;
    color: #7E0524;
}


.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    /*  hides any content that goes beyond the boundaries of the ul element. */
    background-color: #7E0524;
}

.navbar li {
    float: left;
    border-right: 1px solid #bbb;
}

.navbar li:last-child {
    border-right: none;
    /* property removes the right border of the last li element. */
}

.navbar li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;

}

.navbar li a:hover:not(.active) {
    background-color: #F09910;
}

.navbar .active {
    background-color: #F09910;
}



/***********************Menu**************************/
/*****************************************************/


/* Tells the browser to use the Flexbox layout for all elements within that container.*/
/* Flexbox layout for row */
.row {
    display: flex;
}

/* Left column (menu) */
.left {
    flex: 15%;
    height: 100%;
    margin: 0px;
}

/* Style for h2 element in left column */
.left h2 {
    background-color: #fff;
    margin: 0;
    padding: 10px 0 10px 0;
}

/* Right column (page content) */
.right {
    flex: 85%;
    padding: 15px;
}

/* Vertical menu style */
nav.vertical {
    position: relative;
    background: #7E0524;
    text-align: left;
}

/* Style for all ul elements in vertical menu */
nav.vertical ul {
    list-style: none;
    margin: 0;
}

/* Style for all li elements in vertical menu */
nav.vertical li {
    position: relative;
}

/* Style for all a elements in vertical menu */
nav.vertical a {
    display: block;
    color: #eee;
    text-decoration: none;
    padding: 10px 15px;
    transition: 0.2s;
    font-size: 12px;
}

/* Style for a elements when hovering over li element in vertical menu */
nav.vertical li:hover>a {
    background: #F09910;
}

/* Hide inner ul elements in vertical menu */
nav.vertical ul ul {
    background: rgba(0, 0, 0, 0.1);
    transition: max-height 0.2s ease-out;
    max-height: 0;
    overflow: hidden;
}

/* Show inner ul elements in vertical menu when hovering over li element */
nav.vertical li:hover>ul {
    max-height: 500px;
    transition: max-height 0.25s ease-in;
}

/* Style for each row */
.row {
    margin-bottom: 5px;
    padding-bottom: 10px;
    position: relative;
}

/* Style for h3 elements */
h3 {
    background-color: #F09910;
    text-align: left;
    padding: 10px;
}

/* Style for labels */
label {
    color: #FFF;
    display: inline-block;
    width: 100px;
    font-size: 1rem;
}


/* This sets the styles for the "status" table cell */
td.status {
    padding: 5px;
    font-weight: bold;
}

/* These styles apply when the table cell has the class "approved" */
td.approved {
    background-color: #009EFF;
    color: white;
}

/* These styles apply when the table cell has the class "rejected" */
td.rejected {
    background-color: #EB1D36;
    color: white;
}

/* These styles apply when the table cell has the class "pending" */
td.pending {
    background-color: #FFE15D;
}

/* This sets the styles for the "clearance-form" class */
.clearance-form {
    border-radius: 5px;
    background-color: #f2f2f2;
    margin-bottom: 50px;
    border: 1px solid #000;
    padding: 20px;
}

/* These styles apply to the "box1" div */
.box1 {
    float: left;
    width: 30%;
    background-color: #2B3A55;
    height: 100;
    margin-top: 6px;
}

/* These styles apply to the "box2" div */
.box2 {
    float: left;
    width: 30%;
    background-color: #282A3A;
    height: 100;
    margin-top: 6px;
}

/* These styles apply to the "box3" div */
.box3 {
    float: left;
    width: 30%;
    background-color: #5CB8E4;
    height: 100;
    margin-top: 6px;
}

/* This clears the float on the row element */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* This sets the styles for the table */
table {
    width: 100%;
    border-collapse: collapse;
}

/* This sets the styles for odd rows in the table */
tr:nth-of-type(odd) {
    background: none;
}

/* This sets the styles for the table headers */
th {
    background: #333;
    color: white;
    font-weight: bold;
}

/* This sets the styles for table cells */
td,
th {
    padding: 6px;
    border: 1px solid #ccc;
    text-align: left;
    font-size: 12px;
}

/* This sets the styles for "status" table cells */
td.status {
    padding: 5px;
    font-weight: bold;
}

/* These styles apply when the table cell has the class "approved" */
td.approved {
    background-color: #009EFF;
    color: white;
}

/* These styles apply when the table cell has the class "rejected" */
td.rejected {
    background-color: #EB1D36;
    color: white;
}

/* These styles apply when the table cell has the class "pending" */
td.pending {
    background-color: #FFE15D;
}

/* These media queries apply when the screen width is 768px or less */
@media screen and (max-width: 768px) {

    /* These styles apply to elements with the "left", "main", or "right" classes */
    .left,
    .main,
    .right {
        width: 100%;
    }

    /* These styles apply to the "logo" element within the "header" element */
    .header .logo p {
        float: left;
        font-size: 15px;
    }

    /* This changes the display of the "row" element to "contents" */
    .row {
        display: contents;
    }

    .box1,
    .box2,
    .box3,
        {
        width: 100%;
        margin-top: 0;
    }

}


/* Style the footer */
.footer {
    position: fixed;
    /* Fix the position of the footer */
    left: 0;
    /* Set the left edge of the footer to the left edge of the screen */
    bottom: 0;
    /* Set the bottom edge of the footer to the bottom of the screen */
    width: 100%;
    /* Set the width of the footer to 100% of the screen */
    background-color: #7E0524;
    /* Set the background color */
    color: white;
    /* Set the font color */
    text-align: center;
    /* Align the text to the center */
}

input[type=text],
input[type=email],
input[type=number],
input[type=select],
input[type=date],
input[type=select],
input[type=password],
input[type=tel],
select {
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
    padding: 20px;
    height: 600px;
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
    padding: 20px;
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

td.status {
    padding: 5px;
    font-weight: bold;
}

td.approved {
    background-color: #009EFF;
    color: white;
}

td.rejected {
    background-color: #EB1D36;
    color: white;
}

td.pending {
    background-color: #FFE15D;
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






.feedback-button {
    height: 35px;
    border: solid 3px #F09910;
    background: #F09910;
    width: 155px;
    line-height: 30px;
    font-weight: 700;
    color: white;
    transform: rotate(-90deg);
    text-align: center;
    font-size: 18px;
    position: fixed;
    right: -44px;
    top: 55%;
    font-family: "Roboto", helvetica, arial, sans-serif;
    z-index: 999;
}

#feedback-main {
    display: none;
    float: left;
    margin: 0px 10px 10px 10px;
    padding-bottom: 10px;
    border: 1px solid #ccc;


}

#feedback-main input[type=text] {
    width: 90%;
    padding: 12px;
    margin-bottom: 5px;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;



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
                    </table>
                </div>
                <nav class="vertical">
                    <ul>
                        <li><a href="finance.php">Dashboard</a></li>
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
    
    // Query the database to get the clearance details
    $query = "SELECT * FROM clearance WHERE std_regNo = '$std_regNo'";
    $result2 = mysqli_query($connection, $query);
    // Fetch the data
    $clrrow = mysqli_fetch_assoc($result2);
    
    // Query the database to get the path of the fee statement file
    $sql = "SELECT fee_statement FROM students WHERE std_regNo = '{$std_regNo}'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    // Get the path of the fee statement file
    $fee_statement = $row['fee_statement'];
    if ($fee_statement) {
        $fee_statement_path = "../student/files/".$fee_statement;
    } else {
        $fee_statement_path = "#";
        $fee_statement_message = "No fee statement was uploaded by student.";
    }
    
    // Close the database connection
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
                                <td>Fees statement</td>
                                <td>
                                    <?php if ($fee_statement_path != "#"): ?>
                                    <a href="<?php echo $fee_statement_path; ?>" target="_blank">View Fee Statement</a>
                                    <?php else: ?>
                                    <p><?php echo $fee_statement_message; ?></p>
                                    <?php endif; ?>
                                </td>

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


        <script>
        function toggle_visibility() {
            var e = document.getElementById('feedback-main');
            if (e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }
        </script>
</body>

</html>