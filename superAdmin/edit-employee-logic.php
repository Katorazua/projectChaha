<?php 
include '../config/database.php';
  if (isset($_POST['submit'])) {
    // get signup form data if signup button was clicked
      $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $previous_avatar_name = filter_var($_POST['previous_avatar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $age = filter_var($_POST['age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $city = filter_var($_POST['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $addr = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $department = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $company_name = filter_var($_POST['company_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $avatar = $_FILES['avatar'];
  
    if (!$firstname || !$lastname || !$gender || !$age || !$email || !$phone ||!$addr || !$department || !$city || !$company_name || !$role) {
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
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
    $user_query = "UPDATE employees SET firstname='$firstname', lastname='$lastname', email='$email', age='$age', gender='$gender', phone='$phone', city='$city', emp_addr='$addr', department='$department', company_name='$company_name', status='$status', avatar='$avatar_to_insert', role='$role' WHERE id = $id LIMIT 1";
  
    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manpassword-doctor ppassword with success messpassword
        $_SESSION['edit-user-success'] = "$firstname $lastname, details Updated successfully.";
        header('location: manage-employee.php');
        die();
    }
    
  }
   header('location: edit-employee.php');
   die();
