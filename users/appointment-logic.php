<?php 
include '../config/database.php';

if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $user_id = $_SESSION['user-id'];
    $ap_pat_name = filter_var($_POST['ap_pat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_pat_email = filter_var($_POST['ap_pat_email'], FILTER_VALIDATE_EMAIL);
    $ap_service = filter_var($_POST['ap_service'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_pat_ailment = filter_var($_POST['ap_pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ref_code = filter_var($_POST['ref_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_date = filter_var($_POST['ap_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_pat_number = filter_var($_POST['ap_pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$ap_pat_ailment || !$ap_pat_name || !$ap_pat_email || !$ap_date || !$ap_pat_number){
    $_SESSION['add-user'] = "please enter all fields";    
  } else {

    // redirect back to add-patient page if there was any problem
    if (isset($_SESSION['add-user'])) {
        // pass form data back to add-user page
        $_SESSION['add-user-data'] = $_POST;
        header('location: make-appointment.php');
        die();
    } else {
        // insert new user into apointments table
        $status = "successful";
        $user_query = " INSERT INTO  appointments (user_id, ap_pat_name, ap_pat_email, ap_pat_ailment, ap_pat_phone, ap_service, ref_code, ap_date, status) VALUES('$user_id', '$ap_pat_name', '$ap_pat_email', '$ap_pat_ailment', '$ap_pat_number', '$ap_service', '$ref_code', '$ap_date', '$status')";
        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['add-user'] = "Patient Appointment Rquiest fialed";
        } else {
          // set session for user authorization
          $_SESSION['user_is_successful'] = true;

          $_SESSION['add-user-success'] = "$ap_pat_name Appointment Rquiest Sent successfully.";
          header('location: make-appointment.php');
          die();
        }
    }
  }
  
} else {
    header('location: make-appointment.php');
    die();
}