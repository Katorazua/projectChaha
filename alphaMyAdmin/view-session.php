<?php 
include 'partials/header.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM introduction WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
  } 
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'partials/sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Play Session Recorded</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-sessions.php">Home</a></li>
          <li class="breadcrumb-item">Session</li>
          <li class="breadcrumb-item active">Playing</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <!-- <div class="row"> -->
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                <video class="container-fluid" autoplay muted controls>
                    <source src="<?=ROOT_URL .'videos/'. $user['video']?>" type="video/mp4">
                </video>
               <h3><?= $user['title'] ?></h3>
            </div>
          </div>

        </div>
       
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include 'partials/footer.php'; ?>