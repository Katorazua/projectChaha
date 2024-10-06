<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM appointments WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $ap_doc_name = filter_var($_POST['ap_doc_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_doc_number = filter_var($_POST['ap_doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $doc_phone = filter_var($_POST['doc_phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_pat_name = filter_var($_POST['ap_pat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_pat_email = filter_var($_POST['ap_pat_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_pat_ailment = filter_var($_POST['ap_pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_service = filter_var($_POST['ap_service'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_date = filter_var($_POST['ap_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$ap_doc_name){
      $_SESSION['edit-user'] = "Invalid form input "; 
  } elseif (!$ap_doc_number) {
      $_SESSION['edit-user'] = "Invalid form input ";
  } elseif (!$doc_phone) {
     $_SESSION['edit-user'] = "Invalid form input";
  }if (!$ap_pat_name){
    $_SESSION['edit-user'] = "Invalid form input";
  } elseif (!$ap_pat_email){
    $_SESSION['edit-user'] = "Invalid form input";
  } elseif (!$ap_pat_ailment){
    $_SESSION['edit-user'] = "Invalid form input";
  } elseif (!$ap_service){
    $_SESSION['edit-user'] = "Invalid form input";
  } elseif (!$ap_date){
    $_SESSION['edit-user'] = "Invalid form input";
  } elseif (!$status){
    $_SESSION['edit-user'] = "Invalid form input";
  } else {
    
        
        // insert new user into doctor-transfer table
        $user_query = " UPDATE appointments SET ap_doc_name='$ap_doc_name', ap_doc_number='$ap_doc_number', doc_phone='$doc_phone', ap_pat_name='$ap_pat_name',  ap_service='$ap_service', ap_date='$ap_date', ap_pat_email='$ap_pat_email', ap_pat_ailment='$ap_pat_ailment', ap_status='$status' WHERE id=$id LIMIT 1";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "ap_Patient Assign fialed";
        } else {
            $_SESSION['edit-user-success'] = "User's Appointment Details Updated successfully. Click on 'Home'";
        }
    

    }
}


?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update User's Appointment Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-appointments.php">Home</a></li>
          <li class="breadcrumb-item">All Details</li>
          <li class="breadcrumb-item active">Doctors &amp; Patients</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Doctor Details </h1>
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
              <input type="text" name="ap_doc_name" value="<?= $user['ap_doc_name'] ?>" class="form-control" id="inputName5" placeholder="firstname">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Doctor's Number</label>
              <input type="text" name="ap_doc_number" value="<?= $user['ap_doc_number']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Doctor's phone</label>
              <input type="text" name="doc_phone" value="<?= $user['doc_phone']?>"  class="form-control" id="inputName5">
            </div>  
            
             <h1 class="text-center card-title">Patient's Details </h1>
            <hr>              
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Patient Name</label>
              <input type="text" name="ap_pat_name" value="<?=$user['ap_pat_name']?>" class="form-control" id="inputName5">
            </div>          
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's Email</label>
              <input type="text" name="ap_pat_email" value="<?=$user['ap_pat_email']?>" class="form-control" id="inputName5">
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="ap_pat_ailment" value="<?=$user['ap_pat_ailment']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Service</label>
              <input type="text" name="ap_service" value="<?=$user['ap_service']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Date</label>
              <input type="text" name="ap_date" value="<?=$user['ap_date']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Status </label>
              <select name="status" id="inputState" class="form-select">
                <option selected><?=$user['ap_status']?></option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
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