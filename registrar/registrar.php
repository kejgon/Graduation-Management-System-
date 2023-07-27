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
if (isset($_SESSION['userRole']) != "Registrar") {
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
}

.row {
    color: #fff;

}

.box1 {
    float: left;
    width: 20%;
    background-color: #2B3A55;
    height: 100;
    margin: 10px;
    padding: 20px 40px;
}

.box2 {
    float: left;
    width: 20%;
    background-color: #6B728E;
    height: 100;
    margin: 10px;
    padding: 20px 40px;

}

.box3 {
    float: left;
    width: 20%;
    background-color: #009EFF;
    height: 100;
    margin: 10px;
    padding: 20px 40px;

}

.box4 {
    float: left;
    width: 20%;
    background-color: #D2001A;
    height: 100;
    margin: 10px;
    padding: 20px 40px;

}

.row:after {
    content: "";
    display: table;
    clear: both;
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

    .box1 {
        width: 100%;
    }

    .box2 {
        width: 100%;
    }

    .box3 {
        width: 100%;
    }

    .box4 {
        width: 100%;
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


@media screen and (max-width: 600px) {

    .box1,
    .box2,
    .box3,
    .box4,
        {
        width: 100%;
        margin: 0 auto;
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



.button {
    background-color: white;
    color: black;
    border: 2px solid #555555;
    padding: 10px 20px;
    margin-right: 5px;
    text-decoration: none;
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
                            <td>Position:</td>
                            <td><?php echo $_SESSION['position'];?></td>
                        </tr>
                    </table>
                </div>
                <nav class="vertical">
                    <ul>
                        <li><a href="registrar.php">Dashboard</a></li>
                        <li><a href="#">Request</a>
                            <ul>
                                <li><a href="clearanceRequests.php">Clearance request</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Reports</a>
                            <ul>
                                <li><a href="clearedStudents.php">Cleared Students</a></li>
                                <li><a href="graduationlist.php">Graduation list</a></li>

                            </ul>
                        </li>
                        <li><a href="viewprofile.php">Profile</a></li>

                    </ul>
                </nav>
            </div>


            <div class="right" style="background-color:#FFF;">

                <h3> <?php echo $_SESSION['position'] . "'s";?> Dashboard</h3>


                <div class="row">
                    <div class="box1">
                        <p>No. of clearance requests:</p>
                        <?php
//! GETING THE NUMBER OF STUDENTS             
$sql = "SELECT COUNT(*) FROM clearance";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_row($result);
    $count = $row[0];
    echo "<p>$count<p/>";
} else {
    echo "<p>0 </p>";
}

                        ?>
                    </div>
                    <div class="box2">
                        <p>No. of Pending requests are:</p>
                        <?php
                        $sql = "SELECT COUNT(*) FROM reg_clearance_request WHERE stdStatus = 'Pending'";
                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_row($result);
                            $count = $row[0];
                            echo "<p>$count<p/>";
                        } else {
                            echo "<p>0 </p>";
                        }
                        
                        
                        ?>

                    </div>
                    <div class="box3">
                        <p>No. of Approved requests</p>
                        <?php
                        $sql = "SELECT COUNT(*) FROM reg_clearance_request WHERE stdStatus = 'Approved'";
                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_row($result);
                            $count = $row[0];
                            echo "<p>$count<p/>";
                        } else {
                            echo "<p>0 </p>";
                        }
                                                
                        ?>


                    </div>
                    <div class="box4">
                        <p>No. of rejected requests</p>
                        <?php
                        $sql = "SELECT COUNT(*) FROM reg_clearance_request WHERE stdStatus = 'Rejected'";
                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_row($result);
                            $count = $row[0];
                            echo "<p>$count<p/>";
                        } else {
                            echo "<p>0 </p>";
                        }
                        
                        // mysqli_close($connection);
                        
                        ?>
                    </div>




                </div>
                <h3> Clearance Reports</h3>

                <div class="row">

                    <div class="col-10">
                        <a href="completion.php" class="button">Completion students </a>

                        <a href="transfer.php" class="button">Transferred students </a>

                        <a href="withdrawal.php" class="button">Withdrawal students </a>

                        <a href="others.php" class="button">For other reasons </a>

                    </div>
                    <div class="col-9" style="padding:10px">
                    </div>

                </div>
                <div class="row">
                    <div class="col-10" style="width:50%">
                        <h3> Clearance reports by Year</h3>

                        <form action="registrar.php" method="post">
                            <label for="year"> Year:</label>
                            <select name="year" id="year">
                                <option value=" ">Select the year:</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>

                            </select>
                            <input type="submit" name="submitYear" value="search">
                        </form>
                    </div>

                    <?php
                 if(isset($_POST['submitYear'])) {
                    $year = $_POST['year'];
                    $_SESSION['theYear'] = $year;
                    
                    header("Location: clearanceByYear.php"); // Redirect to the desired page
                    exit(); // Terminate the current script
                }
                ?>
                    <div class="col-9" style="width:50%;">
                        <h3> Graduation reports by Year</h3>

                        <form action="registrar.php" method="post">
                            <label for="year"> Year:</label>
                            <select name="year" id="year">
                                <option value=" ">Select the year:</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>

                            </select>
                            <input type="submit" name="submitYear" value="search">
                        </form>
                    </div>

                    <?php
                 if(isset($_POST['submitYear'])) {
                    $department = $_POST['year'];
                    $_SESSION['theYear'] = $department;
                    
                    header("Location: byYear.php"); // Redirect to the desired page
                    exit(); // Terminate the current script
                }
                ?>




                    <?php
                 if(isset($_POST['submitprogram'])) {
                    $program = $_POST['program'];
                    $_SESSION['theProgram'] = $program;
                    
                    header("Location: byprogram.php"); // Redirect to the desired page
                    exit(); // Terminate the current script
                }
                ?>
                </div>

                <h3> Graduation Reports</h3>

                <div class="row">
                    <div class="col-10" style="width:50%">

                        <form action="registrar.php" method="post">
                            <label for="faculty"> Faculty:</label>
                            <select name="faculty" id="faculty">
                                <option value=" ">Select the faculty:</option>
                                <option value="Faculty of Theology">Faculty of Theology</option>
                                <option value="Faculty of Arts & Social Science">Faculty of Arts & Social
                                    Science
                                </option>
                                <option value="School of Business & Economics">School of Business &
                                    Economics
                                </option>
                                <option value="Faculty of Education">Faculty of Education</option>
                                <option value="Faculty of Science">Faculty of Science</option>
                                <option value="School of Nursing">School of Nursing</option>
                                <option value="Faculty of Law">Faculty of Law</option>
                            </select>
                            <input type="submit" name="submitFaculty" value="Search">
                        </form>

                    </div>
                    <?php
                 if(isset($_POST['submitFaculty'])) {
                    $faculty = $_POST['faculty'];
                    $_SESSION['theFaculty'] = $faculty;
                    
                    header("Location: byfaculty.php"); // Redirect to the desired page
                    exit(); // Terminate the current script
                }
                ?>


                    <div class="col-9" style="width:50%">
                        <form action="registrar.php" method="post">
                            <label for="department">Department:</label>
                            <select name="department" id="department">
                                <option value=" ">Select the deptartment:</option>
                                <option value="Department of Community Health and Development">Department of
                                    Community Health and Development</option>
                                <option value="Department of Computer and Information Science">Department of
                                    Computer
                                    and Information Science</option>
                                <option value="Department of Mathematics and Actuarial Science">Department of
                                    Mathematics and Actuarial Science</option>
                                <option value="Department of Pastoral Theology">Department of Pastoral Theology
                                </option>
                                <option value="Department of Spiritual Theology">Department of Spiritual Theology
                                </option>
                                <option value="Department of Moral Theology">Department of Moral Theology</option>
                                <option value="Department of Social Sciences and Development Studies">Department of
                                    Social Sciences and Development Studies</option>
                                <option value="Department of Religious Studies">Department of Religious Studies
                                </option>
                                <option value="Department of Humanities (History, Geography & Environmental Studies)">
                                    Department of Humanities (History, Geography & Environmental Studies)</option>
                                <option value="Department of Economics">Department of Economics</option>
                                <option value="Department of Philosophy">Department of Philosophy</option>
                                <option value="Department of Counseling Psychology">Department of Counseling
                                    Psychology
                                </option>
                                <option
                                    value="Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)">
                                    Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA
                                    CPD)
                                </option>

                            </select>
                            <input type="submit" name="submitDepartment" value="Search">
                        </form>
                    </div>
                    <?php
                 if(isset($_POST['submitDepartment'])) {
                    $department = $_POST['department'];
                    $_SESSION['theDepartment'] = $department;
                    
                    header("Location: bydepartment.php"); // Redirect to the desired page
                    exit(); // Terminate the current script
                }
                ?>
                </div>
                <div class="row">
                    <div class="col-10" style="width:50%">

                        <form action="registrar.php" method="post">
                            <label for="levels"> Levels:</label>
                            <select name="level" id="level">
                                <option value=" ">Select the level:</option>
                                <option value="Certificate">Certificate</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Bachelor">Bachelor</option>
                                <option value="Master">Master</option>
                                <option value="Doctoral">Doctoral</option>
                            </select>
                            <input type="submit" name="submitLevel" value="Search">
                        </form>
                    </div>

                    <?php
                 if(isset($_POST['submitLevel'])) {
                    $department = $_POST['level'];
                    $_SESSION['theLevel'] = $department;
                    
                    header("Location: bylevel.php"); // Redirect to the desired page
                    exit(); // Terminate the current script
                }
                ?>
                    <div class="col-9" style="width:50%">
                        <form action="registrar.php" method="post">
                            <label for="programs">Programs:</label>
                            <select name="program" id="program">
                                <option value=" ">Select the program:</option>
                                <option value="Doctorate in Business Administration">Doctorate in Busine
                                    Administration</option>
                                <option value="Doctor of Philosophy in Business Administration">Doctor of Philosophy
                                    in
                                    Business Administration</option>
                                <option value="Doctor of Philosophy in Education">Doctor of Philosophy in Education
                                </option>
                                <option value="Doctor of Philosophy in Counseling Psychology">Doctor of Philosophy
                                    in
                                    Counseling Psychology</option>
                                <option value="Doctor of Philosophy in History">Doctor of Philosophy in History
                                </option>
                                <option value="Doctor of Philosophy in Social Work">Doctor of Philosophy in Social
                                    Work
                                </option>
                                <option value="Doctor of Philosophy in Mathematics

">Doctor of Philosophy in Mathematics

                                </option>
                                <option value="Doctor of Philosophy in Philosophy">Doctor of Philosophy in
                                    Philosophy
                                </option>
                                <option value="Doctor of Philosophy in Religious Studies">Doctor of Philosophy in
                                    Religious Studies</option>
                                <option value="Doctor of Philosophy in Theology">Doctor of Philosophy in Theology
                                </option>
                                <option value="Doctorate in Sacred Theology">Doctorate in Sacred Theology</option>
                                <option value="Master of Laws">Master of Laws</option>
                                <option value="Master of Business Administration (MBA)">Master of Business
                                    Administration (MBA)</option>
                                <option value="Master of Education">Master of Education</option>
                                <option value="Master of Arts in Applied Linguistics">Master of Arts in Applied
                                    Linguistics</option>
                                <option value="Master of Arts in Counseling Psychology
">Master of Arts in Counseling Psychology
                                </option>
                                <option value="Master of Arts in Development Studies
">Master of Arts in Development Studies
                                </option>
                                <option value="Master of Arts in Economics">Master of Arts in Economics</option>
                                <option value="Master of Arts in Geography">Master of Arts in Geography</option>
                                <option value="Master of Arts in History">Master of Arts in History</option>
                                <option value="Master of Arts in Justice, Peace, and Cohesion">Master of Arts in
                                    Justice, Peace, and Cohesion</option>
                                <option value="Master of Arts in Kiswahili and Communication">Master of Arts in
                                    Kiswahili and Communication</option>
                                <option value="Master of Arts in Literature">Master of Arts in Literature</option>
                                <option value="Master of Theology">Master of Theology</option>
                                <option value="Master of Arts in Philosophy">Master of Arts in Philosophy</option>
                                <option value="Master of Arts in Political Science">Master of Arts in Political
                                    Science
                                </option>
                                <option value="Master of Arts in Project Planning & Management">Master of Arts in
                                    Project Planning & Management</option>
                                <option value="Master of Arts in Regional Integration">Master of Arts in Regional
                                    Integration</option>
                                <option value="Master of Arts in Religious Studies">Master of Arts in Religious
                                    Studies
                                </option>
                                <option value="Master of Arts in Social Work">Master of Arts in Social Work</option>
                                <option value="Master of Arts in Sociology">Master of Arts in Sociology</option>
                                <option value="Master of Science in Mathematics">Master of Science in Mathematics
                                </option>
                                <option value="Master Licentiate in Canon Law">Master Licentiate in Canon Law
                                </option>
                                <option value="Master Licentiate in Theology">Master Licentiate in Theology</option>
                                <option value="Bachelor of Laws (LLB)">Bachelor of Laws (LLB)</option>
                                <option value="Bachelor of Commerce">Bachelor of Commerce
                                </option>
                                <option value="Bachelor of Justice and Peace">Bachelor of Justice and Peace</option>
                                <option value="Bachelor of Education">Bachelor of Education
                                </option>
                                <option value="Bachelor of Arts in Anthropology">Bachelor of Arts in Anthropology
                                </option>
                                <option value="Bachelor of Arts in Counseling Psychology">Bachelor of Arts in
                                    Counseling
                                    Psychology</option>
                                <option value="Bachelor of Arts in Development Studies">Bachelor of Arts in
                                    Development
                                    Studies</option>
                                <option value="Bachelor of Economics">Bachelor of Economics</option>
                                <option value="Bachelor of Economics & Statistics">Bachelor of Economics &
                                    Statistics
                                </option>
                                <option value="Bachelor of Economics & Finance">Bachelor of Economics & Finance
                                </option>
                                <option value="Bachelor of Arts in Environmental Planning & Management">Bachelor of
                                    Arts
                                    in Environmental Planning & Management</option>
                                <option value="Bachelor of Arts in Geography">Bachelor of Arts in Geography</option>
                                <option value="Bachelor of Arts in Histor">Bachelor of Arts in Histor</option>
                                <option value="Bachelor of Arts in Kiswahili and Communication"> Bachelor of Arts in
                                    Kiswahili and Communication</option>
                                <option value="Bachelor of Arts in Philosophy">Bachelor of Arts in Philosophy
                                </option>
                                <option value="Bachelor of Arts in Political Science">Bachelor of Arts in Political
                                    Science</option>
                                <option value="Bachelor of Arts in International Relations">Bachelor of Arts in
                                    International Relations</option>
                                <option value="Bachelor of Arts in Religious Studies">Bachelor of Arts in Religious
                                    Studies</option>
                                <option value="Bachelor of Arts in Social Sciences">Bachelor of Arts in Social
                                    Sciences
                                </option>
                                <option value="Bachelor of Arts in Social Work">Bachelor of Arts in Social Work
                                </option>
                                <option value="Bachelor of Arts in Sociology">Bachelor of Arts in Sociology</option>
                                <option value="Bachelor of Science in Actuarial Science">Bachelor of Science in
                                    Actuarial Science</option>
                                <option value="Bachelor of Science in Biology">Bachelor of Science in Biology
                                </option>
                                <option value="Bachelor of Science in Chemistry">Bachelor of Science in Chemistry
                                </option>
                                <option value="Bachelor of Science in Community Health and Development">Bachelor of
                                    Science in Community Health and Development</option>
                                <option value="Bachelor of Science in Computer Science">Bachelor of Science in
                                    Computer Science
                                </option>
                                <option value="Bachelor of Science in Health Professions Education">Bachelor of
                                    Science
                                    in Health Professions Education</option>
                                <option value="Bachelor of Science in Library and Information Science">Bachelor of
                                    Science in Library and Information Science</option>
                                <option value="Bachelor of Science in Mathematics">Bachelor of Science in
                                    Mathematics
                                </option>
                                <option value="Bachelor of Science in Nursing (direct/upgrading)">Bachelor of
                                    Science in
                                    Nursing (direct/upgrading)</option>
                                <option value="Bachelor of Science in Physics">Bachelor of Science in Physics
                                </option>
                                <option value="Baccalaureate in Sacred Theology">Baccalaureate in Sacred Theology
                                </option>
                                <option value="Bachelor of Theology">Bachelor of Theology</option>
                                <option value="Diploma in Planning and Management of Development Projects">Diploma
                                    in
                                    Planning and Management of Development Projects</option>
                                <option value="Diploma in Education">Diploma in Education</option>
                                <option value="Diploma in Teaching in Higher Education">Diploma in Teaching in
                                    Higher
                                    Education</option>
                                <option value="Diploma in Ecclesiastical Tribunal & Procedural Law">Diploma in
                                    Ecclesiastical Tribunal & Procedural Law</option>
                                <option value="Diploma in Dogmatic Theology">Diploma in Dogmatic Theology</option>
                                <option value="Diploma in Forming Small Christian Communities
">Diploma in Forming Small Christian Communities
                                </option>
                                <option value="Diploma in Ecclesiastical Tribunal & Matrimonial Cases">Diploma in
                                    Ecclesiastical Tribunal & Matrimonial Cases</option>
                                <option value="Diploma in Theology">Diploma in Theology</option>
                                <option value="Diploma in Philosophy">Diploma in Philosophy</option>
                                <option value="Diploma in Law">Diploma in Law</option>
                                <option value="Diploma in Community Health and Development">Diploma in Community
                                    Health
                                    and Development</option>
                                <option value="Diploma in Information Technology">Diploma in Information Technology
                                </option>
                                <option value="Diploma in Records & Information Technology">Diploma in Records &
                                    Information Technology</option>
                                <option value="Diploma in Archives and Record Management">Diploma in Archives and
                                    Record
                                    Management</option>
                                <option value="Diploma in Library and Information Science">Diploma in Library and
                                    Information Science</option>
                                <option value="Diploma in Health Records Management">Diploma in Health Records
                                    Management</option>
                                <option value="Diploma in Archives and Information Technology">Diploma in Archives
                                    and
                                    Information Technology</option>
                                <option value="Diploma in Business Management">Diploma in Business Management
                                </option>
                                <option value="Diploma in Hospitality Management">Diploma in Hospitality Management
                                </option>
                                <option value="Diploma in Advanced Diploma in Business Management">Diploma in
                                    Advanced
                                    Diploma in Business Management</option>
                                <option value="Diploma in Evangelization and Catechesis
">Diploma in Evangelization and Catechesis
                                </option>
                                <option value="Diploma in Pastoral Ministry and Management">Diploma in Pastoral
                                    Ministry
                                    and Management</option>
                                <option value="Diploma in Counselling Psychology">Diploma in Counselling Psychology
                                </option>
                                <option value="Diploma in International Relations">Diploma in International
                                    Relations
                                </option>
                                <option value="Diploma in Social Work">Diploma in Social Work</option>
                                <option value="Diploma in Conflict Management and Peace Building">Diploma in
                                    Conflict
                                    Management and Peace Building</option>
                                <option value="Diploma in Governance, Leadership and Elections">Diploma in
                                    Governance,
                                    Leadership and Elections</option>
                                <option value="Diploma in Justice and Peace">Diploma in Justice and Peace</option>
                                <option value="Diploma in Church Management and Leadership">Diploma in Church
                                    Management
                                    and Leadership</option>
                                <option value="Diploma in Early Childhood Development & Education">Diploma in Early
                                    Childhood Development & Education</option>
                                <option value="Certificate in Program for Preparatory Year at CUEA">Certificate in
                                    Program for Preparatory Year at CUEA</option>
                                <option value="Certificate in Canon Law for Parish Collaborators">Certificate in
                                    Canon
                                    Law for Parish Collaborators</option>
                                <option value="Certificate in Professional Certifications Courses">Certificate in
                                    Professional Certifications Courses</option>
                                <option value="Certificate in Association of Chartered Institute of Accountants (ACCA)">
                                    Certificate in Association of Chartered Institute of Accountants (ACCA)</option>
                                <option value="Certificate in Certified Public Accountant (CPA)">Certificate in
                                    Certified Public Accountant (CPA)</option>
                                <option value="Certificate in Innovation and Entrepreneurship">Certificate in
                                    Innovation
                                    and Entrepreneurship</option>
                                <option value="Certificate in Human Resource Management">Certificate in Human
                                    Resource
                                    Management</option>
                                <option value="Certificate in Community Health and Development">Certificate in
                                    Community
                                    Health and Development</option>
                                <option value="Certificate in Archives and Record Management">Certificate in
                                    Archives
                                    and Record Management</option>
                                <option value="Certificate in Library and Information Science">Certificate in
                                    Library
                                    and Information Science</option>
                                <option value="Certificate in Records and Information Technology">Certificate in
                                    Records
                                    and Information Technology</option>
                                <option value="Certificate in Social Work">Certificate in Social Work</option>
                                <option value="Certificate in Church Management and Leadership.">Certificate in
                                    Church
                                    Management and Leadership</option>
                                <option value="Certificate in Advanced Certificate in Justice and Peace">Certificate
                                    in
                                    Advanced Certificate in Justice and Peace</option>
                                <option value="Certificate in Advanced Certificate in Church Management and Leadership">
                                    Certificate in Advanced Certificate in Church Management and Leadership</option>

                            </select>
                            <input type="submit" name="submitprogram" value="Search">
                        </form>
                    </div>


                    <?php
                 if(isset($_POST['submitprogram'])) {
                    $program = $_POST['program'];
                    $_SESSION['theProgram'] = $program;
                    
                    header("Location: byprogram.php"); // Redirect to the desired page
                    exit(); // Terminate the current script
                }
                ?>

                </div>

                <div class="row" style="margin-bottom:100px">
                    <div class="col-10" style="width:50%">

                        <h3> Summary of clearance Reports by Levels</h3>
                        <form method="post" action="registrar.php">
                            <label for="year"> Year:</label>
                            <select name="year" id="year">
                                <option value=" ">Select the year:</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>

                            </select>
                            <input type="submit" name="getSummary" value="GetSummary">
                        </form>

                        <canvas id="myChart"></canvas>

                    </div>

                    <div class="col-9" style="width:50%">
                        <h3> Summary of Graduants Reports by Levels</h3>
                        <form method="post" action="registrar.php">
                            <label for="year"> Year:</label>
                            <select name="year" id="year">
                                <option value=" ">Select the year:</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>

                            </select>
                            <input type="submit" name="getGsummary" value="Graduants Summary">
                        </form>

                        <canvas id="myChart2"></canvas>

                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

    </div>

    </div>

    <?php
     // Variables to hold the counts
    $certificateCount = 0;
    $diplomaCount = 0;
    $bachelorCount = 0;
    $masterCount = 0;
    $doctoralCount = 0;
if(isset($_POST['getSummary'])) {
    $year = $_POST['year'];
   


    $sql = "SELECT c.clr_id, c.levels ,r.updated_at
        FROM clearance c 
        INNER JOIN fin_clearance_request r ON c.clr_id = r.clr_id
        WHERE YEAR(r.updated_at) = '$year'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check for errors during query execution
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    // Loop through the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $level = $row['levels'];

        // Increment the respective count variable based on the level
        if ($level == 'Diploma') {
            $diplomaCount++;
        } elseif ($level == 'Bachelor') {
            $bachelorCount++;
        } elseif ($level == 'Master') {
            $masterCount++;
        } elseif ($level == 'Doctoral') {
            $doctoralCount++;
        } else {
            $certificateCount++;
        }
    }
   
}


?>
    <?php
   // Variables to hold the counts
   $gCertificateCount = 0;
   $gDiplomaCount = 0;
   $gBachelorCount = 0;
   $gMasterCount = 0;
   $gDoctoralCount = 0;
   if(isset($_POST['getGsummary'])) {

    $year = $_POST['year'];
  

   $sql = "SELECT c.clr_id, c.levels, c.reason_for_clearance, r.updated_at
   FROM clearance c 
   INNER JOIN fin_clearance_request r ON c.clr_id = r.clr_id
   WHERE c.reason_for_clearance = 'completion' AND YEAR(r.updated_at) = '$year' ";

// Execute the query
$result = mysqli_query($connection, $sql);

   // Check for errors during query execution
   if (!$result) {
       die("Query failed: " . mysqli_error($connection));
   }

   // Loop through the result set
   while ($row = mysqli_fetch_assoc($result)) {
       $level = $row['levels'];

       // Increment the respective count variable based on the level
       if ($level == 'Diploma') {
           $gDiplomaCount++;
       } elseif ($level == 'Bachelor') {
           $gBachelorCount++;
       } elseif ($level == 'Master') {
           $gMasterCount++;
       } elseif ($level == 'Doctoral') {
           $gDoctoralCount++;
       } else {
           $gCertificateCount++;
       }
   }
   
}


?>





    <div class=" footer">
        <p><strong>©Copyright CUEAGMS</strong></p>

    </div>

    <script>
    function clearanceSummaryByLevels() {
        // Retrieve the PHP values and store them in JavaScript variables
        var phpValue1 = <?php echo $certificateCount; ?>;
        var phpValue2 = <?php echo $diplomaCount; ?>;
        var phpValue3 = <?php echo $bachelorCount; ?>;
        var phpValue4 = <?php echo $masterCount; ?>;
        var phpValue5 = <?php echo $doctoralCount; ?>;

        // Calculate the total value
        var totalValue = phpValue1 + phpValue2 + phpValue3 + phpValue4 + phpValue5;

        // Calculate the percentage for each value
        var percentage1 = (phpValue1 / totalValue) * 100;
        var percentage2 = (phpValue2 / totalValue) * 100;
        var percentage3 = (phpValue3 / totalValue) * 100;
        var percentage4 = (phpValue4 / totalValue) * 100;
        var percentage5 = (phpValue5 / totalValue) * 100;

        // Get the canvas element from the HTML
        var canvas = document.getElementById('myChart');
        var ctx = canvas.getContext('2d');

        // Set the desired height and width of the chart
        var chartHeight = 300; // Specify the desired height in pixels
        var chartWidth = 300; // Specify the desired width in pixels
        var padding = 40; // Specify the desired padding in pixels

        // Calculate the effective height and width considering the padding
        var effectiveHeight = chartHeight - 2 * padding;
        var effectiveWidth = chartWidth - 2 * padding;

        // Calculate the radius based on the smaller effective dimension (height or width)
        var radius = Math.min(effectiveHeight / 2, effectiveWidth / 2);

        // Calculate the center coordinates adjusted for padding
        var centerX = padding + effectiveWidth / 2;
        var centerY = padding + effectiveHeight / 2;

        // Set the canvas element's height and width attributes including the padding
        canvas.height = chartHeight;
        canvas.width = chartWidth;

        // Draw the doughnut chart
        var startAngle = 0;
        var endAngle = (percentage1 / 100) * (Math.PI * 2);
        if (phpValue1 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#FF6384';
            ctx.fill();

            // Certificate label
            var labelX1 = centerX + (radius * 0.5 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY1 = centerY + (radius * 0.5 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Certificate > " . $certificateCount; ?>', labelX1, labelY1);
        }

        startAngle = endAngle;
        endAngle += (percentage2 / 100) * (Math.PI * 2);
        if (phpValue2 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#36A2EB';
            ctx.fill();

            // Diploma label
            var labelX2 = centerX + (radius * 0.5 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY2 = centerY + (radius * 0.5 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Diploma > " . $diplomaCount; ?>', labelX2, labelY2);
        }

        startAngle = endAngle;
        endAngle += (percentage3 / 100) * (Math.PI * 2);
        if (phpValue3 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#FFCE56';
            ctx.fill();

            // Bachelor label
            var labelX3 = centerX + (radius * 0.6 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY3 = centerY + (radius * 0.6 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Bachelor > " . $bachelorCount; ?>', labelX3, labelY3);
        }

        startAngle = endAngle;
        endAngle += (percentage4 / 100) * (Math.PI * 2);
        if (phpValue4 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#FF9F40';
            ctx.fill();

            // Master label
            var labelX4 = centerX + (radius * 0.7 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY4 = centerY + (radius * 0.7 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Master > " . $masterCount; ?>', labelX4, labelY4);
        }

        startAngle = endAngle;
        endAngle += (percentage5 / 100) * (Math.PI * 2);
        if (phpValue5 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#4BC0C0';
            ctx.fill();

            // Doctoral label
            var labelX5 = centerX + (radius * 0.9 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY5 = centerY + (radius * 0.9 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Doctoral > " . $doctoralCount; ?>', labelX5, labelY5);
        }
    }

    clearanceSummaryByLevels();

    function graduantsSummaryByLevels() {
        // Retrieve the PHP values and store them in JavaScript variables
        var phpValue1 = <?php echo $gCertificateCount; ?>;
        var phpValue2 = <?php echo $gDiplomaCount; ?>;
        var phpValue3 = <?php echo $gBachelorCount; ?>;
        var phpValue4 = <?php echo $gMasterCount; ?>;
        var phpValue5 = <?php echo $gDoctoralCount; ?>;

        // Calculate the total value
        var totalValue = phpValue1 + phpValue2 + phpValue3 + phpValue4 + phpValue5;

        // Calculate the percentage for each value
        var percentage1 = (phpValue1 / totalValue) * 100;
        var percentage2 = (phpValue2 / totalValue) * 100;
        var percentage3 = (phpValue3 / totalValue) * 100;
        var percentage4 = (phpValue4 / totalValue) * 100;
        var percentage5 = (phpValue5 / totalValue) * 100;

        // Get the canvas element from the HTML
        var canvas = document.getElementById('myChart2');
        var ctx = canvas.getContext('2d');

        // Set the desired height and width of the chart
        var chartHeight = 300; // Specify the desired height in pixels
        var chartWidth = 300; // Specify the desired width in pixels
        var padding = 40; // Specify the desired padding in pixels

        // Calculate the effective height and width considering the padding
        var effectiveHeight = chartHeight - 2 * padding;
        var effectiveWidth = chartWidth - 2 * padding;

        // Calculate the radius based on the smaller effective dimension (height or width)
        var radius = Math.min(effectiveHeight / 2, effectiveWidth / 2);

        // Calculate the center coordinates adjusted for padding
        var centerX = padding + effectiveWidth / 2;
        var centerY = padding + effectiveHeight / 2;

        // Set the canvas element's height and width attributes including the padding
        canvas.height = chartHeight;
        canvas.width = chartWidth;

        // Draw the doughnut chart
        var startAngle = 0;
        var endAngle = (percentage1 / 100) * (Math.PI * 2);
        if (phpValue1 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#FF6384';
            ctx.fill();

            // Certificate label
            var labelX1 = centerX + (radius * 0.5 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY1 = centerY + (radius * 0.5 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Certificate > " . $gCertificateCount; ?>', labelX1, labelY1);
        }

        startAngle = endAngle;
        endAngle += (percentage2 / 100) * (Math.PI * 2);
        if (phpValue2 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#36A2EB';
            ctx.fill();

            // Diploma label
            var labelX2 = centerX + (radius * 0.5 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY2 = centerY + (radius * 0.5 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Diploma > " . $gDiplomaCount; ?>', labelX2, labelY2);
        }

        startAngle = endAngle;
        endAngle += (percentage3 / 100) * (Math.PI * 2);
        if (phpValue3 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#FFCE56';
            ctx.fill();

            // Bachelor label
            var labelX3 = centerX + (radius * 0.6 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY3 = centerY + (radius * 0.6 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Bachelor > " . $gBachelorCount; ?>', labelX3, labelY3);
        }

        startAngle = endAngle;
        endAngle += (percentage4 / 100) * (Math.PI * 2);
        if (phpValue4 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#FF9F40';
            ctx.fill();

            // Master label
            var labelX4 = centerX + (radius * 0.7 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY4 = centerY + (radius * 0.7 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Master > " . $gMasterCount; ?>', labelX4, labelY4);
        }

        startAngle = endAngle;
        endAngle += (percentage5 / 100) * (Math.PI * 2);
        if (phpValue5 > 0) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = '#4BC0C0';
            ctx.fill();

            // Doctoral label
            var labelX5 = centerX + (radius * 0.9 * Math.cos(startAngle + (endAngle - startAngle) / 2));
            var labelY5 = centerY + (radius * 0.9 * Math.sin(startAngle + (endAngle - startAngle) / 2));
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000000';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo "Doctoral > " . $gDoctoralCount; ?>', labelX5, labelY5);
        }
    }

    graduantsSummaryByLevels();
    </script>





</body>

</html>