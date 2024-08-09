<?php
require '../config/database.php';

if (isset($_POST['submit'])){
// get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    // validate input
    if(!$title) {
        $_SESSION['edit-category'] = "Invalid form input on edit category page.";
    } elseif (!$description) {
        $_SESSION['edit-category'] = "Invalid form input on edit category page.";
    } else {
        // update user
        $query = " UPDATE categories SET title='$title', description = '$description' WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-category'] = "$title Category update fialed";
        } else {
            $_SESSION['edit-category-success'] = "$title Category updated successfully.";
        }
    }
}

header('location: manage-categories.php');
die();