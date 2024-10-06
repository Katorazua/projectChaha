<?php 
include '../partials/usersheader.php';
include 'partials/appointment-subscription.php';
// fetch users from database but not Super admin
  $id = $_SESSION['user-id'];
  $query = "SELECT * FROM appointments WHERE user_id=$id AND ap_status='Approved' AND status='successful' ";
  $users = mysqli_query($connection, $query);
  $cnt = 1;
 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Appointment Room</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-doctors.php">Home</a></li>
          <li class="breadcrumb-item">Call</li>
          <li class="breadcrumb-item active">chat</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">
                <?php 
                if (isset($_SESSION['user_is_successful'])) { ?>
                    <div class="text-center container">
                      <p>
                      <?php         
                      echo $_SESSION['reminder']
                      ?>
                      </p>
                    </div>
                <?php } else { ?>
                  <div class="text-center container">
                      <p>Appointment can only last for 7 working days </p>
                    </div>
                <?php } ?>

              </h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($users) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>                    
                    <th>ApID</th>
                    <th>NAME</th>
                    <th>Ailment</th>
                    <th>Doctor</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Action</th>
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
                    <td><?= $user['ap_service'] ?></td>
                    <td><?= $user['ap_date'] ?></td>
                    <td>
                      <a href="tel:<?= $user['doc_phone']?>" class="btn sm view"><i class="bi bi-telephone"></i></a>
                      <a href="../alphaChat/doctors_chat.php?id=<?= $user['doc_id']?>" class="btn sm"><i class="bi bi-chat"></i></a>
                    </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                  </tbody>
              </table>
              <?php else : ?>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Pending.....</h5>
                    <p>Please be patience, your Appointment will be set soon. If this message last for 3 days please contact the Admin on (Contact Us)</p>

                    <!-- Center aligned spinner -->
                    <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div><!-- End Center aligned spinner -->

                  </div>
                </div>
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