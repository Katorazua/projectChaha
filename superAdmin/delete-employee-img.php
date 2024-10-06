<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch post from database in order to delete avatar from images
    $query = "SELECT avatar FROM employees WHERE id = $id";
    $result = mysqli_query($connection, $query);

    // make sure only 1 record/post was fetched
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $avatar_name = $post['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        if ($avatar_path) {
            unlink($avatar_path);          

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-post-success'] = "User Avatar deleted successfully";
            }
        }
    }
}

header('location:' .ROOT_URL. 'superAdmin/manage-employee.php');
die();