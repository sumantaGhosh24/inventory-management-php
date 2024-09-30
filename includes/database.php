<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_management_php";

date_default_timezone_set("Asia/Kolkata");
$con = mysqli_connect($host, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>