<?php 
include '../partials/dashboardheader.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // FETCH CATEGORY FROM DATABASE
    $query = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    }
} else {
    header('location:' . ROOT_URL . 'superAdmin/manage-categories.php');
    die();
}

 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

      <main id="main" class="main">

        <div class="pagetitle">
        <h1>Manage Categories</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manage-categories.php">Home</a></li>
            <li class="breadcrumb-item">Components</li>
            <li class="breadcrumb-item active">Categories</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        
        <section class="section">
        <div class="row">
            <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                <h1 class="text-center card-title">Edit Category</h1>
                <hr>
                <?php if(isset($_SESSION['edit-category'])) :  //show if edit-category was NOT successful ?>
                    <div class="alert_message error container">
                    <p class="text-center">
                        <?=  $_SESSION['edit-category'];
                        unset($_SESSION['edit-category']);
                        ?> 
                        </p>
                    </div>
                <?php endif ?>

                <!-- Multi Columns Form -->
                <form class="row g-3" action="<?= ROOT_URL ?>superAdmin/edit-category-logic.php" method="POST" enctype="multipart/form-data"> 
                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
                    
                    <div class="col-md-6">
                      <label for="inputCity" class="form-label">Title</label>
                      <input type="text" name="title" class="form-control" id="inputCity" placeholder="Title" value="<?= $category['title'] ?>">
                    </div>

                    <div class="col-md-6">
                     <textarea name="description" placeholder="Description" rows="5" style="width: 100%;"><?= $category['description'] ?></textarea>
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
    </main>

<?php include '../partials/dashboardfooter.php'; ?>