<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM contact WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $user = mysqli_fetch_assoc($result);
} 
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="messages.php">Home</a></li>
          <li class="breadcrumb-item">Message</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Message Details</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">           
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Name</div>
                    <div class="col-lg-9 col-md-8"><?=$user['fullname'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email Address</div>
                    <div class="col-lg-9 col-md-8"><?=$user['email'] ?></div>
                  </div>

                  <h5 class="card-title">Message</h5>
                  <p class="small fst-italic"><?=$user['message'] ?></p>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date/Time</div>
                    <div class="col-lg-9 col-md-8"><?=$user['date_time'] ?></div>
                  </div>

                  <div class="text-center">
                    <a href="delete-message.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Delete Message</a>                     
                  </div>
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php'; ?>