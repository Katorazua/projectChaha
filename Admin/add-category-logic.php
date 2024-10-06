<?php
require "../config/database.php";

if (isset($_POST['submit'])) {
    // get form data
    $admin_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$title || !$description) {
        $_SESSION['add-category'] = "all fields are required!";
    }

    // Redirect to add category page with form data if there was invalid input.
    if (isset($_SESSION['add-category'])){
        $_SESSION['add-category-data'] = $_POST;
        header('location: manage-categories.php');
        die();
    } else {
        // insert  category into database
        $query = "INSERT INTO categories (admin_id, title, description) VALUE ('$admin_id', '$title', '$description')";
        $result = mysqli_query($connection, $query);
        if (mysqli_errno($connection)) {
            $_SESSION['add-category'] = "Couldn't add categoty";
            header('location: manage-categories.php');
            die();
        } else {
            $_SESSION['add-category-success'] = "Category $title added successfully";
            header('location: manage-categories.php');
            die();
        }
    }
}