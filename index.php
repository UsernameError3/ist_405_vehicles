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

// List all cars
$queryAllCars = 'SELECT * FROM cars
                 ORDER BY car_id';
$db_list_process = $db->prepare($queryAllCars);
$db_list_process->execute();
$cars = $db_list_process->fetchAll();
$db_list_process->closeCursor();

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