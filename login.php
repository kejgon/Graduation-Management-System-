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
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- specifies the character encoding used on the page. In this case, it is set to UTF-8,
 which is a widely used character encoding that supports a wide 
 range of characters and scripts. -->
    <meta charset="UTF-8">
    <!-- sets the compatibility mode for Internet Explorer.
    The value "IE=edge" tells IE to use the latest version of its rendering engine,
    regardless of the document mode. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- sets the viewport settings for the page. The "width=device-width" 
    tells the browser to set the width of the viewport to the width of the device. 
    The "initial-scale=1.0" sets the initial zoom level of the page to 1.0, 
    which means it is not zoomed in or out by default. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUEAGMS</title>


</head>

<style>
/* Set box-sizing to border-box for all elements */
* {
    box-sizing: border-box;
}

/* Set default styles for the body */
body {
    font-family: 'Work Sans', sans-serif;
    text-align: center;
    margin: 0;
}

/***********************Headers and Navbar**************************/
/******************************************************************/

/* Set styles for the header, navbar, sections, and footer */
.header,
.navbar,
.section,
.footer {
    float: left;
    width: 100%;
    /* The width is 100%, by default */
}

/* Set styles for the header */
.header {
    height: 100;
    background-color: #fff;
}

/* Set styles for the logo in the header */
.header .logo img {
    float: left;
}

/* Set styles for the text in the logo in the header */
.header .logo p {
    float: left;
    width: 25%;
    font-size: 20px;
    color: #7E0524;
}

/* Set styles for the navbar */
.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #7E0524;
}

/* Set styles for the items in the navbar */
.navbar li {
    float: left;
    border-right: 1px solid #bbb;
}

/* Set styles for the last item in the navbar */
.navbar li:last-child {
    border-right: none;
}

/* Set styles for the links in the navbar */
.navbar li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Set styles for the active link in the navbar */
.navbar li a:hover:not(.active) {
    background-color: #F09910;
}

/* Set styles for the active item in the navbar */
.navbar .active {
    background-color: #F09910;
}

/* Use a media query to add a breakpoint at 800px */
@media screen and (max-width: 768px) {

    /* Set the width of the left, main, and right sections to 100% when the viewport is 800px or smaller */
    .left,
    .main,
    .right {
        width: 100%;
    }

    /* Set the styles for the items in the navbar when the viewport is 800px or smaller */
    .header .logo p {
        float: left;
        font-size: 15px;
    }

    /* Set the styles for the links in the navbar when the viewport is 800px or smaller */
    .navbar li a {
        padding: 8px 16px;
    }

    /* Set the styles for the active item in the navbar when the viewport is 800px or smaller */
    .navbar .active {
        background-color: #F09910;
        color: white;
    }
}



#container {
    margin: 0 auto;
    margin-top: 8%;
    width: 40%;
    height: auto;
    padding: 50px 15px;
    background-color: #F09910;
    border-radius: 10px;
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

/* Style for text and password input elements and select element */
input[type="text"],
input[type="password"],
select {
    width: 50%;
    height: 30px;
    border-radius: 10px;
    padding: 5px 10px;
    border: none;
    box-sizing: border-box;
    color: black;
}

/* Style for submit button */
input[type="submit"] {
    margin-top: 10px;
    padding: 10px 40px;
    font-weight: bold;
    border-radius: 10px;
    border: 3px solid #7E0524;
    background-color: #F09910;
    color: #fff;
}

/* Style for submit button when hovering */
input[type="submit"]:hover {
    background-color: #7E0524;
}


/* Media query for smaller screens */
@media screen and (max-width: 768px) {

    /* Set the styles for the items in the navbar when the viewport is 800px or smaller */
    .header .logo p {
        float: left;
        font-size: 15px;
    }

    /* Set the styles for the links in the navbar when the viewport is 800px or smaller */
    .navbar li a {
        padding: 8px 16px;
    }

    #container {
        width: 60%;

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





/* Style for captcha element */
.captcha {
    width: 50%;
    background-color: yellow;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
}
</style>

<body>

    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <img src="assets/images/logo/CUEA-logo.png" width="100">
            <p>Catholic Unversity of Eastern Africa Graduation Management System</p>
        </div>
    </div>



    <!-- NAVBAR -->
    <div class="navbar">
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="about.php">About GMS</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li style="float:right"><a href="login.php">Login</a></li>
        </ul>
    </div>



    <div class="section">
        <div id="container">
            <!--return validateForm()!!  returns a boolean value (true or false) depending on whether the form inputs are valid or not -->
            <form id="myForm" onsubmit="return validateForm();" action="login.php" method="post">
                <div class="row ">
                    <label for="Username">Username</label>
                    <input id="username" type="text" id="Username" name="username"><br>
                </div>

                <div class="row">
                    <label for="Password">Password</label>
                    <input id="password" type="password" id="Password" name="password"><br>
                </div>

                <div class="row">
                    <label for="login_as">Login As:</label>
                    <select id="select" name="userRole">
                        <option value="" selected> Select your User Role</option>
                        <option value="Student"> Student </option>
                        <option value="Employee"> Employee </option>
                        <option value="Admin"> Admin </option>
                    </select>
                </div>
                <input type="submit" name="submit" value="Login">
            </form>
        </div>
    </div>



    <?php
// PHP function that checks whether a form has been submitted by checking whether 
// the submit button with name "submit" is set in the $_POST superglobal array
    if (isset($_POST['submit'])) {

//mysqli_real_escape_string is used to escape special characters that may be present in user input, to prevent SQL injection attacks.
        // trim function is used to remove any leading or trailing white spaces from a string
        $username = mysqli_real_escape_string($connection, trim($_POST['username']));
        $password = mysqli_real_escape_string($connection, trim($_POST['password']));
        $user_role = mysqli_real_escape_string($connection, trim($_POST['userRole']));

        // Check if the user exists in the students table
        $query = "SELECT * FROM students WHERE std_regNo = '$username' AND password = '$password' AND role = '$user_role'";
        // PHP function that is used to execute an SQL query on a MySQL database. It takes two parameters:
        $result = mysqli_query($connection, $query);
        $stdRows = mysqli_fetch_assoc($result);

        // built-in function in PHP that returns the number of rows in a result set obtained from a MySQLi query
        if (mysqli_num_rows($result) == 1) {
            
             // sets session variables with the values fetched from the database query for a particular user
             $_SESSION['username'] =$stdRows['std_regNo'];
             $_SESSION['fullname'] =$stdRows['std_fullname'];
             $_SESSION['userRole'] =$stdRows['role'];
             $_SESSION['programs'] =$stdRows['programs'];
             
         if ($stdRows>0) {
            // session_create_id() function generates a new session ID for the current session
             $session_id = session_create_id();
             $_SESSION['session_id'] = $session_id;

         $query ="insert into login_logs(session_id, username, fullname, role,position) values('{$session_id}','".$_SESSION['username']."','".$_SESSION['fullname']."','".$_SESSION['userRole']."','Student')";
         mysqli_query($connection, $query);
          }
          // The header() function in PHP It is typically used to redirect the user to a different location or
          // to send additional HTTP headers that control how the page is displayed.
             header("location: student/student.php");
        } else {
            // Check if the user exists in the employees table
            $query = "SELECT * FROM employees WHERE emp_number = '$username' AND password = '$password' AND role = '$user_role'";
            $result = mysqli_query($connection, $query);
            $empRows = mysqli_fetch_assoc($result);

            if (mysqli_num_rows($result) == 1) {
             // sets session variables with the values fetched from the database query for a particular user    
                $_SESSION['username'] =$empRows['emp_number'];
                $_SESSION['fullname'] =$empRows['emp_fullname'];
                $_SESSION['userRole'] =$empRows['role'];
                $_SESSION['position'] =$empRows['position'];
                $_SESSION['faculty'] =$empRows['faculty'];
                $_SESSION['department'] =$empRows['department'];


                if ($_SESSION['position'] == "Hod") {

                    $session_id = session_create_id();
                    $_SESSION['session_id'] = $session_id;

                        $query ="insert into login_logs(session_id, username, fullname, role,position) values('{$session_id}','{$username}','".$_SESSION['fullname']."','".$_SESSION['userRole']."','Hod')";
                        mysqli_query($connection, $query);
    
                    header("location: hod/hod.php");
                }
                if ($_SESSION['position'] == "Dean") {
                    $session_id = session_create_id();

                    $_SESSION['session_id'] = $session_id;

                        $query ="insert into login_logs(session_id,username, fullname, role,position) values('{$session_id}','{$username}','".$_SESSION['fullname']."','".$_SESSION['userRole']."','Dean')";
                        mysqli_query($connection, $query);
                         
    
                    header("location: dean/dean.php");
                }
                if ($_SESSION['position'] == "Librarian") {
                    $session_id = session_create_id();

                    $_SESSION['session_id'] = $session_id;

                        $query ="insert into login_logs(session_id,username, fullname, role,position) values('{$session_id}','{$username}','".$_SESSION['fullname']."','".$_SESSION['userRole']."','Librarian')";
                        mysqli_query($connection, $query);
                         
    
                    header("location: library/librarian.php");
                }
                if ($_SESSION['position'] == "Finance") {
                    $session_id = session_create_id();
                    $_SESSION['session_id'] = $session_id;


                        $query ="insert into login_logs(session_id,username, fullname, role,position) values('{$session_id}','{$username}','".$_SESSION['fullname']."','".$_SESSION['userRole']."','Finance')";
                        mysqli_query($connection, $query);
                         
    
                    header("location: finance/finance.php");
                }
                if ($_SESSION['position'] == "Registrar") {
                    $session_id = session_create_id();

                    $_SESSION['session_id'] = $session_id;

                        $query ="insert into login_logs(session_id,username, fullname, role,position) values('{$session_id}','{$username}','".$_SESSION['fullname']."','".$_SESSION['userRole']."','Registrar')";
                        mysqli_query($connection, $query);
                    
                    header("location: registrar/registrar.php");
                }
          
               
            } else {
                // Check if the user exists in the admin table
                $query = "SELECT * FROM admin WHERE admin_number = '$username' AND password = '$password' AND role = '$user_role'";
                $result = mysqli_query($connection, $query);
                $adminRows = mysqli_fetch_assoc($result);
                if (mysqli_num_rows($result) == 1) {
                    // Start a session and set the user role to "admin"
                    $_SESSION['username'] =$adminRows['admin_number'];
                    $_SESSION['fullname'] =$adminRows['admin_fullname'];
                    $_SESSION['userRole'] =$adminRows['role'];


                if ($adminRows>0) {
                    $session_id = session_create_id();
                        $_SESSION['session_id'] = $session_id;


                $query ="insert into login_logs(session_id, username, fullname, role,position) values('{$session_id}','".$adminRows['admin_number']."','".$adminRows['admin_fullname']."','".$adminRows['role']."','Admin')";
                mysqli_query($connection, $query);
                 }
                    header("location: admin/admin.php");
                } else {
                    // Show an error message if the login credentials are incorrect
                    echo"<p style='color:red; text-align:center'>Incorrect username or password or user role.<br>Please try again.</p>";
                }
            }
        }
    }
    ?>
    <!-- //! ENDDING TAG FOR PHP SCRIPT -->



    <div class="footer">
        <p><strong>©Copyright CUEAGMS</strong></p>
    </div>


    <script>
    // function to validate form fields
    function validateForm() {
        var username = document.getElementById("username");
        var password = document.getElementById("password");
        var role = document.getElementById("select");


        // USERNAME VALIDATION
        var usernameVal = username.value;
        if (usernameVal.length == 0) {
            window.alert("Username is required");
            return false;
        }

        // PASSWORD VALIDATION
        var passwordVal = password.value;
        if (passwordVal.length == 0) {
            window.alert("Password is required");
            return false;
        }
        // Check if the password is at least 8 characters long
        if (passwordVal.length < 8) {
            window.alert("Password must be at least 8 characters long");
            return false;
        }

        // USERROLE VALIDATION
        var roleVal = role.value;
        if (roleVal == 0) {
            window.alert("Please select your role");
            return false;
        }

    }
    </script>
    <!-- //! ENDDING TAG FOR JAVASCRIPT SCRIPT -->

</body>

</html>