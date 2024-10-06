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
      $admin_id = $_SESSION['user-id'];
      $pay_doc_name = filter_var($_POST['pay_doc_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_doc_email = filter_var($_POST['pay_doc_email'], FILTER_VALIDATE_EMAIL);
      $rid = filter_var($_POST['pay_doc_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_doc_number = filter_var($_POST['pay_doc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_acc_number = filter_var($_POST['pay_acc_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_emp_salary = filter_var($_POST['pay_emp_salary'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_number = filter_var($_POST['pay_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pay_descr = filter_var($_POST['pay_descr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
    if (!$pay_doc_name){
        $_SESSION['add-user'] = "please enter Doctor's fullname";
    } elseif (!$pay_doc_number) {
        $_SESSION['add-user'] = "please enter Doctor's ID";  
    } elseif (!$pay_doc_email) {
        $_SESSION['add-user'] = "please enter a valied email";
    } elseif (!$pay_emp_salary) {
        $_SESSION['add-user'] = "please enter Doctor's salary";
    } elseif (!$pay_acc_number) {
        $_SESSION['add-user'] = "please enter Doctor's Account Number";
    } elseif (!$pay_descr) {
        $_SESSION['add-user'] = "please enter payroll Description";
    } else {
       // check if doc_number or email already exist in datagase
       $user_check_query = "SELECT * FROM payrolls WHERE pay_doc_number ='$pay_doc_number' OR pay_doc_email='$pay_doc_email' ";
       $user_check_result = mysqli_query($connection, $user_check_query);
  
       if (mysqli_num_rows($user_check_result) > 0) {
           $_SESSION['add-user'] = "Doctor's number or Email already exist on payroll";
       }
    } 
  
    // redirect back to add-Doctor payroll if there was any problem
    if (isset($_SESSION['add-user'])) {
      // pass form data back to add-user payroll
      $_SESSION['add-user-data'] = $_POST;
    } else {
      // insert new user into payrolls table
      $status = "NotPaid";
      $user_query = " INSERT INTO payrolls (admin_id, pay_doc_name, pay_descr, pay_doc_email, pay_doc_number, pay_acc_number, pay_emp_salary, pay_number, status, rid) VALUES('$admin_id', '$pay_doc_name', '$pay_descr', '$pay_doc_email', '$pay_doc_number', '$pay_acc_number', '$pay_emp_salary', '$pay_number', '$status', '$rid')";
  
      $user_result = mysqli_query($connection, $user_query);
  
      if (!mysqli_errno($connection)) {
          // redirect to manpassword-doctor ppassword with success messpassword
          $_SESSION['add-user-success'] = "Doctor: $pay_doc_name, added to payroll successfully";
      }
    } 
  }
  

//get back form data if there was a registration error
$pay_emp_salary = $_SESSION['add-user-data']['pay_emp_salary'] ?? null;
$pay_descr = $_SESSION['add-user-data']['pay_descr'] ?? null;
$pay_acc_number = $_SESSION['add-user-data']['pay_acc_number'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Doctor Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="add-payroll.php">Home</a></li>
          <li class="breadcrumb-item">Payroll</li>
          <li class="breadcrumb-item active">Staff</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center card-title">Add Doctors/Consultants/Others</h1>
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
            <form method="post" enctype="multipart/form-data" class="row g-3">
                <div class="row">

                    <div class="form-group col-md-4">
                      <input type="hidden" name="pay_doc_id" value="<?=$user['id']?>" class="form-control">
                      <label for="inputEmail4" class="col-form-label">Doctor's Name</label>
                      <input type="text" required="required" readonly name="pay_doc_name" value="<?="{$user['firstname']} {$user['lastname']}"?>" class="form-control" id="inputEmail4" placeholder="Patient's Name">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4" class="col-form-label">Doctor's Email</label>
                        <input required="required" type="text" readonly name="pay_doc_email" value="<?=$user['email'] ?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4" class="col-form-label">Doctor's Number</label>
                        <input required="required" type="text" readonly name="pay_doc_number" value="<?= $user['doc_number']?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="inputEmail4" class="col-form-label">Doctor's Salary ($/NGN)</label>
                        <input type="text" required="required"  name="pay_emp_salary" value="<?=$pay_emp_salary?>"  class="form-control" id="inputEmail4" >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail4" class="col-form-label">Doctor's Account Number</label>
                        <input type="text" required="required"  name="pay_acc_number" value="<?=$pay_acc_number?>"  class="form-control" id="inputEmail4" >
                    </div>

                    
                </div>
                <div class="form-row">                   
            
                    <div class="form-group col-md-2" style="display:none">
                        <?php 
                            $length = 5;    
                            $pay_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                        ?>
                        <label for="inputZip" class="col-form-label">Payroll Record Number</label>
                        <input type="text" name="pay_number" value="<?= $pay_no;?>" class="form-control" id="inputZip">
                    </div>
                </div>
                
                <div class="form-group">
                        <label for="inputAddress" class="col-form-label">Payroll Description</label>
                        <textarea   type="text" class="form-control" name="pay_descr" id="editor"><?=$pay_descr?> </textarea>
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