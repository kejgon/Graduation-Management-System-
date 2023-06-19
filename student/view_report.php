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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUEAGMS</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">

</head>


<style>
.clearance-form {
    border-radius: 5px;
    background-color: #f2f2f2;
    margin-bottom: 50px;
    border: 1px solid #000;
    padding: 20px;
}




.row:after {
    content: "";
    display: table;
    clear: both;
}



table {
    width: 100%;
    border-collapse: collapse;
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

                        <li><a href="#">Profile</a>
                            <ul>
                                <li><a href="viewprofile.php">View profile</a></li>
                                <li><a href="studentupdates.php">Profile updates</a></li>

                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>


            <div class="right" style="background-color:#FFF;">
                <div class="clearance-form">
                    <div style="overflow:auto; height:500px; background-color:#FFF">
                        <button class="btn btn-success" onClick="printDiv('printableArea')">Print HTML</button>
                        <div id="printableArea">
                            <table width="80%" align="center" border="0" cellpadding="10px" cellspacing="10px">
                                <tr align="center">
                                    <td colspan="3">
                                        <p><strong>REPUBLIC OF KENYA</strong></p>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td colspan="3">
                                        <blockquote>
                                            <p><strong>IMMIGRATION DEPARTMENT</strong></p>
                                        </blockquote>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td colspan="3">
                                        <p><strong>APPLICATION FOR EXTENSION OF A VISITOR'S PASS</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p>Surname of the visitor (IN CAPITALS):&ensp;<strong>&ensp;&ensp;AGOR</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>

                                    <td colspan="3">
                                        <p>Other names&ensp;&ensp;<strong>&ensp;WOL THON AYIIK</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p>Nationality&ensp;&ensp;<strong>&ensp;SOUTH SUDANESE</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p>Passport No &ensp;&ensp;&ensp;<strong>&ensp;R00506968</strong>&ensp;&ensp;
                                            Place
                                            and date of issue&ensp;&ensp;<strong>&ensp; JUBA&ensp;&ensp;
                                                2019-09-25</strong>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <p>Address in Kenya &ensp;&ensp;<strong> 00200&ensp;&ensp; Nairobi&ensp;&ensp;
                                                NAIROBI</strong></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <p>Date of entry to Kenya<strong>
                                                &nbsp;</strong>&nbsp;<strong>&nbsp;&nbsp;&nbsp;2023-02-20&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                            Port of entry&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;JKIA</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p>I wish to stay in Kenya for a further period of <strong>&nbsp;&nbsp;2
                                                WEEKS</strong> &nbsp;&nbsp;Days</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p>......................................................................</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p>Signature of Declarant</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <p>Date&nbsp;&nbsp;...........................................</p>
                                        <p align="right">
                                            &nbsp;&nbsp;&nbsp;......................................................................
                                        </p>
                                        <p align="right">Signature of Visitor</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p><em>Note</em>.- If your stay exceeds 90 days from the date of entry please
                                            note
                                            that you are required to register as an alien in Kenya.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <p><strong>FOR OFFICIAL USE ONLY </strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">
                                        <p><strong>R
                                            </strong>&ensp;&ensp;..........................................................
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">Visitor's Pass extended valid until
                                        &ensp;&ensp;...................................................................................................................................................
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3" align="right">
                                        <p>....................................................................................
                                        </p>
                                        <p>Signature of Officer</p>
                                    </td>
                                </tr>
                            </table>
                            <form class="contact-us form-horizontal" action="printpdf/actionpdf.php" method="post">
                                <input type="hidden" name="surname" id="surname" value="AGOR" />
                                <input type="hidden" name="othernames" id="othernames" value="WOL THON AYIIK" />
                                <input type="hidden" name="nationality" id="nationality" value="SOUTH SUDANESE" />

                                <input type="hidden" name="passportNo" id="passportNo" value="R00506968" />
                                <input type="hidden" name="placeOfIssue" id="placeOfIssue" value="JUBA" />
                                <input type="hidden" name="dateOfIssue" id="dateOfIssue" value="2019-09-25" />
                                <input type="hidden" name="address" id="address" value="00200" />

                                <input type="hidden" name="postalCity" id="postalCity" value="Nairobi" />
                                <input type="hidden" name="postalCode" id="postalCode" value="NAIROBI" />
                                <input type="hidden" name="dateOfEntryToKenya" id="dateOfEntryToKenya"
                                    value="2023-02-20" />
                                <input type="hidden" name="portOfEntry" id="portOfEntry" value="JKIA" />
                                <input type="hidden" name="extensionPeriod" id="extensionPeriod" value="2 WEEKS" />
                                <input type="hidden" name="extensionPeriodIn" id="extensionPeriodIn" value="Days" />
                                <input type="hidden" class="btn btn-success" value="Print PDF" />

                            </form>
                        </div>
                        <form class="contact-us form-horizontal" action="mpdf60/pdfs/extensionpdf.php">
                            <input type="hidden" name="applicantId" id="applicantId" value="711338">
                            <input type="submit" class="btn btn-success" value="Print PDF" />
                        </form>

                    </div>
                </div>

            </div>

        </div>


    </div>
    </div>

    </div>




    <div class="footer">
        <p><strong>©Copyright CUEAGMS</strong></p>

    </div>
</body>

</html>