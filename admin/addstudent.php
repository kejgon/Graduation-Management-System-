<?php
require_once("../config.php");






//! SETTING USERS ACCORDING TO CONDITIONS
if (isset($_SESSION['userRole']) != "Admin") {
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
    margin-top: 10px;

}


input[type=radio],
input[type=checkbox] {
    width: 5%;
    padding-left: 0%;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;
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
    margin-top: 10px;

}

input[type="submit"]:hover {
    background-color: #7E0524;

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
    .col-90 {
        width: 100%;
        margin-top: 0;
    }

    input[type=submit] {
        width: auto;
        margin-top: 10;
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
                    </table>
                </div>
                <nav class="vertical">
                    <ul>
                        <li><a href="admin.php">Dashboard</a></li>
                        <li><a href=" "> Requests</a>
                            <ul>
                                <li><a href="clearanceRequests.php">Clearance Requests</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Employees</a>
                            <ul>
                                <li><a href="addemployees.php">Add an employee</a></li>
                                <li><a href="viewemployees.php">View employees</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Students</a>
                            <ul>
                                <li><a href="addstudent.php">Add students</a></li>
                                <li><a href="viewStudents.php">View students</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Users</a>
                            <ul>
                                <li><a href="addNewAdmin.php">Add new users</a></li>
                                <li><a href="userslogs.php">Users Logs</a></li>
                                <li><a href="usersActivities.php">Users Activities</a></li>

                            </ul>
                        </li>
                        <li><a href="backupNrestore.php">Data backups and restore</a></li>
                        <li><a href="viewprofile.php">Profile</a> </li>


                    </ul>


                </nav>
            </div>


            <div class="right" style="background-color:#FFF;">

                <h3> <?php echo $_SESSION['userRole'];?> Add Students</h3>

                <div class="clearance-form">
                    <p style="text-align:center; color:green; background-color:white; border-radius:10px;">
                        <?php //display_Message();?></p>
                    <form name="" id="addstudentForm" action="addstudent.php" method="post"
                        onsubmit="return validationForm();">

                        <div class="row">
                            <div class="col-10">
                                <label for="fname">Full name:</label>
                                <input type="text" id="fullname" name="fullname" placeholder="Enter your full name">

                            </div>
                            <div class="col-90">
                                <label for="fname">Regisration number:</label>
                                <input type="text" id="regNo" name="regNo" placeholder="Enter your registration number">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="faculty"> Faculty:</label>
                                <select name="faculty" id="faculty">
                                    <option value=" ">Select your faculty:</option>
                                    <option value="Faculty of Theology">Faculty of Theology</option>
                                    <option value="Faculty of Arts & Social Science">Faculty of Arts & Social Science
                                    </option>
                                    <option value="School of Business & Economics">School of Business & Economics
                                    </option>
                                    <option value="Faculty of Education">Faculty of Education</option>
                                    <option value="Faculty of Science">Faculty of Science</option>
                                    <option value="School of Nursing">School of Nursing</option>
                                    <option value="Faculty of Law">Faculty of Law</option>
                                    <option value="Faculty of Commerce">Faculty of Commerce</option>
                                </select>
                            </div>
                            <div class="col-90">
                                <label for="department">Department:</label>
                                <select name="department" id="department">
                                    <option value=" ">Select your deptartment:</option>
                                    <option value="not applicable">Not applicable</option>
                                    <option value="Department of Accounting and Finance">Department of Accounting and
                                        Finance</option>
                                    <option value="Department of Marketing and Management">Department of Marketing and
                                        Management</option>
                                    <option value="Department of Management Science">Department of Management Science
                                    </option>
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
                                    <option value="Department of Religious Studies">Department of Religious Studies
                                    </option>
                                    <option
                                        value="Department of Humanities (History, Geography & Environmental Studies)">
                                        Department of Humanities (History, Geography & Environmental Studies)</option>
                                    <option value="Department of Economics">Department of Economics</option>
                                    <option value="Department of Philosophy">Department of Philosophy</option>
                                    <option value="Department of Counseling Psychology">Department of Counseling
                                        Psychology
                                    </option>
                                    <option value="Department of First Cycle (Baccalaurete/Bachelor of Theology)">
                                        Department of First Cycle (Baccalaurete/Bachelor of Theology)
                                    </option>
                                    <option value="Department of Biblical Theology">
                                        Department of Biblical Theology
                                    </option>
                                    <option value="Department of Dogmatic Theology">
                                        Department of Dogmatic Theology
                                    </option>
                                    <option value="Department of Sacred Liturgy">
                                        Department of Sacred Liturgy
                                    </option>
                                    <option value="Department of Social Sciences and Development Studies">
                                        Department of Social Sciences and Development Studies
                                    </option>
                                    <option value="Department of LLC (English and Kiswahili)">
                                        Department of LLC (English and Kiswahili)
                                    </option>
                                    <option value="Department of Counseling Psychology">
                                        Department of Counseling Psychology
                                    </option>
                                    <option
                                        value="Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)">
                                        Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA
                                        CPD)
                                    </option>
                                    <option value="Department of Library and information Science">
                                        Department of Library and information Science
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-10">
                                <label for="levels"> Levels:</label>
                                <select name="levels" id="levels">
                                    <option value=" ">Select your level:</option>
                                    <option value="Certificate">Certificate</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Bachelor">Bachelor</option>
                                    <option value="Master">Master</option>
                                    <option value="Phd">PHD</option>
                                    <option value="Doctoral">Doctoral</option>
                                </select>

                            </div>
                            <div class="col-90">
                                <label for="programs">Programs:</label>
                                <select name="programs" id="programs">
                                    <option value=" ">Select your program:</option>
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
                                    <option value="Bachelor of Science in Computer Science
">Bachelor of Science in Computer Science
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
                                    <option
                                        value="Certificate in Association of Chartered Institute of Accountants (ACCA)">
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
                                    <option
                                        value="Certificate in Advanced Certificate in Church Management and Leadership">
                                        Certificate in Advanced Certificate in Church Management and Leadership</option>

                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-10">
                                <label for="specialization"> Specialization:</label>
                                <select name="specializations" id="specializations">
                                    <option value=" ">Select your specialization:</option>
                                    <option value="not applicable">Not applicable</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Management">Management</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Human Resource">Human Resource</option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="Curriculum Studies & Instruction">Curriculum Studies & Instruction
                                    </option>
                                    <option value="Research and Evaluation">Research and Evaluation</option>
                                    <option value="Educational Administration & Planning">Educational Administration &
                                        Planning</option>
                                    <option value="Applied Mathematics">Applied Mathematics</option>
                                    <option value="Pure Mathematics">Pure Mathematics</option>
                                    <option value="Marketing Management">Marketing Management</option>
                                    <option value="Financial Management">Financial Management</option>
                                    <option value="Strategic Management">Strategic Management</option>
                                    <option value="Entrepreneurship">Entrepreneurship</option>
                                    <option value="Human Resource Management">Human Resource Management</option>
                                    <option value="E-commerce">E-commerce</option>
                                    <option value="Curriculum Studies and Instruction">Curriculum Studies and
                                        Instruction
                                    </option>
                                    <option value="Research & Evaluation">Research & Evaluation</option>
                                    <option value="Educational Administration & Planning">Educational Administration &
                                        Planning</option>
                                    <option value="Educational Psychology">Educational Psychology</option>
                                    <option value="Guidance and Counselling">Guidance and Counselling</option>
                                    <option value="Biblical Theology">Biblical Theology</option>
                                    <option value="Moral Theology">Moral Theology</option>
                                    <option value="Dogmatic Theology">Dogmatic Theology</option>
                                    <option value="Spiritual Theology">Spiritual Theology</option>
                                    <option value="Pastoral Theology">Pastoral Theology</option>
                                    <option value="Sacred Liturgy">Sacred Liturgy</option>
                                    <option value="Applied Mathematics">Applied Mathematics</option>
                                    <option value="Pure Mathematics">Pure Mathematics</option>
                                    <option value="Statistics">Statistics</option>
                                    <option value="Biblical Theology">Biblical Theology</option>
                                    <option value="Moral Theology">Moral Theology</option>
                                    <option value="Dogmatic Theology">Dogmatic Theology</option>

                                </select>


                            </div>
                            <div class="col-90">
                                <label for="mode_of_study">Mode of study:</label>
                                <select name="mode_of_study" id="mode_of_study">
                                    <option value=" ">Select your mode of study:</option>
                                    <option value="day">Day</option>
                                    <option value="evening">Evening</option>
                                    <option value="odel">Odel</option>

                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-10">
                                <label for="year"> Year:</label>
                                <select name="year" id="year">
                                    <option value=" ">Select year:</option>
                                    <option value="1">Year 1</option>
                                    <option value="2">Year 2</option>
                                    <option value="3">Year 3</option>
                                    <option value="4">Year 4</option>
                                </select>
                            </div>
                            <div class="col-90" style="color: #000;">
                                <label for="gender">Gender:</label>

                                <input type="radio" id="gender" name="gender" value="Male">Male
                                <input type="radio" id="gender" name="gender" value="Female">Female

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email" placeholder="Enter your email address">

                            </div>
                            <div class="col-90">
                                <label for="std_reg">Phone number:</label>
                                <input type="text" id="phone_num" name="phone_num"
                                    placeholder="Enter your phone number">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="address">Address :</label>
                                <input type="text" id="address" name="address" placeholder="Enter your address">
                            </div>
                            <div class="col-90" style="color: #000;">
                                <label for="date">Date:</label>
                                <input type="text" id="date" name="date" placeholder="Date format YYYY-MM-DD">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-10">
                                <label for="Password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Enter the password">
                            </div>
                            <div class="col-90" style="color: #000;">
                                <label for="role"> Role:</label>
                                <select name="role" id="role">
                                    <option value=" ">Select role:</option>
                                    <option value="Student">Student </option>
                                </select>
                            </div>
                        </div>





                        <div class="row">
                            <input type="submit" name="addStudent" value="Add student">
                        </div>

                    </form>
                </div>
            </div>
        </div>





    </div>

    <?php  

if(isset($_POST['addStudent'])){




//***************************** AddStudents  ******************************** ??*/



   // Trim and sanitize inputs
   $fullname = mysqli_real_escape_string($connection, trim($_POST['fullname']));
   $regNo = mysqli_real_escape_string($connection, trim($_POST['regNo']));
   $faculties = mysqli_real_escape_string($connection, trim($_POST['faculties']));
   $departments = mysqli_real_escape_string($connection, trim($_POST['departments']));
   $level = mysqli_real_escape_string($connection, trim($_POST['levels']));
   $program = mysqli_real_escape_string($connection, trim($_POST['programs']));
   $specialization = mysqli_real_escape_string($connection, trim($_POST['specializations']));
   $mode_of_study = mysqli_real_escape_string($connection, trim($_POST['mode_of_study']));
   $year = mysqli_real_escape_string($connection, trim($_POST['year']));
   $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
   $email = mysqli_real_escape_string($connection, trim($_POST['email']));
   $phone_num = mysqli_real_escape_string($connection, trim($_POST['phone_num']));
   $address = mysqli_real_escape_string($connection, trim($_POST['address']));
   $date = mysqli_real_escape_string($connection, trim($_POST['date']));
   $password = mysqli_real_escape_string($connection, trim($_POST['password']));
   $role = mysqli_real_escape_string($connection, trim($_POST['role']));
   
           
   
   $sql = "SELECT COUNT(*) as count FROM students WHERE std_regNO = '$regNo'";
   $result = $connection->query($sql);
   $row = $result->fetch_assoc();
   
   if ($row["count"] > 0) {
       echo "Sorry: A student with the same details already exists.";
   } else {
   
   
       $query = "INSERT INTO students(std_regNo,std_fullname,faculty,department,levels,programs,specialization,mode_of_study,years,gender,email,phone,std_address,date_created,password, role) 
       VALUES('{$regNo}','{$fullname}','{$faculties}','{$departments}','{$level}','{$program}','{$specialization}','{$mode_of_study}',{$year},'{$gender}','{$email}',{$phone_num},'{$address}','{$date}','{$password}','{$role}')";
   if (mysqli_query($connection, $query)) {
   
    ////! User activiy Tracker
    $role = $_SESSION['userRole'];
    $activity="Added new Student.  (Studnet No. ".$regNo.")";
    ////! Inesrting into user activities tables
    $insert = "INSERT INTO useractivity(username, fullname, role, type_of_activity, activity_time)
               VALUES('{$_SESSION['username']}', '{$_SESSION['fullname']}', '$role', '$activity', NOW())";
    mysqli_query($connection, $insert);  
  
   echo "Record inserted successfully";
   
   
   } else {
   
   echo "Could not insert record: " . mysqli_error($connection);
   
   }
   
   }
   
   mysqli_close($connection);
               


    
}



?>


    <div class="footer">
        <p><strong>©Copyright CUEAGMS</strong></p>

    </div>
    <script>
    function validationForm() {

        var fname = document.getElementById("fullname");
        var regNo = document.getElementById("regNo");
        var faculties = document.getElementById("faculty");
        var departments = document.getElementById("department");
        var levels = document.getElementById("levels");
        var programs = document.getElementById("programs");
        var specializations = document.getElementById("specializations");
        var mode_of_study = document.getElementById("mode_of_study");
        var years = document.getElementById("year");
        var email = document.getElementById("email");
        var address = document.getElementById("address");
        var phone_num = document.getElementById("phone_num");
        var date = document.getElementById("date");
        var password = document.getElementById("password");
        var role = document.getElementById("role");



        // //! FUll NAME VALIDATION
        var fnameVal = fname.value;
        if (fnameVal.length == 0) {
            window.alert("Full name is required?");
            return false
        }
        //?To remove the extra spaces within the string
        var newFname = fnameVal[0];
        for (var i = 1; i < fnameVal.length; i++) {
            if (!(fnameVal[i - 1] === " " && fnameVal[i] === " ")) {
                newFname += fnameVal[i];
            }
        }
        //? This to make sure that user input are basically aphabets, spaces and  doesn't contain any symbols
        var index = 0;
        for (var i = 0; i < newFname.length; i++) {
            if (!((newFname[i] >= 'a' && newFname[i] <= 'z') || (newFname[i] >= 'A' && newFname[i] <= 'Z') || newFname[
                    i] === ' ')) {
                window.alert("Please enter a valid name!");
                return false;
            }
            if (newFname[i] === ' ') {
                index++;
            }
        }
        if (index < 1) {
            window.alert("Please enter at least two names!");
            return false;
        }



        //! REGISTRATION NUMBER VALIDATION
        var regNoVal = regNo.value;

        if (regNoVal.length == 0) {
            window.alert("Registration number is required");
            return false;
        }
        //?To remove the extra spaces within the string
        if (regNoVal.indexOf(" ") !== -1) {
            window.alert("The registration number shoudn't contain any spaces");

            return false;
        }
        console.log(regNoVal);





        //! FACULTIES VALIDATION
        var facultyVal = faculties.value;
        if (facultyVal == 0) {
            window.alert("Please select your faculty");
            return false;
        }

        // //! DEPARTMENTS VALIDATION
        var departmentVal = departments.value;
        if (departmentVal == 0) {
            window.alert("Please select your departments ");
            return false;
        }

        //! LEVELS VALIDATION
        var levelVal = levels.value;
        if (levelVal == 0) {
            window.alert("Please select your level!");
            return false;
        }

        //! PROGRAMS VALIDATION
        var progamVal = programs.value;
        if (progamVal == 0) {
            window.alert("Please select your program!");
            return false;
        }


        //! SPECIALAZTION VALIDATION
        var specialVal = specializations.value;
        if (specialVal == 0) {
            window.alert("Please select your specialization!");
            return false;
        }

        //! MODE OF STUDY VALIDATION
        var mode_of_studyVal = mode_of_study.value;
        if (mode_of_studyVal == 0) {
            window.alert("Please select your mode of study!");
            return false;
        }

        //! YEAR VALIDATION
        var yearVal = years.value;
        if (yearVal == 0) {
            window.alert("Please select your year!");
            return false;
        }

        //! GENDER VALIDATION
        if ((gender[0].checked == false) && (gender[1].checked == false)) {
            alert("Please choose your gender!");
            return false;
        }


        //! EMAIL ADDRESS VALIDATION
        var emailVal = email.value;
        if (emailVal.length == 0) {
            window.alert("Email Address is required");
            return false;
        }

        var atPosition = emailVal.indexOf("@");
        var dotPosition = emailVal.lastIndexOf(".");
        if (atPosition < 1 || dotPosition < atPosition + 2 || dotPosition + 2 >= emailVal.length) {
            window.alert("Email address is invalid");

            return false;
        }


        //! PHONE VALIDATION
        var phoneVal = phone_num.value;
        if (phoneVal.length == 0) {
            window.alert("Please enter your phone number!");
            return false;
        }
        var onlyDigitsChars = "";
        for (var i = 0; i < phoneVal.length; i++) {
            if (phoneVal.charCodeAt(i) >= 48 && phoneVal.charCodeAt(i) <= 57) {
                onlyDigitsChars += phoneVal[i];
            }
        }
        if (onlyDigitsChars.length !== 10) {
            window.alert("Your phone number must be at least 10 digits!");
            return false;
        }


        //! ADDRESS VALIDATION
        var addressVal = address.value;
        if (addressVal.length == 0) {
            window.alert("Please enter your address!");
            return false;
        }

        //////!      DATE VALIDATION       
        // Get the value of the date input
        var dateVal = date.value;

        // Initialize variables to store year, month and day values extracted from input
        var year = "";
        var month = "";
        var day = "";

        // Initialize variable to count the number of dashes in the input
        var dashCount = 0;

        // Check if the input is empty
        if (dateVal.length == 0) {
            window.alert("Please enter the date!");
            return false;
        }

        // Loop through the input characters and extract year, month, and day values
        for (var i = 0; i < dateVal.length; i++) {
            var currentChar = dateVal[i];

            if (currentChar === "-") {
                dashCount++;
            } else if (currentChar >= "0" && currentChar <= "9") {
                if (dashCount === 0) {
                    year += currentChar;
                } else if (dashCount === 1) {
                    month += currentChar;
                } else if (dashCount === 2) {
                    day += currentChar;
                }
            } else {
                // If a non-numeric or non-dash character is encountered, return false
                return false;
            }
        }

        // Check if the year, month, and day values have the correct number of digits
        if (year.length !== 4 || month.length !== 2 || day.length !== 2) {
            window.alert(
                "The year must contain 4 digits, the month must contain 2 digits and the day must contain 2 digits."
            );
            return false;
        }

        // Convert the year, month, and day values to integers
        year = parseInt(year);
        month = parseInt(month);
        day = parseInt(day);

        // Create Date objects for the input date and today's date
        var inputDate = new Date(year, month - 1, day);
        var today = new Date();

        // Compare the input date to today's date
        if (inputDate.setHours(0, 0, 0, 0) < today.setHours(0, 0, 0, 0)) {
            window.alert("Please enter today's date.");
            return false;
        }

        if (inputDate.setHours(0, 0, 0, 0) > today.setHours(0, 0, 0, 0)) {
            window.alert("Please do not enter future date.");
            return false;
        }

        // Check if the month value is between 1 and 12
        if (month < 1 || month > 12) {
            window.alert("The number of month must be between 1 and 12");
            return false;
        }

        // Check if the day value is between 1 and 31 depending on the month
        if (day < 1 || day > 31) {
            window.alert("The number of days must be between 1 and 31 depending on the month.");
            return false;
        }

        // Check if the day value is between 1 and 30 depending on the month (April, June, September, November)
        if ((month === 4 || month === 6 || month === 9 || month === 11) && day > 30) {
            window.alert("The number of days must be between 1 and 30 depending on the month.");
            return false;
        }

        // Check if the day value is valid for February
        if (month === 2) {
            // If the day value is greater than 29, it's invalid
            if (day > 29) {
                window.alert("Sorry! The number of days in February must be between 1 and 29.");
                return false;

            }
            if (day === 29) {
                if (year % 4 !== 0 || (year % 100 === 0 && year % 400 !== 0)) {
                    window.alert("Sorry! This is not a leap year day.");
                    return false;
                }
            }
            if (day > 28 && (!(year % 4 === 0 && year % 100 !== 0) && year % 400 !== 0)) {
                return false;
            }
        }


        //! PASSWORD VALIDATION
        var passwordValu = password.value;

        if (passwordValu.length == 0) {
            window.alert("Password number is required");
            return false;
        }
        // Check if the password is at least 8 characters long
        if (passwordValu.length < 8) {
            window.alert("Password must be at least 8 characters long");

            return false;
        }

        // Check if the password contains at least one uppercase letter, one lowercase letter, and one digit
        var specialChars = "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
        var hasSpecialChar = false;
        var hasUpperCase = false;
        var hasLowerCase = false;
        var hasNumber = false;

        for (var i = 0; i < passwordValu.length; i++) {
            if (specialChars.indexOf(passwordValu[i]) !== -1) {
                hasSpecialChar = true;
            }
            if (passwordValu[i] >= 'A' && passwordValu[i] <= 'Z') {
                hasUpperCase = true;
            }
            if (passwordValu[i] >= 'a' && passwordValu[i] <= 'z') {
                hasLowerCase = true;
            }
            if (passwordValu[i] >= '0' && passwordValu[i] <= '9') {
                hasNumber = true;
            }
        }
        if (!hasSpecialChar || !hasUpperCase || !hasLowerCase || !hasNumber) {
            window.alert("Password must at least contains uppercase, lowercase, digits and special characters");

            return false;

        }


        //! ROLE VALIDATION
        var roleVal = role.value;
        if (roleVal == 0) {
            window.alert("Please select your Role!");
            return false;
        }
    }
    </script>

</body>

</html>