<?php 
include '../partials/dashboardheader.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prd_name = filter_var($_POST['prd_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prd_price = filter_var($_POST['prd_price'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prd_mdate = filter_var($_POST['prd_mdate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prd_xpdate = filter_var($_POST['prd_xpdate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    //validate form data
    if (!$prd_name) {
       $_SESSION['edit-post'] = "Enter product title";
    }elseif (!$prd_price) {
        $_SESSION['edit-post'] = "Enter product price";
    }elseif (!$prd_mdate) {
        $_SESSION['edit-post'] = "Enter product manufactural date";
    }elseif (!$prd_xpdate) {
        $_SESSION['edit-post'] = "Enter product Ex. date";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Add product content/diescription";
    } elseif (!$thumbnail['name']) {
        $_SESSION['edit-post'] = "choose product thumbnail";
    } else{
        // delete existing thumbnail if new thumbnail is available
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/'. $previous_thumbnail_name; 
            if ($previous_thumbnail_path) {
            unlink($previous_thumbnail_path);
            }

            // work on thumbnail
            // rename the image
            $time = time(); // make each image name unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/'. $thumbnail_name;

            //make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
            if (in_array($extension, $allowed_files)) {
                    // make sure image is not too big. (2mb+)
                    if ($thumbnail['size'] < 2_000_000) {
                        // upload thumbnail
                        move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                    } else {
                        $_SESSION['edit-post'] = "File too big. Should be less than 2mb";
                    }
            } else {
                    $_SESSION['edit-post'] = "File should be png, jpg or jpeg";
            }
        } 
    } 

    // set thumbnail name if new one was uploaded, else keep old thumbnail name
    $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
    $query  = "UPDATE products SET prd_name='$prd_name',  prd_dsc='$body', thumbnail='$thumbnail_to_insert', prd_cat='$category', prd_price='$prd_price', prd_mdate='$prd_mdate', prd_xpdate='$prd_xpdate' WHERE id = $id LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-post-success'] = "Product: $prd_name, Updated Successfully";
    }
}


// featch category from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// fetch post from database if id is set
if (isset($_GET['id'])) {
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);    
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($connection, $query);
$post = mysqli_fetch_assoc($result);   

}
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update products Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-products.php">Home</a></li>
          <li class="breadcrumb-item">Shop<i class="bi bi-cart"></i></li>
          <li class="breadcrumb-item active">products</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Update product</h1>
              <hr>
              <?php if(isset($_SESSION['edit-post'])) : ?>
                <div class="alert_message error container">
                  <p>
                    <?= $_SESSION['edit-post'];
                    unset($_SESSION['edit-post']);
                    ?>
                  </p>
                </div>
              <?php elseif(isset($_SESSION['edit-post-success'])) : ?>
                <div class="alert_message success container">
                  <p>
                    <?= $_SESSION['edit-post-success'];
                    unset($_SESSION['edit-post-success']);
                    ?>
                  </p>
                </div>
              <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3" method="POST" enctype="multipart/form-data">
              
                <div class="col-md-4">
                  <label for="inputCity" class="form-label">Product Name</label>
                  <input type="hidden" class="form-control"  name="id" value="<?= $post['id'] ?>">
                  <input type="hidden" class="form-control"  name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
                  <input type="text" name="prd_name" class="form-control" value="<?= $post['prd_name'] ?>" id="inputCity" placeholder="product name">
                </div>     

                <div class="col-md-4">
                  <label for="inputCity" class="form-label">Product Price ($/NGN)</label>
                  <input type="text" name="prd_price" class="form-control" value="<?= $post['prd_price'] ?>" id="inputCity" placeholder="product price">
                </div>

                <div class="col-md-4">
                  <label for="inputState" class="form-label">Product Category</label>
                  <select id="inputState" name="category" class="form-select">
                    <option selected>Choose...</option>
                    <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                      <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endwhile ?>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Product Manufactural Date</label>
                  <input type="text" name="prd_mdate" class="form-control" value="<?= $post['prd_mdate'] ?>" id="inputCity" placeholder="product manufactural date">
                </div>

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Product Ex. Date</label>
                  <input type="text" name="prd_xpdate" class="form-control" value="<?= $post['prd_xpdate'] ?>" id="inputCity" placeholder="product Ex. date">
                </div>

                <div class="col-md-12">
                  <label for="inputCity" class="form-label">Description</label>
                  <!-- <input type="text" class="form-control" id="inputCity" placeholder="Name of Class Teacher"> -->
                  <textarea name="body" class="form-control" placeholder="add your product description here...." cols="30" rows="5"><?= $post['prd_dsc'] ?></textarea>
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

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 <?php include '../partials/dashboardfooter.php';?>