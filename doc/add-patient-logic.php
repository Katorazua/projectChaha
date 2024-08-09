<?php
require '../config/database.php';
if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $dob = filter_var($_POST['DOB'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $addr = filter_var($_POST['addr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_number = filter_var($_POST['pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_type = filter_var($_POST['pat_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_ailment = filter_var($_POST['pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  if (!$firstname){
      $_SESSION['add-user'] = "please enter patient's first name";
  } elseif (!$lastname) {
      $_SESSION['add-user'] = "please enter patient's last name";  
  } elseif (!$dob) {
      $_SESSION['add-user'] = "please enter patient's Date Of Birth";
  } elseif (!$age) {
      $_SESSION['add-user'] = "please enter patient's actual age";
  } elseif (!$email) {
      $_SESSION['add-user'] = "please enter a valied email";
  } elseif (!$gender) {
      $_SESSION['add-user'] = "please enter patient's gender";
  } elseif (!$addr){
      $_SESSION['add-user'] = "please enter patient's Address";
  } elseif (!$city){
      $_SESSION['add-user'] = "please enter patient's country & city";
  } elseif (!$phone){
      $_SESSION['add-user'] = "please enter patient's phone number";
  } elseif (!$pat_number){
      $_SESSION['add-user'] = "please enter patient's ID (Hospital Number)";
  } elseif (!$pat_ailment){
      $_SESSION['add-user'] = "please enter patient's ailment";
  } else {
     // check if pat_number or email already exist in datagase
     $user_check_query = "SELECT * FROM patients WHERE pat_number ='$pat_number' ";
     $user_check_result = mysqli_query($connection, $user_check_query);

     if (mysqli_num_rows($user_check_result) > 0) {
         $_SESSION['add-user'] = "Patient's Number already exist or has been taken";
     }
  } 

  // redirect back to add-patient page if there was any problem
  if (isset($_SESSION['add-user'])) {
    // pass form data back to add-user page
    $_SESSION['add-user-data'] = $_POST;
    header('location: add-patient.php');
    die();
  } else {
    // insert new user into patients table
    $user_query = " INSERT INTO patients (doc_id, pat_fname, pat_lname, pat_email, pat_dob, pat_age, pat_addr, pat_gender, pat_number, pat_phone, pat_country, pat_type, pat_ailment) VALUES('$admin_id', '$firstname', '$lastname', '$email', '$dob', '$age', '$addr', '$gender', '$pat_number', '$phone','$city','$pat_type', '$pat_ailment')";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manage-patient page with success message
        $_SESSION['add-user-success'] = "New Patient: $firstname $lastname, added successfully";
        header('location: manage-patients.php');
        die();
    }
  } 
}else {
  // if button was not clicked, bounce back to add-patient page 
  header('location: add-patient.php');
  die();
}