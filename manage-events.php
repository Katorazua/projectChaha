<?php 
include '../partials/dashboardheader.php';

// featch category from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

//get back form data if form was invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

// delete session data
unset($_SESSION['add-post-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Events</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Events</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Add New Event</h1>
              <hr>
              <?php if(isset($_SESSION['add-post'])) : ?>
                <div class="alert_message error container">
                  <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                  </p>
                </div>
              <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= ROOT_URL ?>superAdmin/add-event-logic.php" method="POST" enctype="multipart/form-data">
              
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" value="<?= $title ?>" id="inputCity" placeholder="event's title">
                </div>              

                <div class="col-md-6">
                  <label for="inputState" class="form-label">Category</label>
                  <select id="inputState" name="category" class="form-select">
                    <option selected>Choose...</option>
                    <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                      <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endwhile ?>
                  </select>
                </div>

                <div class="col-md-12">
                  <label for="inputCity" class="form-label">Content</label>
                  <!-- <input type="text" class="form-control" id="inputCity" placeholder="Name of Class Teacher"> -->
                  <textarea name="body" class="form-control" placeholder="create your content body here...." cols="30" rows="5"><?= $body ?></textarea>
                </div>

                <div class="col-md-6"> 
                  <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                  <label for="is_featured">Featured</label>
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
      // fetch users from database 
      $users_post = "SELECT * FROM events ORDER BY id DESC";
      $posts = mysqli_query($connection, $users_post);
      $cnt = 1;              
    ?>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Datatables</h1>
              <hr>
              <?php if(isset($_SESSION['add-post-success'])) :  //show if add-post was successful ?>
                <div class="alert_message success container">
                  <p>
                    <?=  $_SESSION['add-post-success'];
                    unset($_SESSION['add-post-success']);
                    ?>
                    </p>
                </div>
              <?php elseif(isset($_SESSION['add-post'])) :  //show if add-post was NOT successful ?>
                <div class="alert_message error container">
                  <p>
                    <?=  $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?> 
                    </p>
                </div>
              <?php elseif(isset($_SESSION['edit-post-success'])) :  //show if edit-post was successful ?>
                <div class="alert_message success container">
                  <p>
                    <?=  $_SESSION['edit-post-success'];
                    unset($_SESSION['edit-post-success']);
                    ?> 
                    </p>
                </div>
              <?php elseif(isset($_SESSION['edit-post'])) :  //show if edit-post was NOT successful ?>
                <div class="alert_message error container">
                  <p>
                    <?=  $_SESSION['edit-post'];
                    unset($_SESSION['edit-post']);
                    ?> 
                    </p>
                </div>
              <?php elseif(isset($_SESSION['edit-video-success'])) :  //show if edit-video was successful ?>
                <div class="alert_message success container">
                  <p>
                    <?=  $_SESSION['edit-video-success'];
                    unset($_SESSION['edit-video-success']);
                    ?> 
                    </p>
                </div>
              <?php elseif(isset($_SESSION['edit-video'])) :  //show if edit-video was NOT successful ?>
                <div class="alert_message error container">
                  <p>
                    <?=  $_SESSION['edit-video'];
                    unset($_SESSION['edit-video']);
                    ?> 
                    </p>
                </div>
              <?php elseif(isset($_SESSION['delete-video-success'])) :  //show if delete-video was successful ?>
                <div class="alert_message success container">
                  <p>
                    <?=  $_SESSION['delete-video-success'];
                    unset($_SESSION['delete-video-success']);
                    ?> 
                    </p>
                </div>
              <?php elseif(isset($_SESSION['delete-post-success'])) :  //show if delete-post was successful ?>
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
                    <th><b>T</b>itle</th>                                  
                    <th>Category</th>
                    <th>Action</th>
                    <!-- <th>Delete</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <!-- get category title of each post from categories table -->
                    <?php
                    $category_id = $post['category_id'];
                    $category_query = "SELECT title FROM categories WHERE id = $category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                    <tr>
                      <td><?= $cnt; ?></td>
                      <td><?= $post['title']?></td>
                      <td><?= $category['title'] ?></td>
                      <td>
                        <a href="<?= ROOT_URL ?>superAdmin/edit-event.php?id=<?= $post['id']?>" class="btn sm"><i class="bi bi-pencil-square"></i></a>
                        <a href="<?= ROOT_URL ?>superAdmin/delete-event.php?id=<?= $post['id']?>" class="btn sm danger"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Event found" ?></div>
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