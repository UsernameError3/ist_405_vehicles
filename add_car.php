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

function addCar() {

    // Get the car form data
    $car_make = filter_input(INPUT_POST, 'car_Make');
    $car_model = filter_input(INPUT_POST, 'car_Model');
    $car_color = filter_input(INPUT_POST, 'car_Color');
    $car_year = filter_input(INPUT_POST, 'car_Year', FILTER_VALIDATE_INT);
    $car_price = filter_input(INPUT_POST, 'car_Price', FILTER_VALIDATE_FLOAT);

    // Validate inputs
    if ($car_make == null || $car_make == false || 
        $car_model == null || $car_model == false || 
        $car_color == null || $car_color == false || 
        $car_year == null || $car_year == false || 
        $car_price == null || $car_price == false) {
            $error_message = "Invalid car data. Check all fields and try again.";
            include('db_error.php');

    } else {
        require_once('db_conn.php');

        // Add car to the database  
        $queryAddCar = 'INSERT INTO cars 
                            (car_make, car_model, car_color, car_year, car_price)
                        VALUES 
                            (:car_make, :car_model, :car_color, :car_year, :car_price)';

        $db_add_process = $db->prepare($queryAddCar);
        $db_add_process->bindValue(':car_make', $car_make);
        $db_add_process->bindValue(':car_model', $car_model);
        $db_add_process->bindValue(':car_color', $car_color);
        $db_add_process->bindValue(':car_year', $car_year);
        $db_add_process->bindValue(':car_price', $car_price);
        $db_add_process->execute();
        $db_add_process->closeCursor();

        header("Location: /index.php");
        exit;
    }
}

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
        <form action="add_car.php" id="add_car" method="post">
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
            <input type="submit" name="add" action="addCar()" value="Add Car"><br>
        </form>
        <!-- Add Car -->
        <p><a href="index.php">Return to Main Page</a></p>
    </main>
</body>

</html>