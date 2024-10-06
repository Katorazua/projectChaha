<?php
require '../config/database.php';
if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $doc_number = filter_var($_POST['doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$firstname){
      $_SESSION['add-user'] = "please enter Doctor's first name";
  } elseif (!$lastname) {
      $_SESSION['add-user'] = "please enter Doctor's last name";  
  } elseif (!$doc_number) {
      $_SESSION['add-user'] = "please enter Doctor's ID";  
  } elseif (!$email) {
      $_SESSION['add-user'] = "please enter a valied email";
  } elseif (strlen($password) < 8) {
      $_SESSION['add-user'] = "please Doctor's password should be 8+ characters";
  } else {
     // check if doc_number or email already exist in datagase
     $user_check_query = "SELECT * FROM doctors WHERE doc_number ='$doc_number' OR email='$email' ";
     $user_check_result = mysqli_query($connection, $user_check_query);

     if (mysqli_num_rows($user_check_result) > 0) {
         $_SESSION['add-user'] = "Doctor's Number or Email already exist or has been taken";
     }
  } 

  // redirect back to add-Doctor ppassword if there was any problem
  if (isset($_SESSION['add-user'])) {
    // pass form data back to add-user ppassword
    $_SESSION['add-user-data'] = $_POST;
    header('location:' . ROOT_URL. 'superAdmin/add-doctor.php');
    die();
  } else {

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $status = "Active now";
    $dept = "Not Assigned";
    // insert new user into doctors table
    $user_query = " INSERT INTO doctors (admin_id, firstname, lastname, email, doc_number, password, department, status, role) VALUES('$admin_id', '$firstname', '$lastname', '$email', '$doc_number', '$hashed_password', '$dept', '$status', '$role')";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manpassword-doctor ppassword with success messpassword
        $_SESSION['add-user-success'] = "New Doctor: $firstname $lastname, added successfully";
        header('location:' . ROOT_URL . 'superAdmin/manage-doctors.php');
        die();
    }
  } 
}else {
  // if button was not clicked, bounce back to add-doctor ppassword 
  header('location:'.ROOT_URL.'superAdmin/add-doctor.php');
  die();
}