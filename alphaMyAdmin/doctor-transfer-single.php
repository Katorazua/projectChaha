<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM doctors WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $doc_number = filter_var($_POST['doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dept = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ref_hospital = filter_var($_POST['ref_hospital'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date_transfer = filter_var($_POST['date_transfer'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$firstname){
      $_SESSION['edit-user'] = "Invalid form input.";
  } elseif (!$lastname) {
      $_SESSION['edit-user'] = "Invalid form input.";  
  } elseif (!$doc_number) {
      $_SESSION['edit-user'] = "Invalid form input.";  
  } elseif (!$dept) {
      $_SESSION['edit-user'] = "Invalid form input.";
  } elseif (!$email) {
      $_SESSION['edit-user'] = "Invalid form input.";
  } elseif (!$ref_hospital) {
     $_SESSION['edit-user'] = "Please enter Doctor's referral hospital.";
  } elseif (!$date_transfer) {
     $_SESSION['edit-user'] = "Please enter Doctor's date transferd.";
  } else {

         // check if user name or email already exist in datagase
      $user_check_query = "SELECT doc_number, ref_hospital FROM doc_transfer WHERE doc_number='$doc_number' OR ref_hospital = '$ref_hospital'";
      $user_check_result = mysqli_query($connection, $user_check_query);

      if (mysqli_num_rows($user_check_result) > 0) {
          $_SESSION['edit-user'] = "Doctor has already been transfered to $ref_hospital";
      } else {
        $status = "Transfered";
        // insert new user into doctor-transfer table
        $user_query = " INSERT INTO doc_transfer (admin_id, firstname, lastname, email, department, doc_number, ref_hospital, date_transfer, status) VALUES('$admin_id', '$firstname', '$lastname', '$email', '$dept', '$doc_number','$ref_hospital', '$date_transfer', '$status')";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Doctor's transfer fialed";
        } else {
            $_SESSION['edit-user-success'] = "Doctor: $firstname $lastname details has been transfered to $ref_hospital successfully. Click on 'Home'";
        }
      }
    }
}

// featch category from database
$query = "SELECT * FROM department";
$department = mysqli_query($connection, $query);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Transfer To Refferal Company</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-doctors.php">Home</a></li>
          <li class="breadcrumb-item">Hospital/Institution/Industry/Company</li>
          <li class="breadcrumb-item active">Doctors/Consultants/Others</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Fill All Fields </h1>
          <hr>
            <?php if(isset($_SESSION['edit-user-success'])) :  // show if edit-user is successful ?>
                <div class="alert_message success text-center container">
                    <p>
                    <?=  $_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']);
                    ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['edit-user'])) :  // show if edit-user was NOT successful ?>
                <div class="alert_message error container">
                    <p>
                    <?=  $_SESSION['edit-user'];
                    unset($_SESSION['edit-user']);
                    ?>
                    </p>
                </div>
            <?php endif ?>
          <!-- Multi Columns Form -->
          <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" name="firstname" value="<?= $user['firstname'] ?>" class="form-control" id="inputName5" placeholder="firstname">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Last Name</label>
              <input type="text" name="lastname" value="<?=$user['lastname']?>" class="form-control" id="inputName5" placeholder="lastname">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="text" name="email" value="<?= $user['email']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">ID</label>
              <input type="text" name="doc_number" value="<?= $user['doc_number']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Department</label>
              <input type="text" name="department" value="<?= $user['department']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>  
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Refferal Hospital</label>
              <input type="text" name="ref_hospital" class="form-control" id="inputName5">
            </div>                                        
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Date Transfered</label>
              <input type="date" name="date_transfer" class="form-control" id="inputName5">
            </div>                                        
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-primary">Transfer Doctor</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php' ?>