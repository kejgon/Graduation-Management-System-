<?php



//! A function to pass MYSQL QUERIES
function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}


//! A function to Test our queries whether there an error or not
function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}


//! This function escapes special characters in a string for use in an SQL query
function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}



function fetch_Array($result)
{
    return mysqli_fetch_array($result);
}


function redirect($location)
{
    header("Location: $location");
}



function set_Message($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

function display_Message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}



function login_User()
{
    if (isset($_POST['submit'])) {
        $username =  escape_string($_POST['username']);
        $password =  escape_string($_POST['password']);
        $user_role = escape_string($_POST['userRole']);

        


        // $query = query("SELECT * FROM users WHERE username = '{$username}' AND password='{$password}' AND userRole='{$user_role}'");
        // confirm($query);

        // if (mysqli_num_rows($query) == 0) {
        //     set_Message("Your username or  password or user role are incorrect!");
        //     redirect("login.php");
        // } else {
        //     $row = mysqli_fetch_array($query);


        //     session_regenerate_id(); //! To replace the current session id with a new one, and keep the current session information
        //     //Let's pass our table values through session
        //     $_SESSION['username'] = $row['username'];
        //     $_SESSION['fullname'] = $row['fullname'];
        //     $_SESSION['userRole'] = $row['userRole'];

        //     if ($row>0) {
        //         query("insert into login_logs(username) values('".$_SESSION['username']."')");
        //     }

        //     session_write_close(); //! Ends the current session and store session data
        //     if ($_SESSION['userRole'] == "Student") {
        //         redirect("student/student.php");
        //     } elseif ($_SESSION['userRole'] == "Hod") {
        //         redirect("hod/hod.php");
        //     } elseif ($_SESSION['userRole'] == "Finance") {
        //         redirect("finance/finance.php");
        //     } elseif ($_SESSION['userRole'] == "Registrar") {
        //         redirect("registrar/registrar.php");
        //     } elseif ($_SESSION['userRole'] == "Dean") {
        //         redirect("dean/dean.php");
        //     } elseif ($_SESSION['userRole'] == "Admin") {
        //         redirect("admin/admin.php");
        //     } elseif ($_SESSION['userRole'] == "Librarian") {
        //         redirect("library/librarian.php");
        //     }
        // }
    }
}












function get_users_logs()
{

    $query = query("SELECT * FROM login_logs");
    confirm($query);


    //Pagaination process
    $rows = mysqli_num_rows($query); // Get total of mumber of rows from the database


    if (isset($_GET['page'])) { //get page from URL if its there

        $page = preg_replace('#[^0-9]#', '', $_GET['page']); //filter everything but numbers



    } else { // If the page url variable is not present force it to be number 1

        $page = 1;
    }


    $perPage = 10; // Items per page here 

    $lastPage = ceil($rows / $perPage); // Get the value of the last page


    // Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

    if ($page < 1) { // If it is less than 1

        $page = 1; // force if to be 1

    } elseif ($page > $lastPage) { // if it is greater than $lastpage

        $page = $lastPage; // force it to be $lastpage's value

    }



    $middleNumbers = ''; // Initialize this variable

    // This creates the numbers to click in between the next and back buttons


    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;



    if ($page == 1) {

        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    } elseif ($page == $lastPage) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
    } elseif ($page > 2 && $page < ($lastPage - 1)) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . '">' . $sub2 . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . '">' . $add2 . '</a></li>';
    } elseif ($page > 1 && $page < $lastPage) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page= ' . $sub1 . '">' . $sub1 . '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    }


    // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query


    $limit = 'LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;




    // $query2 is what we will use to to display products with out $limit variable

    $query2 = query(" SELECT * FROM login_logs $limit");
    confirm($query2);


    $outputPagination = ""; // Initialize the pagination output variable


    // if($lastPage != 1){

    //    echo "Page $page of $lastPage";


    // }


    // If we are not on page one we place the back link

    if ($page != 1) {


        $prev  = $page - 1;

        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prev . '">Back</a></li>';
    }

    // Lets append all our links to this variable that we can use this output pagination

    $outputPagination .= $middleNumbers;


    // If we are not on the very last page we the place the next link

    if ($page != $lastPage) {


        $next = $page + 1;

        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $next . '">Next</a></li>';
    }






    while ($row = fetch_Array($query2)) {

        $loggs = <<<HEREDOC

        <tr>
            <td>{$row['login_id']}</td>
            <td>{$row['username']}</td>
            <td>{$row['loginTime']}</td>
            <td>{$row['logoutTime']}</td>
        </tr>
        
        HEREDOC;
        echo $loggs;
    }
    echo "
    <div class'fuild-container' style='clear:both'>
    <div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>
    </div>
    ";
}




//***************************** Display faculties ******************************** ??*/
function display_faculties()
{
    $query = query("SELECT * FROM faculties");
    confirm($query);
    while ($row = fetch_Array($query)) {
        $fac_id = $row['fac_id'];
        $fac_name = $row['fac_title'];

        $faculties = <<<HEREDOC
        <tr>
           <td>{$fac_id}</td>
           <td>{$fac_name}</td>
           <td><a  href="delete_faculty.php?id={$row['fac_id']}">Delete</td>
        </tr>
        HEREDOC;
        echo $faculties;
    }
}

//***************************** Add faculty ******************************** ??*/
function add_faculty()
{
    if (isset($_POST['submit'])) {

        $faculty_name = escape_string($_POST['fac_name']);

        if (empty($faculty_name) || $faculty_name == " ") {
            echo "<p style='color:red;'>Please fill in the field</p>";
        } else {

            $insert_query = query("INSERT INTO faculties (fac_title) VALUES ('{$faculty_name}')");
            confirm($insert_query);
            set_Message("The Faculty have been Added");
        }
    }
}



//***************************** ADD USERS ******************************** ??*/
function add_Users()
{
    if (isset($_POST['add_user'])) {

        $fullname         = escape_string($_POST['fullname']);
        $user_name         = escape_string($_POST['username']);
        $user_email        = escape_string($_POST['email']);
        $address        = escape_string($_POST['address']);
        $phone        = escape_string($_POST['phone']);
        $user_type         = escape_string($_POST['userRole']);
        $user_password     = escape_string($_POST['password']);
        //$encrypt_Password  = password_hash($user_password, PASSWORD_DEFAULT);

        // if (
        //     (empty($user_name) || $user_name == " ")
        //     && (empty($user_email) || $user_email == " ")
        //     && (empty($user_password) || $user_password == " ")
        //     && (empty($user_type) || $user_type == " ")
        // ) {
        //     echo "<p class='bg-danger'>Please fill in the field</p>";
        // } else {

            $inert_users = query("INSERT INTO users(fullname, username, address, email,phone,userRole,password) VALUES('{$fullname}','{$user_name}','{$address}','{$user_email}','{$phone}','{$user_type}','{$user_password}')");
            confirm($inert_users);
            set_Message("A new users have been Added!");
            redirect("newusers.php");
       // }
    }
}




//***************************** AddStudents  ******************************** ??*/
function addstudents()
{
    if (isset($_POST['addStudent'])) {

        $fullname         = escape_string($_POST['fullname']);
        $regNo         = escape_string($_POST['regNo']);
        $faculties        = escape_string($_POST['faculties']);
        $departments        = escape_string($_POST['departments']);
        $level       = escape_string($_POST['levels']);
        $program         = escape_string($_POST['programs']);
        $specialization     = escape_string($_POST['specializations']);
        $mode_of_study     = escape_string($_POST['mode_of_study']);
        $year     = escape_string($_POST['year']);
        $gender     = escape_string($_POST['gender']);
        $email     = escape_string($_POST['email']);
        $phone_num     = escape_string($_POST['phone_num']);
        $address     = escape_string($_POST['address']);
         $date     = escape_string($_POST['date']);
        //  if (
        //     (empty($fullname) || $fullname == " ")
        //     && (empty($regNo) || $regNo == " ")
        //     && (empty($faculties) || $faculties == " ")
        //     && (empty($departments) || $departments == " ")
        //     && (empty($program) || $program == " ")
        //     && (empty($specialization) || $specialization == " ")
        //     && (empty($mode_of_study) || $mode_of_study == " ")
        //     && (empty($year) || $year == " ")
        //     && (empty($gender) || $gender == " ")
        //     && (empty($email) || $email == " ")
        //     && (empty($phone_num) || $phone_num == " ")
        //     && (empty($date) || $date == " ")
        // ) {
        //     echo "<p style ='color:red;'>Please fill in the field</p>";
        //     // set_Message("<p >Please fill in the field</p>");

        // } else {


            $insert_Student = query("INSERT INTO students(std_regNo,std_fullname,faculty,department,levels,programs,specialization,mode_of_study,years,gender,email,phone,std_address,date_created) 
            VALUES('{$regNo}','{$fullname}','{$faculties}','{$departments}','{$level}','{$program}','{$specialization}','{$mode_of_study}',{$year},'{$gender}','{$email}',{$phone_num},'{$address}','{$date}')");
            confirm($insert_Student);
            set_Message("New Student have been added");
            redirect("addStudent.php");
       }
   // }
}

//***************************** ClearanceRequest  ******************************** ??*/
function clearanceRequests()
{
    if (isset($_POST['clearancReq'])) {

        $fullname         = escape_string($_POST['fullname']);
        $regNo         = escape_string($_POST['regNo']);
        $faculties        = escape_string($_POST['faculties']);
        $departments        = escape_string($_POST['departments']);
        $level       = escape_string($_POST['levels']);
        $program         = escape_string($_POST['programs']);
        $specialization     = escape_string($_POST['specializations']);
        $year     = escape_string($_POST['year']);
        $mode_of_study     = escape_string($_POST['mode_of_study']);
        $compus     = escape_string($_POST['compus']);
        $cl_reason     = escape_string($_POST['cl_reason']);
        $others     = escape_string($_POST['others']);
        $date     = escape_string($_POST['date']);

            $insert_requests = query("INSERT INTO clearance(std_fullname, std_regNo,faculty,department,levels,programs,specialization,years,mode_of_study,compus,reason_for_clearance,other_reasons,date_of_submission) 
            VALUES('{$fullname}',{$regNo},'{$faculties}','{$departments}','{$level}','{$program}','{$specialization}',{$year},'{$mode_of_study}','{$compus}','{$cl_reason}','{$others}','{$date}')");
            confirm($insert_requests);
            set_Message("Clearance request have been made. Please wait until the request has been processed.<br>Thank you.");
            redirect("studentClearanceReq.php");
       // }
    }
}