<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var ($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // FETCH USER FROM DATABASE
    $query = "SELECT * FROM medical_records WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);  

    // delete patient from database
    $delete_patient_query = "DELETE FROM medical_records WHERE id=$id";
    $delete_patient_result = mysqli_query($connection, $delete_patient_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Unable to delete {$user['mdr_pat_name']} Medical Record";
    } else {
        $_SESSION['delete-user-success'] = "{$user['mdr_pat_name']} Medical Record deleted successfully";
    }
}

header('location: manage-medical-record.php');
die();