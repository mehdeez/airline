<?php
$servername = "localhost";
$username = "root";
$password  = "";
$dbname = "ucsi_uni";


$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn) {
    echo "Connected successfully";
} else {
    die("Connection failed: " . mysqle_connect_error());
}

?>