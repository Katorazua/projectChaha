<?php 
include '../partials/docheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM patients WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $mdr_pat_name = filter_var($_POST['mdr_pat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_age = filter_var($_POST['mdr_pat_age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_gender = filter_var($_POST['mdr_pat_gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_number = filter_var($_POST['mdr_pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_adr = filter_var($_POST['mdr_pat_adr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_ailment = filter_var($_POST['mdr_pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_btemp = filter_var($_POST['mdr_pat_btemp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_hrp = filter_var($_POST['mdr_pat_hrp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_rt = filter_var($_POST['mdr_pat_rt'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_bp = filter_var($_POST['mdr_pat_bp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_number = filter_var($_POST['mdr_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mdr_pat_prescr = filter_var($_POST['mdr_pat_prescr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$mdr_pat_name){
    $_SESSION['add-user'] = "please enter patient's name";
} elseif (!$mdr_pat_age) {
    $_SESSION['add-user'] = "please enter patient's actual age";
} elseif (!$mdr_pat_gender) {
    $_SESSION['add-user'] = "please enter patient's gender";
} elseif (!$mdr_pat_adr){
    $_SESSION['add-user'] = "please enter patient's Address";
} elseif (!$mdr_pat_number){
    $_SESSION['add-user'] = "please enter patient's ID (Hospital Number)";
} elseif (!$mdr_pat_ailment){
    $_SESSION['add-user'] = "please enter patient's ailment";
} elseif (!$mdr_pat_btemp || !$mdr_pat_hrp || !$mdr_pat_rt || !$mdr_pat_bp){
    $_SESSION['add-user'] = "please enter patient's Vitals";
} elseif (!$mdr_pat_prescr){
    $_SESSION['add-user'] = "please enter patient's Prescription";
  } else {
     // check if pat_number or mdr_pat_number already exist in database
     $user_check_query = "SELECT mdr_pat_number FROM medical_records WHERE mdr_pat_number ='$mdr_pat_number'";
     $user_check_result = mysqli_query($connection, $user_check_query);

     if (mysqli_num_rows($user_check_result) > 0) {
         $_SESSION['add-user'] = "Patient's Medical Record already exist, you can only update Records.";
     }
    
    }

    // redirect back to add-patient page if there was any problem
    if (isset($_SESSION['add-user'])) {
        // pass form data back to add-user page
        $_SESSION['add-user-data'] = $_POST;
    } else {
        // insert new user into doctor-transfer table
        $user_query = " INSERT INTO  medical_records (doc_id, mdr_pat_name, mdr_pat_number, mdr_pat_age, mdr_pat_gender, mdr_pat_ailment, mdr_pat_adr, mdr_pat_btemp, mdr_pat_hrp, mdr_pat_rt, mdr_pat_bp, mdr_number, mdr_pat_prescr) VALUES('$admin_id', '$mdr_pat_name', '$mdr_pat_number', '$mdr_pat_age', '$mdr_pat_gender', '$mdr_pat_ailment', '$mdr_pat_adr', '$mdr_pat_btemp', '$mdr_pat_hrp', '$mdr_pat_rt', '$mdr_pat_bp', '$mdr_number', '$mdr_pat_prescr')";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['add-user'] = "Patient medical_records fialed";
        } else {
            $_SESSION['add-user-success'] = "Patient: $mdr_pat_name Medical Record added successfully. Click on 'Home'";
        }
    }

}


//get back form data if there was a registration error
$mdr_pat_prescr = $_SESSION['add-user-data']['mdr_pat_prescr'] ?? null;
$mdr_pat_btemp = $_SESSION['add-user-data']['mdr_pat_btemp'] ?? null;
$mdr_pat_hrp = $_SESSION['add-user-data']['mdr_pat_hrp'] ?? null;
$mdr_pat_rt = $_SESSION['add-user-data']['mdr_pat_rt'] ?? null;
$mdr_pat_bp = $_SESSION['add-user-data']['mdr_pat_bp'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Medical Record</h1>
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
          <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Patient's Name</label>
              <input type="text" name="mdr_pat_name" value="<?="{$user['pat_fname']} {$user['pat_lname']}"?>" class="form-control" id="inputName5">
            </div>   
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="mdr_pat_age" value="<?=$user['pat_age']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Gender</label>
              <input type="text" name="mdr_pat_gender" value="<?=$user['pat_gender']?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's Address</label>
              <input type="text" name="mdr_pat_adr" value="<?=$user['pat_addr']?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's ID (Hospital No.)</label>
              <input type="text" name="mdr_pat_number" value="<?=$user['pat_number']?>" class="form-control" id="inputName5">
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="mdr_pat_ailment" value="<?=$user['pat_ailment']?>" class="form-control" id="inputName5">
            </div>   
          
            <div class="form-group col-md-2" style="display:none">
                <?php 
                    $length = 6;    
                    $pres_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                ?>
                <label for="inputZip" class="col-form-label">Medical Record Number</label>
                <input type="text" name="mdr_number" value="<?= $pres_no;?>" class="form-control" id="inputZip">
            </div>

            <h1 class="text-center card-title">Patient's Vitals</h1>
            <hr>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Body Temperature</label>
              <input type="text" name="mdr_pat_btemp" value="<?=$mdr_pat_btemp?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Heart Rate/Pulse</label>
              <input type="text" name="mdr_pat_hrp" value="<?=$mdr_pat_hrp?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Respiratory Rate</label>
              <input type="text" name="mdr_pat_rt" value="<?=$mdr_pat_rt?>" class="form-control" id="inputName5">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Blood Pressure</label>
              <input type="text" name="mdr_pat_bp" value="<?=$mdr_pat_bp?>" class="form-control" id="inputName5">
            </div> 
            <hr>
            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Patient's Prescription</label>
                <textarea  type="text" class="form-control" name="mdr_pat_prescr" rows="10" id="editor"><?=$mdr_pat_prescr?></textarea>
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