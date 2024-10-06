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
$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

 // update patient
 $query = " UPDATE patients SET pat_discharge_status='$status' WHERE id = $id LIMIT 1";
 $result = mysqli_query($connection, $query);

 // check for error conection
 if (mysqli_errno($connection)) {
     $_SESSION['edit-user'] = "Patient's update fialed";
 } else {
     $_SESSION['edit-user-success'] = "$firstname $lastname details discharged successfully. Click on 'Home'";
 }
    
}

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Discharge Patient</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="discharge-patient.php">Home</a></li>
          <li class="breadcrumb-item">Discharge</li>
          <li class="breadcrumb-item active">Patient Status</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Fill All Fields</h1>
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
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="age" value="<?=$user['pat_age']?>" class="form-control" id="inputName5">
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
              <label for="inputEmail5" class="form-label">Patient's ID (Hospital No.)</label>
              <input type="text" name="pat_number" value="<?=$user['pat_number']?>" class="form-control" id="inputName5">
            </div>                     
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="pat_ailment" value="<?=$user['pat_ailment']?>" class="form-control" id="inputName5">
            </div>  
            <div class="col-md-6">
              <label for="inputState" class="form-label">Discharge Status</label>
              <select id="inputState" name="status" class="form-select">
                <option value="NULL">NULL</option>
                <option value="Discharged">Discharged</option>
                <option value="On-Medication">Discharge But still On-medication</option>
              </select>
            </div>            
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-primary">Discharge</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php' ?>