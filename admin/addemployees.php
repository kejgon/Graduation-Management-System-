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

                <h3> <?php echo $_SESSION['userRole'];?> Add Employee</h3>

                <div class="clearance-form">
                    <form action="addemployees.php" method="post" onsubmit="return formValidation();">

                        <div class="row">
                            <div class="col-10">
                                <label for="fname">Full name:</label>
                                <input type="text" id="emp_fullname" name="emp_fullname"
                                    placeholder="Enter your full name">
                            </div>
                            <div class="col-90">
                                <label for="fname">Employee number:</label>
                                <input type="text" id="emp_No" name="emp_No" placeholder="Enter your employee number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="faculty"> Faculty:</label>
                                <select name="faculty" id="faculty">
                                    <option value=" ">Select your faculty:</option>
                                    <option value="not applicable">Not applicable</option>

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
                                    <option value="Faculty of Registrar">Faculty of Registrar</option>
                                    <option value="Faculty of Finance">Faculty of Finance</option>
                                </select>
                            </div>
                            <div class="col-90">
                                <label for="department">Department:</label>
                                <select name="department" id="departments">
                                    <option value=" ">Select your deptartment:</option>
                                    <option value="not applicable">Not applicable</option>
                                    <option value="Department of Accounting and Finance">Department of Accounting and
                                        Finance</option>
                                    <option value="Department of Marketing and Management">Department of Marketing and
                                        Management</option>
                                    <option value="Department of Management Science">Department Management Science
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
                                    <option value="Department of Natural Sciences">
                                        Department of Natural Sciences
                                    </option>

                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-10">
                                <label for="position">Employee Position:</label>
                                <select name="position" id="position">
                                    <option value=" ">Select position:</option>
                                    <option value="Librarian"> Librarian </option>
                                    <option value="Finance"> Finance </option>
                                    <option value="Hod"> Hod</option>
                                    <option value="Dean"> Dean </option>
                                    <option value="Registrar"> Registrar</option>
                                </select>

                            </div>
                            <div class="col-90">
                                <label for="role"> Role:</label>
                                <select name="role" id="role">
                                    <option value=" ">Select role:</option>
                                    <option value="Employee">Employee </option>
                                </select>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-10" style="color: #000;">
                                <label for="gender">Gender:</label>

                                <input type="radio" id="gender" name="gender" value="Male">Male
                                <input type="radio" id="gender" name="gender" value="Female">Female


                            </div>
                            <div class="col-90">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email" placeholder="Enter your email address">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="std_reg">Phone number:</label>
                                <input type="text" id="phone_num" name="phone_num"
                                    placeholder="Enter your phone number">

                            </div>
                            <div class="col-90">
                                <label for="address">Address :</label>
                                <input type="text" id="address" name="address" placeholder="Enter your address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="date">Date:</label>

                                <input type="text" id="date" name="date" placeholder="Date format YYYY-MM-DD">

                            </div>
                            <div class="col-90" style="color: #000;">
                                <label for="Password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Enter the password">

                            </div>
                        </div>

                        <div class="row">
                            <input type="submit" name="addEmployee" value="Add Employee">
                        </div>

                    </form>

                    <?php
//***************************** AddEmployee  ******************************** */

if(isset($_POST['addEmployee'])) {

    // Trim and sanitize inputs using mysqli_real_escape_string()
    $emp_No = mysqli_real_escape_string($connection, trim($_POST['emp_No']));
    $fullname = mysqli_real_escape_string($connection, trim($_POST['emp_fullname']));
    $faculty = mysqli_real_escape_string($connection, trim($_POST['faculty']));
    $department = mysqli_real_escape_string($connection, trim($_POST['department']));
    $position = mysqli_real_escape_string($connection, trim($_POST['position']));
    $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $phone_num = mysqli_real_escape_string($connection, trim($_POST['phone_num']));
    $address = mysqli_real_escape_string($connection, trim($_POST['address']));
    $date = mysqli_real_escape_string($connection, trim($_POST['date']));
    $password = mysqli_real_escape_string($connection, trim($_POST['password']));
    $role = mysqli_real_escape_string($connection, trim($_POST['role']));

    // Check if an employee with the same employee number already exists in the database
    $sql = "SELECT COUNT(*) as count FROM employees WHERE emp_number = '{$emp_No}'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row["count"] > 0) {
        echo "<p style='color:red'>Sorry: An employee with the same details already exists.</p>";
    } else {
        // Insert the new employee's information into the database
        $query = "INSERT INTO employees (emp_number, emp_fullname, faculty, department, position, gender, email, phone, emp_address, date_created, password, role)
    VALUES ('{$emp_No}', '{$fullname}', '{$faculty}', '{$department}', '{$position}', '{$gender}', '{$email}', '{$phone_num}', '{$address}', '{$date}', '{$password}', '{$role}')";
        if (mysqli_query($connection, $query)) {

  ////! User activiy Tracker
  $role = $_SESSION['userRole'];
  $activity="Added new employee. (Employees No. ".$emp_No.")";
  ////! Inesrting into user activities tables
  $insert = "INSERT INTO useractivity(username, fullname, role, type_of_activity, activity_time)
             VALUES('{$_SESSION['username']}', '{$_SESSION['fullname']}', '$role', '$activity', NOW())";
  mysqli_query($connection, $insert);     



            echo "<p style='color:green'>Employee have been added successfully</p>";
        } else {
            echo "<p style='color:red'> Could not insert record: " . mysqli_error($connection) . "</p>";
        }
    }
    // Close the database connection
    mysqli_close($connection);
}
?>

                </div>
            </div>
        </div>

    </div>




    <div class="footer">
        <p><strong>©Copyright CUEAGMS</strong></p>

    </div>
    <script>
    function formValidation() {
        var empfname = document.getElementById("emp_fullname");
        var emp_No = document.getElementById("emp_No");
        var faculties = document.getElementById("faculty");
        var departments = document.getElementById("departments");
        var position = document.getElementById("position");
        var role = document.getElementById("role");
        var email = document.getElementById("email");
        var address = document.getElementById("address");
        var phone_num = document.getElementById("phone_num");
        var date = document.getElementById("date");
        var passowrd = document.getElementById("password");




        // //! FUll NAME VALIDATION
        var fnameVal = empfname.value;
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
            if (!((newFname[i] >= 'a' && newFname[i] <= 'z') || (newFname[i] >= 'A' && newFname[i] <= 'Z') ||
                    newFname[i] === ' ')) {
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



        //! EMPLOYEE NUMBER VALIDATION
        var empNoVal = emp_No.value;

        if (empNoVal.length == 0) {
            window.alert("Employee number is required");
            return false;
        }
        //?To remove the extra spaces within the string
        if (empNoVal.indexOf(" ") !== -1) {
            window.alert("The Employee number shoudn't contain any spaces");

            return false;
        }





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

        //! POSITION VALIDATION
        var positionVal = position.value;
        if (positionVal == 0) {
            window.alert("Please select your position!");
            return false;
        }
        //! ROLE VALIDATION
        var roleVal = role.value;
        if (roleVal == 0) {
            window.alert("Please select your Role!");
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


    }
    </script>

</body>

</html>