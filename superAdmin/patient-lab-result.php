
<?php 
include '../partials/dashboardheader.php';
$user_query = "SELECT * FROM laboratory ORDER BY RAND()";
$user_result = mysqli_query($connection,$user_query);
$cnt = 1;
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Patient Lab Results</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Laboratory</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Patients List</h1>
              <hr>
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

              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($user_result) > 0) :?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>Lab Number</th>                    
                    <th>Name</th>
                    <th>Ailment</th>
                    <th>Hosp. Number</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Unit/Ward</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($user_result)) :?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?=$user['lab_number']?></td>
                    <td><?=$user['lab_pat_name']?></td>
                    <td><?= $user['lab_pat_ailment'] ?></td>
                    <td><?= $user['lab_pat_number'] ?></td>
                    <td><?= $user['lab_pat_age'] ?></td>
                    <td><?= $user['lab_pat_gender'] ?></td>
                    <td><?= $user['lab_pat_unit'] ?></td>
                    <td>
                      <a href="add-patient-lab-result.php?id=<?= $user['id']?>" class="btn sm view"><i class="bi bi-pencil-square"></i>Add Lab Results</a>
                    </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?>
                  </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Patient list found" ?></div>
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