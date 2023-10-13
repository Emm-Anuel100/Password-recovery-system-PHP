<?php 

## connection properties
$servername = "localhost";
$username = "root";
$password = "";
$DBname = "kriptip_db";

//making connection to the database
$conn = new mysqli($servername, $username, $password, $DBname); //OOP

//checking the connection to the database sever 
if ($conn->connect_error) {
    die ("Connection failed: " .$conn->connect_error);
}

?>