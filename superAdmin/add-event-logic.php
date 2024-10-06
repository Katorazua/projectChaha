<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //set is featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;    

    //validate form data
    if (!$title) {
       $_SESSION['add-post'] = "Enter event title";
    }elseif (!$category_id) {
        $_SESSION['add-post'] = "select event category";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Add event content/diescription";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "choose event thumbnail";
    } else{
       // work on thumbnail
       // rename the image
       $time = time(); // make each image name unique
       $thumbnail_name = $time . $thumbnail['name'];
       $thumbnail_tmp_name = $thumbnail['tmp_name'];
       $thumbnail_destination_path = '../images/'. $thumbnail_name;

       move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
    } 

    // Redirect (with form-data) to add-post if is_featured for this event is 1
    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location:'.ROOT_URL. 'superAdmin/manage-events.php');
        die();
    } else {
        // set is_featured of all events to 0 if is_featured for this event is 1
        if ($is_featured == 1) {
            $is_featured_query = "UPDATE events SET is_featured = 0";
            $is_featured_result = mysqli_query($connection, $is_featured_query);
        }

        // insert event into database
        $query  = "INSERT INTO events (title, body, thumbnail, category_id, author_id, is_featured) VALUES ('$title', '$body', '$thumbnail_name', '$category_id', '$author_id', '$is_featured')";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New Event: $title, added successfully";
            header('location:' .ROOT_URL. 'superAdmin/manage-events.php');
            die();
        }
    }
}

header('location:' .ROOT_URL. 'superAdmin/manage-events.php');
die();