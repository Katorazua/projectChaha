<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $occupation = filter_var($_POST['occupation'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
    $thumbnail = $_FILES['avatar'];

    //validate form data
    if (!$firstname || !$lastname) {
       $_SESSION['edit-user'] = "Couldn't update testimonial. Invalid form data on testimonial page.";
    } else{
        // delete existing thumbnail if new thumbnail is available
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/'. $previous_thumbnail_name; 
            if ($previous_thumbnail_path) {
               unlink($previous_thumbnail_path);
            }

            // work on thumbnail
            // rename the avatar
            $time = time(); // make each avatar name unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/'. $thumbnail_name;

            move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);      
        }   
    }     
    
    if (isset($_SESSION['edit-user'])) {
        // Redirect (with form-data) to manage form page if form was invalid
       header('location:'.ROOT_URL. 'alphaMyAdmin/manage-testimonials.php');
        die();
    } else {
        // set thumbnail name if new one was uploaded, else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        $query  = "UPDATE testimonials SET firstname='$firstname', lastname = '$lastname', email = '$email', body = '$body', occupation = '$occupation', phone = '$phone', avatar = '$thumbnail_to_insert'
         WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);       
    }

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-user-success'] = "$firstname $lastname comment updated successfully"; 
        header('location:' .ROOT_URL. 'alphaMyAdmin/manage-testimonials.php');
die();          
    }
}  else {
    $_SESSION['edit-user'] = "File too big. Should be less than 40mb";

    header('location:' .ROOT_URL. 'alphaMyAdmin/manage-testimonials.php');
    die();
}

