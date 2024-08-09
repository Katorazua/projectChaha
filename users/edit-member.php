<?php 
include '../partials/usersheader.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}


if (isset($_POST['submit'])) {
    // get signup form data if signup button was clicked
    $current_admin_id = $_SESSION['user-id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userfield = filter_var($_POST['userfield'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$firstname){
        $_SESSION['edit-user'] = "please enter your first name";
    } elseif (!$lastname) {
        $_SESSION['edit-user'] = "please enter your last name";
    } elseif (!$email) {
        $_SESSION['edit-user'] = "please enter a valied email";
    } elseif (!$username) {
        $_SESSION['edit-user'] = "please enter your user name";
    } elseif (!$gender) {
        $_SESSION['edit-user'] = "please enter your user gender";
    } elseif (!$userfield) {
        $_SESSION['edit-user'] = "please enter your user field";
    } elseif (!$phone) {
        $_SESSION['edit-user'] = "please enter your user phone number";
    } else {
        // update user
        $user_query = " UPDATE users SET firstname='$firstname', lastname = '$lastname', email = '$email', username = '$username', userfield = '$userfield', phone='$phone', gender = '$gender' WHERE id = $id LIMIT 1";  

        $user_result = mysqli_query($connection, $user_query);

        if (!mysqli_errno($connection)) {
            // redirect to login page with success message
            $_SESSION['edit-user-success'] = "$firstname $lastname Details Updated successfully";
        }
    }  
    
}
   
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update My Family Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-members.php">Home</a></li>
          <li class="breadcrumb-item">Edit Form</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Update user</h1>
          <hr>
          <?php if(isset($_SESSION['edit-user'])) : ?>
            <div class="alert_message error">
              <p>
                  <?= $_SESSION['edit-user'];
                  unset($_SESSION['edit-user']);
                  ?>
              </p>
            </div>
          <?php elseif(isset($_SESSION['edit-user-success'])) : ?>
            <div class="alert_message success text-center">
              <p>
                  <?= $_SESSION['edit-user-success'];
                  unset($_SESSION['edit-user-success']);
                  ?>
              </p>
            </div>
          <?php endif ?>
          <!-- Multi Columns Form -->
          <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">First Name</label>
                <input type="text" class="form-control"  name="firstname" value="<?=$user['firstname']?>"
                    placeholder="First Name">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Last Name</label>
                <input type="text" class="form-control"  name="lastname" value="<?=$user['lastname']?>"
                    placeholder="Last Name">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Email editress</label>
                <input type="email" class="form-control"  name="email" value="<?=$user['email']?>"
                    placeholder="Email">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">User Name</label>
                <input type="text" class="form-control"  name="username" value="<?=$user['username']?>"
                    placeholder="Username">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Gender</label>
                <input type="text" class="form-control"  name="gender" value="<?=$user['gender']?>"
                    placeholder="gender">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">User Field</label>
                <input type="text" class="form-control" name="userfield" value="<?=$user['userfield']?>"
                    placeholder="job (occupation)">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?=$user['phone']?>"
                    placeholder="phone number">
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