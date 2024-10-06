<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    $current_admin_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prices = filter_var($_POST['prices'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    //validate form data
    if (!$title) {
       $_SESSION['add-service'] = "Enter post title";
    } elseif (!$prices) {
        $_SESSION['add-service'] = "Enter post price";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-service'] = "Please choose a thumbnail";
    } else{
       // work on post
       // rename the thumbnail
       $time = time(); // make each thumbnail name unique
       $thumbnail_name = $time . $thumbnail['name'];
       $thumbnail_tmp_name = $thumbnail['tmp_name'];
       $thumbnail_destination_path = '../images/'. $thumbnail_name;
       move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);

    }    

    if (isset($_SESSION['add-service'])) {
        $_SESSION['add-service-data'] = $_POST;
        header('location:'.ROOT_URL. 'superAdmin/manage-services.php');
        die();
    } else {
        // insert post into database
        $thumbnail_query = "INSERT INTO services (title, prices, thumbnail, author_id) VALUE ('$title', '$prices', '$thumbnail_name', '$current_admin_id')";
        $thumbnailresult = mysqli_query($connection, $thumbnail_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-service-success'] = "New service: $title added successfully";
            header('location:' .ROOT_URL. 'superAdmin/manage-services.php');
            die();
        }
    }
} else {
    $_SESSION['add-service'] = "File too big. Should be less than 40mb";

    header('location:' .ROOT_URL. 'superAdmin/manage-services.php');
    die();
}