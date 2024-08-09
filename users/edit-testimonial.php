<?php 
include '../partials/usersheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM testimonials WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location:' . ROOT_URL . 'superAdmin/manage-testimonials.php');
    die();
}
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Testimonials</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Testimonials</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Edit Comment</h1>
              <hr>
                <?php if(isset($_SESSION['edit-user'])) : ?>
                        <div class="alert_message error container">
                        <p>
                            <?= $_SESSION['edit-user'];
                            unset($_SESSION['edit-user']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= ROOT_URL ?>superAdmin/edit-testimonial-logic.php" method="POST" enctype="multipart/form-data">
              
                <div class="col-md-6">
                  <input type="hidden" class="form-control" name="id" value="<?= $user['id'] ?>">
                  <input type="hidden" class="form-control"  name="previous_thumbnail_name" value="<?= $user['avatar'] ?>">                                 

                  <label for="inputCity" class="form-label">First Name</label>
                  <input type="text" name="firstname" class="form-control" value="<?= $user['firstname'] ?>" id="inputCity" placeholder="user's firstname">
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Last Name</label>
                  <input type="text" name="lastname" class="form-control" value="<?= $user['lastname'] ?>" id="inputCity" placeholder="user's lastname">
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Profesion</label>
                  <input type="text" name="occupation" class="form-control" value="<?=$user['occupation'] ?>" id="inputCity" placeholder="user's occupation">
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" id="inputCity" placeholder="user's email address">
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Contact</label>
                  <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" id="inputCity" placeholder="user's phone number">
                </div> 
                
                <div class="col-md-6"> 
                  <label for="avatar"><i class="bi bi-plus-circle"></i>Add User Avatar</label>
                  <br>
                  <input type="file" name="avatar" id="avatar">
                </div>

                <div class="col-md-12">
                  <label for="inputCity" class="form-label">Content</label>
                  <!-- <input type="text" class="form-control" id="inputCity" placeholder="Name of Class Teacher"> -->
                  <textarea name="body" class="form-control" placeholder="create your content body here...." cols="30" rows="5"><?= $user['body'] ?></textarea>
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