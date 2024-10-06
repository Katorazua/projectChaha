<?php
include 'partials/header.php';

if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM events WHERE title LIKE '%$search%' ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query); 
}

 // fetch 9 events from events table for each page
//  $query = "SELECT * FROM events ORDER BY date_time DESC";
//  $posts = mysqli_query($connection, $query);
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
            <a href="#" class="h4 text-white">Search</a>
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