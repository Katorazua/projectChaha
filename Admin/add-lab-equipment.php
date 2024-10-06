<?php 
include '../partials/dashboardheader.php';

if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $eqp_name = filter_var($_POST['eqp_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_qty = filter_var($_POST['eqp_qty'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_dept = filter_var($_POST['eqp_dept'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_vendor = filter_var($_POST['eqp_vendor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_code = filter_var($_POST['eqp_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_status = filter_var($_POST['eqp_status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_desc = filter_var($_POST['eqp_desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  if (!$eqp_name || !$eqp_qty || !$eqp_code || !$eqp_desc){
      $_SESSION['add-user'] = "please enter all required fields";
  }  else {
     // check if pat_number or v_email already exist in datagase
     $user_check_query = "SELECT eqp_name FROM equipments WHERE eqp_name ='$eqp_name'";
     $user_check_result = mysqli_query($connection, $user_check_query);

     if (mysqli_num_rows($user_check_result) > 0) {
         $_SESSION['add-user'] = "equipments already exist, you can only update";
     }
  } 

  // redirect back to add-patient page if there was any problem
  if (isset($_SESSION['add-user'])) {
    // pass form data back to add-user page
    $_SESSION['add-user-data'] = $_POST;
  } else {
    // insert new user into equipments table
    $user_query = " INSERT INTO equipments (admin_id, eqp_name, eqp_qty, eqp_dept, eqp_vendor, eqp_code, eqp_desc, eqp_status) VALUES('$admin_id', '$eqp_name', '$eqp_qty', '$eqp_dept', '$eqp_vendor', '$eqp_code', '$eqp_desc', '$eqp_status')";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manage-patient page with success message
        $_SESSION['add-user-success'] = "New equipments: $eqp_name, added successfully";
    }
  } 
}

//get back form data if there was a registration error
$eqp_name = $_SESSION['add-user-data']['eqp_name'] ?? null;
$eqp_desc = $_SESSION['add-user-data']['eqp_desc'] ?? null;
$eqp_qty = $_SESSION['add-user-data']['eqp_qty'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Create An Equipments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-lab-equipments.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Fill all fields</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Equipments</h1>
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
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="col-form-label">Equipment Name</label>
                    <input type="text" required="required" name="eqp_name" value="<?=$eqp_name?>" class="form-control" id="inputEmail4" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="col-form-label">Equipment Quantity(Cattons)</label>
                    <input required="required" type="text" name="eqp_qty" value="<?=$eqp_qty?>" class="form-control"  id="inputPassword4">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Equipment Department</label>
                <select name="eqp_dept" id="inputState" class="form-select">
                    <?php
                    $query = "SELECT * FROM department ORDER BY RAND()";
                    $dept = mysqli_query($connection, $query);
                    ?>
                    <option selected>Choose Equipment Department...</option>
                    <?php while ($department = mysqli_fetch_assoc($dept)) : ?>
                    <option value="<?= $department['name'] ?>"><?= $department['name'] ?></option>
                    <?php endwhile ?>
                </select>
            </div> 
            <div class="col-md-6">
                <label for="inputState" class="form-label">Equipment Vendor</label>
                <select name="eqp_vendor" id="inputState" class="form-select">
                    <?php
                    $query = "SELECT * FROM vendor ORDER BY RAND()";
                    $vendor = mysqli_query($connection, $query);
                    ?>
                    <option selected>Choose Equipment Vendor...</option>
                    <?php while ($deptegory = mysqli_fetch_assoc($vendor)) : ?>
                    <option value="<?= $deptegory['v_name'] ?>"><?= $deptegory['v_name'] ?></option>
                    <?php endwhile ?>
                </select>
            </div>   
            <div class="form-group col-md-6">
                <label for="inputPassword4" class="col-form-label">Equipment Barcode(EAN-8)</label>
                <?php 
                    $length = 5;    
                    $eqp_code =  substr(str_shuffle('0123456789'),1,$length);
                ?>
                <input required="required" type="text" value="CEH<?php echo $eqp_code;?>" name="eqp_code" class="form-control"  id="inputPassword4">
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Equipment Status</label>
              <select id="inputState" name="eqp_status" class="form-select">
                <option selected>Choose Equipment Status...</option>
                <option value="Functioning">Functioning</option>
                <option value="Not Functioning">Not Functioning</option>
              </select>
            </div> 

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Equipment Description</label>
                <textarea  type="text" class="form-control" name="eqp_desc" rows="5" id="editor"><?=$eqp_desc?></textarea>
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