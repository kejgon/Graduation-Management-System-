<?php
session_start();







//! SETTING USERS ACCORDING TO CONDITIONS
if (isset($_SESSION['userRole']) != "Hod") {
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

</head>

<style>
.clearance-form {
    border-radius: 5px;
    background-color: #f2f2f2;
    margin-bottom: 50px;
    border: 1px solid #000;
    padding: 20px;
}

.row {
    color: #fff;

}

.box1 {
    float: left;
    width: 20%;
    background-color: #2B3A55;
    height: 100;
    margin: 10px;
    padding: 20px 40px;
}

.box2 {
    float: left;
    width: 20%;
    background-color: #6B728E;
    height: 100;
    margin: 10px;
    padding: 20px 40px;

}

.box3 {
    float: left;
    width: 20%;
    background-color: #009EFF;
    height: 100;
    margin: 10px;
    padding: 20px 40px;

}

.box4 {
    float: left;
    width: 20%;
    background-color: #D2001A;
    height: 100;
    margin: 10px;
    padding: 20px 40px;

}

.row {
    color: #7e0524;
}

.row:after {
    content: "";
    display: table;
    clear: both;
}

@media screen and (max-width: 600px) {

    .box1,
    .box2,
    .box3,
        {
        width: 100%;
        margin: 0 auto;
        margin-top: 0;
    }
}


.table {
    font-family: "Fira Sans", sans-serif;
    border-collapse: collapse;
    width: 100%;
}

.table th {
    text-align: center;
    border-top: 2px solid #009578;
    border-bottom: 2px solid #009578;
}

.table td,
.search-input {
    font-size: 1em;
    padding: 0.6em 1em;
}

.search-input {
    border: none;
    outline: none;
    font-family: "Fira Sans", sans-serif;
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
            <p>Catholic Unversity of Eastern Africa Graduation Management System</p>
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
                        <li><a href="hod.php">Dashboard</a></li>
                        <li><a href="#">Request</a>
                            <ul>
                                <li><a href="clearanceRequests.php">Clearance request</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Reports</a>
                            <ul>
                                <li><a href="#">Cleared Students</a></li>
                                <li><a href="">Uncleared Students</a></li>
                            </ul>
                </nav>
            </div>


            <div class="right" style="background-color:#FFF;">
                <h3> Clearance Status</h3>

                <button onclick="window.print()"
                    style="padding: 10px 20px; float: right; margin: 5px 10px; background-color: #47B5FF; border: none; border-radius:10px">Print</button>
                <div class="clearance-form">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    <input type="text" class="search-input" placeholder="Name">
                                </th>
                                <th>
                                    <input type="text" class="search-input" placeholder="Reg Number">
                                </th>
                                <th>
                                    <input type="text" class="search-input" placeholder="Program">
                                </th>
                                <th>
                                    <input type="text" class="search-input" placeholder="Facutly">
                                </th>
                                <th>
                                    <input type="text" class="search-input" placeholder="Year">
                                </th>
                                <th>
                                    <input type="text" class="search-input" placeholder="Reason">
                                </th>
                                <th>
                                    <input type="text" class="search-input" placeholder="Status">
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Reamonn Corkill</td>
                                <td>1223993</td>
                                <td>Bachelor in Computer Science</td>
                                <td>Science</td>
                                <td>4 Year</td>
                                <td>shifting</td>
                                <td>Approved</td>
                                <td><button>action</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Peter Kamau</td>
                                <td>1333993</td>
                                <td>Bachelor in Political Science</td>
                                <td>Art and Science</td>
                                <td>4 Year</td>
                                <td>Clearace</td>
                                <td>Approved</td>
                                <td><button>action</button></td>
                            </tr>
                            <tr>
                                <td>3</td>

                                <td>Mary Anna</td>
                                <td>1424493</td>
                                <td>Bachelor in Economic</td>
                                <td>Art and science</td>
                                <td>4 Year</td>
                                <td>Clearace</td>
                                <td>rejected</td>
                                <td><button>action</button></td>
                            </tr>
                            <tr>
                                <td>4</td>

                                <td>Sarah Luke</td>
                                <td>1344493</td>
                                <td>Diploma in Information Technology</td>
                                <td>Science</td>
                                <td>2 Year</td>
                                <td>Clearace</td>
                                <td>rejected</td>
                                <td><button>action</button></td>
                            </tr>


                        </tbody>
                    </table>

                </div>


            </div>

            <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelectorAll(".search-input").forEach((inputField) => {
                    const tableRows = inputField
                        .closest("table")
                        .querySelectorAll("tbody > tr");
                    const headerCell = inputField.closest("th");
                    const otherHeaderCells = headerCell.closest("tr").children;
                    const columnIndex = Array.from(otherHeaderCells).indexOf(headerCell);
                    const searchableCells = Array.from(tableRows).map(
                        (row) => row.querySelectorAll("td")[columnIndex]
                    );

                    inputField.addEventListener("input", () => {
                        const searchQuery = inputField.value.toLowerCase();

                        for (const tableCell of searchableCells) {
                            const row = tableCell.closest("tr");
                            const value = tableCell.textContent.toLowerCase().replace(",", "");

                            row.style.visibility = null;

                            if (value.search(searchQuery) === -1) {
                                row.style.visibility = "collapse";
                            }
                        }
                    });
                });
            });
            </script>


            <div class="footer">
                <p><strong>©Copyright CUEAGMS</strong></p>

            </div>
</body>

</html>