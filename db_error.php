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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="shortcut icon" href="">
    <title>Car Manager</title>
</head>

<body>
    <main>
        <h1>Database Error</h1>
        <p>There waas an error connecting to the database.</p>
        <p>Error Message: <?php echo $error_message; ?></p>

        <p><a href="index.php">Return to Main Page</a></p>
    </main>
</body>

</html>