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


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



// List all cars
$queryAllCars = 'SELECT * FROM cars 
                 ORDER BY car_id';
$db_list_process = $db -> prepare($queryAllCars);
$db_list_process -> execute();
$cars = $db_list_process -> fetchAll();
$db_list_process -> closeCursor();


// Edit Record On Form Submit
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

    header("Refresh:0");
};



// Delete Record Function
function deleteTableRecord($deleted_record) {
    if ($car_id != false) {
        $deleteRecord = 'DELETE FROM cars
                         WHERE car_id = :deleted_record';
        $db_delete_process = $db->prepare($deleteRecord);
        $db_delete_process->bindValue(':deleted_record', $car_id);
        $success = $db_delete_process->execute();
        $db_delete_process->closeCursor();
    }

    header("Refresh:0");
};

// Delete Record On Form Submit
if ( isset($_POST['delete']) ) {
    $deletedCarID = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
    $result = deleteTableRecord($deletedCarID);
}

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
        <h1>List of Cars</h1>
        <section>
            <table>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Year</th>
                    <th>Price</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <!-- List Cars -->
                <?php foreach ($cars as $car) : ?>
                <tr>
                    <td><?php echo $car['car_make'];?></td>
                    <td><?php echo $car['car_model'];?></td>
                    <td><?php echo $car['car_color'];?></td>
                    <td><?php echo $car['car_year'];?></td>
                    <td><?php echo $car['car_price'];?></td>
                    <td>
                        <!-- Delete Car -->
                        <form action="index.php" method="post">
                            <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                    <td>
                        <!-- Edit Car -->
                        <form action="edit_car.php" method="post">
                            <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>">
                            <input type="submit" name="edit" value="Edit">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <!-- Add Car -->
            <p><a href="add_car.php">Add New Car</a></p>
        </section>
    </main>
</body>

</html>