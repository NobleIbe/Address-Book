<?php

$server  ="localhost";
$username = "root";
$password = "root";
$db = "db_client_addressbook";

$conn = mysqli_connect($server,$username,$password,$db);

if (!$conn){

    die("connection failed: " . mysqli_connect_error() );
}

?>