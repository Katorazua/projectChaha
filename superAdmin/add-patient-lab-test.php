<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM patients WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $lab_pat_name = filter_var($_POST['lab_pat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_age = filter_var($_POST['lab_pat_age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_gender = filter_var($_POST['lab_pat_gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_number = filter_var($_POST['lab_pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_ailment = filter_var($_POST['lab_pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_unit = filter_var($_POST['lab_pat_unit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_number = filter_var($_POST['lab_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_tests = filter_var($_POST['lab_pat_tests'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$lab_pat_name){
    $_SESSION['add-user'] = "please enter patient's name";
} elseif (!$lab_pat_age) {
    $_SESSION['add-user'] = "please enter patient's actual age";
} elseif (!$lab_pat_gender) {
    $_SESSION['add-user'] = "please enter patient's gender";
} elseif (!$lab_pat_number){
    $_SESSION['add-user'] = "please enter patient's ID (Hospital Number)";
} elseif (!$lab_pat_ailment){
    $_SESSION['add-user'] = "please enter patient's ailment";
} elseif (!$lab_pat_unit){
    $_SESSION['add-user'] = "please enter patient's Unit/Ward";
} elseif (!$lab_pat_tests){
    $_SESSION['add-user'] = "please enter patient's Lab tests";
  } else {
     // check if pat_number or lab_pat_number already exist in database
     $user_check_query = "SELECT lab_pat_number FROM laboratory WHERE lab_pat_number ='$lab_pat_number'";
     $user_check_result = mysqli_query($connection, $user_check_query);

     if (mysqli_num_rows($user_check_result) > 0) {
         $_SESSION['add-user'] = "Patient's Lab Test already exist, you can only update Records.";
     }
    
    }

    // redirect back to add-patient page if there was any problem
    if (isset($_SESSION['add-user'])) {
        // pass form data back to add-user page
        $_SESSION['add-user-data'] = $_POST;
    } else {
        // insert new user laboratory table
        $user_query = " INSERT INTO  laboratory (admin_id, lab_pat_name, lab_pat_number, lab_pat_age, lab_pat_gender, lab_pat_ailment, lab_pat_unit, lab_number, lab_pat_tests) VALUES('$admin_id', '$lab_pat_name', '$lab_pat_number', '$lab_pat_age', '$lab_pat_gender', '$lab_pat_ailment', '$lab_pat_unit', '$lab_number', '$lab_pat_tests')";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['add-user'] = "Patient lab Test fialed";
        } else {
            $_SESSION['add-user-success'] = "Patient: $lab_pat_name Lab Test added successfully. Click on 'Home'";
        }
    }

}


//get back form data if there was a registration error
$lab_pat_unit = $_SESSION['add-user-data']['lab_pat_unit'] ?? null;
$lab_pat_tests = $_SESSION['add-user-data']['lab_pat_tests'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Lab Test</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="patient-lab-test.php">Home</a></li>
          <li class="breadcrumb-item">Fill All Fields</li>
          <li class="breadcrumb-item active">Lab Tests</li>
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
              <input type="text" name="lab_pat_name" value="<?="{$user['pat_fname']} {$user['pat_lname']}"?>" class="form-control" id="inputName5">
            </div>   
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="lab_pat_age" value="<?=$user['pat_age']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Gender</label>
              <input type="text" name="lab_pat_gender" value="<?=$user['pat_gender']?>" class="form-control" id="inputName5">
            </div>          
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's ID (Hospital No.)</label>
              <input type="text" name="lab_pat_number" value="<?=$user['pat_number']?>" class="form-control" id="inputName5">
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="lab_pat_ailment" value="<?=$user['pat_ailment']?>" class="form-control" id="inputName5">
            </div>          
          
            <div class="form-group col-md-6">
                <?php 
                    $length = 6;    
                    $pres_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                ?>
                <label for="inputZip" class="col-form-label">Lab Test Number</label>
                <input type="text" name="lab_number" value="<?= $pres_no;?>" class="form-control" id="inputZip">
            </div>

            <div class="col-md-12">
              <label for="inputEmail5" class="form-label">Patient Unit/Ward</label>
              <input type="text" name="lab_pat_unit" value="<?=$lab_pat_unit?>" class="form-control" id="inputName5">
            </div>   
          
            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Laboratory Tests</label>
                <textarea  type="text" class="form-control" name="lab_pat_tests" rows="10" id="editor" placeholder="Write your lab tesete here......"><?=$lab_pat_tests?></textarea>
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