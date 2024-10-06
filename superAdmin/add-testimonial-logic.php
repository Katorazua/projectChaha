<?php
// require 'config/constants.php';
require '../config/database.php';

// get signup form data if signup button was clicked
if (isset($_POST['submit'])) {
    // get signup form data if signup button was clicked
    $current_admin_id = $_SESSION['user-id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $occupation = filter_var($_POST['occupation'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   
    $avatar = $_FILES['avatar'];

    if (!$firstname){
        $_SESSION['add-user'] = "please enter your first name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "please enter your last name";
    } elseif (!$body) {
        $_SESSION['add-user'] = "please express yourself";
    } elseif (!$email) {
        $_SESSION['add-user'] = "please enter a valied email";
    } elseif (!$occupation) {
        $_SESSION['add-user'] = "please enter your user Field";
    } elseif (!$phone) {
        $_SESSION['add-user'] = "please enter your phone contact";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "please add avatar";
    } else {
 
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
            if ($avatar['size'] < 1000000) {
                // upload avatar
                move_uploaded_file($avatar_tmp_name, $avatar_detination_path);
            } else {
                $_SESSION['add-user'] = "File size too big. shoul be lass than 1mb";
            }
        } else {
            $_SESSION['add-user'] = "File should be png, jpg, jpeg";
        }

    
    }  
    
  // redirect back to add-user page if there was any problem
    if (isset($_SESSION['add-user'])) {
        // pass form data back to add-user page
        $_SESSION['add-user-data'] = $_POST;
        header('location:' . ROOT_URL. 'superAdmin/manage-testimonials.php');
        die();
    } else {
        // insert new user into users table
        $user_query = " INSERT INTO testimonials (firstname, lastname, email, body, occupation, phone, avatar, user_id) VALUES('$firstname', '$lastname', '$email', '$body', '$occupation', '$phone','$avatar_name', '$current_admin_id')";

        $user_result = mysqli_query($connection, $user_query);

        if (!mysqli_errno($connection)) {
            // redirect to login page with success message
            $_SESSION['add-user-success'] = "$firstname $lastname, comment added successfully";
            header('location:' . ROOT_URL . 'superAdmin/manage-testimonials.php');
            die();
        }
    }

}else {
      // if button was not clicked, bounce back to add-user page 
      header('location:'.ROOT_URL.'superAdmin/manage-testimonials.php');
      die();
}
   