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

// Display Car Record On Index Edit Button Form Submit
if ( isset($_POST['edit']) ) {
    $editCarID = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);

    // List Car Fields From Edit Button Input (car_id)
    $queryCar = 'SELECT * FROM cars
                 WHERE car_id = :editCarID';

    $db_list_process = $db->prepare($queryCar);
    $db_list_process->bindValue(':editCarID', $editCarID);
    $db_list_process->execute();
    $car = $db_list_process->fetch();
    $db_list_process->closeCursor();

}

// Edit Record On Form Submit
if ( isset($_POST['edited']) ) {
    $editedCarID = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
    $car_make = filter_input(INPUT_POST, 'car_Make');
    $car_model = filter_input(INPUT_POST, 'car_Model');
    $car_color = filter_input(INPUT_POST, 'car_Color');
    $car_year = filter_input(INPUT_POST, 'car_Year', FILTER_VALIDATE_INT);
    $car_price = filter_input(INPUT_POST, 'car_Price', FILTER_VALIDATE_FLOAT);

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
        include('index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="shortcut icon" href="">
    <title>Car Manager - Add Cars</title>
</head>

<body>
    <main>
        <h1>Add Product</h1>
        <!-- Edit Car Form -->
        <form action="edit_car.php" id="add_car" method="post">
            <label>Make:</label><br>
            <input type="text" value="<?php echo $car['car_make'];?>" name="car_Make"><br>
            <label>Model:</label><br>
            <input type="text" value="<?php echo $car['car_model'];?>" name="car_Model"><br>
            <label>Color:</label><br>
            <input type="text" value="<?php echo $car['car_color'];?>" name="car_Color"><br>
            <label>Year:</label><br>
            <input type="text" value="<?php echo $car['car_year'];?>" name="car_Year"><br>
            <label>Price:</label><br>
            <input type="text" value="<?php echo $car['car_price'];?>" name="car_Price"><br>
            <label> </label><br>
            <input type="hidden" name="car_id" value="<?php echo $car['car_id'];?>">
            <input type="submit" name="edited" value="Edit Car"><br>
        </form>
    </main>
</body>

</html>