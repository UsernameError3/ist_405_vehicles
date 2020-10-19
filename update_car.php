<?php
include('db_conn.php');
/*****************************************************************************
Title:  	Arrays and Custom Functions
Use:     	To demonstrate using databases with PHP & SQL.
Author:  	Alex Fleming
School:  	Southern Illinois University
Term:    	Fall 2019
Developed:  10/11/20
Tested:     10/11/20
******************************************************************************/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Edit Record On Form Submit
if ( isset($_POST['edited']) ) {
    $posted_car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
    $posted_car_make = filter_input(INPUT_POST, 'car_Make');
    $posted_car_model = filter_input(INPUT_POST, 'car_Model');
    $posted_car_color = filter_input(INPUT_POST, 'car_Color');
    $posted_car_year = filter_input(INPUT_POST, 'car_Year', FILTER_VALIDATE_INT);
    $posted_car_price = filter_input(INPUT_POST, 'car_Price', FILTER_VALIDATE_FLOAT);

    updateCar($posted_car_id, $posted_car_make, $posted_car_model, $posted_car_color, $posted_car_year, $posted_car_price);

}

function updateCar($car_id, $car_make, $car_model, $car_color, $car_year, $car_price) {

    // Validate inputs
    if ( $car_id == null || $car_id == false || 
        $car_make == null || $car_make == false || 
        $car_model == null || $car_model == false || 
        $car_color == null || $car_color == false || 
        $car_year == null || $car_year == false || 
        $car_price == null || $car_price == false) {
            $error_message = "Invalid car data. Check all fields and try again.";
            include('db_error.php');

    } else {
        include('db_conn.php');
        // Add car to the database  
        $queryAddCar = 'UPDATE cars 
                        SET
                        car_make = :car_make,
                        car_model = :car_model,
                        car_color = :car_color,
                        car_year = :car_year,
                        car_price = :car_price
                        WHERE
                        car_id = :car_id';

        $db_edit_process = $db->prepare($queryAddCar);
        $db_edit_process->bindValue(':car_id', $car_id);
        $db_edit_process->bindValue(':car_make', $car_make);
        $db_edit_process->bindValue(':car_model', $car_model);
        $db_edit_process->bindValue(':car_color', $car_color);
        $db_edit_process->bindValue(':car_year', $car_year);
        $db_edit_process->bindValue(':car_price', $car_price);
        $success = $db_edit_process->execute();
        $db_edit_process->closeCursor();

        // Go Back to The Car List
        header('Location: index.php');
    }

}


?>
