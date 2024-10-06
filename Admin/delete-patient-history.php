<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch post from database in order to delete avatar from images
    $query = "SELECT * FROM patient_transfer WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // make sure only 1 record/post was fetched
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $avatar_name = $post['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        if ($avatar_path) {
            unlink($avatar_path);

            // delete post from database
            $delete_post_query = "DELETE FROM patient_transfer WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($connection, $delete_post_query);

            if (mysqli_errno($connection)) {
                $_SESSION['delete-user'] = "Unable to delete {$user['pat_fname']} {$user['pat_lname']}";
            } else {
                $_SESSION['delete-user-success'] = "{$user['pat_fname']} {$user['pat_lname']} deleted successfully";
            }
        }
    }
}

header('location: history.php');
die();