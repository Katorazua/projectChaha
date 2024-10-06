<?php 
include '../partials/dashboardheader.php';
//get back form data if there was a registration error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['password'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Doctor Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Form</li>
          <li class="breadcrumb-item active">Staff</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Doctors/Consultants/Others</h1>
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
          <form action="<?=ROOT_URL?>superAdmin/add-doctor-logic.php" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" name="firstname" value="<?= $firstname ?>" class="form-control" id="inputName5" placeholder="firstname">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Last Name</label>
              <input type="text" name="lastname" value="<?=$lastname?>" class="form-control" id="inputName5" placeholder="lastname">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">ID</label>
              <?php 
                  $length = 5;    
                  $doc_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
              ?>
              <input type="text" name="doc_number" value="CEH/DOC/<?= $doc_number?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="email" name="email" value="<?=$email?>" class="form-control" id="inputEmail5" placeholder="email address">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Password</label>
              <input type="password" name="password" value="<?=$password?>" class="form-control" id="inputEmail5" placeholder="password">
            </div> 
            <div class="col-md-6">
              <label for="inputState" class="form-label">Role</label>
              <select id="inputState" name="role" class="form-select">
                <option selected>Choose user role...</option>
                <option value="Medical_Doctor">Medical Doctor</option>
                <!-- <option value="Consultant">Consultant</option> -->
              </select>
            </div>            
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php' ?>