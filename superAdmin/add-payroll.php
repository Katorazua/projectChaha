<?php 
include '../partials/dashboardheader.php';
// fetch users from database but not Super admin
  $admin_id = $_SESSION['user-id'];

  $query = "SELECT * FROM doctors WHERE admin_id=$admin_id ORDER BY RAND()";
  $users = mysqli_query($connection, $query);
  $cnt = 1;
 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Create Emplyees Payroll</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Add Payroll</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">

      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Create Doctors Payroll</h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($users) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>
                      <b>N</b>ame
                    </th>                    
                    <th>ID Number</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?="{$user['firstname']} {$user['lastname']}"?></td>
                    <td><?=$user['doc_number']?></td>
                    <td><?= $user['department'] ?></td>
                    <td><?= $user['status'] ?></td>
                    <td>
                      <a href="<?= ROOT_URL ?>superAdmin/add-doctor-payroll.php?id=<?= $user['id']?>" class="btn sm view"><i class="bi bi-pencil-square"></i>Add To Payroll</a>
                   </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                  </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Doctors Payroll List found" ?></div>
              <?php endif ?>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section> <!-- End table section -->

    
    <section class="section">
        <?php 
            // fetch users from database but not Super admin
            $query = "SELECT * FROM employees ORDER BY RAND()";
            $users = mysqli_query($connection, $query);
            $cnt = 1;
        ?>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Other Employees</h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($users) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>
                      <b>N</b>ame
                    </th>                    
                    <th>ID Number</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?="{$user['firstname']} {$user['lastname']}"?></td>
                    <td><?=$user['emp_number']?></td>
                    <td><?= $user['department'] ?></td>
                    <td><?= $user['status'] ?></td>
                    <td>
                      <a href="<?= ROOT_URL ?>superAdmin/add-employees-payroll.php?id=<?= $user['id']?>" class="btn sm view"><i class="bi bi-pencil-square"></i>Add To Payroll</a>
                   </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                  </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Employees Payroll List found" ?></div>
              <?php endif ?>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section> <!-- End table section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php'; ?>