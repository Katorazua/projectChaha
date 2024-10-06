<?php 
include '../partials/dashboardheader.php';
// fetch users from database but not Super admin
  $query = "SELECT * FROM appointments";
  $users = mysqli_query($connection, $query);
  $cnt = 1;
 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Appointments Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-appointments.php">Home</a></li>
          <li class="breadcrumb-item">Appointments</li>
          <li class="breadcrumb-item active">View Appointments</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Appointments List</h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($users) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>Name</th>
                    <th>Ailment</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?=$user['ap_pat_name']?></td>
                    <td><?= $user['ap_pat_ailment'] ?></td>
                    <td><?= $user['ap_service'] ?></td>
                    <td><?= $user['ap_status'] ?></td>
                    <td><?= $user['ap_date'] ?></td>
                    <td>
                      <a href="set-appointment-single.php?id=<?= $user['id']?>" class="btn sm view"><i class="bi bi-pencil-square"></i>Assign Doctor</a>
                   </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                  </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Appointment List found" ?></div>
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