
<?php 
include '../partials/docheader.php';
$admin_id = $_SESSION['user-id'];
$user_query = "SELECT * FROM patients WHERE doc_id=$admin_id ORDER BY RAND()";
$user_result = mysqli_query($connection,$user_query);
$cnt = 1;
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Patient Surgery/Theatre</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Patient Status</li>
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
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($user_result) > 0) :?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>
                      <b>N</b>ame
                    </th>                    
                    <th>Hosp. Number</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Category</th>                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody
                <?php while ($user = mysqli_fetch_assoc($user_result)) :?>>
                  <tr>
                  <td><?= $cnt; ?></td>
                    <td><?="{$user['pat_fname']} {$user['pat_lname']}"?></td>
                    <td><?=$user['pat_number']?></td>
                    <td><?= $user['pat_addr'] ?></td>
                    <td><?= $user['pat_age'] ?></td>
                    <td><?= $user['pat_gender'] ?></td>
                    <td><?= $user['pat_type'] ?></td>
                    <td>
                      <a href="patient-surgery-single.php?id=<?= $user['id']?>" class="btn sm view"><i class="bi bi-pencil-square"></i>Add Patient</a>
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

    <?php
      $doc_number = $_SESSION['user-id'];
      $query = "SELECT * FROM patient_assign WHERE doc_number=$doc_number ORDER BY RAND()";
      $result = mysqli_query($connection,$query);
      $cnt = 1;
    ?>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Patients Assigned</h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($result) > 0) :?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>
                      <b>N</b>ame
                    </th>                    
                    <th>Hosp. Number</th>
                    <th>Ailment</th>
                    <th>Phone</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)) :?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?="{$row['pat_fname']} {$row['pat_lname']}"?></td>
                    <td><?=$row['pat_number']?></td>
                    <td><?= $row['pat_ailment'] ?></td>
                    <td><?= $row['pat_phone'] ?></td>
                    <td><?= $row['pat_age'] ?></td>
                    <td><?= $row['pat_gender'] ?></td>
                    <td><?= $row['doc_dept'] ?></td>
                    <td>
                      <a href="add-asigned-patient-surgery-single.php?id=<?= $row['id']?>" class="btn sm view"><i class="bi bi-pencil-square"></i>Add Patient</a>
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