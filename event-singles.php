<?php
include 'partials/header.php';
// fetch event from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM events WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
 header('location:'.ROOT_URL.'index.php');
 die();
}
?>

  <main class="main">

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Event</h3>
              <a href="<?=ROOT_URL?>events.php" class="h4 text-white">Home</a>
              <span class="h4 text-white">/</span>
              <a href="#" class="h4 text-white"><?= $post['title']?></a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->  

    <!-- About Section -->
    <section class="about section">

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
            <img src="./images/<?= $post['thumbnail']?>" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>
          <div class="col-lg-12 content" data-aos="fade-up" data-aos-delay="200">
            <h3><?= $post['title']?></h3>
            <p class="fst-italic"><?= date("M D, Y - H:i", strtotime($post['date_time'])) ?></p>
            <p><?= $post['body']?></p>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

  </main>

  <?php include 'partials/footer.php'; ?>