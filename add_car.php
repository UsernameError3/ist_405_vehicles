<?php
require_once('db_conn.php');

/*****************************************************************************
Title:  	Arrays and Custom Functions
Use:     	To demonstrate using databases with PHP & SQL.
Author:  	Alex Fleming
School:  	Southern Illinois University
Term:    	Fall 2019
Developed:  10/11/20
Tested:     10/11/20
******************************************************************************/

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Car Manager - Add Cars</title>
</head>

<body>
    <main>
        <h1>Add Car</h1>
        <form action="insert_car.php" id="add_car" method="post">
            <label>Make:</label><br>
            <input type="text" name="car_Make"><br>
            <label>Model:</label><br>
            <input type="text" name="car_Model"><br>
            <label>Color:</label><br>
            <input type="text" name="car_Color"><br>
            <label>Year:</label><br>
            <input type="text" name="car_Year"><br>
            <label>Price:</label><br>
            <input type="text" name="car_Price"><br>
            <label> </label><br>
            <input type="submit" name="add" value="Add Car"><br>
        </form>
        <!-- Add Car -->
        <p><a href="index.php">Return to Main Page</a></p>
    </main>
</body>

</html>