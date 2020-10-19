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
        <form action="update_car.php" id="edit_car" method="post">
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