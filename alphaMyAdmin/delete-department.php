<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM department WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $category = mysqli_fetch_assoc($result);

    if (!mysqli_errno($connection)) {        
        // delete category
        $query = "DELETE FROM department WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        $_SESSION['delete-category-success'] = "Department: {$category['name']} deleted successfully";
    }

}
header('location:' . ROOT_URL . 'alphaMyAdmin/manage-departments.php');
die();
