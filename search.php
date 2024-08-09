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

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Search Any Thing...</h1>
                <a href="<?=ROOT_URL?>event-field.php" class="h4">Home</a>
                <span class="h4 text-white">/</span>
                <a href="" class="h4 text-white">Search</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->
  
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