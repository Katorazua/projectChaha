<?php
include 'partials/header.php';
// fetch event from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM events WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
 header('location:'.ROOT_URL.'idex.php');
 die();
}
?>

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Event</h1> 
                <a href="<?=ROOT_URL?>event-field.php" class="h4">Home</a>
                <span class="h4 text-white">/</span>
                <a href="#" class="h4 text-white"><?= $post['title']?></a>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Testimonial Start -->
    
    <div class="container blog py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">                   
                <div class="testimonial-item text-center ">
                    <div class="post-img" style="margin: 1rem;">
                        <img src="./images/<?= $post['thumbnail']?>" class="img-fluid">
                    </div>
                    <p><?= date("M D, Y - H:i", strtotime($post['date_time'])) ?></p>
                    <hr class="mx-auto w-25" style="color: #333;">
                    <h4 class=" mb-0"><?= $post['title']?></h4>
                    <p style=" text-align:left; justify-content: left;"><?= $post['body']?></p>
                </div>                     
            </div>
        </div>
    </div>

    <!-- Testimonial End -->
    
    <?php include 'partials/footer.php'; ?>