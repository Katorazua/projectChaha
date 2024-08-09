<?php
require 'config/database.php';

// destroy all session and redirect to log in page 
 session_destroy();
 $status = "Offline";

 $sql = "UPDATE `users` 
    SET `user_mode` = ?
    WHERE `id` = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $status, $_SESSION['user-id']);
    $stmt->execute();
 header('location:' . ROOT_URL . 'signin.php');
 die();  