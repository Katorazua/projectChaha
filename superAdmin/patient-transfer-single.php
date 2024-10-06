<?php 
include '../partials/dashboardheader.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM patients WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])){
// get updated form data
$admin_id = $_SESSION['user-id'];
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$dob = filter_var($_POST['DOB'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$age = filter_var($_POST['age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$addr = filter_var($_POST['addr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$city = filter_var($_POST['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pat_number = filter_var($_POST['pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ref_hospital = filter_var($_POST['ref_hospital'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pat_ailment = filter_var($_POST['pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // check for valid input
    if(!$ref_hospital) {
        $_SESSION['edit-user'] = "Please enter patient's referral hospital.";
    } else {
      // check if user name or email already exist in datagase
      $user_check_query = "SELECT pat_number, ref_hospital FROM patient_transfer WHERE pat_number='$pat_number' OR ref_hospital = '$ref_hospital'";
      $user_check_result = mysqli_query($connection, $user_check_query);

      if (mysqli_num_rows($user_check_result) > 0) {
          $_SESSION['edit-user'] = "Patient has already been transfered to $ref_hospital";
      } else {
        $status = "Transfered";
        // insert new user into patient-transfer table
        $user_query = " INSERT INTO patient_transfer (admin_id, pat_fname, pat_lname, pat_email, pat_dob, pat_age, pat_addr, pat_gender, pat_number, pat_phone, pat_country, ref_hospital, pat_ailment, status) VALUES('$admin_id', '$firstname', '$lastname', '$email', '$dob', '$age', '$addr', '$gender', '$pat_number', '$phone','$city','$ref_hospital', '$pat_ailment', '$status')";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Patient's transfer fialed";
        } else {
            $_SESSION['edit-user-success'] = "$firstname $lastname details has been transfered to $ref_hospital successfully. Click on 'Home'";
        }
      }
        
    }
    
}
// header('location:' . ROOT_URL . 'superAdmin/manage-patients.php');
// die();
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Transfer Patient To A Refferal Facility</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-patients.php">Home</a></li>
          <li class="breadcrumb-item">Fill All Fields</li>
          <li class="breadcrumb-item active">Patient's Transfer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Patient's Transfer Form</h1>
          <hr>
          <?php if(isset($_SESSION['edit-user'])) : ?>
            <div class="alert_message error">
              <p>
                  <?= $_SESSION['edit-user'];
                  unset($_SESSION['edit-user']);
                  ?>
              </p>
            </div>
          <?php elseif(isset($_SESSION['edit-user-success'])) : ?>
            <div class="alert_message success text-center">
              <p>
                  <?= $_SESSION['edit-user-success'];
                  unset($_SESSION['edit-user-success']);
                  ?>
              </p>
            </div>
          <?php endif ?>
          <!-- Multi Columns Form -->
          <form method="post" class="row g-3">
            <div class="col-md-6">
              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" name="firstname" value="<?=$user['pat_fname']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Last Name</label>
              <input type="text" name="lastname" value="<?=$user['pat_lname']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Date Of Birth</label>
              <input type="date" name="DOB" value="<?=$user['pat_dob']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="age" value="<?=$user['pat_age']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="email" name="email" value="<?=$user['pat_email']?>" class="form-control" id="inputEmail5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Gender</label>
              <input type="text" name="gender" value="<?=$user['pat_gender']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Address</label>
              <input type="text" name="addr" value="<?=$user['pat_addr']?>" class="form-control" id="inputName5">
            </div>            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">City</label>
              <input type="text" name="city" value="<?=$user['pat_country']?>" class="form-control" id="inputName5" placeholder="provide Country and State">
            </div>            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Phone</label>
              <input type="text" name="phone" value="<?=$user['pat_phone']?>" class="form-control" id="inputName5">
            </div>            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's ID (Hospital No.)</label>
              <input type="text" name="pat_number" value="<?=$user['pat_number']?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="pat_ailment" value="<?=$user['pat_ailment']?>" class="form-control" id="inputName5">
            </div>            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Refferal Hospital</label>
              <input type="text" name="ref_hospital" class="form-control" id="inputName5">
            </div>                              
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-primary">Transfer Patient</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php' ?>