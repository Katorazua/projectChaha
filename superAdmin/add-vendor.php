<?php 
include '../partials/dashboardheader.php';

if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $v_name = filter_var($_POST['v_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $v_phone = filter_var($_POST['v_phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $v_email = filter_var($_POST['v_email'], FILTER_VALIDATE_EMAIL);
    $v_adr = filter_var($_POST['v_adr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $v_desc = filter_var($_POST['v_desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $v_number = filter_var($_POST['v_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  if (!$v_name){
      $_SESSION['add-user'] = "please enter Vendor's name";
  } elseif (!$v_phone) {
      $_SESSION['add-user'] = "please enter Vendor's phone number";  
  } elseif (!$v_adr) {
      $_SESSION['add-user'] = "please enter Vendor's address";
  } elseif (!$v_email) {
      $_SESSION['add-user'] = "please enter a valied v_email";
  } elseif (!$v_desc) {
      $_SESSION['add-user'] = "please enter Vendor's description note";
  } else {
     // check if pat_number or v_email already exist in datagase
     $user_check_query = "SELECT v_name, v_email FROM vendor WHERE v_name ='$v_name' OR v_email='$v_email' ";
     $user_check_result = mysqli_query($connection, $user_check_query);

     if (mysqli_num_rows($user_check_result) > 0) {
         $_SESSION['add-user'] = "Vendor's name or email already exist or has been taken";
     }
  } 

  // redirect back to add-patient page if there was any problem
  if (isset($_SESSION['add-user'])) {
    // pass form data back to add-user page
    $_SESSION['add-user-data'] = $_POST;
  } else {
    // insert new user into vendor table
    $user_query = " INSERT INTO vendor (admin_id, v_name, v_phone, v_email, v_adr, v_desc, v_number) VALUES('$admin_id', '$v_name', '$v_phone', '$v_email', '$v_adr', '$v_desc', '$v_number')";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manage-patient page with success message
        $_SESSION['add-user-success'] = "New Vendor: $v_name, added successfully";
    }
  } 
}

//get back form data if there was a registration error
$v_name = $_SESSION['add-user-data']['v_name'] ?? null;
$v_phone = $_SESSION['add-user-data']['v_phone'] ?? null;
$v_adr = $_SESSION['add-user-data']['v_adr'] ?? null;
$v_email = $_SESSION['add-user-data']['v_email'] ?? null;
$v_desc = $_SESSION['add-user-data']['v_desc'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Vendor Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-vendor.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Vendor</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Vendor </h1>
          <hr>
            <?php if(isset($_SESSION['add-user-success'])) :  //show if add-user is successful ?>
                <div class="alert_message success container">
                    <p>
                        <?=  $_SESSION['add-user-success'];
                        unset($_SESSION['add-user-success']);
                        ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['add-user'])) : ?>
                <div class="alert_message error">
                    <p>
                        <?= $_SESSION['add-user'];
                        unset($_SESSION['add-user']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
          <!-- Multi Columns Form -->
          <form method="post" enctype="multypat/form-data" class="row g-3">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4" class="col-form-label">Vendor Name</label>
                    <input type="text" required="required" name="v_name" value="<?=$v_name?>" class="form-control" id="inputEmail4" >
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4" class="col-form-label">Vendor Phone Number</label>
                    <input required="required" type="text" name="v_phone" value="<?=$v_phone?>" class="form-control"  id="inputPassword4">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4" class="col-form-label">Vendor Address</label>
                    <input required="required" type="text" name="v_adr" value="<?=$v_adr?>" class="form-control"  id="inputPassword4">
                </div>
            </div>

            <div class="form-group col-md-2" style="display:none">
                    <?php 
                        $length = 8;    
                        $vendor_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                    ?>
                    <label for="inputZip" class="col-form-label">Vendor Number</label>
                    <input type="text" name="v_number" value="<?=$vendor_number?>" class="form-control" id="inputZip">
                </div>

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Vendor Email</label>
                <input required="required" type="email" class="form-control" name="v_email" value="<?=$v_email?>" id="inputAddress">
            </div>

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Vendor Details</label>
                <textarea  type="text" class="form-control" name="v_desc" id="editor"><?=$v_desc?></textarea>
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