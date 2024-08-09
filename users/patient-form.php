<?php 
include '../partials/usersheader.php';

//get back form data if there was a registration error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$dob = $_SESSION['add-user-data']['DOB'] ?? null;
$age = $_SESSION['add-user-data']['age'] ?? null;
$addr = $_SESSION['add-user-data']['addr'] ?? null;
$gender = $_SESSION['add-user-data']['gender'] ?? null;
$city = $_SESSION['add-user-data']['city'] ?? null;
$pat_number = $_SESSION['add-user-data']['pat_number'] ?? null;
$phone = $_SESSION['add-user-data']['phone'] ?? null;
$pat_ailment = $_SESSION['add-user-data']['pat_ailment'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Patient's Form</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Fill All Fields</li>
          <li class="breadcrumb-item active">Patient</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Patient's Details</h1>
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
          <form action="add-patient-logic.php" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" name="firstname" value="<?=$firstname?>" class="form-control" id="inputName5" required>
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Last Name</label>
              <input type="text" name="lastname" value="<?=$lastname?>" class="form-control" id="inputName5" required>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Date Of Birth</label>
              <input type="date" name="DOB" value="<?=$dob?>" class="form-control" id="inputName5" required>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="age" value="<?=$age?>" class="form-control" id="inputName5" required>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="email" name="email" value="<?=$email?>" class="form-control" id="inputEmail5" required>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Gender</label>
              <input type="text" name="gender" value="<?=$gender?>" class="form-control" id="inputName5" required>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Address</label>
              <input type="text" name="addr" value="<?=$addr?>" class="form-control" id="inputName5" required>
            </div>            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">City</label>
              <input type="text" name="city" value="<?=$city?>" class="form-control" id="inputName5" placeholder="provide Country and State" required>
            </div>            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Phone</label>
              <input type="text" name="phone" value="<?=$phone?>" class="form-control" id="inputName5" required>
            </div>             
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="pat_ailment" value="<?=$pat_ailment?>" class="form-control" id="inputName5" required>
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