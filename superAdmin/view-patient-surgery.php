<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM surgery WHERE id=$id";
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
          <li class="breadcrumb-item"><a href="manage-pat-surgery.php">Home</a></li>
          <li class="breadcrumb-item">Surgery | Theatre</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
          <img src="<?=ROOT_URL?>img/surg.png" >           
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

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Patient Name</div>
                    <div class="col-lg-9 col-md-8"><?=$user['s_pat_name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Patient Number</div>
                    <div class="col-lg-9 col-md-8"><?=$user['s_pat_number'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Patient Ailment</div>
                    <div class="col-lg-9 col-md-8"><?=$user['s_pat_ailment'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Surgery Record Number</div>
                    <div class="col-lg-9 col-md-8"><?=$user['s_number'] ?></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Surgeon</div>
                    <div class="col-lg-9 col-md-8">Dr. <?=$user['s_doc'] ?></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Surgery Status</div>
                    <div class="col-lg-9 col-md-8"><?=$user['s_pat_status'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Surgery Date/Time</div>
                    <div class="col-lg-9 col-md-8"><?=$user['s_pat_date'] ?></div>
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