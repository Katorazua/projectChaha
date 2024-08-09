<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM doctors WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit']) && isset($_POST['is_featured'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $doc_number = filter_var($_POST['doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dept = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_fname = filter_var($_POST['pat_fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_lname = filter_var($_POST['pat_lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_number = filter_var($_POST['pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_ailment = filter_var($_POST['pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$fullname || !$dept || !$email || !$phone | !$pat_fname || !$pat_lname || !$pat_number || !$pat_ailment){
    $_SESSION['add-user'] = "please enter all fields";
  } else {

    // check if patient  already exist in datagase
    $user_check_query = "SELECT * FROM patient_assign WHERE pat_number ='$pat_number'";
    $user_check_result = mysqli_query($connection, $user_check_query);

    if (mysqli_num_rows($user_check_result) > 0) {
      $_SESSION['add-user'] = "Patient already Assigned to A Doctor $doc_fname";
    }

    // redirect back to add-patient page if there was any problem
    if (isset($_SESSION['add-user'])) {
        // pass form data back to add-user page
        $_SESSION['add-user-data'] = $_POST;
    } else {
        $status = "Assigned";
        // insert new user into doctor-transfer table
        $user_query = " INSERT INTO  patient_assign (admin_id, doc_fname, doc_email, doc_dept, doc_number, doc_phone, pat_fname, pat_lname, pat_number, pat_ailment, status) VALUES('$admin_id', '$fullname', '$email', '$dept', '$doc_number', '$phone', '$pat_fname', '$pat_lname', '$pat_number', '$pat_ailment', '$status')";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['add-user'] = "Patient Assign fialed";
        } else {
            $_SESSION['add-user-success'] = "Patient: $pat_fname $pat_lname has been Assigned to Doctor: $fullname $lastname successfully. Click on 'Home'";
        }
    }

    }
}

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
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
              <label for="inputName5" class="form-label">Doctor's Name</label>
              <input type="text" name="fullname" value="<?= "{$user['firstname']} {$user['lastname']}" ?>" class="form-control" id="inputName5" placeholder="firstname">
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
              <input type="text" name="phone" value="<?= $user['doc_phone']?>"  class="form-control" id="inputName5">
            </div>  
            <?php
              // featch patients from database
              $query = "SELECT * FROM patients ORDER BY RAND()";
              $pat = mysqli_query($connection, $query);
              $cnt = 1;
            ?>

            <section class="section">
              <div class="row">
                <div class="col-lg-12">

                  <div class="card">
                    <div class="card-body">
                      <h1 class="text-center card-title">Patient's Details</h1>
                      <hr>

                      <!-- Table with stripped rows -->
                      <?php if (mysqli_num_rows($pat) > 0) :?>
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>Ext.</th>
                            <th>First Name</th>                    
                            <th>Last Name</th>                    
                            <th>Hosp. Number</th>
                            <th>Ailment</th>
                            <th>Category</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php while ($user = mysqli_fetch_assoc($pat)) : ?>
                          <tr>
                            <td><?= $cnt; ?></td>
                            <td><input type="text" name="pat_fname" value="<?=$user['pat_fname']?>" style="border: none; width: 100px;"></td>
                            <td><input type="text" name="pat_lname" value="<?=$user['pat_lname']?>" style="border: none; width: 100px;"></td>
                            <td><input type="text" name="pat_number" value="<?=$user['pat_number']?>" style="border: none; width: 100px;"></td>
                            <td><input type="text" name="pat_ailment" value="<?=$user['pat_ailment']?>" style="border: none; width: 100px;"></td>
                            <td><input type="text" value="<?=$user['pat_type']?>" style="border: none; width: 100px;"></td>
                            <td><input type="checkbox" name="is_featured"></td>
                          </tr>
                          <?php $cnt=$cnt+1; endwhile ?>
                          </tbody>
                      </table>
                      <?php else : ?>
                        <div class="alert_message error text-center"><?= "No Patient list found" ?></div>
                      <?php endif ?>
                      <!-- End Table with stripped rows -->

                    </div>
                  </div>

                </div>
              </div>
            </section> <!-- End table section -->
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