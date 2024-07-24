<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch video from database in order to delete thumbnail from videos
    $query = "SELECT * FROM introduction WHERE id = $id";
    $result = mysqli_query($connection, $query);

    // make sure only 1 record/post was fetched
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $video_name = $post['video'];
        $video_path = '../videos/' . $video_name;

        if ($video_path) {
            unlink($video_path);

            // delete post from database
            $delete_video_query = "DELETE FROM introduction WHERE id=$id LIMIT 1";
            $delete_video_result = mysqli_query($connection, $delete_video_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-user-success'] = "video deleted successfully";
            }
        }
    }
}

header('location: manage-sessions.php');
die();