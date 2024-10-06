<?php
include 'partials/header.php';
// fetch post from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM events WHERE category_id = $id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
  
  } else {
    header('location:'.ROOT_URL. 'index.php');
    die();
  }
?>

<main class="main">

  <!-- Call To Action Section -->
  <section id="call-to-action" class="call-to-action section accent-background">
    <?php
      // fetch category from categories table using category_id of post
      $category_id = $id;
      $category_query = "SELECT * FROM categories WHERE id=$category_id";
      $category_result = mysqli_query($connection, $category_query);
      $category =mysqli_fetch_assoc($category_result);
    ?>
    <div class="container">
      <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
        <div class="col-xl-10">
          <div class="text-center">
            <h3><?= $category['title']?></h3>
            <a href="<?=ROOT_URL?>events.php" class="h4 text-white">Home</a>
            <span class="h4 text-white">/</span>
            <a href="#" class="h4 text-white">Categories</a>
          </div>
        </div>
      </div>
    </div>

  </section><!-- /Call To Action Section --> 
  
  <!-- Events Section -->
  <section class="doctors section light-background">

    <div class="container">
      <?php if(mysqli_num_rows($posts) > 0) :?>
        <div class="row gy-4">
          <?php while ($post = mysqli_fetch_assoc($posts)) : ?> 
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="team-member">
                <div class="member-img">
                  <img src="./images/<?= $post['thumbnail']?>" class="img-fluid" alt="">
                  <div class="social">
                    <p class="text-white"><?= substr($post['body'], 0, 100) ?>...</p>
                  </div>
                </div>
                <div class="member-info">
                  <h4 class="title"><a href="<?=ROOT_URL?>event-singles.php?id=<?= $post['id']?>"><?= $post['title']?></a></h4>
                  <span><?= date("M D, Y - H:i", strtotime($post['date_time'])) ?></span>
                </div>
              </div>
            </div><!-- End Team Member -->
          <?php endwhile ?> 
        </div>
      <?php else :?>
        <div class="alert_message error text-center"><?= "No Event found" ?></div>
      <?php endif ?> 
    </div>

  </section><!-- /Events Section -->

</main>

  <?php include 'partials/footer.php'; ?>