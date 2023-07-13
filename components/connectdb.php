<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iSecure";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("sorry we failed to connect to database: " . mysqli_connect_error());
} else {
    // echo "connection succesfull";
}
