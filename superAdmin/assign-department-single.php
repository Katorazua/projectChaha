<?php 
include '../partials/dashboardheader.php';
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM doctors WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 


if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $company_name = filter_var($_POST['company_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $doc_number = filter_var($_POST['doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dept = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$fullname){
      $_SESSION['edit-user'] = "Invalid form input on edit page."; 
  } elseif (!$doc_number) {
      $_SESSION['edit-user'] = "Invalid form input on edit page.";  
  } elseif (!$company_name) {
      $_SESSION['edit-user'] = "Invalid form input on edit page. Please add company name";
  } elseif (!$dept) {
      $_SESSION['edit-user'] = "Invalid form input on edit page.";
  } else {

    $user_query = "UPDATE doctors SET department='$dept', company_name='$company_name' WHERE id = $id LIMIT 1";

    $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
      // redirect to manpassword-doctor ppassword with success messpassword
      $_SESSION['edit-user-success'] = "Doctor: $fullname, Assigned Department successfully. Click on 'Home'";
    }
  }
}


// featch category from database
$query = "SELECT * FROM department";
$department = mysqli_query($connection, $query);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Assign Doctor's Department</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-doctors.php">Home</a></li>
          <li class="breadcrumb-item">Form</li>
          <li class="breadcrumb-item active">Staff</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Doctors/Consultants/Others</h1>
          <hr>
            <?php if(isset($_SESSION['edit-user-success'])) :  // show if edit-user is successful ?>
                <div class="alert_message success text-center container">
                    <p>
                    <?=  $_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']);
                    ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['edit-user'])) :  // show if edit-user was NOT successful ?>
                <div class="alert_message error container">
                    <p>
                    <?=  $_SESSION['edit-user'];
                    unset($_SESSION['edit-user']);
                    ?>
                    </p>
                </div>
            <?php endif ?>
          <!-- Multi Columns Form -->
          <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <input type="hidden" class="form-control" name="id" value="<?= $user['id'] ?>">

              <label for="inputName5" class="form-label">Full Name</label>
              <input type="text" name="fullname" value="<?= "{$user['firstname']}  {$user['lastname']}" ?>" class="form-control" id="inputName5" placeholder="fullname">
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">ID</label>
              <input type="text" name="doc_number" value="<?= $user['doc_number']?>" class="form-control" id="inputName5" placeholder="Doctor's number">
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Company Name</label>
              <input type="text" name="company_name"  class="form-control" id="inputName5" placeholder="company name">
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Dpartment </label>
              <select name="department" id="inputState" class="form-select">
                <option selected>Choose...</option>
                <?php while ($category = mysqli_fetch_assoc($department)) : ?>
                <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
                <?php endwhile ?>
            </select>
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