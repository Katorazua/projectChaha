<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch thumbnail from database in order to delete thumbnail from thumbnails
    $query = "SELECT * FROM services WHERE id = $id";
    $result = mysqli_query($connection, $query);

    // make sure only 1 record/post was fetched
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);

            // delete post from database
            $delete_thumbnail_query = "DELETE FROM services WHERE id=$id LIMIT 1";
            $delete_thumbnail_result = mysqli_query($connection, $delete_thumbnail_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-service-success'] = "Service Type deleted successfully";
            }
        }
    }
}

header('location:' .ROOT_URL. 'superAdmin/manage-services.php');
die();