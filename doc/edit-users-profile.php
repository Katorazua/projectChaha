<?php 
include '../config/database.php';

if (isset($_POST['submit'])) {
    // get signup form data if signup button was clicked
      $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $previous_avatar_name = filter_var($_POST['previous_avatar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      $about = filter_var($_POST['about'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $relationship = filter_var($_POST['relationship'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $job = filter_var($_POST['job'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $company = filter_var($_POST['company'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $city = filter_var($_POST['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $addr = filter_var($_POST['addr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $twitter = filter_var($_POST['twitter'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $facebook = filter_var($_POST['facebook'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $instagram = filter_var($_POST['instagram'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $linkedin = filter_var($_POST['linkedin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
    if (!$firstname || !$lastname || !$gender || !$job || !$email || !$phone ||!$addr || !$city) {
        $_SESSION['edit-user'] = "please enter all fields";
    } 
    // set avatar name if new one was uploaded, else keep old avatar name
    $user_query = "UPDATE doctors SET firstname='$firstname', lastname='$lastname', email='$email', doc_about='$about', job='$job', company_name='$company', doc_gender='$gender', relationship='$relationship', doc_phone='$phone', doc_city='$city', doc_addr='$addr', status='$status', twitter='$twitter', facebook='$facebook', instagram='$instagram', linkedin='$linkedin' WHERE id = $id LIMIT 1";
  
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