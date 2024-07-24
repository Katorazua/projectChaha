<?php 
include '../partials/dashboardheader.php';

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];    
  $subject = $_POST['subject'];
  $hps = "AHMS";

  if (!$name){
      $_SESSION['signup'] = "please enter your full name";
  } if (!$email) {
      $_SESSION['signup'] = "please enter a valied email";
  } if (!$subject) {
      $_SESSION['signup'] = "please enter your subject";
  } if (!$message) {
      $_SESSION['signup'] = "please type a message";
  }

  $user_query = " INSERT INTO contact (hps, fullname, email, subject, message) VALUES('$hps', '$name', '$email', '$subject', '$message')";
  $user_result = mysqli_query($connection, $user_query);
  

  if (!mysqli_errno($connection)) {
      // echo "Message sent successfully!";
      $_SESSION['add-user-success'] = "Message sent successfully!";
  } else {
      echo "Error sending message.";
      $_SESSION['add-user'] = "Error sending message.";
  }
}
?>

  <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Contact</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Location</li>
          <li class="breadcrumb-item active">Contact</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section contact">

      <div class="row gy-4">

        <div class="col-xl-6">

          <div class="row">
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-geo-alt"></i>
                <h3>Address</h3>
                <p>KM 3 Gboko Road,<br>BSUC Makurdi, Benue State Nigeria </p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-telephone"></i>
                <h3>Call Us</h3>
                <p>+234 9047948009<br>+243 8063656085<br>+243 8115597273</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p>info@example.com<br>projectalpha@email.com</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-clock"></i>
                <h3>Open Hours</h3>
                <p>Monday - Friday<br>9:00AM - 05:00PM</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-6">
          <div class="card p-4">
          <?php if(isset($_SESSION['add-user-success'])) :  // show if add-user is successful ?>
              <div class="alert_message success text-center container">
                  <p>
                  <?=  $_SESSION['add-user-success'];
                  unset($_SESSION['add-user-success']);
                  ?>
                  </p>
              </div>
          <?php elseif(isset($_SESSION['add-user'])) :  // show if add-user was NOT successful ?>
              <div class="alert_message error container">
                  <p>
                  <?=  $_SESSION['add-user'];
                  unset($_SESSION['add-user']);
                  ?>
                  </p>
              </div>
          <?php endif ?>
            <form method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit" name="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div>

        </div>

      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php'; ?>