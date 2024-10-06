<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM pharmaceuticals WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $phar_name = filter_var($_POST['phar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_qty = filter_var($_POST['phar_qty'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_cat = filter_var($_POST['phar_cat'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_vendor = filter_var($_POST['phar_vendor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phar_desc = filter_var($_POST['phar_desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  if (!$phar_name){
      $_SESSION['edit-user'] = "please enter phar_name";
  } elseif (!$phar_qty) {
      $_SESSION['edit-user'] = "please enter phar_qty";
  } elseif (!$phar_desc) {
      $_SESSION['edit-user'] = "please enter phar_desc";
  } else {
     // update pharmaceuticals table
     $user_query = "UPDATE pharmaceuticals SET phar_name='$phar_name', phar_qty='$phar_qty', phar_cat='$phar_cat', phar_vendor='$phar_vendor', phar_desc ='$phar_desc' WHERE id=$id LIMIT 1";

     $user_result = mysqli_query($connection, $user_query);
 
     if (!mysqli_errno($connection)) {
         // redirect to manage-patient page with success message
         $_SESSION['edit-user-success'] = "pharmaceuticals: $phar_name, Updated successfully";
     }
  } 
  
}

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Pharmaceutical</h1>
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
          <h1 class="text-center card-title">Update Pharmaceutical</h1>
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
                <div class="form-group col-md-6">
                    <input type="hidden" class="form-control" name="id" value="<?= $user['id'] ?>">

                    <label for="inputEmail4" class="col-form-label">Pharmaceutical Name</label>
                    <input type="text" required="required" name="phar_name" value="<?=$user['phar_name']?>" class="form-control" id="inputEmail4" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="col-form-label">Pharmaceutical Quantity(Cartons)</label>
                    <input required="required" type="text" name="phar_qty" value="<?=$user['phar_qty']?>" class="form-control"  id="inputPassword4">
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
                <label for="inputAddress" class="col-form-label">Pharmaceutical Description</label>
                <textarea  type="text" class="form-control" name="phar_desc" id="editor"><?=$user['phar_desc']?></textarea>
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