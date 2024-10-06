<?php 
include '../partials/dashboardheader.php';
// fetch users from database but not Super admin
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM payrolls WHERE pay_id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} 

if (isset($_POST['submit'])) {
    // get signup form data if signup button was clicked
      $pay_doc_name = filter_var($_POST['pay_doc_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_doc_email = filter_var($_POST['pay_doc_email'], FILTER_VALIDATE_EMAIL);
      $pay_doc_number = filter_var($_POST['pay_doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_acc_number = filter_var($_POST['pay_acc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_emp_salary = filter_var($_POST['pay_emp_salary'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_descr = filter_var($_POST['pay_descr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      
  
    if (!$pay_doc_name){
        $_SESSION['edit-user'] = "please enter Doctor's fullname";
    } elseif (!$pay_doc_number) {
        $_SESSION['edit-user'] = "please enter Doctor's ID";  
    } elseif (!$pay_doc_email) {
        $_SESSION['edit-user'] = "please enter a valied email";
    } elseif (!$pay_emp_salary) {
        $_SESSION['edit-user'] = "please enter Doctor's salary";
    } elseif (!$pay_acc_number) {
        $_SESSION['edit-user'] = "please enter Doctor's Account Number";
    } elseif (!$pay_descr) {
        $_SESSION['edit-user'] = "please enter payroll Description";
    } 
       // UPDATE payrolls table    
       $status  = $_POST['status'];  
      $user_query = " UPDATE payrolls SET pay_doc_name='$pay_doc_name', pay_descr='$pay_descr', pay_doc_email='$pay_doc_email', pay_doc_number='$pay_doc_number', pay_acc_number='$pay_acc_number', pay_emp_salary='$pay_emp_salary', status='$status' WHERE pay_id=$id LIMIT 1";
  
      $user_result = mysqli_query($connection, $user_query);
  
      if (!mysqli_errno($connection)) {
          // redirect to manpassword-doctor ppassword with success messpassword
          $_SESSION['edit-user-success'] = "Doctor: $pay_doc_name, updated to payroll successfully";
      }
    
  
  }

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Doctor Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-payroll.php">Home</a></li>
          <li class="breadcrumb-item">Payroll</li>
          <li class="breadcrumb-item active">Staff</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Update Doctors/Consultants/Others</h1>
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
            <form method="post" enctype="multipart/form-data" class="row g-3">
                <div class="row">

                    <div class="form-group col-md-4">
                        <input type="hidden" class="form-control" name="id" value="<?= $user['pay_id'] ?>">

                        <label for="inputEmail4" class="col-form-label">Doctor's Name</label>
                        <input type="text" required="required" readonly name="pay_doc_name" value="<?=$user['pay_doc_name']?>" class="form-control" id="inputEmail4" placeholder="Patient's Name">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4" class="col-form-label">Doctor's Email</label>
                        <input required="required" type="text" readonly name="pay_doc_email" value="<?=$user['pay_doc_email'] ?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4" class="col-form-label">Doctor's Number</label>
                        <input required="required" type="text" readonly name="pay_doc_number" value="<?= $user['pay_doc_number']?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="inputEmail4" class="col-form-label">Doctor's Salary ($/NGN)</label>
                        <input type="text" required="required"  name="pay_emp_salary" value="<?=$user['pay_emp_salary']?>"  class="form-control" id="inputEmail4" >
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputEmail4" class="col-form-label">Doctor's Account Number</label>
                        <input type="text" required="required"  name="pay_acc_number" value="<?=$user['pay_acc_number']?>"  class="form-control" id="inputEmail4" >
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputEmail4" class="col-form-label">Doctor's Account Number</label>
                        <input type="text" required="required"  name="status" value="<?=$user['status']?>"  class="form-control" id="inputEmail4" >
                    </div>

                    <!-- <div class="form-group col-md-4">
                        <label for="inputEmail4" class="col-form-label">Doctor's Pay Status</label>
                        <select id="inputState" name="status" class="form-select">
                            <option selected>Update Status</option>
                            <option value="Paid">Paid</option>
                            <option value="NotPaid">Not Paid</option>
                            <option value="Pending">Pending</option>                        
                        </select>
                    </div> -->
                    
                </div>
                
                <div class="form-group">
                        <label for="inputAddress" class="col-form-label">Payroll Description</label>
                        <textarea   type="text" class="form-control" name="pay_descr" id="editor"><?=$user['pay_descr']?> </textarea>
                </div>

                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php' ?>