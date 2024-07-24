<?php 
include '../partials/dashboardheader.php';

if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $pharm_cat_name = filter_var($_POST['pharm_cat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pharm_cat_desc = filter_var($_POST['pharm_cat_desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pharm_cat_vendor = filter_var($_POST['pharm_cat_vendor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  if (!$pharm_cat_name || !$pharm_cat_desc){
      $_SESSION['add-user'] = "please enter all required field";
  } else {
     // check if pat_number or v_email already exist in datagase
     $user_check_query = "SELECT pharm_cat_name FROM pharmaceuticals_categories WHERE pharm_cat_name ='$pharm_cat_name'";
     $user_check_result = mysqli_query($connection, $user_check_query);

     if (mysqli_num_rows($user_check_result) > 0) {
         $_SESSION['add-user'] = "pharmaceuticals_categories already exist or has been taken";
     }
  } 

  // redirect back to add-patient page if there was any problem
  if (isset($_SESSION['add-user'])) {
    // pass form data back to add-user page
    $_SESSION['add-user-data'] = $_POST;
  } else {
    // insert new user into pharmaceuticals_categories table
    $user_query = " INSERT INTO pharmaceuticals_categories (admin_id, pharm_cat_name, pharm_cat_desc, pharm_cat_vendor) VALUES('$admin_id', '$pharm_cat_name', '$pharm_cat_desc', '$pharm_cat_vendor')";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manage-patient page with success message
        $_SESSION['add-user-success'] = "New pharmaceuticals_categories: $pharm_cat_name, added successfully";
    }
  } 
}

//get back form data if there was a registration error
$pharm_cat_name = $_SESSION['add-user-data']['pharm_cat_name'] ?? null;
$pharm_cat_desc = $_SESSION['add-user-data']['pharm_cat_desc'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Create A Pharmaceutical Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-pharm-category.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Fill all fields</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Pharmaceutical Category</h1>
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
                    <label for="inputEmail4" class="col-form-label">Pharmaceutical Category Name</label>
                    <input type="text" required="required" name="pharm_cat_name" value="<?=$pharm_cat_name?>" class="form-control" id="inputEmail4" >
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Pharmaceutical Vendor</label>
                    <select name="pharm_cat_vendor" id="inputState" class="form-select">
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
            </div>

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Pharmaceutical Category Description</label>
                <textarea  type="text" class="form-control" name="pharm_cat_desc" id="editor"><?=$pharm_cat_desc?></textarea>
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