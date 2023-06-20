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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
html,
body {
    font-family: Consolas, monaco, monospace;
}

#chart {
    padding: 20px;
}

table {
    width: 100%;
    height: 400px;
}

.charttitle {
    text-align: center;
}

.bars td {
    vertical-align: bottom;
}

.bars div:hover {
    opacity: 0.6;
}

.legend {
    vertical-align: bottom;
    padding-left: 20px;
    text-align: left;
}

.legbox {
    display: block;
    clear: both;
}

.xaxisname {
    margin: 5px;
    color: #fff;
    font-size: 77%;
    padding: 5px;
    float: left;
}

/*Flat UI colors*/
.one {
    background: #16A085;
}

.two {
    background: #2ECC71;
}

.three {
    background: #27AE60;
}

.four {
    background: #3498DB;
}

.five {
    background: #2980B9;
}

.six {
    background: #9B59B6;
}

.seven {
    background: #8E44AD;
}

.eight {
    background: #34495E;
}

.nine {
    background: #2C3E50;
}

.ten {
    background: #22313f;
}

.eleven {
    background: #F1C40F;
}

.twelve {
    background: #F39C12;
}

.thirteen {
    background: #E67E22;
}

.fourteen {
    background: #D35400;
}

.fifteen {
    background: #E74C3C;
}

.sixteen {
    background: #C0392B;
}

.seventeen {
    background: #ECF0F1;
}

.seventeen.clouds {
    color: #BDC3C7;
}

.eighteen {
    background: #BDC3C7;
}

.nineteen {
    background: #95A5A6;
}

.twenty {
    background: #7F8C8D;
}
</style>

<body>
    <div id="chart"></div>

    <?php
    // Variables to hold the counts
    $gCertificateCount = 0;
    $gDiplomaCount = 0;
    $gBachelorCount = 0;
    $gMasterCount = 0;
    $gDoctoralCount = 0;
    $year = 2023;
   

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
    
   echo $gCertificateCount . "<br>";
   echo $gDiplomaCount . "<br>";
   echo $gBachelorCount . "<br>";
   echo $gMasterCount . "<br>";
   echo $gDoctoralCount;
 ?>


</body>

</html>