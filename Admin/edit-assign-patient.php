<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM patient_assign WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $dept = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_fname = filter_var($_POST['pat_fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_lname = filter_var($_POST['pat_lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_number = filter_var($_POST['pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_ailment = filter_var($_POST['pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$fullname){
      $_SESSION['edit-user'] = "Invalid form input "; 
  } elseif (!$doc_number) {
      $_SESSION['edit-user'] = "Invalid form input ";  
  } elseif (!$dept) {
      $_SESSION['edit-user'] = "Invalid form input ";
  } elseif (!$email) {
      $_SESSION['edit-user'] = "Invalid form input ";
  } elseif (!$phone) {
     $_SESSION['edit-user'] = "Invalid form input";
  }if (!$pat_fname){
    $_SESSION['edit-user'] = "Invalid form input";
  } elseif (!$pat_lname) {
    $_SESSION['edit-user'] = "Invalid form input"; 
  } elseif (!$pat_number){
    $_SESSION['edit-user'] = "Invalid form input";
  } elseif (!$pat_ailment){
    $_SESSION['edit-user'] = "Invalid form input";
  } elseif (!$status){
    $_SESSION['edit-user'] = "Invalid form input";
  } else {
    
        
        // insert new user into doctor-transfer table
        $user_query = " UPDATE patient_assign SET doc_fname='$fullname', doc_email='$email', doc_dept='$dept', doc_phone='$phone', pat_fname='$pat_fname',  pat_lname='$pat_lname', pat_number='$pat_number', pat_ailment='$pat_ailment', status='$status'";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Patient Assign fialed";
        } else {
            $_SESSION['edit-user-success'] = "Assigned Details Updated successfully. Click on 'Home'";
        }
    

    }
}


?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Assigned Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="view-assign-patient.php">Home</a></li>
          <li class="breadcrumb-item">All Details</li>
          <li class="breadcrumb-item active">Doctors/Consultants/Others</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Staff Details </h1>
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
              <label for="inputName5" class="form-label">Dorctor's Name</label>
              <input type="text" name="fullname" value="<?= $user['doc_fname'] ?>" class="form-control" id="inputName5" placeholder="firstname">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="text" name="email" value="<?= $user['doc_email']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Department</label>
              <input type="text" name="department" value="<?= $user['doc_dept']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>  
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Phone</label>
              <input type="text" name="phone" value="<?= $user['doc_phone']?>"  class="form-control" id="inputName5">
            </div>  
            
             <h1 class="text-center card-title">Patient's Details </h1>
            <hr>              
            <div class="col-md-6">
              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" name="pat_fname" value="<?=$user['pat_fname']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Last Name</label>
              <input type="text" name="pat_lname" value="<?=$user['pat_lname']?>" class="form-control" id="inputName5">
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
              <label for="inputEmail5" class="form-label">Status</label>
              <input type="text" name="status" value="<?=$user['status']?>" class="form-control" id="inputName5">
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