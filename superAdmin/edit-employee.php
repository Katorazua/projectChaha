<?php 
include '../partials/dashboardheader.php';
// fetch users from database 
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM employees WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
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
          <li class="breadcrumb-item"><a href="manage-employee.php">Home</a></li>
          <li class="breadcrumb-item">Staff</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?= ROOT_URL . 'images/' . $user['avatar'] ?>" class="rounded-circle">
              <h2><?="{$user['firstname']}{$user['lastname']}"?></h2>
              <h3><?=$user['role']?></h3>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
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
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li> -->

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?="{$user['firstname']}{$user['lastname']}"?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?=$user['gender']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Age</div>
                    <div class="col-lg-9 col-md-8"><?=$user['age']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8"><?=$user['company_name']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ID Number</div>
                    <div class="col-lg-9 col-md-8"><?=$user['emp_number']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?=$user['role']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8"><?=$user['city']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?=$user['emp_addr']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(+234) <?=$user['phone']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$user['email']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Status</div>
                    <div class="col-lg-9 col-md-8"><?=$user['status']?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">                 

                  <!-- Profile Edit Form -->
                  <form action="edit-employee-logic.php" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="hidden" class="form-control"  name="previous_avatar_name" value="<?= $user['avatar'] ?>">
                        <img src="<?=ROOT_URL .'images/'. $user['avatar']?>" alt="Profile">
                        <div class="pt-2">
                          <label for="avatar" class="btn btn-primary btn-sm text-white"><i class="bi bi-upload"></i></label>
                          <input type="file" name="avatar" id="avatar" hidden>Upload Image                          
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <input type="hidden" class="form-control" name="id" value="<?= $user['id'] ?>">

                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control" id="fullName" value="<?=$user['firstname'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="fullName" value="<?=$user['lastname']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Age</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="age" type="text" class="form-control" id="fullName" value="<?=$user['age']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="gender" type="text" class="form-control" id="fullName" value="<?=$user['gender']?>">
                      </div>
                    </div>

                    <!-- <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Staff ID</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="emp_number" type="text" class="form-control" id="fullName" value="<?=$user['emp_number']?>">
                      </div>
                    </div> -->

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company_name" type="text" class="form-control" id="company" value="<?=$user['company_name'] ?>">
                      </div>
                    </div>

                    <?php 
                      // featch category from database
                      $query = "SELECT * FROM department";
                      $department = mysqli_query($connection, $query);
                    ?>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Department</label>
                      <div class="col-md-8 col-lg-9">
                      <select id="inputState" name="department" class="form-select">
                        <option value="<?=$user['department']?>"><?=$user['department']?></option>
                         <?php while ($category = mysqli_fetch_assoc($department)) : ?>
                          <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
                         <?php endwhile ?>
                     </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                      <select id="inputState" name="role" class="form-select">
                        <option value="<?=$user['role']?>"><?=$user['role']?></option>
                        <option value="Nurse">Nurse</option>
                        <option value="Lab">MLS/MLT</option>
                        <option value="Reseptionist">Reseptionist</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Casher">Casher</option>
                        <option value="Security">Security</option>
                        <option value="StoreKeeper">StoreKeeper</option>
                     </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="city" type="text" class="form-control" id="Country" value="<?=$user['city']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?=$user['emp_addr']?>">
                      </div>
                    </div> 

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?=$user['phone']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?=$user['email']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Status</label>
                      <div class="col-md-8 col-lg-9">
                      <select id="inputState" name="status" class="form-select">
                        <option value="<?=$user['status']?>"><?=$user['status']?></option>
                        <option value="Non-staff">Non Staff</option>
                        <option value="Active-staff">Active Staff</option>
                        <option value="Non-active">Non Active</option>                        
                     </select>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

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
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
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