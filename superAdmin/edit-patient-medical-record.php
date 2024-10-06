<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM medical_records WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $mdr_pat_name = filter_var($_POST['mdr_pat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_btemp = filter_var($_POST['mdr_pat_btemp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_hrp = filter_var($_POST['mdr_pat_hrp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_rt = filter_var($_POST['mdr_pat_rt'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_bp = filter_var($_POST['mdr_pat_bp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_prescr = filter_var($_POST['mdr_pat_prescr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$mdr_pat_btemp || !$mdr_pat_hrp || !$mdr_pat_rt || !$mdr_pat_bp){
    $_SESSION['edit-user'] = "please enter patient's Vitals";
} elseif (!$mdr_pat_prescr){
    $_SESSION['edit-user'] = "please enter patient's Prescription";
} else {

        // UPDATEser into medical_records table
        $user_query = " UPDATE medical_records SET mdr_pat_btemp='$mdr_pat_btemp', mdr_pat_hrp='$mdr_pat_hrp', mdr_pat_rt='$mdr_pat_rt', mdr_pat_bp='$mdr_pat_bp', mdr_pat_prescr='$mdr_pat_prescr' WHERE id=$id LIMIT 1";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Patient medical_records fialed";
        } else {
            $_SESSION['edit-user-success'] = "Patient: $mdr_pat_name Medical Record Updated successfully. Click on 'Home'";
        }

    }

}

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Medical Record</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-medical-record.php">Home</a></li>
          <li class="breadcrumb-item">Fill All Fields</li>
          <li class="breadcrumb-item active">Medical Records</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Patient's Details</h1>
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
              <label for="inputName5" class="form-label">Patient's Name</label>
              <input type="text" name="mdr_pat_name" value="<?=$user['mdr_pat_name']?>" class="form-control" id="inputName5">
            </div>   
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="mdr_pat_age" value="<?=$user['mdr_pat_age']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Gender</label>
              <input type="text" name="mdr_pat_gender" value="<?=$user['mdr_pat_gender']?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's Address</label>
              <input type="text" name="mdr_pat_adr" value="<?=$user['mdr_pat_adr']?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's ID (Hospital No.)</label>
              <input type="text" name="mdr_pat_number" value="<?=$user['mdr_pat_number']?>" class="form-control" id="inputName5">
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="mdr_pat_ailment" value="<?=$user['mdr_pat_ailment']?>" class="form-control" id="inputName5">
            </div>

            <h1 class="text-center card-title">Patient's Vitals</h1>
            <hr>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Body Temperature</label>
              <input type="text" name="mdr_pat_btemp" value="<?=$user['mdr_pat_btemp']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Heart Rate/Pulse</label>
              <input type="text" name="mdr_pat_hrp" value="<?=$user['mdr_pat_hrp']?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Respiratory Rate</label>
              <input type="text" name="mdr_pat_rt" value="<?=$user['mdr_pat_rt']?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Blood Pressure</label>
              <input type="text" name="mdr_pat_bp" value="<?=$user['mdr_pat_bp']?>" class="form-control" id="inputName5">
            </div> 
            <hr>
            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Patient's Prescription</label>
                <textarea  type="text" class="form-control" name="mdr_pat_prescr" rows="20" id="editor"><?=$user['mdr_pat_prescr']?></textarea>
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