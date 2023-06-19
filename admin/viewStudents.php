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
    color: #eee;

}

/* These styles apply to the "box2" div */
.box2 {
    float: left;
    width: 30%;
    background-color: #282A3A;
    height: 100;
    margin-top: 6px;
    color: #eee;

}

/* These styles apply to the "box3" div */
.box3 {
    float: left;
    width: 30%;
    background-color: #5CB8E4;
    height: 100;
    margin-top: 6px;
    color: #eee;

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

.clearance-form {
    border-radius: 5px;
    background-color: #f2f2f2;
    margin-bottom: 50px;
    border: 1px solid #000;
    padding: 20px;
}

input[type=text] {
    width: 45%;
    padding: 12px;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;
    margin-top: 10px;

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

.clearance-form table tr:nth-child(even) {
    background-color: #F2F7A1
}

.pagination li {
    display: inline;
    text-decoration: none;
    padding-right: 5px;
}

.page-link {
    padding: 0 10px;
}

.pagination li:hover {
    cursor: pointer;
}




.pagination {
    padding-right: 0;

}

.pagination>li>a,
.pagination>li>span {
    float: right;
    margin-right: -1px;
    margin-left: 0px;

}

.pagination>li:first-child>a,
.pagination>li:first-child>span {
    margin-left: 0;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
}

.pagination>li:last-child>a,
.pagination>li:last-child>span {
    margin-right: -1px;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
}

.pager {
    padding-right: 0;
    padding-left: none;
}

.pager .next>a,
.pager .next>span {
    float: left;
}

.pager .previous>a,
.pager .previous>span {
    float: right;
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

.btn-danger {
    margin-left: 5px;
    background-color: #CD0404;
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

                <h3> Students list</h3>

                <div class="clearance-form">
                    <input style="margin:20px" type="text" id="searchInput" placeholder="Search">

                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Reg Number</th>
                                </th>
                                <th>
                                    Full Names </th>
                                <th>
                                    Faculty </th>
                                <th>
                                    Department </th>
                                </th>
                                <th>
                                    Levels </th>
                                <th>
                                    Program </th>
                                </th>
                                <th>
                                    Specializations </th>
                                </th>
                                <th>
                                    Mode of study
                                </th>
                                <th>
                                    Years </th>
                                <th>
                                    Gender </th>
                                <th>
                                    Emails </th>
                                <th>
                                    Phone number</th>
                                <th>
                                    Address </th>
                                <th>
                                    Date </th>
                                <th>
                                    Action </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
$query = "SELECT * FROM students";
$result =$connection->query($query);
$countRow =1;

while ($row = mysqli_fetch_array($result)) {

    $display = <<<HEREDOC
    <tr>
       <td>{$countRow}</td>
       <td>{$row['std_regNo']}</td>
       <td>{$row['std_fullname']}</td>
       <td>{$row['faculty']}</td>
       <td>{$row['department']}</td>
       <td>{$row['levels']}</td>
       <td>{$row['programs']}</td>
       <td>{$row['specialization']}</td>
       <td>{$row['mode_of_study']}</td>
       <td>{$row['years']}</td>
       <td>{$row['gender']}</td>
       <td>{$row['email']}</td>
       <td>{$row['phone']}</td>
       <td>{$row['std_address']}</td>
       <td>{$row['date_created']}</td>
       
       <td><a class='btn-danger' href="delete_student.php?id={$row['std_id']}">Delete</td>
    </tr>
    HEREDOC;
    echo $display;
    $countRow++;
}?>

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


    <!-- Search and pagination Script -->
    <script>
    // Get references to the required elements
    const table = document.getElementById("myTable"); // The table element
    const searchInput = document.getElementById("searchInput"); // The search input field
    const previousBtn = document.getElementById("previous"); // The previous page button
    const nextBtn = document.getElementById("next"); // The next page button
    const pageNumber = document.getElementById("pageNumber"); // The current page number display
    const totalPages = document.getElementById("totalPages"); // The total page count display
    const rowsPerPage = 10; // Number of rows to display per page

    let currentPage = 1; // Current page number

    // Event listener for the search input
    searchInput.addEventListener("keyup", function() {
        currentPage = 1; // Reset the current page to 1
        updateTable(); // Update the table based on the search input
    });

    // Event listener for the previous page button
    previousBtn.addEventListener("click", function() {
        currentPage--; // Decrease the current page by 1
        updateTable(); // Update the table based on the new page
    });

    // Event listener for the next page button
    nextBtn.addEventListener("click", function() {
        currentPage++; // Increase the current page by 1
        updateTable(); // Update the table based on the new page
    });

    // Function to update the table based on the search input and current page
    function updateTable() {
        const filter = searchInput.value.toLowerCase(); // Get the search filter value
        const rows = table.getElementsByTagName("tr"); // Get all rows in the table
        let startRow = (currentPage - 1) * rowsPerPage; // Calculate the starting row index
        let endRow = startRow + rowsPerPage; // Calculate the ending row index
        let totalRows = 0; // Counter for total visible rows

        // Loop through each row in the table
        for (let i = 0; i < rows.length; i++) {
            // Show the table header
            rows[0].style.display = "";

            const cells = rows[i].getElementsByTagName("td"); // Get all cells in the current row
            let found = false; // Flag to indicate if the row matches the search filter

            // Loop through each cell in the row
            for (let j = 0; j < cells.length; j++) {
                const cellValue = cells[j].innerHTML.toLowerCase(); // Get the cell value in lowercase
                if (cellValue.indexOf(filter) > -1) {
                    found = true; // Match found, set the flag to true
                    break; // Exit the loop since the match is found
                }
            }

            // Determine whether to show or hide the row based on the search filter and current page
            if (found) {
                totalRows++; // Increment the visible rows counter

                if (i >= startRow && i < endRow) {
                    rows[i].style.display = ""; // Show the row if it falls within the current page range
                } else {
                    rows[i].style.display = "none"; // Hide the row if it's outside the current page range
                }
            } else {
                rows[i].style.display = "none"; // Hide the row if it doesn't match the search filter
            }
        }

        // Calculate the total page count
        const totalPageCount = Math.ceil(totalRows / rowsPerPage);
        totalPages.innerHTML = totalPageCount; // Update the total page count display
        pageNumber.innerHTML = currentPage; // Update the current page number display

        // Disable or enable the previous and next buttons based on the current page
        if (currentPage === 1) {
            previousBtn.disabled = true; // Disable the previous button if on the first page
        } else {
            previousBtn.disabled = false; // Enable the previous button if not on the first page
        }

        if (currentPage === totalPageCount) {
            nextBtn.disabled = true; // Disable the next button if on the last page
        } else {
            nextBtn.disabled = false; // Enable the next button if not on the last page
        }
    }

    updateTable(); // Initial table update when the page loads
    </script>


</body>

</html>