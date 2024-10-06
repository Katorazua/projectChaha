<?php 
include '../partials/dashboardheader.php';

$current_admin_id = $_SESSION['user-id'];

//get back form data if there was a registration error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$occupation = $_SESSION['add-user-data']['occupation'] ?? null;
$phone = $_SESSION['add-user-data']['phone'] ?? null;
$body = $_SESSION['add-user-data']['body'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Testimonial</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Testimonial</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="text-center card-title">Add New Comment</h1>
              <hr>
                <?php if(isset($_SESSION['add-user'])) : ?>
                        <div class="alert_message error">
                        <p>
                            <?= $_SESSION['add-user'];
                            unset($_SESSION['add-user']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="add-testimonial-logic.php" method="POST" enctype="multipart/form-data">
              
                <div class="col-md-6">
                  <input type="text" class="form-control"  name="admin_id"  value="<?= $current_admin_id ?>" hidden>

                  <label for="inputCity" class="form-label">First Name</label>
                  <input type="text" name="firstname" class="form-control" value="<?= $firstname ?>" id="inputCity" placeholder="user's firstname">
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Last Name</label>
                  <input type="text" name="lastname" class="form-control" value="<?= $lastname ?>" id="inputCity" placeholder="user's lastname">
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Profesion</label>
                  <input type="text" name="occupation" class="form-control" value="<?=$occupation?>" id="inputCity" placeholder="user's occupation">
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-control" value="<?= $email ?>" id="inputCity" placeholder="user's email address">
                </div>   

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Contact</label>
                  <input type="text" name="phone" class="form-control" value="<?= $phone ?>" id="inputCity" placeholder="user's phone number">
                </div> 
                
                <div class="col-md-6"> 
                  <label for="avatar"><i class="bi bi-plus-circle"></i>Add User Avatar</label>
                  <br>
                  <input type="file" name="avatar" id="avatar">
                </div>

                <div class="col-md-12">
                  <label for="inputCity" class="form-label">Content</label>
                  <!-- <input type="text" class="form-control" id="inputCity" placeholder="Name of Class Teacher"> -->
                  <textarea name="body" class="form-control" placeholder="create your content body here...." cols="30" rows="5"><?= $body ?></textarea>
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
         // fetch users from database but not Super admin
        $current_admin_id = $_SESSION['user-id'];

        $query = "SELECT * FROM testimonials";
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
                    <th><b>N</b>ame</th>                                  
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                      <td><?= $cnt; ?></td>
                      <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                      <td><?= $user['phone'] ?></td>
                      <td><?= date("M D, Y - H:i", strtotime($user['date_time'])) ?></td>
                      <td>
                        <a href="edit-testimonial.php?id=<?= $user['id']?>" class="btn sm"><i class="bi bi-pencil-square"></i></a>
                        <a href="delete-testimonial.php?id=<?= $user['id']?>" class="btn sm danger"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  <?php $cnt=$cnt+1; endwhile ?> 
                </tbody>
              </table>
              <?php else : ?>
                <div class="alert_message error text-center"><?= "No Content found" ?></div>
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