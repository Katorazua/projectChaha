<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM equipments WHERE id=$id";
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
          <li class="breadcrumb-item"><a href="manage-lab-equipments.php">Home</a></li>
          <li class="breadcrumb-item">Equipment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
          <img src="<?=ROOT_URL?>img/hosp_asset.jpg" >           
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Desacription</h5>
                  <p class="small fst-italic"><?=$user['eqp_desc'] ?></p>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Name</div>
                    <div class="col-lg-9 col-md-8"><?=$user['eqp_name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Barcode(EAN-8)</div>
                    <div class="col-lg-9 col-md-8"><?=$user['eqp_code'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Quqntity</div>
                    <div class="col-lg-9 col-md-8"><?=$user['eqp_qty'] ?></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Vendor</div>
                    <div class="col-lg-9 col-md-8"><?=$user['eqp_vendor'] ?></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Equipment Status</div>
                    <div class="col-lg-9 col-md-8"><?=$user['eqp_status'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Created On</div>
                    <div class="col-lg-9 col-md-8"><?=$user['date_time'] ?></div>
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