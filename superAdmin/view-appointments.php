<?php 
include '../partials/dashboardheader.php';
// fetch users from database but not Super admin
  $query = "SELECT * FROM appointments ORDER BY date_time DESC";
  $users = mysqli_query($connection, $query);
  $cnt = 1;
 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>View Appointments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-appointments.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">View Assigned</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Notice: Appointment Schedule Will Last For 7 Working Days. No Doctor should have more than (5) Patients Assigned!</h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($users) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>                    
                    <th>Appointment ID</th>
                    <th>NAME</th>
                    <th>Ailment</th>
                    <th>Doctor</th>
                    <th>Doctor ID</th>
                    <th>Service</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?=$user['ref_code']?></td>
                    <td><?=$user['ap_pat_name']?></td>
                    <td><?=$user['ap_pat_ailment']?></td>
                    <td><?=$user['ap_doc_name']?></td>
                    <td><?=$user['ap_doc_number']?></td>
                    <td><?= $user['ap_service'] ?></td>
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

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php'; ?>