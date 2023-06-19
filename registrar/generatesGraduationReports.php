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
                <h3>Graduation list</h3>

                <div class="clearance-form">

                    <form id="clearedStudentsForm" action="generatesGraduationReports.php" method="post">

                        <div class="row">
                            <div class="col-10">
                                <label for="year">Year from:</label>
                                <input type="text" name="dateFrom" id="dateFrom">
                            </div>
                            <div class="col-90">
                                <label for="year">To:</label>
                                <input type="text" name="dateTo" id="dateTo">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-10">
                                <label for="faculty"> Faculty:</label>
                                <select name="faculty" id="faculties">
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
                                </select>
                            </div>
                            <div class="col-90">
                                <label for="department">Department:</label>
                                <select name="department" id="departments">
                                    <option value=" ">Select your deptartment:</option>
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
                                    <option
                                        value="Department of Humanities (History, Geography & Environmental Studies)">
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
                                <label for="campus">Campus:</label>
                                <select name="campus" id="campus">
                                    <option value=" ">Select the campus:</option>
                                    <option value="Langata">Langata</option>
                                    <option value="Gaba">Gaba</option>

                                </select>
                            </div>
                            <div class="col-90">
                                <input type="submit" name="filter" value="Filter">
                            </div>
                        </div>

                    </form>
                    <hr style="border: 3px solid #F09910">
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
                                    Status
                                </th>

                                <th>
                                    Date
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
// Assuming $conn is your database connection
if (isset($_POST['filter'])) {

    // Get user input
    $dateFrom = mysqli_real_escape_string($connection, trim($_POST['dateFrom']));
    $dateTo = mysqli_real_escape_string($connection, trim($_POST['dateTo']));
    $faculty = mysqli_real_escape_string($connection, trim($_POST['faculty']));
    $department = mysqli_real_escape_string($connection, trim($_POST['department']));
    $levels = mysqli_real_escape_string($connection, trim($_POST['levels']));
    $programs = mysqli_real_escape_string($connection, trim($_POST['programs']));
    $campus = mysqli_real_escape_string($connection, trim($_POST['campus']));

 // Build the query
 $sql = "SELECT c.clr_id, c.std_fullname, c.std_regNo, c.faculty, c.department, c.levels,c.programs, c.specialization, c.campus, r.stdStatus, r.updated_at 
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
                <td class='status'>{$row['stdStatus']}</td>
                <td>{$row['updated_at']}</td>       
            </tr>
        HEREDOC;

        echo $display;
        $countRow++;
    }
} else {
    echo "<td colspan='13' style='text-align:center'>No records found.</td>";
}

$filteredResults = array();

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
// Loop through the rows and filter the data based on user inputs
while ($row = mysqli_fetch_assoc($result)) {
 $match = true;
 
 if (!empty($dateFrom) && !empty($dateTo)) {
     if ($row['updated_at'] < $dateFrom || $row['updated_at'] > $dateTo) {
         $match = false;
     }
 } elseif (!empty($dateFrom)) {
     if ($row['updated_at'] < $dateFrom) {
         $match = false;
     }
 } elseif (!empty($dateTo)) {
     if ($row['updated_at'] > $dateTo) {
         $match = false;
     }
 }
 
 if (!empty($faculty) && $row['faculty'] != $faculty) {
     $match = false;
 }
 if (!empty($department) && $row['department'] != $department) {
     $match = false;
 }
 if (!empty($levels) && $row['levels'] != $levels) {
     $match = false;
 }
 if (!empty($programs) && $row['programs'] != $programs) {
     $match = false;
 }
 if (!empty($campus) && $row['campus'] != $campus) {
     $match = false;
 }
 
 // If the row matches the filter conditions, add it to the filtered results array
 if ($match) {
     array_push($filteredResults, $row);
 }
}
}

// Close the database connection
mysqli_close($connection);
}

// Display the filtered results in the table
if (!empty($filteredResults)) {
foreach ($filteredResults as $row) {
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
<td class='status'>{$row['stdStatus']}</td>
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