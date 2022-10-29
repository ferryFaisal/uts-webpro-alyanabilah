<?php
// used to connect to the database
$host = "localhost";
$username = "root";
$password = "";
$db_name = "webpro";

//create connection
$conn = mysqli_connect($host, $username, $password, $db_name);

//check connection
if(!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
}
// echo "Connected Successfully . (MYSQLi Procedural) <br><br>";
?>