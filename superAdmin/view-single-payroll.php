<?php 
include '../partials/dashboardheader.php';

if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM doctors WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $pay_acc_number = filter_var($_POST['pay_acc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pay_acc_name = filter_var($_POST['pay_acc_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pay_bank = filter_var($_POST['pay_bank'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$pay_acc_name){
      $_SESSION['edit-user'] = "Invalid form input on edit page.";
  } elseif (!$pay_bank) {
      $_SESSION['edit-user'] = "Invalid form input on edit page.";  
  } elseif (!$pay_acc_number) {
      $_SESSION['edit-user'] = "Invalid form input on edit page.";
  } else {
    //   update payroll
    $user_query = "UPDATE payrolls SET pay_acc_name='$pay_acc_name', pay_bank='$pay_bank', pay_acc_number='$pay_acc_number' WHERE rid = $id LIMIT 1";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to users-profile with success message
        $_SESSION['edit-user-success'] = "$pay_acc_name from $pay_bank, details Updated into payroll successfully. New acc No: $pay_acc_number ";
    }

    }      
}  


?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?= ROOT_URL . 'images/' . $user['avatar'] ?>" alt="Profile" class="rounded-circle" style="width: 8rem; height: 8rem; overflow: hidden;">
              <h2><?="{$user['firstname']} {$user['lastname']}"?></h2>
              <h3><?= $user['job'] ?></h3>
              <div class="social-links mt-2">
                <a target="_blank" href="<?=$user['twitter'] ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a target="_blank" href="<?=$user['facebook'] ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a target="_blank" href="<?=$user['instagram'] ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <a target="_blank" href="<?=$user['linkedin'] ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <?php if(isset($_SESSION['edit-user-success'])) :  // show if edit-user is successful ?>
            <div class="alert_message success container">
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
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Update Payroll Account</button>
                </li>

              </ul>

                <?php
                    $doc_id = $user['id'];
                    $query = "SELECT * FROM payrolls WHERE rid=$doc_id ";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($result);
                ?>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?=$user['doc_about']?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?="{$user['firstname']}  {$user['lastname']}"?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">ID</div>
                    <div class="col-lg-9 col-md-8"><?= $user['doc_number'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Department</div>
                    <div class="col-lg-9 col-md-8"><?= $user['department'] ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8"><?= $user['company_name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?= $user['job'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Joined On</div>
                    <div class="col-lg-9 col-md-8"><?= $user['date_time'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $user['email'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Bank Name</div>
                    <div class="col-lg-9 col-md-8"><?= $row['pay_bank'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Account Name</div>
                    <div class="col-lg-9 col-md-8"><?= $row['pay_acc_name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Account Number</div>
                    <div class="col-lg-9 col-md-8"><?= $row['pay_acc_number'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">PayCode</div>
                    <div class="col-lg-9 col-md-8"><?= $row['pay_number'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Status</div>
                    <div class="col-lg-9 col-md-8"><?= $row['status'] ?></div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post" enctype="multipart/form-data">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Bank Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pay_bank" type="text" value="<?= $row['pay_bank'] ?>" class="form-control" id="currentPassword" placeholder="Enter Bank Name">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Account Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pay_acc_name" type="text" value="<?= $row['pay_acc_name'] ?>" class="form-control" id="newPassword" placeholder="Enter Your Account Name">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Account Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pay_acc_number" type="text" value="<?= $row['pay_acc_number'] ?>" class="form-control" id="renewPassword" placeholder="Enter Your Account Number">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php'; ?>