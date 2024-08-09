<?php 
include '../partials/usersheader.php';
// fetch users from database but not Super admin
 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>NHIS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">NHIS</li>
          <li class="breadcrumb-item active">Registration</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Loading ....</h5>
                    <p>If this message last for 3 days please contact the Admin on (Contact Us)</p>

                    <!-- Center aligned spinner -->
                    <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div><!-- End Center aligned spinner -->

                  </div>
                </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section> <!-- End table section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php'; ?>