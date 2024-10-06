<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var ($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // FETCH USER FROM DATABASE
    $query = "SELECT * FROM pharmaceuticals WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);  

    // delete pharmaceutical from database
    $delete_phar_query = "DELETE FROM pharmaceuticals WHERE id=$id";
    $delete_phar_result = mysqli_query($connection, $delete_phar_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Unable to delete {$user['phar_name']} pharmaceutical";
    } else {
        $_SESSION['delete-user-success'] = "{$user['phar_name']} pharmaceutical deleted successfully";
    }
}

header('location:' .ROOT_URL . 'superAdmin/manage-pharmaceuticals.php');
die();