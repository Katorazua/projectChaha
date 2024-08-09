<?php 
include '../partials/dashboardheader.php';

if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $phar_name = filter_var($_POST['phar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_qty = filter_var($_POST['phar_qty'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_cat = filter_var($_POST['phar_cat'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_vendor = filter_var($_POST['phar_vendor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_bcode = filter_var($_POST['phar_bcode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_desc = filter_var($_POST['phar_desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  if (!$phar_name || !$phar_qty || !$phar_bcode || !$phar_desc){
      $_SESSION['add-user'] = "please enter all required field";
  } else {
     // check if pat_number or v_email already exist in datagase
     $user_check_query = "SELECT phar_name FROM pharmaceuticals WHERE phar_name ='$phar_name'";
     $user_check_result = mysqli_query($connection, $user_check_query);

     if (mysqli_num_rows($user_check_result) > 0) {
         $_SESSION['add-user'] = "pharmaceutical already exist or has been taken";
     }
  } 

  // redirect back to add-patient page if there was any problem
  if (isset($_SESSION['add-user'])) {
    // pass form data back to add-user page
    $_SESSION['add-user-data'] = $_POST;
  } else {
    // insert new user into pharmaceuticals table
    $user_query = " INSERT INTO pharmaceuticals (admin_id, phar_name, phar_qty, phar_cat, phar_vendor, phar_bcode, phar_desc) VALUES('$admin_id', '$phar_name', '$phar_qty', '$phar_cat', '$phar_vendor', '$phar_bcode', '$phar_desc')";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manage-patient page with success message
        $_SESSION['add-user-success'] = "New pharmaceuticals: $phar_name, added successfully";
    }
  } 
}

//get back form data if there was a registration error
$phar_name = $_SESSION['add-user-data']['phar_name'] ?? null;
$phar_desc = $_SESSION['add-user-data']['phar_desc'] ?? null;
$phar_qty = $_SESSION['add-user-data']['phar_qty'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Create A Pharmaceutical</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-pharmaceuticals.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Fill all fields</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Pharmaceutical</h1>
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
                    <label for="inputEmail4" class="col-form-label">Pharmaceutical Name</label>
                    <input type="text" required="required" name="phar_name" value="<?=$phar_name?>" class="form-control" id="inputEmail4" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="col-form-label">Pharmaceutical Quantity(Cartons)</label>
                    <input required="required" type="text" name="phar_qty" value="<?=$phar_qty?>" class="form-control"  id="inputPassword4">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Pharmaceutical Category</label>
                <select name="phar_cat" id="inputState" class="form-select">
                    <?php
                    $query = "SELECT * FROM pharmaceuticals_categories ORDER BY RAND()";
                    $vendor = mysqli_query($connection, $query);
                    ?>
                    <option selected>Choose Pharmaceutical Category...</option>
                    <?php while ($category = mysqli_fetch_assoc($vendor)) : ?>
                    <option value="<?= $category['pharm_cat_name'] ?>"><?= $category['pharm_cat_name'] ?></option>
                    <?php endwhile ?>
                </select>
            </div> 
            <div class="col-md-6">
                <label for="inputState" class="form-label">Pharmaceutical Vendor</label>
                <select name="phar_vendor" id="inputState" class="form-select">
                    <?php
                    $query = "SELECT * FROM vendor ORDER BY RAND()";
                    $vendor = mysqli_query($connection, $query);
                    ?>
                    <option selected>Choose Pharmaceutical Vendor...</option>
                    <?php while ($category = mysqli_fetch_assoc($vendor)) : ?>
                    <option value="<?= $category['v_name'] ?>"><?= $category['v_name'] ?></option>
                    <?php endwhile ?>
                </select>
            </div>   
            <div class="form-group">
                <label for="inputPassword4" class="col-form-label">Pharmaceutical Barcode(EAN-8)</label>
                <?php 
                    $length = 5;    
                    $phar_bcode =  substr(str_shuffle('0123456789'),1,$length);
                ?>
                <input required="required" type="text" value="CEH<?php echo $phar_bcode;?>" name="phar_bcode" class="form-control"  id="inputPassword4">
            </div>

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Pharmaceutical Description</label>
                <textarea  type="text" class="form-control" name="phar_desc" id="editor"><?=$phar_desc?></textarea>
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