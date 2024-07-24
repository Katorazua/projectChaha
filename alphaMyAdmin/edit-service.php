<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM services WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location:' . ROOT_URL . 'alphaMyAdmin/index.php');
    die();
}
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Services</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Services</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Edit Service</h1>
              <hr>
              <?php if(isset($_SESSION['edit-service'])) : ?>
                  <div class="alert_message error container">
                  <p>
                    <?= $_SESSION['edit-service'];
                    unset($_SESSION['edit-service']);
                    ?>
                  </p>
                </div>
              <?php endif ?>
              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?=ROOT_URL?>alphaMyAdmin/edit-service-logic.php" method="Post" enctype="multipart/form-data">
              
                <div class="col-md-6">
                  <input type="hidden" class="form-control" name="id" value="<?= $user['id'] ?>">
                  <input type="hidden" class="form-control"  name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">                                

                  <label for="inputCity" class="form-label">Title</label>
                  <input type="text" class="form-control" name="title" value="<?= $user['title'] ?>" id="inputCity" placeholder="service title">
                </div>

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Price</label>
                  <input type="text" class="form-control" name="prices" value="<?= $user['prices'] ?>" id="inputCity" placeholder="service price">
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
  <?php include '../partials/dashboardfooter.php'; ?>