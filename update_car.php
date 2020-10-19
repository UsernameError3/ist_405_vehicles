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

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

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

        // Update car in the database  
        $queryEditCar = 'UPDATE cars 
                         SET
                         car_make = ?,
                         car_model = ?,
                         car_color = ?,
                         car_year = ?,
                         car_price = ?
                         WHERE car_id = ?';

        $db_list_process = mysqli_prepare($db, $queryEditCar);
        mysqli_stmt_bind_param($db_list_process, "sssidi", $car_make, $car_model, $car_color, $car_year, $car_price, $car_id);
        mysqli_stmt_execute($db_list_process);
        mysqli_stmt_close($db_list_process);
        mysqli_close($db);

        // Go Back to The Car List
        header('Location: index.php');
    }

}


?>
