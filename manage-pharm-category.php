<?php 
include '../partials/dashboardheader.php';
// fetch users from database but not Super admin
  $admin_id = $_SESSION['user-id'];

  $query = "SELECT * FROM pharmaceuticals_categories ORDER BY RAND()";
  $users = mysqli_query($connection, $query);
  $cnt = 1;
 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Pharmaceutical Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Pharmaceuticals</li>
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
              <h1 class="text-center card-title">Manage Pharmaceutical Categories</h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($users) > 0) : ?>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Ext.</th>
                    <th>
                      <b>Category N</b>ame
                    </th>                    
                    <th>Category Vendor</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?=$user['pharm_cat_name']?></td>
                    <td><?= $user['pharm_cat_vendor'] ?></td>
                    <td>
                      <a href="<?= ROOT_URL ?>superAdmin/view-pharm-category.php?id=<?= $user['id']?>" class="btn sm view"><i class="bi bi-eye"></i></a>
                      <a href="<?= ROOT_URL ?>superAdmin/edit-pharm-category.php?id=<?= $user['id']?>" class="btn sm"><i class="bi bi-pencil-square"></i></a>
                      <a href="<?= ROOT_URL ?>superAdmin/delete-pharm-category.php?id=<?= $user['id']?>" class="btn sm danger"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                  </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No pharmaceuticals_categories List found" ?></div>
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