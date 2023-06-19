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
    <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/css/statusColor.css?v=<?php echo time(); ?>">

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
                <h3>Graduation list by <?php echo $_SESSION['theFaculty'];?></h3>

                <div class="clearance-form">

                    <hr style="border: 3px solid #F09910">
                    <table id="myTable" style="color:#000; text-align:left; padding-left:10px;">

                        <tbody>
                            <?php
// Check if the 'faculty' key is set in the $_SESSION array
if (isset($_SESSION['theFaculty'])) {
    $selectedFaculty = $_SESSION['theFaculty'];

    // Build the query
    $sql = "SELECT c.clr_id, c.std_fullname, c.std_regNo, c.faculty, c.department, c.levels, c.programs, c.specialization, c.campus, r.stdStatus, DATE(r.updated_at) as update_Date 
            FROM clearance c 
            INNER JOIN fin_clearance_request r ON c.clr_id = r.clr_id
            WHERE c.faculty = '$selectedFaculty' AND c.reason_for_clearance = 'completion'";

    // Execute the query
    $result = mysqli_query($connection, $sql);
    $countRow = 1;

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Display the table header
        echo "<table>";
        echo "<thead><tr><th>No.</th><th>Student fullnames</th><th>Registration number</th><th>Faculty</th><th>Department</th><th>Levels</th><th>Programs</th><th>Specialization</th><th>Campus</th><th>Status</th><th>Date</th></tr></thead>";
        echo "<tbody>";

        // Loop through the rows and display all records
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$countRow}</td>";
            echo "<td>{$row['std_fullname']}</td>";
            echo "<td>{$row['std_regNo']}</td>";
            echo "<td>{$row['faculty']}</td>";
            echo "<td>{$row['department']}</td>";
            echo "<td>{$row['levels']}</td>";
            echo "<td>{$row['programs']}</td>";
            echo "<td>{$row['specialization']}</td>";
            echo "<td>{$row['campus']}</td>";
            echo "<td class='status'>{$row['stdStatus']}</td>";
            echo "<td>{$row['update_Date']}</td>";
            echo "</tr>";
            $countRow++;
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<td colspan='11' style='text-align:center'>No records found.</td>";
    }

    // Close the database connection
    mysqli_close($connection);
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
    </div>





    <div class="footer">
        <p><strong>©Copyright CUEAGMS</strong></p>

    </div>

    <script src="../assets/js/statusColor.js"></script>

</body>

</html>