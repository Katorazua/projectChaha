<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM equipments WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $eqp_name = filter_var($_POST['eqp_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_qty = filter_var($_POST['eqp_qty'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_dept = filter_var($_POST['eqp_dept'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_vendor = filter_var($_POST['eqp_vendor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_code = filter_var($_POST['eqp_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_status = filter_var($_POST['eqp_status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eqp_desc = filter_var($_POST['eqp_desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  if (!$eqp_name){
      $_SESSION['edit-user'] = "please enter eqp_name";
  } elseif (!$eqp_qty) {
      $_SESSION['edit-user'] = "please enter eqp_qty";
  } elseif (!$eqp_code) {
      $_SESSION['edit-user'] = "please enter eqp_code";
  } elseif (!$eqp_desc) {
      $_SESSION['edit-user'] = "please enter eqp_desc";
  } else {
    // update equipments table
    $user_query = "UPDATE equipments SET eqp_name='$eqp_name', eqp_qty='$eqp_qty', eqp_dept='$eqp_dept', eqp_vendor='$eqp_vendor', eqp_desc ='$eqp_desc', eqp_status='$eqp_status' WHERE id=$id LIMIT 1";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // redirect to manage-patient page with success message
        $_SESSION['edit-user-success'] = "Equipments: $eqp_name, Updated successfully";
    }
  } 

}

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Equipments</h1>
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
          <h1 class="text-center card-title">Update Equipments</h1>
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
                    <label for="inputEmail4" class="col-form-label">Equipment Name</label>
                    <input type="text" required="required" name="eqp_name" value="<?=$user['eqp_name']?>" class="form-control" id="inputEmail4" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="col-form-label">Equipment Quantity(Cattons)</label>
                    <input required="required" type="text" name="eqp_qty" value="<?=$user['eqp_qty']?>" class="form-control"  id="inputPassword4">
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
                <input required="required" type="text" value="<?= $user['eqp_code'];?>" name="eqp_code" class="form-control"  id="inputPassword4">
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
                <textarea  type="text" class="form-control" name="eqp_desc" rows="5" id="editor"><?=$user['eqp_desc']?></textarea>
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