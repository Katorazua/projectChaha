<?php 
include '../config/database.php';

if (isset($_POST['submit'])) {
    // get signup form data if signup button was clicked
    $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $previous_avatar_name = filter_var($_POST['previous_avatar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['file'];  

    // delete existing avatar if new avatar is available
    if ($avatar['name']) {
        $previous_avatar_path = '../images/'. $previous_avatar_name; 
        if ($previous_avatar_path) {
            unlink($previous_avatar_path);
        }

        // Work on avater, rename avatar
        $time = time();  //make each image name unique using current timestamp
        $avatar_name = $time . $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_detination_path = '../images/' . $avatar_name;

        // make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $avatar_name);
        $extention = end($extention);
        if (in_array($extention, $allowed_files)) {
            // make sure image is not larger than 1mb+
            move_uploaded_file($avatar_tmp_name, $avatar_detination_path);

        } else {
            $_SESSION['add-user'] = "File should be png, jpg, jpeg";
        } 
    }
        
    // set avatar name if new one was uploaded, else keep old avatar name
    $avatar_to_insert = $avatar_name ?? $previous_avatar_name;
    $user_query = "UPDATE doctors SET avatar='$avatar_to_insert' WHERE id = $id LIMIT 1";
  
    $user_result = mysqli_query($connection, $user_query);
  
    if (!mysqli_errno($connection)) {
        // redirect to users-profile with success message
        $_SESSION['edit-user-success'] = "Profile Image Updated successfully.";
        header('location: users-profile.php');
        die();
    }
    
  }
  header('location: users-profile.php');
  die();