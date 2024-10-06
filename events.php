<?php 
  include 'partials/header.php';
  // fetch featured post from database
  $featured_query = "SELECT * FROM events WHERE is_featured = 1";
  $featured_result = mysqli_query($connection, $featured_query);
  $featured = mysqli_fetch_assoc($featured_result);

  // fetch 9 events from events table for each page
  $query = "SELECT * FROM events ORDER BY date_time DESC";
  $posts = mysqli_query($connection, $query);

?>

  <main class="main">

    <!-- Featured Section -->
    <section id="hero" class="hero section">

      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
      <?php if(mysqli_num_rows($featured_result) == 1) : ?>
        <div class="carousel-item active">
          <img src="./images/<?= $featured['thumbnail']?>" alt="Featured">
          <!-- search bar -->
          <div class="container">
            <h2><?= $featured['title'] ?></h2>
            <p><?= substr($featured['body'], 0, 250) ?>...</p>
            <form action="search.php" method="get" class="mx-auto" style="max-width: 600px;">
                <div class="input-group">
                    <input name="search" type="text" class="form-control border-white p-3" placeholder="Search...">
                    <button type="submit"  name="submit" class="btn btn-dark px-4"><i class="bi bi-search"></i></button>
                </div>
            </form>
          </div><!-- End search bar -->
        </div><!-- End Carousel Item -->
        <?php endif ?>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

      </div>

    </section><!-- /Featured Section -->

    <!-- Events Section -->
    <section class="doctors section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Events</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->
      <div class="container">
        <?php if(mysqli_num_rows($posts) > 0) :?>
          <div class="row gy-4">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?> 
              <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="team-member">
                  <?php
                    // fetch category from categories table using category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category =mysqli_fetch_assoc($category_result);
                  ?>
                  <div class="member-img">
                    <img src="./images/<?= $post['thumbnail']?>" class="img-fluid" alt="">
                    <div class="social">
                      <p class="text-white"><?= substr($post['body'], 0, 100) ?>...</p>
                    </div>
                  </div>
                  <div class="member-info">
                    <h4 class="title"><a href="<?=ROOT_URL?>event-singles.php?id=<?= $post['id']?>"><?= $post['title']?></a></h4>
                    <span>
                     <a href="<?= ROOT_URL ?>event-category.php?id=<?= $post['category_id']?>" class="category_button"><?= $category['title'];?></a>
                    </span>
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