<?php
//Database connection settings

$host = "localhost";
$user = "root";
$pwd = "";
$sql_db= "ecopower";

//Connect to MySQL database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

//Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
