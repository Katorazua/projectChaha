<?php 
  include '../partials/docheader.php';
  // fetch users from database but not Super admin
  $admin_id = $_SESSION['user-id'];

  $query = "SELECT * FROM patient_assign WHERE doc_number=$admin_id ORDER BY RAND()";
  $users = mysqli_query($connection, $query);
  $cnt = 1;

 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage History</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">History</li>
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
              <h1 class="text-center card-title">Patients Assign History</h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($users) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>
                      <b>D</b>octors
                    </th>                    
                    <th>ID</th>
                    <th>Department</th>
                    <th>Patients</th>
                    <th>Number</th>
                    <th>Satus</th>
                    <th>Date/Time Assigend</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                  <tr>
                    <?php
                      $doc_number = $user['doc_number'];
                      $doc_query = "SELECT doc_number FROM doctors WHERE id=$doc_number";
                      $doc_result = mysqli_query($connection,$doc_query);
                      $row = mysqli_fetch_assoc($doc_result);
                    ?>
                    <td><?= $cnt; ?></td>
                    <td><?="{$user['doc_fname']} {$user['doc_lname']}"?></td>
                    <td><?=$row['doc_number']?></td>
                    <td><?= $user['doc_dept'] ?></td>
                    <td><?="{$user['pat_fname']} {$user['pat_lname']}"?></td>
                    <td><?= $user['pat_number'] ?></td>
                    <td><?= $user['status'] ?></td>
                    <td><?= $user['date_time'] ?></td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                  </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Assigned List found" ?></div>
              <?php endif ?>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section> <!-- End table section -->

    <?php
      // fetch patient from database but not Super admin
      $admin_id = $_SESSION['user-id'];

      $query = "SELECT * FROM patient_transfer WHERE doc_id=$admin_id ORDER BY RAND()";
      $users = mysqli_query($connection, $query);
      $cnt = 1;
    ?>

    <section class="section"> 
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Patients Transfer History</h1>
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
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Ailment</th>
                    <th>Referal Hospital</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Clear History</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?="{$user['pat_fname']} {$user['pat_lname']}"?></td>
                    <td><?=$user['pat_number']?></td>
                    <td><?= $user['pat_age'] ?></td>
                    <td><?= $user['pat_gender'] ?></td>
                    <td><?= $user['pat_ailment'] ?></td>
                    <td><?= $user['ref_hospital'] ?></td>
                    <td><?= $user['status'] ?></td>
                    <td><?= $user['date_time'] ?></td>
                    <td>
                     <a href="delete-patient-history.php?id=<?= $user['id']?>" class="btn sm danger"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                  </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Patients List found" ?></div>
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