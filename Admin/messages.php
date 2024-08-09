<?php 
include '../partials/dashboardheader.php';
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>All Messages</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Messages</i></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <?php 
      // fetch users from database 
      $current_user_id = $_SESSION['user-id'];
      $users_post = "SELECT * FROM contact  WHERE hps = 'CEH' ORDER BY RAND()";
      $posts = mysqli_query($connection, $users_post);
      $cnt = 1;              
    ?>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Datatable</h1>
              <hr>
              <?php if(isset($_SESSION['delete-post-success'])) :  //show if delete-post was successful ?>
                <div class="alert_message success container">
                  <p>
                    <?=  $_SESSION['delete-post-success'];
                    unset($_SESSION['delete-post-success']);
                    ?> 
                    </p>
                </div>
              <?php endif ?>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($posts) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>Name</th>                                  
                    <th>Email</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                    <tr>
                      <td><?= $cnt; ?></td>
                     <td><?= $post['fullname']?></td>
                      <td><?= $post['email']?></td>
                      <td><?= $post['date_time']?></td>
                      <td>
                        <a href="view-messages.php?id=<?= $post['id']?>" class="btn sm view"><i class="bi bi-eye"></i>View message</a>
                      </td>
                    </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Messages found" ?></div>
              <?php endif ?>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section> <!-- End table section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 <?php include '../partials/dashboardfooter.php';?>