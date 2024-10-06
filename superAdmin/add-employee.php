<?php 
include '../partials/dashboardheader.php';

if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $emp_number = filter_var($_POST['emp_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $addr = filter_var($_POST['addr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $department = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $company_name = filter_var($_POST['company_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

  if (!$firstname){
      $_SESSION['add-user'] = "please enter employee's first name";
  } elseif (!$lastname) {
      $_SESSION['add-user'] = "please enter employee's last name";  
  } elseif (!$emp_number) {
      $_SESSION['add-user'] = "please enter employee's ID";  
  } elseif (!$gender) {
      $_SESSION['add-user'] = "please enter employee's gender";  
  } elseif (!$age) {
      $_SESSION['add-user'] = "please enter employee's age";  
  } elseif (!$email) {
      $_SESSION['add-user'] = "please enter a valied email";
  } elseif (!$phone) {
      $_SESSION['add-user'] = "please enter employee's phone number";
  } elseif (!$addr) {
      $_SESSION['add-user'] = "please enter employee's address";
  } elseif (!$department) {
      $_SESSION['add-user'] = "please enter employee's department";
  } elseif (!$city) {
      $_SESSION['add-user'] = "please enter employee's city/country";
  } elseif (!$company_name) {
      $_SESSION['add-user'] = "please enter employee's company name";
  } elseif (!$avatar['name']) {
      $_SESSION['add-user'] = "please add employee's avatar";
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
  
    // redirect back to add-employee pdepartment if there was any problem
    if (isset($_SESSION['add-user'])) {
    // pass form data back to add-user pdepartment
    $_SESSION['add-user-data'] = $_POST;
    } else {
        $status = "Active Staff";
        // insert new user into employees table
        $user_query = " INSERT INTO employees (admin_id, firstname, lastname, email, emp_number, age, gender, phone, emp_addr, city, department, company_name, avatar, status, role) VALUES('$admin_id', '$firstname', '$lastname', '$email', '$emp_number','$age', '$gender', '$phone', '$adrr', '$city', '$department',  '$company_name', '$avatar_name', '$status', '$role')";

        $user_result = mysqli_query($connection, $user_query);

        if (!mysqli_errno($connection)) {
            // redirect to add-employee page with success message
            $_SESSION['add-user-success'] = "New employee: $firstname $lastname, added successfully";
        }
    } 

}


//get back form data if there was a registration error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$gender = $_SESSION['add-user-data']['gender'] ?? null;
$age = $_SESSION['add-user-data']['age'] ?? null;
$emp_number = $_SESSION['add-user-data']['emp_number'] ?? null;
$phone = $_SESSION['add-user-data']['phone'] ?? null;
$addr = $_SESSION['add-user-data']['addr'] ?? null;
$city = $_SESSION['add-user-data']['city'] ?? null;
$company_name = $_SESSION['add-user-data']['company_name'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Employee Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-employee.php">Home</a></li>
          <li class="breadcrumb-item">Form</li>
          <li class="breadcrumb-item active">Staff</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Employee</h1>
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
            <div class="col-md-6">
              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" name="firstname" value="<?= $firstname ?>" class="form-control" id="inputName5" placeholder="firstname">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Last Name</label>
              <input type="text" name="lastname" value="<?=$lastname?>" class="form-control" id="inputName5" placeholder="lastname">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">ID</label>
              <?php 
                  $length = 5;    
                  $emp_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
              ?>
              <input type="text" name="emp_number" value="CEH/EMP/<?= $emp_number?>" class="form-control" id="inputName5" placeholder="employee's number">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Gender</label>
              <input type="text" name="gender" value="<?= $gender?>" class="form-control" id="inputName5" placeholder="employee's gender">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Age</label>
              <input type="text" name="age" value="<?= $age?>" class="form-control" id="inputName5" placeholder="employee's age">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="email" name="email" value="<?=$email?>" class="form-control" id="inputEmail5" placeholder="email address">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Phone</label>
              <input type="text" name="phone" value="<?=$phone?>" class="form-control" id="inputEmail5" placeholder="phone number">
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Address</label>
              <input type="text" name="addr" value="<?=$addr?>" class="form-control" id="inputEmail5" placeholder="employee's address">
            </div> 
            <?php 
                $category = "SELECT * FROM department";
                $result = mysqli_query($connection,$category);
            ?>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Department</label>
              <select id="inputState" name="department" class="form-select">
              <option selected>Choose user department...</option>
                <?php while ($department = mysqli_fetch_assoc($result)) :?>                
                <option value="<?=$department['name'] ?>"><?=$department['name'] ?></option>
                <?php endwhile ?>
              </select>
            </div> 
            <div class="col-md-6">
              <label for="inputState" class="form-label">Role</label>
              <select id="inputState" name="role" class="form-select">
                <option selected>Choose user role...</option>
                <option value="Nurse">Nurse</option>
                <option value="Lab">MLS/MLT</option>
                <option value="Reseptionist">Reseptionist</option>
                <option value="Accountant">Accountant</option>
                <option value="Casher">Casher</option>
                <option value="Security">Security</option>
                <option value="StoreKeeper">StoreKeeper</option>
              </select>
            </div> 
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">City</label>
              <input type="text" name="city" value="<?=$city?>" class="form-control" id="inputEmail5" placeholder="employee's city/country">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Company Name</label>
              <input type="text" name="company_name" value="<?=$company_name?>" class="form-control" id="inputEmail5" placeholder="employee's company name">
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Employee Avatar</label>
              <input type="file" name="avatar" class="form-control" id="inputEmail5">
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