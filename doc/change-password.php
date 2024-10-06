<?php

require '../config/database.php';

if (isset($_POST['submit']) ) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpassword = filter_var($_POST['currentpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $newpassword = filter_var($_POST['newpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $renewpassword = filter_var($_POST['renewpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (strlen($cpassword) < 8 || strlen($newpassword) < 8 || strlen($renewpassword) < 8) {
        $_SESSION['edit-user'] = "Password should be at least 8 characters";
        header('location: users-profile.php');
        exit;
    }

    if ($newpassword !== $renewpassword) {
        $_SESSION['edit-user'] = "Passwords do not match";
        header('location: users-profile.php');
        exit;
    }

    $query = "SELECT password FROM doctors WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $db_password = $row['password'];

    if (password_verify($cpassword, $db_password)) {
        $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

        $update_query = "UPDATE doctors SET password = ? WHERE id = ? LIMIT 1";
        $update_stmt = mysqli_prepare($connection, $update_query);
        mysqli_stmt_bind_param($update_stmt, "si", $hashed_password, $id);

        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION['edit-user-success'] = "Password updated successfully";
            header('location: users-profile.php');
            exit;
        } else {
            $_SESSION['edit-user'] = "Error updating password";
            header('location: users-profile.php');
            exit;
        }
    } else {
        $_SESSION['edit-user'] = "Current password is incorrect";
        header('location: users-profile.php');
        exit;
    }
}
