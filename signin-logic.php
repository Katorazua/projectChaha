<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   

    if (!$username_email || !$password) {
        $_SESSION['signin'] = "All user fields required.";
    }else {
        //fetch user from database
        $fetch_user_query = "SELECT * FROM users  WHERE username='$username_email' OR email = '$username_email' ";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query); 

        if (mysqli_num_rows($fetch_user_result) == 1) {
            //convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
    
            //compare form password with database password
            if (password_verify($password, $db_password)) {
                // set session for access control
                $_SESSION['user-id'] = $user_record['id'];

                    // update user's details
                    $status = "Active now";
                    $sql = "UPDATE `users` 
                        SET `user_mode` = ?
                        WHERE `id` = ?";
                        $stmt = $connection->prepare($sql);
                        $stmt->bind_param("ss", $status, $_SESSION['user-id']);
                        $stmt->execute();

                // set session if user is super admin 
                if($user_record['role'] == 'super') {
                    $_SESSION['user_is_admim'] = true; 
                      // log user in to
                 header('location:' . ROOT_URL . 'superAdmin/index.php');

                }elseif ($user_record['role'] == 'Alpha') {                      
                    // set session if user is  alpha
                        $_SESSION['user_is_admim'] = true;
                            // log user in to
                    header('location:' . ROOT_URL . 'alphaMyAdmin/index.php');

                }elseif ($user_record['role'] == 'Admin') {                      
                    // set session if user is  admin
                        $_SESSION['user_is_admim'] = true;
                            // log user in to
                    header('location:' . ROOT_URL . 'Admin/index.php');

                }elseif ($user_record['role'] == 'Bronze') {                      
                    // set session if user is  Bronze
                        $_SESSION['user_is_bronze'] = true;
                            // log user in to
                    header('location:' . ROOT_URL . 'users/index.php');

                }elseif ($user_record['role'] == 'Silver') {                      
                    // set session if user is  Silver
                        $_SESSION['user_is_silver'] = true;
                            // log user in to
                    header('location:' . ROOT_URL . 'users/index.php');

                }elseif ($user_record['role'] == 'Gold') {                      
                    // set session if user is  Gold
                        $_SESSION['user_is_gold'] = true;
                            // log user in to
                    header('location:' . ROOT_URL . 'users/index.php');
                    
                }elseif ($user_record['role'] == 'Diamond') {                      
                    // set session if user is  Diamond
                        $_SESSION['user_is_diamond'] = true;
                            // log user in to
                    header('location:' . ROOT_URL . 'users/index.php');

                }else{                  
                    // display what only the regular user is supposed to see
                    header('location:' . ROOT_URL . 'index.php');
                }         
                         
            } else {                
                $_SESSION['signin'] = "Please check your input";
            }
        
        } else {
            $_SESSION['signin'] = "User not found. Please signup";
        }
    }

    // if any problem, redirect to signin page with login data
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location:' . ROOT_URL . 'signin.php');
        die();
    } 


} else {
    header('location:' . ROOT_URL . 'signin.php');
} 
