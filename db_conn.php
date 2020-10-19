<?php

/*****************************************************************************
Title:  	Arrays and Custom Functions
Use:     	To demonstrate using databases with PHP & SQL.
Author:  	Alex Fleming
School:  	Southern Illinois University
Term:    	Fall 2019
Developed:  10/18/20
Tested:     10/18/20
******************************************************************************/

$dsn = 'mysql:host=127.0.0.1;dbname=vehicles';
$username = 'root';
$password = 'abc123';

try {
    $db = new mysqli("127.0.0.1", "root", "abc123", "vehicles");
} catch (Exception $e) {
    $error_message = mysqli_connect_error();
    include('db_error.php');
    exit();
}

?>
