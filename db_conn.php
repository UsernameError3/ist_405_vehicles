<?php

/*****************************************************************************
Title:  	Arrays and Custom Functions
Use:     	To demonstrate using databases with PHP & SQL.
Author:  	Alex Fleming
School:  	Southern Illinois University
Term:    	Fall 2019
Developed:  10/11/20
Tested:     10/11/20
******************************************************************************/

$dsn = 'mysql:host=localhost;db_name=vehicles';
$username = 'root';
$password = 'abc123';

try {
    $db = new PDO ($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('db_error.php');
    exit();
}
?>