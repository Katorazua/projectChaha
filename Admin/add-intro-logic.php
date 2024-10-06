<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    // $current_admin_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $video = $_FILES['video'];

    //validate form data
    if (!$title) {
       $_SESSION['add-user'] = "Enter post title";
    } else{
       // work on post
       // rename the video
       $time = time(); // make each video name unique
       $video_name = $time . $video['name'];
       $video_tmp_name = $video['tmp_name'];
       $video_destination_path = '../videos/'. $video_name;
       move_uploaded_file($video_tmp_name, $video_destination_path);

    }    

    if (isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST;
        header('location: manage-sessions.php');
        die();
    } else {
        // insert post into database
        $video_query = "INSERT INTO introduction (title, video) VALUE ('$title', '$video_name')";
        $videoresult = mysqli_query($connection, $video_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-user-success'] = "New video: $title, added successfully";
            header('location: manage-sessions.php');
            die();
        }
    }
} else {
    $_SESSION['add-user'] = "File too big. Should be less than 40mb";

    header('location: manage-sessions.php');
    die();
}