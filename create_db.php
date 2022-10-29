<?php 
require "database.php";

//create database
$sql ="CREATE DATABASE webpro";
if(mysqli_query ($conn , $sql)) {
    echo "Database Created Successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

?>
