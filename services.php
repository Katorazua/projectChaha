<?php include 'partials/header.php'; ?>

  <main class="main">

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>In an emergency? Need help now?</h3>
              <p>Save 30% On Your First health Checkup. Chat with Our Certified & Experienced Doctors, have you treated home and abroad, meet new people. Signup now. Your Health Care For Life!</p>
              <?php if (isset($_SESSION['user-id'])) :?>
                <a class="cta-btn" href="<?=ROOT_URL?>appointment.php">Make an Appointment</a>
              <?php else :?>
                <a class="cta-btn" href="<?=ROOT_URL?>signin.php">Make an Appointment</a>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->  

    <!-- Services Section -->
    <section class="doctors section light-background">
      <?php
        // fetch services fro database
        $query = "SELECT * FROM services ORDER BY date_time DESC";
        $posts = mysqli_query($connection, $query); 
      ?>

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>We Offer The Best Quality Health Services with fair price</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <?php while ($post = mysqli_fetch_assoc($posts)) : ?> 
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="team-member">
                <div class="member-img">
                  <img src="./images/<?= $post['thumbnail']?>" class="img-fluid" alt="picture">
                  <div class="social">
                  <p class="text-white mb-0">NGN_<?= $post['prices']?></p>
                  </div>
                </div>
                <div class="member-info">
                  <h4><?= $post['title']?></h4>
                  <span>NGN <?= $post['prices']?></span>
                </div>
              </div>
            </div><!-- End Team Member -->
          <?php endwhile?>                   
        </div>

      </div>

    </section><!-- /Services Section -->

  </main>

  <?php include 'partials/footer.php'; ?>