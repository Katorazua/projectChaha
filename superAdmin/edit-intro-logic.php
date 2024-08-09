<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $thumbnail = $_FILES['video'];

    //validate form data
    if (!$title) {
       $_SESSION['edit-user'] = "Couldn't update video. Invalid form data on video page.";
  
    } elseif (!$thumbnail['name']) {
        $_SESSION['edit-user'] = "Couldn't update video. Invalid file type.";
    } else{
        // delete existing thumbnail if new thumbnail is available
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../videos/'. $previous_thumbnail_name; 
            if ($previous_thumbnail_path) {
               unlink($previous_thumbnail_path);
            }

            // work on thumbnail
            // rename the video
            $time = time(); // make each video name unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../videos/'. $thumbnail_name;

            move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);      
        }   
    }     
    
    if (isset($_SESSION['edit-user'])) {
        // Redirect (with form-data) to manage form page if form was invalid
       header('location:'.ROOT_URL. 'superAdmin/manage-sessions.php');
        die();
    } else {
        // set thumbnail name if new one was uploaded, else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        $query  = "UPDATE introduction SET title = '$title', video = '$thumbnail_to_insert' WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);       
    }

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-user-success'] = "video: $title, updated successfully"; 
        header('location:' .ROOT_URL. 'superAdmin/manage-sessions.php');
die();          
    }
}  else {
    $_SESSION['edit-user'] = "File too big. Should be less than 40mb";

    header('location:' .ROOT_URL. 'superAdmin/manage-sessions.php');
    die();
}

