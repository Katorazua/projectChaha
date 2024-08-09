<?php 
include 'partials/header.php';
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
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $doc_number = filter_var($_POST['doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dept = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_fname = filter_var($_POST['pat_fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_lname = filter_var($_POST['pat_lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_email = filter_var($_POST['pat_email'], FILTER_VALIDATE_EMAIL);
    $pat_age = filter_var($_POST['pat_age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_gender = filter_var($_POST['pat_gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_number = filter_var($_POST['pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_phone = filter_var($_POST['pat_phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_ailment = filter_var($_POST['pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$firstname){
      $_SESSION['add-user'] = "Invalid form input ";
  } elseif (!$lastname) {
      $_SESSION['add-user'] = "Invalid form input ";  
  } elseif (!$doc_number) {
      $_SESSION['add-user'] = "Invalid form input ";  
  } elseif (!$dept) {
      $_SESSION['add-user'] = "Invalid form input ";
  } elseif (!$email) {
      $_SESSION['add-user'] = "Invalid form input ";
  } elseif (!$phone) {
     $_SESSION['add-user'] = "Please enter Doctor's Phone number.";
  }if (!$pat_fname){
    $_SESSION['add-user'] = "please enter patient's first name";
} elseif (!$pat_lname) {
    $_SESSION['add-user'] = "please enter patient's last name";  
} elseif (!$pat_age) {
    $_SESSION['add-user'] = "please enter patient's actual age";
} elseif (!$pat_email) {
    $_SESSION['add-user'] = "please enter a valied email";
} elseif (!$pat_gender) {
    $_SESSION['add-user'] = "please enter patient's gender";
} elseif (!$pat_phone){
    $_SESSION['add-user'] = "please enter patient's phone number";
} elseif (!$pat_number){
    $_SESSION['add-user'] = "please enter patient's ID (Hospital Number)";
} elseif (!$pat_ailment){
    $_SESSION['add-user'] = "please enter patient's ailment";
  } else {
    // redirect back to add-patient page if there was any problem
        if (isset($_SESSION['add-user'])) {
            // pass form data back to add-user page
            $_SESSION['add-user-data'] = $_POST;
        } else {
            $status = "Assigned";
            // insert new user into doctor-transfer table
            $user_query = " INSERT INTO  patient_assign (admin_id, doc_fname, doc_lname, doc_email, doc_dept, doc_number, doc_phone, pat_fname, pat_lname, pat_number, pat_age, pat_gender, pat_email, pat_phone, pat_ailment, status) VALUES('$admin_id', '$firstname', '$lastname', '$email', '$dept', '$doc_number', '$phone', '$pat_fname', '$pat_lname', '$pat_number', '$pat_age', '$pat_gender', '$pat_email', '$pat_phone', '$pat_ailment', '$status')";

            $user_result = mysqli_query($connection, $user_query);

            // check for error conection
            if (mysqli_errno($connection)) {
                $_SESSION['add-user'] = "Patient Assign fialed";
            } else {
                $_SESSION['add-user-success'] = "Patient: $pat_fname $pat_lname has been Assigned to Doctor: $firstname $lastname successfully. Click on 'Home'";
            }
        }

    }
}


//get back form data if there was a registration error
$pat_fname = $_SESSION['add-user-data']['pat_fname'] ?? null;
$pat_lname = $_SESSION['add-user-data']['pat_lname'] ?? null;
$pat_email = $_SESSION['add-user-data']['pat_email'] ?? null;
$phone = $_SESSION['add-user-data']['phone'] ?? null;
$pat_age = $_SESSION['add-user-data']['pat_age'] ?? null;
$pat_gender = $_SESSION['add-user-data']['pat_gender'] ?? null;
$pat_number = $_SESSION['add-user-data']['pat_number'] ?? null;
$pat_phone = $_SESSION['add-user-data']['pat_phone'] ?? null;
$pat_ailment = $_SESSION['add-user-data']['pat_ailment'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'partials/sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Assign Patient To Doctor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="assign-patient.php">Home</a></li>
          <li class="breadcrumb-item">Fill All Fields</li>
          <li class="breadcrumb-item active">Doctors/Consultants/Others</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Staff Details </h1>
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
            <div class="col-md-6" style="display: none;">
              <label for="inputEmail5" class="form-label">ID</label>
              <input type="text" name="doc_number" value="<?= $user['id']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Department</label>
              <input type="text" name="department" value="<?= $user['department']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>  
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Phone</label>
              <input type="text" name="phone" value="<?= $phone?>"  class="form-control" id="inputName5">
            </div>  
            
             <h1 class="text-center card-title">Patient's Details </h1>
            <hr>              
            <div class="col-md-6">
              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" name="pat_fname" value="<?=$pat_fname?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Last Name</label>
              <input type="text" name="pat_lname" value="<?=$pat_lname?>" class="form-control" id="inputName5">
            </div>   
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="pat_age" value="<?=$pat_age?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="email" name="pat_email" value="<?=$pat_email?>" class="form-control" id="inputEmail5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Gender</label>
              <input type="text" name="pat_gender" value="<?=$pat_gender?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Phone</label>
              <input type="text" name="pat_phone" value="<?=$pat_phone?>" class="form-control" id="inputName5">
            </div>            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's ID (Hospital No.)</label>
              <input type="text" name="pat_number" value="<?=$pat_number?>" class="form-control" id="inputName5">
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient Ailment</label>
              <input type="text" name="pat_ailment" value="<?=$pat_ailment?>" class="form-control" id="inputName5">
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
<?php include 'partials/footer.php' ?>