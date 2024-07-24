<?php 
include '../partials/dashboardheader.php';

//get back form data if there was a registration error
$title = $_SESSION['add-user-data']['title'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Intro</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Intro Video</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Add An Intro Video</h1>
              <hr>
              <?php if(isset($_SESSION['add-user'])) : ?>
                <div class="alert_message error container">
                  <p>
                    <?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                    ?>
                  </p>
                </div>
              <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="add-intro-logic.php" method="POST" enctype="multipart/form-data">
              
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" value="<?= $title ?>" id="inputCity" placeholder="event's title">
                </div>              

                <div class="col-md-6"> 
                  <label for="video"><i class="bi bi-plus-circle"></i>Add Intro Video</label>
                  <br>
                  <input type="file" name="video" id="video">
                </div>
               
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>


        </div>

      </div>
    </section> <!-- End form section -->


    <?php 
      // fetch users from database 
      $query = "SELECT * FROM introduction ";
      $users = mysqli_query($connection, $query);
      $cnt = 1;              
    ?>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Datatables</h1>
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
              <?php if (mysqli_num_rows($users) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th><b>T</b>itle</th>                                  
                    <th>Date</th>
                    <th>Action</th>
                    <!-- <th>Delete</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                      <td><?= $cnt; ?></td>
                      <td><?= $user['title']?></td>
                      <td><?= date("M D, Y - H:i", strtotime($user['date_time'])) ?></td>
                      <td>
                        <a href="view-session.php?id=<?= $user['id']?>" class="btn sm view"><i class="bi bi-play"></i></a>
                        <a href="edit-intro.php?id=<?= $user['id']?>" class="btn sm"><i class="bi bi-pencil-square"></i></a>
                        <a href="delete-intro.php?id=<?= $user['id']?>" class="btn sm danger"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Session found" ?></div>
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