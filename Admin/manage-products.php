<?php 
include '../partials/dashboardheader.php';
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Shop<i class="bi bi-cart"></i></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <?php 
      // fetch users from database 
      $current_user_id = $_SESSION['user-id'];
      $users_post = "SELECT * FROM products  WHERE admin_id = $current_user_id ORDER BY RAND()";
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
                    <th>Products.</th>
                    <th>Name</th>                                  
                    <th>Code</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                    <!-- <th>Delete</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <!-- get category title of each post from categories table -->
                    <?php
                    $category_id = $post['prd_cat'];
                    $category_query = "SELECT title FROM categories WHERE id = $category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                    <tr>
                      <td><?= $cnt; ?></td>
                      <td><img src="<?= ROOT_URL . 'images/' . $post['thumbnail'] ?>" alt="Profile" class="rounded-circle" style="width: 2.5rem; height: 2.5rem; border-radius: 50%; overflow: hidden;"></td>
                      <td><?= $post['prd_name']?></td>
                      <td><?= $post['prd_number']?></td>
                      <td><?= $post['prd_price']?></td>
                      <td><?= $category['title'] ?></td>
                      <td>
                        <a href="view-product.php?id=<?= $post['id']?>" class="btn sm view"><i class="bi bi-eye"></i></a>
                        <a href="edit-product.php?id=<?= $post['id']?>" class="btn sm"><i class="bi bi-pencil-square"></i></a>
                        <a href="delete-product.php?id=<?= $post['id']?>" class="btn sm danger"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Products List found" ?></div>
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