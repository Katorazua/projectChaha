</p>
<?php 
include '../partials/dashboardheader.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // FETCH CATEGORY FROM DATABASE
    $query = "SELECT * FROM  department WHERE id = $id";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    }
}



if (isset($_POST['submit'])){
// get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    // validate input
    if(!$title) {
        $_SESSION['edit-category'] = "Invalid form input on edit category page.";
    } elseif (!$description) {
        $_SESSION['edit-category'] = "Invalid form input on edit category page.";
    } else {
        // update user
        $query = " UPDATE department SET name ='$title', description = '$description' WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        // check for error conection
        if (mysqli_errno($connection)) {
            $_SESSION['edit-category'] = "$title Category update fialed";
        } else {
            $_SESSION['edit-category-success'] = "$title Category updated successfully. Click on 'Home'";
        }
    }
}


 ?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

      <main id="main" class="main">

        <div class="pagetitle">
        <h1>Manage Departmens</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manage-departments.php">Home</a></li>
            <li class="breadcrumb-item">Components</li>
            <li class="breadcrumb-item active">Departmens</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        
        <section class="section">
        <div class="row">
            <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                <h1 class="text-center card-title">Edit Department Category</h1>
                <hr>
                <?php if(isset($_SESSION['edit-category-success'])) :  //show if edit-category was successful ?>
                    <div class="alert_message success container">
                    <p class="text-center">
                        <?=  $_SESSION['edit-category-success'];
                        unset($_SESSION['edit-category-success']);
                        ?> 
                        </p>
                    </div>
                <?php elseif(isset($_SESSION['edit-category'])) :  //show if edit-category was NOT successful ?>
                    <div class="alert_message error container">
                    <p class="text-center">
                        <?=  $_SESSION['edit-category'];
                        unset($_SESSION['edit-category']);
                        ?> 
                        </p>
                    </div>
                <?php endif ?>

                <!-- Multi Columns Form -->
                <form class="row g-3"method="POST" enctype="multipart/form-data"> 
                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
                    
                    <div class="col-md-6">
                      <label for="inputCity" class="form-label">Title</label>
                      <input type="text" name="title" class="form-control" id="inputCity" placeholder="Title" value="<?= $category['name'] ?>">
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