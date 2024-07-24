<?php
require '../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch post from database in order to delete thumbnail from images
    $query = "SELECT * FROM contact WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);

    // make sure only 1 record/post was fetched
    if (mysqli_num_rows($result) == 1) {
         // delete post from database
         $delete_post_query = "DELETE FROM contact WHERE id=$id LIMIT 1";
         $delete_post_result = mysqli_query($connection, $delete_post_query);

         if (!mysqli_errno($connection)) {
             $_SESSION['delete-post-success'] = "Message from {$post['fullname']} deleted successfully";
         }
    }
}

header('location: messages.php');
die();