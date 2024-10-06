<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $prices = filter_var($_POST['prices'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $thumbnail = $_FILES['thumbnail'];

    //validate form data
    if (!$title || !$thumbnail['name'] || !$prices) {
        $_SESSION['edit-service'] = "Couldn't update . Invalid form data ";
    } else{
        // delete existing thumbnail if new thumbnail is available
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/'. $previous_thumbnail_name; 
            if ($previous_thumbnail_path) {
               unlink($previous_thumbnail_path);
            }

            // work on thumbnail
            // rename the thumbnail
            $time = time(); // make each thumbnail name unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/'. $thumbnail_name;

            move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);      
        }   
    }     
    
    if (isset($_SESSION['edit-service'])) {
        // Redirect (with form-data) to manage form page if form was invalid
       header('location: manage-services.php');
        die();
    } else {
        // set thumbnail name if new one was uploaded, else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        $query  = "UPDATE services SET title = '$title', prices = '$prices', thumbnail = '$thumbnail_to_insert' WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);       
    }

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-service-success'] = "Service Type: $title, updated successfully"; 
        header('location: manage-services.php');
        die();          
    }
}  else {
    $_SESSION['edit-service'] = "File too big. Should be less than 40mb";

    header('location: manage-services.php');
    die();
}

