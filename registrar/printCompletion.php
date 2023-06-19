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
    <title>CATHOLIC UNIVERSITY OF EASTERN AFRICA GRADUATION MANAGEMENT SYSTEM REPORT</title>

</head>

<style>
.clearance-form {
    border-radius: 5px;
    background-color: #f2f2f2;
    margin-bottom: 50px;
    border: 1px solid #000;
    padding: 20px;
}


.col1 {
    float: left;
    width: 15%;
    margin-top: 6px;
}

.col2 {
    float: left;
    width: 60%;
    margin-top: 6px;
}

.col3 {
    float: left;
    width: 15%;
    margin-top: 6px;
}

.row:after {
    content: "";
    display: table;
    clear: both;
}

.col2 .title h3 {
    text-align: center;
    font-size: 1em;
    margin-left: 20px;
}

.col2 .title h2,
p {
    text-align: center;

}

.col3 .title p {
    text-align: left;
    font-size: 9px;
    font-weight: bold;
    padding-left: 5px;

}

.col2 .title p {
    text-align: center;


}

.logo {
    text-align: center;
}

@media screen and (max-width: 600px) {

    .col1,
    .col2,
    .col3,
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

.profile-tab1 {
    margin-left: 50px;
}

.profile-tab1 td th {
    padding: 6px;
    text-align: left;
    font-size: 10px;
}

.profile-tab td,
th {
    padding: 6px;
    border: 1px solid #ccc;
    text-align: left;
    font-size: 10px;
}

.profile-tab1 td,
th {
    padding: 6px;
    text-align: left;
    font-size: 10px;
}



.profile-tab1 td:nth-child(2n+1) {
    font-weight: bold;
}
</style>

<body>
    <header>
        <div class="row">
            <div class="col1">
                <div class="logo">
                    <img src="../assets/images/logo/CUEA-logo.png" width="100">
                </div>

            </div>
            <div class="col2">
                <div class="title">
                    <h3>CATHOLIC UNIVERSITY OF EASTERN AFRICA</h3>
                    <h2> A. M. E. C. E. A.</h2>
                    <p>OFFICE OF THE REGISTRAR</p>

                </div>
            </div>
            <div class="col3">
                <div class="title">
                    <p>P.O. Box 62157, 00200</p>
                    <p>Nairobi, KENYA</p>
                    <p>Telephone: 0709691000</p>
                    <p>E-mail: registrar@cuea.edu</p>
                    <p>Website: www.cuea.edu</p>

                </div>
            </div>
        </div>
    </header>
    <?php
    //! RETREIVING STUDENT AND CLEARANCE Details


  
   
?>
    <h3 style="text-align: left; margin-top:100px; padding-left:31%;padding-bottom:5%;">Completion Students' Clearance
        Report</h3>
    <div class="row">

        <table id="myTable" style="color:#000; text-align:left; padding-left:10px;">
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
                        Faculty </th>
                    <th>
                        Department </th>

                    <th>
                        Levels </th>

                    <th>
                        Programs </th>
                    <th>
                        Specialization </th>

                    <th>
                        Campus </th>


                    <th>
                        Date
                    </th>

                </tr>
            </thead>
            <tbody>
                <?php
    // Build the query
    $sql = "SELECT c.clr_id, c.std_fullname, c.std_regNo, c.faculty, c.department, c.levels,c.programs, c.specialization, c.campus, r.updated_at 
 FROM clearance c 
 INNER JOIN fin_clearance_request r ON c.clr_id = r.clr_id";

    // Execute the query
    $result = mysqli_query($connection, $sql);
    $countRow = 1;
    $countRow = 1;

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through the rows and display all records
        while ($row = mysqli_fetch_assoc($result)) {
            $display = <<<HEREDOC
            <tr>
                <td>{$countRow}</td>
                <td>{$row['std_fullname']}</td>
                <td>{$row['std_regNo']}</td>
                <td>{$row['faculty']}</td>
                <td>{$row['department']}</td>
                <td>{$row['levels']}</td>
                <td>{$row['programs']}</td>
                <td>{$row['specialization']}</td>
                <td>{$row['campus']}</td>
                <td>{$row['updated_at']}</td>       
            </tr>
        HEREDOC;

            echo $display;
            $countRow++;
        }
    } else {
        echo "<td colspan='13' style='text-align:center'>No records found.</td>";
    }

?>

            </tbody>
        </table>
    </div>


</body>

</html>