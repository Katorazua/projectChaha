<?php 
include '../partials/dashboardheader.php';
//get back form data if there was a registration error
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

// delete session data
unset($_SESSION['add-category-data']);
 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Categories</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item active">Events</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Add New Category</h1>
              <hr>

              <?php if(isset($_SESSION['add-category-success'])) :  //show if add-category was successful ?>
                <div class="alert_message success container">
                  <p class="text-center">
                    <?=  $_SESSION['add-category-success'];
                    unset($_SESSION['add-category-success']);
                    ?>
                    </p>
                </div>
              <?php elseif(isset($_SESSION['add-category'])) :  //show if add-category was NOT successful ?>
                <div class="alert_message error container">
                  <p class="text-center">
                    <?=  $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                    ?> 
                    </p>
                </div>
              <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3"  action="add-category-logic.php" method="post" enctype="multipart/form-data"> 
              
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" id="inputCity" placeholder="Title" value="<?= $title ?>">
                </div>

                <div class="col-md-6">
                  <textarea name="description" value="<?= $description ?>"  placeholder="Please give your product Description" rows="5" style="width: 100%;"></textarea>
                </div> 
               
                <div class="text-center">
                  <button name="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>
        </div>
      </div>
    </section> <!-- End form section -->

    <section class="section">
      <?php 
        // fetch category from database
        $admim_id = $_SESSION['user-id'];
        $query = "SELECT * FROM categories WHERE admin_id=$admim_id ORDER BY title";
        $categories = mysqli_query($connection, $query);
        $cnt = 1;
      ?>

      <?php if(isset($_SESSION['edit-category-success'])) :  //show if edit-category was successful ?>
        <div class="alert_message success container">
          <p>
            <?=  $_SESSION['edit-category-success'];
            unset($_SESSION['edit-category-success']);
            ?> 
            </p>
        </div>
      <?php elseif(isset($_SESSION['edit-category'])) :  //show if edit-category was NOT successful ?>
        <div class="alert_message error container">
          <p>
            <?=  $_SESSION['edit-category'];
            unset($_SESSION['edit-category']);
            ?> 
            </p>
        </div>
        <?php elseif(isset($_SESSION['delete-category-success'])) :  //show if delete-category was successful ?>
        <div class="alert_message success container">
          <p>
            <?=  $_SESSION['delete-category-success'];
            unset($_SESSION['delete-category-success']);
            ?> 
            </p>
        </div>
      <?php endif ?>

      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">All Categories Datatable</h1>
              <hr>
              <!-- Table with stripped rows -->
              <?php if (mysqli_num_rows($categories) > 0) : ?>
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
                  <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                  <tr>
                    <td><?= $cnt; ?></td>
                    <td><?= $category['title'] ?></td>
                    <td><?= $category['date_time'] ?></td>
                    <td><a href="edit-category.php?id=<?= $category['id']?>" class="btn sm"><i class="bi bi-pencil-square"></i></a>
                    <a href="delete-category.php?id=<?= $category['id']?>" class="btn sm danger"><i class="bi bi-trash"></i></a></td>
                  </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No category found" ?></div>
              <?php endif ?>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section> <!-- End table section -->

  </main><!-- End #main -->
<?php include '../partials/dashboardfooter.php'; ?>