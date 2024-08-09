<?php 
include '../partials/usersheader.php';

//get back form data if there was a registration error
if(isset($_SESSION['user-id'])){
    $userID = $_SESSION['user-id'];
    $user_query = "SELECT * FROM users WHERE id=$userID";
    $user_result = mysqli_query($connection,$user_query);
    $user = mysqli_fetch_assoc($user_result);
}

//get back form data if there was a registration error
$ap_pat_ailment = $_SESSION['add-user-data']['ap_pat_ailment'] ?? null;
$ap_date = $_SESSION['add-user-data']['ap_date'] ?? null;
$ap_pat_number = $_SESSION['add-user-data']['ap_pat_number'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Make Appointment </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Appointment</li>
          <li class="breadcrumb-item active">Form</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Fill All Fields</h1>
          <hr>
            <?php if(isset($_SESSION['add-user-success'])) :  // show if add-user is successful ?>
                <div class="alert_message success text-center container">
                    <p>
                    <?=  $_SESSION['add-user-success'];
                    unset($_SESSION['add-user-success']);
                    ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['add-user'])) :  // show if add-user was NOT successful ?>
                <div class="alert_message error container">
                    <p>
                    <?=  $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                    ?>
                    </p>
                </div>
            <?php endif ?>
          <!-- Multi Columns Form -->
            <?php
                //  fetch services from database
                $query = "SELECT * FROM services ORDER BY RAND()";
                $services = mysqli_query($connection, $query);
            ?>
          <form action="appointment-logic.php" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Full Name</label>
              <input type="text" name="ap_pat_name" value="<?="{$user['firstname']} {$user['lastname']}"?>" class="form-control bg-light border-0" placeholder="Your Name (in full)" style="height: 55px;" required>
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Patient's Ailment</label>
              <input type="text" name="ap_pat_ailment" class="form-control bg-light border-0" value="<?=$ap_pat_ailment?>" placeholder="Your Ailment" style="height: 55px;" required>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email Address</label>
              <input type="email" name="ap_pat_email" value="<?= $user['email'] ?>" class="form-control bg-light border-0" placeholder="Your Email" style="height: 55px;" required>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Appointment Date</label>
              <input name="ap_date" type="date" value="<?=$ap_date?>"
                class="form-control bg-light border-0 datetimepicker-input"
                placeholder="Appointment Date" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;" required>
            </div>
            <div class="col-md-6" style="display: none;">
              <label for="inputEmail5" class="form-label">Appointment Number</label>
                <?php 
                    $length = 5;    
                    $ref_code =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                ?>
                <div class="time" id="time1" data-target-input="nearest">
                    <input name="ref_code" type="text" value="<?=$ref_code?>"
                        class="form-control bg-light border-0 datetimepicker-input"
                        placeholder="Apointment Number" data-target="#time1" data-toggle="datetimepicker" style="height: 55px;">
                </div>
           </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Phone</label>
              <input type="text" name="ap_pat_number" value="<?=$ap_pat_number?>"
                class="form-control bg-light border-0 datetimepicker-input"
                placeholder="Your Phone Number" data-target="#time1" data-toggle="datetimepicker" style="height: 55px;" required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail5" class="form-label">Services</label>
                <select name="ap_service" class="form-select bg-light border-0" style="height: 55px;">
                    <option selected>Select A Service</option>
                    <?php while ($service = mysqli_fetch_assoc($services)) : ?>
                        <option value="<?= $service['title'] ?>"><?= $service['title'] ?></option>
                    <?php endwhile ?>
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