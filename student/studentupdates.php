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




            <?php 
//! RETREIVING STUDENT DATA FROM DATABASE
$std_regNo = $_SESSION['username'];

$query = "SELECT * FROM students WHERE std_regNo = '$std_regNo'";
$result = mysqli_query($connection, $query);

// Fetch the data
$row = mysqli_fetch_assoc($result);



   
?>
            <div class="right" style="background-color:#FFF;">

                <h3>Update Profile</h3>
                <div class="clearance-form">
                    <div class="row">
                        <p><a style="
                                background-color: #F09910;
                                color: white;
                                padding: 12px 20px;
                                margin-left:10px;
                                border: none;
                                border-radius: 10px;
                                float: left;
                                 text-decoration: none;" href="viewprofile.php">View Profile</a>
                        </p>
                    </div>
                    <form action="studentupdates.php" method="post" onsubmit=" return formValidation();">
                        <div class="row">
                            <div class="col-10">
                                <label for="fname">Student Full name:</label>
                                <input type="text" id="fullname" name="fullname"
                                    value="<?php echo $row['std_fullname'];?>">

                            </div>
                            <div class="col-90">
                                <p>Student No. : <?php echo $row['std_regNo'];?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="gender">Gender:</label>
                                <input type="radio" id="gender" name="gender" value="Male">Male
                                <input type="radio" id="gender" name="gender" value="Female">Female
                            </div>
                            <div class="col-90">
                                <label for="mode_of_study">Mode of study:</label>
                                <select name="mode_of_study" id="mode_of_study">
                                    <option value="<?php echo $row['mode_of_study'];?>">
                                        <?php echo $row['mode_of_study'];?>
                                    </option>
                                    <option value="day">Day</option>
                                    <option value="evening">Evening</option>
                                    <option value="odel">Odel</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email" value="<?php echo $row['email'];?>">
                            </div>
                            <div class="col-90">
                                <label for="std_reg">Phone number:</label>
                                <input type="text" id="phone_num" name="phone_num" value="<?php echo $row['phone'];?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address"
                                    value="<?php echo $row['std_address'];?>">
                            </div>
                            <div class="col-90">
                                <label for="date">Date:</label>
                                <input type="text" id="date" name="date" placeholder="Date format YYYY-MM-DD">
                            </div>
                        </div>


                        <div class="row">
                            <input type="submit" name="updates" value="Update Profile">
                        </div>

                    </form>
                </div>

                <?php
if(isset($_POST['updates'])) {
    // Retrieve the form input values and sanitize them
    $fullname = trim(mysqli_real_escape_string($connection, $_POST['fullname']));
    $gender = trim(mysqli_real_escape_string($connection, $_POST['gender']));
    $email = trim(mysqli_real_escape_string($connection, $_POST['email']));
    $phone_num = trim(mysqli_real_escape_string($connection, $_POST['phone_num']));
    $address = trim(mysqli_real_escape_string($connection, $_POST['address']));
    $date = mysqli_real_escape_string($connection, trim($_POST['date']));



    // Perform database update
    $query = "UPDATE students SET 
                std_fullname = '$fullname', 
                gender = '$gender',
                email = '$email',
                phone = '$phone_num',
                std_address = '$address',
                updated_at = '$date'
                WHERE std_regNo = '{$_SESSION['username']}'";
              
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Update the session variables with the updated user data
        $_SESSION['fullname'] = $fullname;
        // Update other session variables as needed

        // User activity tracker
        $role = $_SESSION['userRole'];
        $activity = "Student profile updated. (Student No. " . $_SESSION['username'] . ")";
        // Inserting into user activities table
        $insert = "INSERT INTO useractivity(username, fullname, role, type_of_activity, activity_time)
                   VALUES('{$_SESSION['username']}', '{$_SESSION['fullname']}', '$role', '$activity', NOW())";
        mysqli_query($connection, $insert);

        // Database update successful
        echo "<p style='color:green'>Database update successful!</p>";
    } else {
        // Database update failed
        echo "<p style='color:red'>Database update failed!</p>";
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
            </div>
        </div>

    </div>




    <div class="footer">
        <p><strong>©Copyright CUEAGMS</strong></p>

    </div>

    <script>
    function formValidation() {
        var fullname = document.getElementById("fullname"); // Get the full name input element
        var email = document.getElementById("email"); // Get the email input element
        var phone_num = document.getElementById("phone_num"); // Get the phone number input element
        var address = document.getElementById("address"); // Get the address input element
        var currentPassword = document.getElementById("currPassword"); // Get the current password input element
        var newPassword = document.getElementById("newPassword"); // Get the new password input element

        var fnameVal = fullname.value; // Get the value of the full name input
        if (fnameVal.length == 0) {
            window.alert("Full name is required?"); // Display an alert if the full name is empty
            return false;
        }

        // Remove extra spaces within the string
        var newFname = fnameVal[0];
        for (var i = 1; i < fnameVal.length; i++) {
            if (!(fnameVal[i - 1] === " " && fnameVal[i] === " ")) {
                newFname += fnameVal[i];
            }
        }

        // Validate that the name contains only alphabets, spaces, and no symbols
        var index = 0;
        for (var i = 0; i < newFname.length; i++) {
            if (!((newFname[i] >= 'a' && newFname[i] <= 'z') || (newFname[i] >= 'A' && newFname[i] <= 'Z') || newFname[
                    i] === ' ')) {
                window.alert("Please enter a valid name!"); // Display an alert if the name contains invalid characters
                return false;
            }
            if (newFname[i] === ' ') {
                index++;
            }
        }
        if (index < 1) {
            window.alert("Please enter at least two names!"); // Display an alert if the name contains only one word
            return false;
        }


        //! GENDER VALIDATION
        // Assuming you have radio buttons with the name 'gender'
        var gender = document.getElementsByName("gender");
        if ((gender[0].checked == false) && (gender[1].checked == false)) {
            alert("Please choose your gender!"); // Display an alert if the gender is not selected
            return false;
        }

        //! EMAIL ADDRESS VALIDATION
        var emailVal = email.value;
        if (emailVal.length == 0) {
            window.alert("Email Address is required"); // Display an alert if the email address is empty
            return false;
        }

        // Validate the email address format
        var atPosition = emailVal.indexOf("@");
        var dotPosition = emailVal.lastIndexOf(".");
        if (atPosition < 1 || dotPosition < atPosition + 2 || dotPosition + 2 >= emailVal.length) {
            window.alert("Email address is invalid"); // Display an alert if the email address format is invalid
            return false;
        }
        //! PHONE VALIDATION
        var phoneVal = phone_num.value;
        if (phoneVal.length == 0) {
            window.alert("Please enter your phone number!"); // Display an alert if the phone number is empty
            return false;
        }

        // Remove non-digit characters from the phone number
        var onlyDigitsChars = "";
        for (var i = 0; i < phoneVal.length; i++) {
            if (phoneVal.charCodeAt(i) >= 48 && phoneVal.charCodeAt(i) <= 57) {
                onlyDigitsChars += phoneVal[i];
            }
        }

        if (onlyDigitsChars.length !== 10) {
            window.alert(
                "Your phone number must be at least 10 digits!"
            ); // Display an alert if the phone number is not 10 digits long
            return false;
        }

        //! ADDRESS VALIDATION
        var addressVal = address.value;
        if (addressVal.length == 0) {
            window.alert("Please enter your address!"); // Display an alert if the address is empty
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


        // If all validations pass, the form is considered valid
        return true;
    }
    </script>
</body>

</html>