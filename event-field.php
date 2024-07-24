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


  <!-- Hero Start -->
  <div class="container-fluid bg-primary py-5 hero-header mb-5">
      <div class="row py-3">
          <div class="col-12 text-center">
              <h1 class="display-3 text-white animated zoomIn">Events</h1>
              <a href="<?=ROOT_URL?>index.php" class="h4">Home</a>
              <span class="h4 text-white">/</span>
              <a href="#" class="h4 text-white">Recent Happenings</a>
          </div>
      </div>
  </div>
  <!-- Hero End -->

  <!-- search bar -->
  <div class="container">
    <form action="search.php" method="get" class="mx-auto" style="max-width: 600px;">
        <div class="input-group">
            <input name="search" type="text" class="form-control border-white p-3" placeholder="Search...">
            <button type="submit"  name="submit" class="btn btn-dark px-4"><i class="bi bi-search"></i></button>
        </div>
    </form>
  </div><!-- End search bar -->

  <!-- Featured section Start -->
  <div class="container-fluid py-5">
      <div class="container">
          <div class="row g-5">
          
              <div class="col-lg-12 wow slideInUp" data-wow-delay="0.1s">
              <?php if(mysqli_num_rows($featured_result) == 1) : ?>
                  <div class="section-title bg-light rounded h-100 p-5" style="background-image: url('./images/<?= $featured['thumbnail']?>');">
                      <h5 class="position-relative d-inline-block text-primary text-uppercase">Events</h5>
                      <h1 class="display-6 mb-4">Join Us & Experience The Fantacy On The Upcoming Events</h1>
                  </div>
                  <?php endif ?>
              </div>          
              </div>
          </div>
      </div>
  </div>
  <!-- Featured section End -->
    
  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog">      
    <div class="container" data-aos="fade-up"> 
      <?php if(mysqli_num_rows($posts) > 0) :?>            
      <div class="row gy-4 posts-list">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>  
        <div class="col-xl-4 col-md-6">          
          <article>
            <div class="post-img" style="margin: 1rem;">
              <img src="./images/<?= $post['thumbnail']?>" class="img-fluid">
            </div>
            <?php
                  // fetch category from categories table using category_id of post
                  $category_id = $post['category_id'];
                  $category_query = "SELECT * FROM categories WHERE id=$category_id";
                  $category_result = mysqli_query($connection, $category_query);
                  $category =mysqli_fetch_assoc($category_result);
                ?>
                <p class="post-category"><a href="<?= ROOT_URL ?>event-category.php?id=<?= $post['category_id']?>" class="category_button"><?= $category['title'];?></a></p>
            <h2 class="title">
              <a href="<?=ROOT_URL?>event-singles.php?id=<?= $post['id']?>"><?= $post['title']?></a>
            </h2>            
            <div class="d-flex align-items-center" style="padding-bottom: 2rem;">              
              <div class="post-meta">
                <p class="post-date">
                  <?= date("M D, Y - H:i", strtotime($post['date_time'])) ?>
                </p>
              </div>
            </div>
          </article>           
        </div><!-- End post list item --> 
        <?php endwhile ?>         
      </div><!-- End blog posts list --> 
      <?php else :?>
        <div class="alert_message error text-center"><?= "No Event found" ?></div>
      <?php endif ?>      
    </div>     
  </section><!-- End Blog Section -->

    

 <?php include 'partials/footer.php'; ?>