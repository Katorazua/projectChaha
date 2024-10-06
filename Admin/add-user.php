<?php 
include '../partials/dashboardheader.php';

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
    $user_role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $avatar = $_FILES['avatar'];

    if (!$firstname || !$lastname || !$email || !$username || !$gender || !$userfield || !$phone) {
        $_SESSION['add-user'] = "please enter all required fields";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8 ){
        $_SESSION['add-user'] = "password should be 8+ character";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "please add avatar";
    } else {
        // check if password don't match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-user'] = "Password do not match";
        } else {
            // Hashed password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
            
            // check if username or email already exist in datagase
            $user_check_query = "SELECT * FROM users WHERE username ='$username' OR email = '$email' ";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "user name or email already exist";
            } else {
                // Work on avater, rename avatar
                $time = time();  //make each image name unique using current timestamp
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_detination_path = '../images/' . $avatar_name;

                // make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_files)) {
                    // make sure image is not larger than 1mb+
                    if ($avatar['size'] < 1000000) {
                        // upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_detination_path);
                    } else {
                        $_SESSION['add-user'] = "File size too big. shoul be lass than 1mb";
                    }
                } else {
                    $_SESSION['add-user'] = "File should be png, jpg, jpeg";
                }

            }
        }   
    }  
    
  // redirect back to add-user page if there was any problem
    if (isset($_SESSION['add-user'])) {
        // pass form data back to add-user page
        $_SESSION['add-user-data'] = $_POST;
    } else {
        $terms ="I accept";
        // insert new user into users table
        $user_query = " INSERT INTO users (firstname, lastname, email, username, gender, phone, userfield, password, avatar, role, terms) VALUES('$firstname', '$lastname', '$email', '$username', '$gender', '$phone', '$userfield', '$hashed_password', '$avatar_name', '$user_role','$terms')";

        $user_result = mysqli_query($connection, $user_query);

        if (!mysqli_errno($connection)) {
            // redirect to login page with success message
            $_SESSION['add-user-success'] = "New user $firstname $lastname added successfully";
        }
    }

}
   


//get back form data if there was a registration error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$gender = $_SESSION['add-user-data']['gender'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$phone = $_SESSION['add-user-data']['phone'] ?? null;
$userfield = $_SESSION['add-user-data']['userfield'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Users Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-users.php">Home</a></li>
          <li class="breadcrumb-item">Form</li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add New user</h1>
          <hr>
          <?php if(isset($_SESSION['add-user'])) : ?>
            <div class="alert_message error">
              <p>
                  <?= $_SESSION['add-user'];
                  unset($_SESSION['add-user']);
                  ?>
              </p>
            </div>
          <?php elseif(isset($_SESSION['add-user-success'])) : ?>
            <div class="alert_message success">
              <p>
                  <?= $_SESSION['add-user-success'];
                  unset($_SESSION['add-user-success']);
                  ?>
              </p>
            </div>
          <?php endif ?>
          <!-- Multi Columns Form -->
          <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">First Name</label>
                <input type="text" class="form-control"  name="firstname" value="<?=$firstname?>"
                    placeholder="First Name">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Last Name</label>
                <input type="text" class="form-control"  name="lastname" value="<?=$lastname?>"
                    placeholder="Last Name">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Email Address</label>
                <input type="email" class="form-control"  name="email" value="<?=$email?>"
                    placeholder="Email">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">User Name</label>
                <input type="text" class="form-control"  name="username" value="<?=$username?>"
                    placeholder="Username">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Gender</label>
                <input type="text" class="form-control"  name="gender" value="<?=$gender?>"
                    placeholder="gender">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">User Field</label>
                <input type="text" class="form-control" name="userfield" value="<?=$userfield?>"
                    placeholder="job (occupation)">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?=$phone?>"
                    placeholder="phone number">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Set Password</label>
                <input type="password" class="form-control" name="createpassword" 
                    placeholder="Create Password">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="inputName5" class="form-label">Retype Password</label>
                <input type="password" class="form-control" name="confirmpassword"
                    placeholder="Comfirm Password">
            </div>
            <div class="col-md-6">
                <label for="inputName5" class="form-label">User Role</label>
                <select name="role" id="inputState" class="form-select">
                    <option value="Bronze" selected>User</option>
                </select>
            </div>  
            <div class="col-md-6 form-group p_star">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
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