<?php

// Start a new PHP session and buffer the output
session_start();
ob_start();

// Database connection details
$host = "127.0.0.1";   // Server name or IP address where MySQL is running
$user = "cueagmsAC";   // MySQL user name
$password = "password";   // MySQL password
$dbname = "cueagms";   // MySQL database name

// Create a new MySQL connection using the above details
$connection = mysqli_connect($host, $user, $password, $dbname);

// Check if the connection was successful
if ($connection === false) {
    // If the connection failed, stop the script and display an error message
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


//! SETTING USERS ACCORDING TO CONDITIONS
if (isset($_SESSION['userRole']) != "Student") {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>

<head>

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

    // Gets the student registration number from the URL
    $std_regNo = $_SESSION['username'];

    // Query the database to get the student's details
    $query = "SELECT * FROM students WHERE std_regNo = '$std_regNo'";
    $result = mysqli_query($connection, $query);
    // Fetch the data
    $stdrow = mysqli_fetch_assoc($result);

    // Query the database to get the student's clearance details
    $query = "SELECT * FROM clearance WHERE std_regNo = '$std_regNo'";
    $result2 = mysqli_query($connection, $query);
    // Fetch the data
    $clrrow = mysqli_fetch_assoc($result2);

  
   
?>
    <h3 style="text-align: left; margin-top:100px; padding-left:31%;padding-bottom:5%;">Students' Clearance Report</h3>
    <span style="float:right; color: #333; margin-right:60px">Ref No. <?php echo $clrrow['clr_id'];?></span>
    <div class="row">
        <table class="profile-tab1">
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
                <td><?php 
                $query = "SELECT campus
                FROM clearance
                WHERE campus IS NOT NULL AND std_regNo = '$std_regNo'";
                $result = mysqli_query($connection, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                  // Fetch the data
                  $row = mysqli_fetch_assoc($result);
                  echo $row['campus'];
                } else {
                  echo "None";
                }
                ?></td>
                <td>Reason for Clearance</td>
                <td>
                    <?php 
                $query = "SELECT reason_for_clearance
                FROM clearance
                WHERE reason_for_clearance IS NOT NULL AND std_regNo = '$std_regNo'";
                $result = mysqli_query($connection, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                  // Fetch the data
                  $row = mysqli_fetch_assoc($result);
                  echo $row['reason_for_clearance'];
                } else {
                  echo "None";
                }
                ?>
                </td>
            </tr>
            <tr>
                <td>Year </td>
                <td><?php echo $stdrow['years'];?></td>
                <td>Date Of submission </td>
                <td> <?php 
                $query = "SELECT date_of_submission
                FROM clearance
                WHERE date_of_submission IS NOT NULL AND std_regNo = '$std_regNo'";
                $result = mysqli_query($connection, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                  // Fetch the data
                  $row = mysqli_fetch_assoc($result);
                  echo $row['date_of_submission'];
                } else {
                  echo "None";
                }
                ?></td>
            </tr>

        </table>
    </div>

    <?php
    //! RETREIVING  CLEARANCE DETAILS FROM ALL THE DERPARTMENTS

// Gets the student registration number from the URL


// Query the database to get the student's clearance details from the HOD department
$hodquery = "SELECT clr_id, stdStatus, emp_fullname, DATE(updated_at) 
             FROM hod_clearance_request 
             WHERE std_regNo = '$std_regNo'";

$hod = mysqli_query($connection, $hodquery); // Execute the query and get the result set
$hodRow = mysqli_fetch_assoc($hod); // Fetch the first row of data from the result set and store it in $hodRow

// Query the database to get the student's clearance details from the library department
$libquery = "SELECT clr_id, stdStatus, emp_fullname, DATE(updated_at) 
             FROM library_clearance_request 
             WHERE std_regNo = '$std_regNo'";

$library = mysqli_query($connection, $libquery); // Execute the query and get the result set
$libRow = mysqli_fetch_assoc($library); // Fetch the first row of data from the result set and store it in $libRow

// Query the database to get the student's clearance details from the dean department
$deanquery = "SELECT clr_id, stdStatus, emp_fullname, DATE(updated_at) 
              FROM dean_clearance_request 
              WHERE std_regNo = '$std_regNo'";

$dean = mysqli_query($connection, $deanquery); // Execute the query and get the result set
$denRow = mysqli_fetch_assoc($dean); // Fetch the first row of data from the result set and store it in $denRow

// Query the database to get the student's clearance details from the registrar department
$regquery = "SELECT clr_id, stdStatus, emp_fullname, DATE(updated_at) 
             FROM reg_clearance_request 
             WHERE std_regNo = '$std_regNo'";

$reg = mysqli_query($connection, $regquery); // Execute the query and get the result set
$regRow = mysqli_fetch_assoc($reg); // Fetch the first row of data from the result set and store it in $regRow

          
   
?>
    <div class="row" style="margin:50px">
        <table class="profile-tab">
            <tr>
                <th>#</th>
                <th>Department</th>
                <th>Status</th>
                <th>Clearing Officer</th>
                <th>Date</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Head of Department</td>
                <?php
                $query = "SELECT stdStatus, emp_fullname, DATE(updated_at) as updated_date   
                FROM hod_clearance_request
                WHERE stdStatus IS NOT NULL AND emp_fullname IS NOT NULL AND updated_at IS NOT NULL AND std_regNo = '$std_regNo'";
      $result = mysqli_query($connection, $query);
      if ($result && mysqli_num_rows($result) > 0) {
          // Fetch the data
          $finsRow = mysqli_fetch_assoc($result);
          echo "<td>{$finsRow['stdStatus']}</td>" ;
          echo "<td>{$finsRow['emp_fullname']}</td>" ;
          echo "<td>{$finsRow['updated_date']}</td>" ;
       
      } else {
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          
      }
      
                
                ?>
            </tr>
            <tr>
                <td>2</td>
                <td>Library</td>
                <?php
                $query = "SELECT stdStatus, emp_fullname, DATE(updated_at) as updated_date  
                FROM library_clearance_request
                WHERE stdStatus IS NOT NULL AND emp_fullname IS NOT NULL AND updated_at IS NOT NULL AND std_regNo = '$std_regNo'";
      $result = mysqli_query($connection, $query);
      if ($result && mysqli_num_rows($result) > 0) {
          // Fetch the data
          $finsRow = mysqli_fetch_assoc($result);
          echo "<td>{$finsRow['stdStatus']}</td>" ;
          echo "<td>{$finsRow['emp_fullname']}</td>" ;
          echo "<td>{$finsRow['updated_date']}</td>" ;
       
      } else {
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          
      }
      
                
                ?>
            </tr>
            <tr>
                <td>3</td>
                <td>Dean of Students'</td>
                <?php
                $query = "SELECT stdStatus, emp_fullname, DATE(updated_at) as updated_date  
                FROM dean_clearance_request
                WHERE stdStatus IS NOT NULL AND emp_fullname IS NOT NULL AND updated_at IS NOT NULL AND std_regNo = '$std_regNo'";
      $result = mysqli_query($connection, $query);
      if ($result && mysqli_num_rows($result) > 0) {
          // Fetch the data
          $finsRow = mysqli_fetch_assoc($result);
          echo "<td>{$finsRow['stdStatus']}</td>" ;
          echo "<td>{$finsRow['emp_fullname']}</td>" ;
          echo "<td>{$finsRow['updated_date']}</td>" ;
       
      } else {
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          
      }
      
                
                ?>
            </tr>
            <tr>
                <td>4</td>
                <td>Registrar</td>
                <?php
                $query = "SELECT stdStatus, emp_fullname, DATE(updated_at) as updated_date  
                FROM reg_clearance_request
                WHERE stdStatus IS NOT NULL AND emp_fullname IS NOT NULL AND updated_at IS NOT NULL AND std_regNo = '$std_regNo'";
      $result = mysqli_query($connection, $query);
      if ($result && mysqli_num_rows($result) > 0) {
          // Fetch the data
          $finsRow = mysqli_fetch_assoc($result);
          echo "<td>{$finsRow['stdStatus']}</td>" ;
          echo "<td>{$finsRow['emp_fullname']}</td>" ;
          echo "<td>{$finsRow['updated_date']}</td>" ;
       
      } else {
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          
      }
      
                
                ?>
            </tr>
            <tr>
                <td>5</td>
                <td>Finance</td>
                <?php
                $query = "SELECT stdStatus, emp_fullname, DATE(updated_at) as updated_date 
                FROM fin_clearance_request
                WHERE stdStatus IS NOT NULL AND emp_fullname IS NOT NULL AND updated_at IS NOT NULL AND std_regNo = '$std_regNo'";
      $result = mysqli_query($connection, $query);
      if ($result && mysqli_num_rows($result) > 0) {
          // Fetch the data
          $finsRow = mysqli_fetch_assoc($result);
          echo "<td>{$finsRow['stdStatus']}</td>" ;
          echo "<td>{$finsRow['emp_fullname']}</td>" ;
          echo "<td>{$finsRow['updated_date']}</td>" ;
       
      } else {
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          echo "<td>Pending<t/d>";
          
      }
      
                
                ?>

            </tr>

        </table>
    </div>


</body>

</html>