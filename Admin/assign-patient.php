<?php 
include '../partials/dashboardheader.php';
// fetch users from database but not Super admin
  $query = "SELECT * FROM doctors ORDER BY firstname ASC";
  $users = mysqli_query($connection, $query);
  $cnt = 1;
 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Doctors Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Form</li>
          <li class="breadcrumb-item active">View Doctors</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <?php if(isset($_SESSION['add-user-success'])) :  //show if add-user is successful ?>
      <div class="alert_message success container">
        <p>
          <?=  $_SESSION['add-user-success'];
          unset($_SESSION['add-user-success']);
          ?>
          </p>
      </div>
   <?php elseif(isset($_SESSION['edit-user-success'])) :  // show if edit-user is successful ?>
      <div class="alert_message success container">
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
   <?php elseif(isset($_SESSION['delete-user'])) :  // show if delete-user was NOT successful ?>
      <div class="alert_message error container">
        <p>
          <?=  $_SESSION['delete-user'];
          unset($_SESSION['delete-user']);
          ?>
          </p>
      </div>
   <?php elseif(isset($_SESSION['delete-user-success'])) :  // show if delete-user was successful ?>
      <div class="alert_message success container">
        <p>
          <?=  $_SESSION['delete-user-success'];
          unset($_SESSION['delete-user-success']);
          ?>
          </p>
      </div>
    <?php endif ?>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">All Doctors</h1> 
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
                    <th>Specialization</th>
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
                    <td><?=$user['job']?></td>
                    <td><?= $user['department'] ?></td>
                    <td><?= $user['status'] ?></td>
                    <td>
                      <a href="assign-patient-single.php?id=<?= $user['id']?>" class="btn sm view"><i class="bi bi-pencil-square"></i>Assign Patient</a>
                   </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                  </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Doctors List found" ?></div>
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