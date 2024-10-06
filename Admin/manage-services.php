<?php 
include '../partials/dashboardheader.php';

$current_admin_id = $_SESSION['user-id'];
//get back form data if there was a registration error
$title = $_SESSION['add-service-data']['title'] ?? null;
$prices = $_SESSION['add-service-data']['prices'] ?? null;

// delete session data
unset($_SESSION['add-service-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Services</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Services</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Add New Service</h1>
              <hr>
              <?php if(isset($_SESSION['add-service'])) : ?>
                  <div class="alert_message error container">
                  <p>
                    <?= $_SESSION['add-service'];
                    unset($_SESSION['add-service']);
                    ?>
                  </p>
                </div>
              <?php endif ?>
              <!-- Multi Columns Form -->
              <form class="row g-3" action="add-service-logic.php" method="Post" enctype="multipart/form-data">
              
                <div class="col-md-6">
                  <input type="text" class="form-control"  name="author_id"  value="<?= $current_admin_id ?>" hidden>

                  <label for="inputCity" class="form-label">Title</label>
                  <input type="text" class="form-control" name="title" value="<?=$title?>" id="inputCity" placeholder="service title">
                </div>

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Price</label>
                  <input type="text" class="form-control" name="prices" value="<?=$prices?>" id="inputCity" placeholder="service price">
                </div>

                <div class="col-md-6">
                  <label for="thumbnail"><i class="bi bi-plus-circle"></i>Add Thumbnail</label>
                  <input type="file" name="thumbnail" id="thumbnail">
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
      // fetch category from database
      $author_id = $_SESSION['user-id'];
      $query = "SELECT * FROM services WHERE author_id=$author_id ORDER BY title";
      $posts = mysqli_query($connection, $query);
      $cnt=1;
    ?>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Datatables</h1>
              <hr>
              <?php if(isset($_SESSION['add-service-success'])) :  //show if add-service was successful ?>
                <div class="alert_message success container">
                  <p>
                    <?=  $_SESSION['add-service-success'];
                    unset($_SESSION['add-service-success']);
                    ?>
                    </p>
                </div>
              <?php elseif(isset($_SESSION['add-service'])) :  //show if add-service was NOT successful ?>
                <div class="alert_message error container">
                  <p>
                    <?=  $_SESSION['add-service'];
                    unset($_SESSION['add-service']);
                    ?> 
                    </p>
                </div>
              <?php elseif(isset($_SESSION['edit-service-success'])) :  //show if edit-service was successful ?>
                <div class="alert_message success container">
                  <p>
                    <?=  $_SESSION['edit-service-success'];
                    unset($_SESSION['edit-service-success']);
                    ?>
                    </p>
                </div>
              <?php elseif(isset($_SESSION['edit-service'])) :  //show if edit-service was NOT successful ?>
                <div class="alert_message error container">
                  <p>
                    <?=  $_SESSION['edit-service'];
                    unset($_SESSION['edit-service']);
                    ?> 
                    </p>
                </div>
              <?php elseif(isset($_SESSION['delete-service-success'])) :  //show if delete-service was successful ?>
                <div class="alert_message success container">
                  <p>
                    <?=  $_SESSION['delete-service-success'];
                    unset($_SESSION['delete-service-success']);
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
                    <th><b>T</b>itle</th>                                  
                    <th>Prices</th>
                    <th>Action</th>
                    <!-- <th>Delete</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?= $post['title'] ?></td>
                    <td><?= $post['prices'] ?></td>
                    <td>
                      <a href="edit-service.php?id=<?= $post['id']?>" class="btn sm"><i class="bi bi-pencil-square"></i></a>
                      <a href="delete-service.php?id=<?= $post['id']?>" class="btn sm danger"><i class="bi bi-trash"></i></a>
                  </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Services found" ?></div>
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