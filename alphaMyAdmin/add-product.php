<?php 
include '../partials/dashboardheader.php';

if (isset($_POST['submit'])) {
    $admin_id = $_SESSION['user-id'];
    $prd_name = filter_var($_POST['prd_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prd_price = filter_var($_POST['prd_price'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prd_mdate = filter_var($_POST['prd_mdate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prd_xpdate = filter_var($_POST['prd_xpdate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prd_number = filter_var($_POST['prd_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    //validate form data
    if (!$prd_name) {
       $_SESSION['add-post'] = "Enter product title";
    }elseif (!$prd_price) {
        $_SESSION['add-post'] = "Enter product price";
    }elseif (!$prd_mdate) {
        $_SESSION['add-post'] = "Enter product manufactural date";
    }elseif (!$prd_xpdate) {
        $_SESSION['add-post'] = "Enter product Ex. date";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Add product content/diescription";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "choose product thumbnail";
    } else{
       // work on thumbnail
       // rename the image
       $time = time(); // make each image name unique
       $thumbnail_name = $time . $thumbnail['name'];
       $thumbnail_tmp_name = $thumbnail['tmp_name'];
       $thumbnail_destination_path = '../images/'. $thumbnail_name;

       move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
    } 

    // Redirect (with form-data) to add-post if is_featured for this product is 1
    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
    } else {

        // insert product into database
        $query  = "INSERT INTO products (prd_name, prd_dsc, thumbnail, prd_number, prd_cat, prd_price, prd_mdate, prd_xpdate, admin_id) VALUES ('$prd_name', '$body', '$thumbnail_name', '$prd_number', '$category', '$prd_price', '$prd_mdate', '$prd_xpdate', '$admin_id')";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New product: $prd_name, added successfully";
        }
    }
}


// featch category from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

//get back form data if form was invalid
$prd_name = $_SESSION['add-post-data']['prd_name'] ?? null;
$prd_price = $_SESSION['add-post-data']['prd_price'] ?? null;
$prd_mdate = $_SESSION['add-post-data']['prd_mdate'] ?? null;
$prd_xpdate = $_SESSION['add-post-data']['prd_xpdate'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

// delete session data
unset($_SESSION['add-post-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage products</h1>
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
              <h1 class="text-center card-title">Add New product</h1>
              <hr>
              <?php if(isset($_SESSION['add-post'])) : ?>
                <div class="alert_message error container">
                  <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                  </p>
                </div>
              <?php elseif(isset($_SESSION['add-post-success'])) : ?>
                <div class="alert_message success container">
                  <p>
                    <?= $_SESSION['add-post-success'];
                    unset($_SESSION['add-post-success']);
                    ?>
                  </p>
                </div>
              <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3" method="POST" enctype="multipart/form-data">
              
                <div class="col-md-4">
                  <label for="inputCity" class="form-label">Product Name</label>
                  <input type="text" name="prd_name" class="form-control" value="<?= $prd_name ?>" id="inputCity" placeholder="product name">
                </div>     

                <div class="col-md-4">
                  <label for="inputCity" class="form-label">Product Price ($/NGN)</label>
                  <input type="text" name="prd_price" class="form-control" value="<?= $prd_price ?>" id="inputCity" placeholder="product price">
                </div>                           

                <div class="form-group col-md-2" style="display:none">
                    <?php 
                        $length = 8;    
                        $pay_no =  substr(str_shuffle('0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOPpQqRrSsTtUuVvWXYyZ'),1,$length);
                    ?>
                    <label for="inputZip" class="col-form-label">Product Record Number</label>
                    <input type="text" name="prd_number" value="<?= $pay_no?>" class="form-control" id="inputZip">
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
                  <input type="text" name="prd_mdate" class="form-control" value="<?= $prd_mdate ?>" id="inputCity" placeholder="product manufactural date">
                </div>

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Product Ex. Date</label>
                  <input type="text" name="prd_xpdate" class="form-control" value="<?= $prd_xpdate ?>" id="inputCity" placeholder="product Ex. date">
                </div>

                <div class="col-md-12">
                  <label for="inputCity" class="form-label">Description</label>
                  <!-- <input type="text" class="form-control" id="inputCity" placeholder="Name of Class Teacher"> -->
                  <textarea name="body" class="form-control" placeholder="add your product description here...." cols="30" rows="5"><?= $body ?></textarea>
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