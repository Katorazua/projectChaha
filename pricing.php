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

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pricing</h2>
        <p>Insure Your health, and that of your family with Chaha Eye Hospital.We Offer Fair Prices for Treatment.</p>
      </div><!-- End Section Title -->

      <div class="container">
        <?php if (isset($_SESSION['price-success'])) : ?>
          <div class="alert_message success">
            <p>
              <?=  $_SESSION['price-success'];
                unset($_SESSION['price-success']);
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['price'])) : ?>
          <div class="alert_message error">
            <p>
              <?=  $_SESSION['price'];
                unset($_SESSION['price']);
              ?>
            </p>
          </div>
        <?php endif ?> 
        <div class="row gy-3">
          <?php
            if(isset($_SESSION['user-id'])) {
              $user_id = $_SESSION['user-id'];
              $sql = "SELECT * FROM users WHERE id = $user_id";
              $sqlconn = mysqli_query($connection, $sql);
              $row = mysqli_fetch_assoc($sqlconn);
            }
          ?>
          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing-item">
              <h3>Free</h3>
              <h4><sup>NGN</sup>0<span> / Year</span></h4>
              <ul>
                <li>Nursing Care</li>
                <li>First Aid Kit</li>
                <li class="na">VIP Emegency Service</li>
                <li class="na">NHIS Registration</li>
                <li class="na">Add Family Mamber (2)</li>
                <li class="na">Diamond Card</li>
              </ul>
              <?php if(isset($_SESSION['user-id'])) :?>
                <div class="btn-wrap">
                  <a href="profile-logic.php" class="btn-buy">Default</a>
                </div>
              <?php else :?>
                <div class="btn-wrap">
                  <a href="<?=ROOT_URL?>signin.php" class="btn-buy">Buy Now</a>
                </div>
              <?php endif ?>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="pricing-item featured">
              <h3>Silver</h3>
              <h4><sup>NGN</sup>19<span> / Year</span></h4>
              <ul>
                <li>Nursing Care</li>
                <li>First Aid Kit</li>
                <li>VIP Emegency Service</li>
                <li class="na">NHIS Registration</li>
                <li class="na">Add Family Mamber (2)</li>
                <li class="na">Diamond Card</li>
              </ul>
              <?php if(isset($_SESSION['user-id'])) :?>
                <div class="btn-wrap">
                  <a href="price.php?id=<?= $row['id'] ?>" class="btn-buy">Buy Now</a>
                </div>
              <?php else :?>
                <div class="btn-wrap">
                  <a href="<?=ROOT_URL?>signin.php" class="btn-buy">Buy Now</a>
                </div>
              <?php endif ?>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="pricing-item">
              <h3>Gold</h3>
              <h4><sup>NGN</sup>29<span> / Year</span></h4>
              <ul>
                <li>Nursing Care</li>
                <li>First Aid Kit</li>
                <li>VIP Emegency Service</li>
                <li>NHIS Registration</li>
                <li class="na">Add Family Mamber (2)</li>
                <li class="na">Diamond Card</li>
              </ul>
              <?php if(isset($_SESSION['user-id'])) :?>
                <div class="btn-wrap">
                  <a href="price.php?id=<?= $row['id'] ?>" class="btn-buy">Buy Now</a>
                </div>
              <?php else :?>
                <div class="btn-wrap">
                  <a href="<?=ROOT_URL?>signin.php" class="btn-buy">Buy Now</a>
                </div>
              <?php endif ?>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="pricing-item">
              <span class="advanced">Advanced</span>
              <h3>Diamond</h3>
              <h4><sup>NGN</sup>49<span> / Year</span></h4>
              <ul>
                <li>Nursing Care</li>
                <li>First Aid Kit</li>
                <li>VIP Emegency Service</li>
                <li>NHIS Registration</li>
                <li>Add Family Mamber (2)</li>
                <li>Diamond Card</li>
              </ul>
              <?php if(isset($_SESSION['user-id'])) :?>
                <div class="btn-wrap">
                  <a href="price.php?id=<?= $row['id'] ?>" class="btn-buy">Buy Now</a>
                </div>
              <?php else :?>
                <div class="btn-wrap">
                  <a href="<?=ROOT_URL?>signin.php" class="btn-buy">Buy Now</a>
                </div>
              <?php endif ?>
            </div>
          </div><!-- End Pricing Item -->

        </div>

      </div>

    </section><!-- /Pricing Section -->

  </main>

  <?php include 'partials/footer.php'; ?>