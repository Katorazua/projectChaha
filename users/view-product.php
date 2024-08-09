<?php 
include '../partials/usersheader.php';
if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM products WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $user = mysqli_fetch_assoc($result);
} 
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-products.php">Home</a></li>
          <li class="breadcrumb-item">Products</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
          <img src="<?= ROOT_URL . 'images/' . $user['thumbnail'] ?>" >           
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Vitals</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Desacription</h5>
                  <p class="small fst-italic"><?=$user['prd_dsc'] ?></p>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Name</div>
                    <div class="col-lg-9 col-md-8"><?=$user['prd_name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Productcode</div>
                    <div class="col-lg-9 col-md-8"><?=$user['prd_number'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Price</div>
                    <div class="col-lg-9 col-md-8"><?=$user['prd_price'] ?></div>
                  </div>
                  
                  <?php
                    $category_id = $user['prd_cat'];
                    $category_query = "SELECT title FROM categories WHERE id = $category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Product Catygory</div>
                    <div class="col-lg-9 col-md-8"><?=$category['title'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Added On</div>
                    <div class="col-lg-9 col-md-8"><?=$user['date_time'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Mfg. Date</div>
                    <div class="col-lg-9 col-md-8"><?=$user['prd_mdate'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Exp. Date</div>
                    <div class="col-lg-9 col-md-8"><?=$user['prd_xpdate'] ?></div>
                  </div>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php'; ?>