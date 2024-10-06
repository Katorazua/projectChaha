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
    $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $doc_number = filter_var($_POST['doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$firstname){
      $_SESSION['edit-user'] = "Invalid form input on edit page.";
  } elseif (!$lastname) {
      $_SESSION['edit-user'] = "Invalid form input on edit page.";  
  } elseif (!$doc_number) {
      $_SESSION['edit-user'] = "Invalid form input on edit page.";  
  } elseif (!$email) {
      $_SESSION['edit-user'] = "Invalid form input on edit page.";
  } else {

        $user_query = "UPDATE doctors SET firstname='$firstname', lastname='$lastname', email='$email', doc_number='$doc_number', role='$role' WHERE id = $id LIMIT 1";

        $user_result = mysqli_query($connection, $user_query);

        if (!mysqli_errno($connection)) {
            // redirect to manpassword-doctor ppassword with success messpassword
            $_SESSION['edit-user-success'] = "Doctor: $firstname $lastname, details Updated successfully. Click on 'Home'";
        }
    }
}

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Doctor's Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-doctors.php">Home</a></li>
          <li class="breadcrumb-item">Form</li>
          <li class="breadcrumb-item active">Staff</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Doctors/Consultants/Others</h1>
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
              <input type="hidden" class="form-control" name="id" value="<?= $user['id'] ?>">

              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" name="firstname" value="<?= $user['firstname'] ?>" class="form-control" id="inputName5" placeholder="firstname">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Last Name</label>
              <input type="text" name="lastname" value="<?=$user['lastname']?>" class="form-control" id="inputName5" placeholder="lastname">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">ID</label>
              <input type="text" name="doc_number" value="<?= $user['doc_number']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="email" name="email" value="<?=$user['email']?>" class="form-control" id="inputEmail5" placeholder="email address">
            </div> 
            <div class="col-md-6">
              <label for="inputState" class="form-label">Role</label>
              <select id="inputState" name="role" class="form-select">
                <option selected>Choose user role...</option>
                <option value="Residence_Doctor">Medical Doctor</option>
                <option value="Consultant">Consultant</option>
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