<?php 
include '../partials/docheader.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM patient_assign WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])){
// get updated form data
$admin_id = $_SESSION['user-id'];
$s_pat_name = filter_var($_POST['s_pat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$s_pat_ailment = filter_var($_POST['s_pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$s_pat_number = filter_var($_POST['s_pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$s_pat_status = filter_var($_POST['s_pat_status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$s_doc = filter_var($_POST['s_doc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$s_number = filter_var($_POST['s_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // check for valid input
    if(!$s_pat_status) {
        $_SESSION['edit-user'] = "Please enter patient's Surgery Status.";
    } else {
      // check if user name or email already exist in datagase
      $user_check_query = "SELECT s_pat_number FROM surgery WHERE s_pat_number='$s_pat_number'";
      $user_check_result = mysqli_query($connection, $user_check_query);

      if (mysqli_num_rows($user_check_result) > 0) {
          $_SESSION['edit-user'] = "Patient surgery details already exist";
      } else {
        // insert new user into surgery table
        $user_query = " INSERT INTO surgery (doc_id, s_pat_name, s_pat_ailment, s_number, s_pat_number, s_pat_status, s_doc) VALUES('$admin_id', '$s_pat_name', '$s_pat_ailment', '$s_number', '$s_pat_number', '$s_pat_status', '$s_doc')";

        $user_result = mysqli_query($connection, $user_query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Patient's surgery fialed";
        } else {
            $_SESSION['edit-user-success'] = "$s_pat_name Surgery Detials Added Successfully. Click on 'Home'";
        }
      }
        
    }
    
}
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Surgery Patient Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-pat-surgery.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Surgery | Theatre</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Fill All Fields</h1>
          <hr>
          <?php if(isset($_SESSION['edit-user'])) : ?>
            <div class="alert_message error">
              <p>
                  <?= $_SESSION['edit-user'];
                  unset($_SESSION['edit-user']);
                  ?>
              </p>
            </div>
          <?php elseif(isset($_SESSION['edit-user-success'])) : ?>
            <div class="alert_message success text-center">
              <p>
                  <?= $_SESSION['edit-user-success'];
                  unset($_SESSION['edit-user-success']);
                  ?>
              </p>
            </div>
          <?php endif ?>
          <!-- Multi Columns Form -->
          <form method="post" class="row g-3">
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Patient Name</label>
              <input type="text" name="s_pat_name" value="<?="{$user['pat_fname']} {$user['pat_lname']}"?>" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Patient Ailment</label>
              <input type="text" name="s_pat_ailment" value="<?=$user['pat_ailment']?>" class="form-control" id="inputName5">
            </div>       
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Patient's ID (Hospital No.)</label>
              <input type="text" name="s_pat_number" value="<?=$user['pat_number']?>" class="form-control" id="inputName5">
            </div>   
            <?php
                $query = "SELECT * FROM doctors WHERE department = 'Surgery | Theatre' ORDER BY RAND()";
                $result = mysqli_query($connection, $query);
            ?>  
            <div class="col-md-6">
              <label for="inputState" class="form-label">Surgeon </label>
              <select name="s_doc" id="inputState" class="form-select">
                <option selected>Choose a Surgeon...</option>
                <?php while ($user = mysqli_fetch_assoc($result)) : ?>
                <option value="<?="{$user['firstname']} {$user['lastname']}"?>">Dr. <?="{$user['firstname']} {$user['lastname']}"?></option>
                <?php endwhile ?>
            </select>
            </div>           
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Surgery Status</label>
              <input type="text" name="s_pat_status" class="form-control" id="inputName5">
            </div>   
            <div class="form-row">
                                               
              <div class="form-group col-md-2" style="display:none">
                  <?php 
                      $length = 5;    
                      $s_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                  ?>
                  <label for="inputZip" class="col-form-label">Surgery Record Number</label>
                  <input type="text" name="s_number" value="<?php echo $s_number;?>" class="form-control" id="inputZip">
              </div>
          </div>                           
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-primary"> Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php' ?>