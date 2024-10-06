<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM laboratory WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $lab_pat_name = filter_var($_POST['lab_pat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_age = filter_var($_POST['lab_pat_age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_gender = filter_var($_POST['lab_pat_gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_number = filter_var($_POST['lab_pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_adr = filter_var($_POST['lab_pat_adr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_ailment = filter_var($_POST['lab_pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_unit = filter_var($_POST['lab_pat_unit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_number = filter_var($_POST['lab_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_tests = filter_var($_POST['lab_pat_tests'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lab_pat_results = filter_var($_POST['lab_pat_results'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
} elseif (!$lab_pat_results){
    $_SESSION['add-user'] = "please enter patient's Lab tests";
  } else {
   
        // redirect back to add-patient page if there was any problem
        if (isset($_SESSION['add-user'])) {
            // pass form data back to add-user page
            $_SESSION['add-user-data'] = $_POST;
        } else {
            // update new user into laboratory table
            $user_query = " UPDATE laboratory SET lab_pat_name='$lab_pat_name', lab_pat_number='$lab_pat_number',  lab_pat_age='$lab_pat_age', lab_pat_gender='$lab_pat_gender', lab_pat_ailment='$lab_pat_ailment', lab_pat_unit='$lab_pat_unit',  lab_number='$lab_number', lab_pat_results='$lab_pat_results', lab_pat_tests='$lab_pat_tests' WHERE id=$id LIMIT 1";

            $user_result = mysqli_query($connection, $user_query);

            // check for error conection
            if (mysqli_errno($connection)) {
                $_SESSION['add-user'] = "Patient lab Test fialed";
            } else {
                $_SESSION['add-user-success'] = "Patient: $lab_pat_name Lab Result added successfully. Click on 'Home'";
            }
        }
    }

}

//get back form data if there was a registration error
$lab_pat_results = $_SESSION['add-user-data']['lab_pat_results'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Lab Result</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="patient-lab-result.php">Home</a></li>
          <li class="breadcrumb-item">Fill All Fields</li>
          <li class="breadcrumb-item active">Lab Results</li>
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
              <input type="text" name="lab_pat_name" value="<?=$user['lab_pat_name']?>" class="form-control" id="inputName5">
            </div>   
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="lab_pat_age" value="<?=$user['lab_pat_age']?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Gender</label>
              <input type="text" name="lab_pat_gender" value="<?=$user['lab_pat_gender']?>" class="form-control" id="inputName5">
            </div>          
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's ID (Hospital No.)</label>
              <input type="text" name="lab_pat_number" value="<?=$user['lab_pat_number']?>" class="form-control" id="inputName5">
            </div> 

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="lab_pat_ailment" value="<?=$user['lab_pat_ailment']?>" class="form-control" id="inputName5">
            </div> 

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Lab Number</label>
              <input type="text" name="lab_number" value="<?=$user['lab_number']?>" class="form-control" id="inputName5">
            </div> 

            <div class="col-md-12">
              <label for="inputEmail5" class="form-label">Patient Unit/Ward</label>
              <input type="text" name="lab_pat_unit" value="<?=$user['lab_pat_unit']?>" class="form-control" id="inputName5">
            </div>   
          
            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Laboratory Tests</label>
                <textarea  type="text" class="form-control" name="lab_pat_tests" rows="10" id="editor" placeholder="Write your lab tesete here......"><?=$user['lab_pat_tests']?></textarea>
            </div>  

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Laboratory Results</label>
                <textarea  type="text" class="form-control" name="lab_pat_results" rows="10" id="editor" placeholder="Write your lab results here......"><?=$lab_pat_results?></textarea>
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