<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM vendor WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $v_name = filter_var($_POST['v_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $v_phone = filter_var($_POST['v_phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $v_email = filter_var($_POST['v_email'], FILTER_VALIDATE_EMAIL);
    $v_adr = filter_var($_POST['v_adr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $v_desc = filter_var($_POST['v_desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $v_number = filter_var($_POST['v_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  if (!$v_name){
      $_SESSION['edit-user'] = "please enter Vendor's name";
  } elseif (!$v_phone) {
      $_SESSION['edit-user'] = "please enter Vendor's phone number";  
  } elseif (!$v_adr) {
      $_SESSION['edit-user'] = "please enter Vendor's address";
  } elseif (!$v_email) {
      $_SESSION['edit-user'] = "please enter a valied v_email";
  } elseif (!$v_desc) {
      $_SESSION['edit-user'] = "please enter Vendor's description note";
  } else {
    // Update vendor table
    $user_query = " UPDATE vendor SET  v_name='$v_name', v_phone='$v_phone', v_email='$v_email', v_adr='$v_adr', v_desc='$v_desc' WHERE id = $id LIMIT 1";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manage-patient page with success message
        $_SESSION['edit-user-success'] = "Vendor: $v_name, updated successfully";
    }
  } 

  
}

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Vendor Details</h1>
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
          <h1 class="text-center card-title">Update Vendor </h1>
          <hr>
            <?php if(isset($_SESSION['edit-user-success'])) :  //show if edit-user is successful ?>
                <div class="alert_message success container">
                    <p>
                        <?=  $_SESSION['edit-user-success'];
                        unset($_SESSION['edit-user-success']);
                        ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['edit-user'])) : ?>
                <div class="alert_message error">
                    <p>
                        <?= $_SESSION['edit-user'];
                        unset($_SESSION['edit-user']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
          <!-- Multi Columns Form -->
          <form method="post" enctype="multypat/form-data" class="row g-3">
            <div class="row">
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" name="id" value="<?= $user['id'] ?>">

                    <label for="inputEmail4" class="col-form-label">Vendor Name</label>
                    <input type="text" required="required" name="v_name" value="<?=$user['v_name']?>" class="form-control" id="inputEmail4" >
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4" class="col-form-label">Vendor Phone Number</label>
                    <input required="required" type="text" name="v_phone" value="<?=$user['v_phone']?>" class="form-control"  id="inputPassword4">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4" class="col-form-label">Vendor Address</label>
                    <input required="required" type="text" name="v_adr" value="<?=$user['v_adr']?>" class="form-control"  id="inputPassword4">
                </div>
            </div>

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Vendor Email</label>
                <input required="required" type="email" class="form-control" name="v_email" value="<?=$user['v_email']?>" id="inputAddress">
            </div>

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Vendor Details</label>
                <textarea  type="text" class="form-control" name="v_desc" id="editor"><?=$user['v_desc']?></textarea>
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