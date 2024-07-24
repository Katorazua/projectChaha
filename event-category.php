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

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
    <?php
    // fetch category from categories table using category_id of post
    $category_id = $id;
    $category_query = "SELECT * FROM categories WHERE id=$category_id";
    $category_result = mysqli_query($connection, $category_query);
    $category =mysqli_fetch_assoc($category_result);
    ?>
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn"><?= $category['title']?></h1>
                <a href="<?=ROOT_URL?>event-field.php" class="h4">Home</a>
                <span class="h4 text-white">/</span>
                <a href="" class="h4 text-white">Categories</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->
  
          <!-- ======= Blog Section ======= -->
          <section id="blog" class="blog">      
      <div class="container" data-aos="fade-up">
       <?php if (mysqli_num_rows($posts) > 0) : ?>             
        <div class="row gy-4 posts-list">
          <?php while ($post = mysqli_fetch_assoc($posts)) : ?>  
          <div class="col-xl-4 col-md-6">          
            <article>
              <div class="post-img">
                <img src="./images/<?= $post['thumbnail']?>" class="img-fluid">
              </div>          
              <h2 class="title">
                <a href="<?=ROOT_URL?>event-singles.php?id=<?= $post['id']?>"><?= $post['title']?></a>
              </h2>            
              <div class="d-flex align-items-center">
              <?php
                // fetch author from users table  using author_id
                $author_id = $post['author_id'];
                $author_query = "SELECT * FROM users WHERE id=$author_id";
                $author_result =mysqli_query($connection, $author_query);
                $author = mysqli_fetch_assoc($author_result);
                ?>               
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
        <?php else : ?>
            <div class="alert_message error"><?= "No post found for this category yet." ?></div>
            <?php endif ?>
      </div>     
    </section><!-- End Blog Section -->

    <?php include 'partials/footer.php'; ?>