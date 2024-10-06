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
$pat_type = filter_var($_POST['pat_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pat_ailment = filter_var($_POST['pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // check for valid input
    if(!$firstname) {
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    } elseif (!$lastname) {
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    } elseif (!$pat_number){
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    } elseif (!$pat_ailment){
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    } else {
        // update patient
        $query = " UPDATE patients SET pat_fname='$firstname', pat_lname = '$lastname', pat_email = '$email', pat_dob='$dob', pat_age='$age', pat_addr='$addr', pat_gender='$gender', pat_phone='$phone', pat_number = '$pat_number', pat_ailment = '$pat_ailment', pat_type = '$pat_type', pat_country = '$city' WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Patient's update fialed";
        } else {
            $_SESSION['edit-user-success'] = "$firstname $lastname details updated successfully. Click on 'Home'";
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
      <h1>Update Patient</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-patients.php">Home</a></li>
          <li class="breadcrumb-item">Fill All Fields</li>
          <li class="breadcrumb-item active">Patient</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Update Patient's Details</h1>
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
              <input type="hidden" class="form-control" name="id" value="<?= $user['id'] ?>">

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
              <label for="inputState" class="form-label">Patient's type</label>
              <select id="inputState" name="pat_type" class="form-select">
                <option selected>Choose...</option>
                <option value="In-patient">In Patient</option>
                <option value="Out-pateint">Out Patient</option>
              </select>
            </div>            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="pat_ailment" value="<?=$user['pat_ailment']?>" class="form-control" id="inputName5">
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