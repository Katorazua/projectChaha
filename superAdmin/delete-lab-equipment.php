<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var ($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // FETCH USER FROM DATABASE
    $query = "SELECT * FROM equipments WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);  

    // delete equipments from database
    $delete_lab_query = "DELETE FROM equipments WHERE id=$id";
    $delete_lab_result = mysqli_query($connection, $delete_lab_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Unable to delete {$user['eqp_name']} Lab Equipment";
    } else {
        $_SESSION['delete-user-success'] = "{$user['eqp_name']} Lab Equipment deleted successfully";
    }
}

header('location:' .ROOT_URL . 'superAdmin/manage-lab-equipments.php');
die();