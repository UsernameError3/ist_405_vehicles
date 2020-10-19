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


// Delete Record On Form Submit
if ( isset($_POST['delete']) ) {
    $posted_car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
    deleteCar($posted_car_id);
}

// Delete Record Function
function deleteCar($car_id) {

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

        $queryDeleteCar = 'DELETE * FROM cars
                           WHERE car_id = :car_id';

        $db_delete_process = $db->prepare($queryDeleteCar);
        $db_delete_process->bindValue(':car_id', $car_id);
        $success = $db_delete_process->execute();
        $db_delete_process->closeCursor();

        // Go Back to The Car List
        header('Location: index.php');
    }

}


?>
