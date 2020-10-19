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

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// Delete Record On Form Submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the car form data
    $posted_car_make = filter_input(INPUT_POST, 'car_Make');
    $posted_car_model = filter_input(INPUT_POST, 'car_Model');
    $posted_car_color = filter_input(INPUT_POST, 'car_Color');
    $posted_car_year = filter_input(INPUT_POST, 'car_Year', FILTER_VALIDATE_INT);
    $posted_car_price = filter_input(INPUT_POST, 'car_Price', FILTER_VALIDATE_FLOAT);

    addCar($posted_car_make, $posted_car_model, $posted_car_color, $posted_car_year, $posted_car_price);
}

function addCar($car_make, $car_model, $car_color, $car_year, $car_price) {

    // Validate inputs
    if ($car_make == null || $car_make == false || 
        $car_model == null || $car_model == false || 
        $car_color == null || $car_color == false || 
        $car_year == null || $car_year == false || 
        $car_price == null || $car_price == false) {
            $error_message = "Invalid car data. Check all fields and try again.";
            include('db_error.php');
        
    } else {
        include('db_conn.php');

        // Add car to the database  
        $queryAddCar = 'INSERT INTO cars (car_make, car_model, car_color, car_year, car_price)
                        VALUES (:car_make, :car_model, :car_color, :car_year, :car_price)';

        $db_add_process = $db->prepare($queryAddCar);
        $db_add_process->bindValue(':car_make', $car_make);
        $db_add_process->bindValue(':car_model', $car_model);
        $db_add_process->bindValue(':car_color', $car_color);
        $db_add_process->bindValue(':car_year', $car_year);
        $db_add_process->bindValue(':car_price', $car_price);
        // $db_add_process->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db_add_process->execute();
        $db_add_process->closeCursor();
        
        header('Location: index.php');
    }

}

?>