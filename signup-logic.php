<?php
require 'config/database.php';
// get signup form data if signup button was clicked
if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userfield = filter_var($_POST['userfield'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $terms = filter_var($_POST['terms'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 
    $avatar = $_FILES['avatar'];
    
    // User validate input value
    if (!$firstname || !$lastname || !$username || !$email || !$phone || !$userfield || strlen($createpassword) < 8 || strlen($confirmpassword) < 8 || !$avatar['name']) {
        $_SESSION['signup'] = "please all fields are required!";
    } elseif (!$terms) {
        $_SESSION['signup'] = "please you must agree to the terms & condition";
    } else {
        // check if password don't match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Password do not match";
        } else {
            // Hashed password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
            
            // check if user name or email already exist in datagase
            $user_check_query = "SELECT * FROM forgetpass WHERE username='$username' OR email = '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "user name or email already exist";
            } else {
                // Work on avater, rename avatar
                $time = time();  //make each image name unique using current timestamp
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_detination_path = 'images/' . $avatar_name;

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
                        $_SESSION['signup'] = "File size too big. shoul be lass than 1mb";
                    }
                } else {
                    $_SESSION['signup'] = "File should be png, jpg, jpeg";
                }

            }
        }
    }  
    
    // redirect back to signup page if there was any problem
    if (isset($_SESSION['signup'])) {
        // pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location:' . ROOT_URL. 'signup.php#msg');
        die();
    } else {
        $user_mode = "Active now";
        $terms = "I accept";

        $user_query = " INSERT INTO users (firstname, lastname, username, email, phone, gender, userfield, password, avatar, role, user_mode, terms) VALUES('$firstname', '$lastname', '$username', '$email', '$phone', '$gender', '$userfield', '$hashed_password', '$avatar_name', ' $role', '$user_mode', '$terms')";

        $user_result = mysqli_query($connection, $user_query);
        if (!mysqli_errno($connection)) {
            // redirect to login page with success message
            $_SESSION['signup-success'] = "Registration successful. Please login now";
            header('location:' . ROOT_URL . 'signin.php#msg');
            die();
        }
    }

} else {
    // if button was not clicked, bounce back to signup page 
    header('location:'.ROOT_URL.'signup.php#msg');
    die();
}