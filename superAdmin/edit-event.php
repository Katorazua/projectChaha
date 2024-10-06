<?php 
include '../partials/dashboardheader.php';

    // fetch category from database
    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $query);
    // fetch post from database if id is set
    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);    
        $query = "SELECT * FROM events WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $post = mysqli_fetch_assoc($result);   
    
    } else {
        header('location:' . ROOT_URL . 'superAdmin/index.php');
        die();
    }
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Events</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-events.php">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Events</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Edit Event</h1>
              <hr>
                <?php if(isset($_SESSION['edit-post'])) : ?>
                    <div class="alert_message error container">
                        <p>
                            <?= $_SESSION['edit-post'];
                            unset($_SESSION['edit-post']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= ROOT_URL ?>superAdmin/edit-event-logic.php" method="POST" enctype="multipart/form-data">
              
                <div class="col-md-6">
                  <input type="hidden" class="form-control"  name="id" value="<?= $post['id'] ?>">
                  <input type="hidden" class="form-control"  name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
                  <label for="inputCity" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" value="<?= $post['title'] ?>" id="inputCity" placeholder="event's title">
                </div>              

                <div class="col-md-6">
                  <label for="inputState" class="form-label">Category</label>
                  <select id="inputState" name="category" class="form-select">
                    <option selected>Choose...</option>
                    <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                      <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endwhile ?>
                  </select>
                </div>

                <div class="col-md-12">
                  <label for="inputCity" class="form-label">Content</label>
                  <!-- <input type="text" class="form-control" id="inputCity" placeholder="Name of Class Teacher"> -->
                  <textarea name="body" class="form-control text-center" placeholder="create your content body here...." cols="30" rows="5"><?= $post['body'] ?></textarea>
                </div>

                <div class="col-md-6"> 
                  <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                  <label for="is_featured">Featured</label>
                </div>

                <div class="col-md-6"> 
                  <label for="thumbnail"><i class="bi bi-plus-circle"></i>Add Thumbnail</label>
                  <input type="file" name="thumbnail" id="thumbnail">
                </div>
               
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>


        </div>

      </div>
    </section> <!-- End form section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 <?php include '../partials/dashboardfooter.php';?>