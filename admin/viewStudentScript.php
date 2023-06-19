<?php 

session_start();
ob_start(); //turning on output buffer ////! its send alot of request at the same time
$host="localhost";
$user="cueagmsac";
$password="password";
$dbname="cueagms";


$connection = mysqli_connect($host, $user, $password, $dbname);
if ($connection === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$query = "SELECT * FROM students";
$result = $connection->query($sql);
while ($row = mysqli_fetch_array($result)) {

    $display = <<<HEREDOC
    <tr>
       <td>{$row['std_id']}</td>
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
       <td>{$row['emails']}</td>
       <td>{$row['phone']}</td>
       <td>{$row['std_address']}</td>
       <td>{$row['date_created']}</td>
       
       <td><a  href="delete_faculty.php?id={$row['std_id']}">Delete</td>
    </tr>
    HEREDOC;
    echo $display;
}