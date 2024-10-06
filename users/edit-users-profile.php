<?php 
include '../config/database.php';
  if (isset($_POST['submit'])) {
    // get signup form data if signup button was clicked
      $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $previous_avatar_name = filter_var($_POST['previous_avatar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $userfield = filter_var($_POST['userfield'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $user_mode = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $city = filter_var($_POST['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $addr = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $avatar = $_FILES['avatar'];
  
    if (!$firstname || !$lastname || !$username || !$gender || !$userfield ||!$email || !$phone || !$addr || !$city) {
        $_SESSION['edit-user'] = "Invalide user input";
    } else {

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
    }
    // set avatar name if new one was uploaded, else keep old avatar name
    $avatar_to_insert = $avatar_name ?? $previous_avatar_name;
    $user_query = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', username='$username', userfield='$userfield', gender='$gender', phone='$phone', city='$city', user_mode='$user_mode', addr='$addr', avatar='$avatar_to_insert' WHERE id = $id LIMIT 1";
  
    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to users-profile with success message
        $_SESSION['edit-user-success'] = "$firstname $lastname, details Updated successfully.";
        header('location: users-profile.php');
        die();
    }
    
  }
   header('location: users-profile.php');
   die();
