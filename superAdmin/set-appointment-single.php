<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM appointments WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit']) && isset($_POST['is_featured'])) {
  // get signup form data if signup button was clicked
    $doc_id = filter_var($_POST['doc_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_doc_name = filter_var($_POST['ap_doc_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ap_doc_number = filter_var($_POST['ap_doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $doc_phone = filter_var($_POST['doc_phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$is_featured){
      $_SESSION['add-user'] = "Invalid form input "; 
  } else {
    // redirect back to add-patient page if there was any problem
        if (isset($_SESSION['add-user'])) {
            // pass form data back to add-user page
            $_SESSION['add-user-data'] = $_POST;
        } else {
            // insert new user into doctor-transfer table
            $user_query = " UPDATE appointments SET  ap_doc_name='$ap_doc_name', doc_id='$doc_id', ap_doc_number='$ap_doc_number', doc_phone='$doc_phone' WHERE id=$id LIMIT 1";
            $user_result = mysqli_query($connection, $user_query);

            // check for error conection
            if (mysqli_errno($connection)) {
                $_SESSION['add-user'] = "Patient Assign fialed";
            } else {
                $_SESSION['add-user-success'] = "Patient has been Assigned to Doctor: $ap_doc_name successfully. Click on Home to view";
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
          <li class="breadcrumb-item"><a href="view-appointments.php">Home</a></li>
          <li class="breadcrumb-item">Fill All Fields</li>
          <li class="breadcrumb-item active">Doctors/Consultants/Others</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Patient's Details </h1>
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
          <form method="post" class="row g-3">
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Patient's Name</label>
              <input type="text" name="fullname" value="<?= $user['ap_pat_name'] ?>" class="form-control" id="inputName5" disabled>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's Ailment</label>
              <input type="text" name="email" value="<?= $user['ap_pat_ailment']?>" class="form-control" id="inputName5" disabled>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's Appointment ID</label>
              <input type="text" name="department" value="<?= $user['ref_code']?>" class="form-control" id="inputName5" disabled>
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's Service Request</label>
              <input type="text" name="department" value="<?= $user['ap_service']?>" class="form-control" id="inputName5" disabled>
            </div> 
            
            <?php
              // featch patients from database
              $query = "SELECT * FROM doctors ORDER BY RAND()";
              $pat = mysqli_query($connection, $query);
              $cnt = 1;
            ?>

            <section class="section">
              <div class="row">
                <div class="col-lg-12">

                  <div class="card">
                    <div class="card-body">
                      <h1 class="text-center card-title">Doctors Details</h1>
                      <hr>

                      <!-- Table with stripped rows -->
                      <?php if (mysqli_num_rows($pat) > 0) :?>
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>Ext.</th>
                            <th>Name</th>                   
                            <th>Number</th>
                            <th>Contact</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php while ($user = mysqli_fetch_assoc($pat)) : ?>
                          <tr>
                            <td><?= $cnt; ?></td>                            
                            <td style="display: none;"><input type="text" name="doc_id" value="<?=$user['id']?>" style="border: none; width: 100px;"></td>                            
                            <td><input type="text" name="ap_doc_name" value="<?="{$user['firstname']} {$user['lastname']}"?>" style="border: none; width: 150px;"></td>
                            <td><input type="text" name="ap_doc_number" value="<?=$user['doc_number']?>" style="border: none; width: 100px;"></td>
                            <td><input type="text" name="doc_phone" value="<?=$user['doc_phone']?>" style="border: none; width: 100px;"></td>
                            <td><input type="text" value="<?=$user['department']?>" style="border: none; width: 150px;"></td>
                            <td><input type="text" value="<?=$user['status']?>" style="border: none; width: 100px;"></td>
                            <td><input type="checkbox" name="is_featured"></td>
                          </tr>
                          <?php $cnt=$cnt+1; endwhile ?>
                          </tbody>
                      </table>
                      <?php else : ?>
                        <div class="alert_message error text-center"><?= "No Doctors list found" ?></div>
                      <?php endif ?>
                      <!-- End Table with stripped rows -->

                    </div>
                  </div>

                </div>
              </div>
            </section> <!-- End table section -->

            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              <a href="set-appointment.php" class="btn btn-secondary">Back</a>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php' ?>