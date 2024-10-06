<?php

require 'config/database.php';

if (isset($_SESSION['user-id'])) { 
    $user_id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    //fetch user from database
    $user_query = "SELECT * FROM users WHERE id=$user_id";
    $user_result = mysqli_query($connection, $user_query);

    if (mysqli_num_rows($user_result) == 1) {
        
        //convert the record into assoc array
        $user_record = mysqli_fetch_assoc($user_result);
        // $db_password = $user_record['id'];


        // set session if user is super admin 
        if($user_record['role'] == 'super') {
            $_SESSION['user_is_super'] = true; 
                // log user in to
            header('location:' . ROOT_URL . 'superAdmin/index.php');

        }elseif ($user_record['role'] == 'Admin') {
                
            // set session if user is  admin
                $_SESSION['user_is_admim'] = true;
                    // log user in to
            header('location:' . ROOT_URL . 'Admin/index.php');
        }elseif ($user_record['role'] == 'Alpha') {
                
            // set session if user is  admin
                $_SESSION['user_is_alpha'] = true;
                    // log user in to
            header('location:' . ROOT_URL . 'alphaMyAdmin/index.php');

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
            header('location:' . ROOT_URL . 'pages-error-404.php');
        }          
                    
        
    }else {
        header('location:' . ROOT_URL . 'signin.php');
    }
} else {
    header('location:' . ROOT_URL . 'signin.php');
} 

