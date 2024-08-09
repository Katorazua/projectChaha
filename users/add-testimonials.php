<?php 
include '../partials/usersheader.php';

$current_admin_id = $_SESSION['user-id'];
//get back form data if there was a registration error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$occupation = $_SESSION['add-user-data']['occupation'] ?? null;
$phone = $_SESSION['add-user-data']['phone'] ?? null;
$body = $_SESSION['add-user-data']['body'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>What's Do You Say About Us</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-testimonials.php">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Testimonial</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->    
   
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Add New Comment</h1>
              <hr>
                <?php if(isset($_SESSION['add-user'])) : ?>
                        <div class="alert_message error">
                        <p>
                            <?= $_SESSION['add-user'];
                            unset($_SESSION['add-user']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="add-testimonial-logic.php" method="POST" enctype="multipart/form-data">
              
                <div class="col-md-6">
                  <input type="text" class="form-control"  name="admin_id"  value="<?= $current_admin_id ?>" hidden>

                  <label for="inputCity" class="form-label">First Name</label>
                  <input type="text" name="firstname" class="form-control" value="<?= $firstname ?>" id="inputCity" placeholder="user's firstname" required>
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Last Name</label>
                  <input type="text" name="lastname" class="form-control" value="<?= $lastname ?>" id="inputCity" placeholder="user's lastname" required>
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Profesion</label>
                  <input type="text" name="occupation" class="form-control" value="<?=$occupation?>" id="inputCity" placeholder="user's occupation" required>
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-control" value="<?= $email ?>" id="inputCity" placeholder="user's email address" required>
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Contact</label>
                  <input type="text" name="phone" class="form-control" value="<?= $phone ?>" id="inputCity" placeholder="user's phone number" required>
                </div> 
                
                <div class="col-md-6"> 
                  <label for="avatar"><i class="bi bi-plus-circle"></i>Add User Avatar</label>
                  <br>
                  <input type="file" name="avatar" id="avatar" required>
                </div>

                <div class="col-md-12">
                  <label for="inputCity" class="form-label">Content</label>
                  <!-- <input type="text" class="form-control" id="inputCity" placeholder="Name of Class Teacher"> -->
                  <textarea name="body" class="form-control" placeholder="create your content body here...." cols="30" rows="5" required><?= $body ?></textarea>
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