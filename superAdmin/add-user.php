<?php
// session_start(); // Start the session

include '../partials/dashboardheader.php'; // Include your header file

// Database connection
// $connection = mysqli_connect('hostname', 'username', 'password', 'database');
// if (!$connection) {
//     die("Connection failed: " . mysqli_connect_error());
// }

if (isset($_POST['submit'])) {
    // Get signup form data
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

    // Validate form inputs
    if (!$firstname) {
        $_SESSION['add-user'] = "Please enter your first name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please enter your last name";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter a valid email";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please enter your user name";
    } elseif (!$gender) {
        $_SESSION['add-user'] = "Please enter your gender";
    } elseif (!$userfield) {
        $_SESSION['add-user'] = "Please enter your field";
    } elseif (!$phone) {
        $_SESSION['add-user'] = "Please enter your phone number";
    } elseif (strlen($createpassword) < 8) {
        $_SESSION['add-user'] = "Password should be at least 8 characters";
    } elseif ($createpassword !== $confirmpassword) {
        $_SESSION['add-user'] = "Passwords do not match";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "Please upload an avatar";
    } else {
        // Hashed password
        $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
        
        // Check if username or email already exists in the database
        $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);

        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['add-user'] = "Username or email already exists";
        } else {
            // Handle avatar upload
            $time = time(); // Make each image name unique
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = '../images/' . $avatar_name;

            // Validate image file
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($avatar_name, PATHINFO_EXTENSION);
            if (in_array($extension, $allowed_files) && $avatar['size'] < 1000000) {
                // Upload avatar
                move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
            } else {
                $_SESSION['add-user'] = "File should be png, jpg, or jpeg and less than 1MB";
            }

            // Insert new user into users table
            if (!isset($_SESSION['add-user'])) { // Only insert if no errors
                $terms = "I accept";
                $user_query = "INSERT INTO users (firstname, lastname, email, username, gender, phone, userfield, password, avatar, role, terms) 
                               VALUES ('$firstname', '$lastname', '$email', '$username', '$gender', '$phone', '$userfield', '$hashed_password', '$avatar_name', '$user_role', '$terms')";

                $user_result = mysqli_query($connection, $user_query);
                if (!$user_result) {
                    die("Query failed: " . mysqli_error($connection));
                }

                $_SESSION['add-user-success'] = "New user $firstname $lastname added successfully";
            }
        }
    }

    // Redirect back to add-user page if there was any problem
    if (isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST; // Pass form data back
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
                    <option value="Bronze" selected>Bronze User</option>
                    <option value="Silver">Silver User</option>
                    <option value="Gold">Gold User</option>
                    <option value="Diamond">Diamond User</option>
                    <option value="Admin">Admin</option>
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