
 <?php
require '../config/database.php';

// destroy all session and redirect to log in page 
 session_destroy();
 $status = "Offline";

 $sql = "UPDATE `doctors` 
    SET `status` = ?
    WHERE `id` = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $status, $_SESSION['user-id']);
    $stmt->execute();
    
 header('location: doc-login.php');
 die();  