<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch post from database in order to delete avatar from images
    $query = "SELECT * FROM testimonials WHERE id = $id";
    $result = mysqli_query($connection, $query);

    // make sure only 1 record/post was fetched
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $avatar_name = $post['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        if ($avatar_path) {
            unlink($avatar_path);

            // delete post from database
            $delete_post_query = "DELETE FROM testimonials WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($connection, $delete_post_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-user-success'] = "User content deleted successfully";
            }
        }
    }
}

header('location:' .ROOT_URL. 'superAdmin/manage-testimonials.php');
die();