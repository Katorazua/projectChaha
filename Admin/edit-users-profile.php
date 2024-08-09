<?php 
include '../config/database.php';
  if (isset($_POST['submit'])) {
    // get signup form data if signup button was clicked
      $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $userfield = filter_var($_POST['userfield'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $city = filter_var($_POST['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $addr = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
    if (!$firstname || !$lastname || !$username || !$gender || !$userfield || !$email || !$phone || !$addr || !$city) {
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    } 

    // set avatar name if new one was uploaded, else keep old avatar name

    $user_query = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', username='$username', userfield='$userfield', gender='$gender', phone='$phone', city='$city', addr='$addr' WHERE id = $id LIMIT 1";
  
    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to users-profile with success message
        $_SESSION['edit-user-success'] = "$firstname $lastname, details Updated successfully.";
        header('location: users-profile.php');
        die();
    }
    
    header('location: users-profile.php');
    die();
  }
  
