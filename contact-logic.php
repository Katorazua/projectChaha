<?php require 'config/database.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];    
    $subject = $_POST['subject'];
    $hps = "CEH";

    $user_query = " INSERT INTO contact (hps, fullname, email, subject, message) VALUES('$hps', '$name', '$email', '$subject', '$message')";
    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // echo "Message sent successfully!";
        $_SESSION['add-user-success'] = "Message sent successfully!";
    } else {
        echo "Error sending message.";
        $_SESSION['add-user'] = "Error sending message.";
    }
} 
header('location: contact.php');
exit();