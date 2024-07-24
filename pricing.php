<?php
include 'partials/header.php';
?>

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
              <h1 class="display-3 text-white animated zoomIn">SetUp A Plan</h1>
            </div>
        </div>
    </div>
    <!-- Hero End -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">        
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <!-- <h2>Pricing</h2> -->
          <h3>Check our <span>Pricing</span></h3>
          <p>Insure Your health, and that of your family with Chaha Eye Hospital.We Offer Fair Prices for Treatment.</p>
        </div>
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
        <div class="row">
         
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <h3>Free</h3>
              <h4><sup>$</sup>0<span> / Available</span></h4>
              <h4><span>(NGN 0.00)</span></h4>
              <ul>
                <li>Events</li>
                <li>User privileges</li>
                <li class="na">Registration</li>
                <li class="na">Nursing Care</li>
                <li class="na">lab test</li>
                <li class="na">Appointment</li>
                <li class="na">Treatment Allover Chaha Hospitals</li>
                <li class="na">Add Family Mamber (2)</li>
                <li class="na">Consultation</li>
                <li class="na">Access AHMS Doctors Allover The Globe</li>
                <li class="na">VIP Emegency Service</li>
                <li class="na">NHIS Registration</li>
                <li class="na">First Aid Kit</li>
                <li class="na">Diamond Card</li>
              </ul>
              <?php if(isset($_SESSION['user-id'])) :?>              
              <div class="btn-wrap">
                <a href="<?=ROOT_URL?>profile-logic.php" class="my-plan">Default</a>
              </div>
              <?php else :?>
              <div class="btn-wrap">
                <a href="<?=ROOT_URL?>signin.php" class="btn-buy">Buy Now</a>
              </div> 
              <?php endif ?>             
            </div>
          </div>           

          <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box featured">
              <h3>Silver</h3>
              <h4><sup>$</sup>129<span> / 1Year</span></h4>
              <h4><span>(NGN 500,000.00)</span></h4>
              <ul>
                <li>Events</li>
                <li>User privileges</li>
                <li>Registration</li>
                <li>Nursing Care</li>
                <li>lab test</li>
                <li>Appointment</li>
                <li class="na">Treatment Allover Chaha Hospitals</li>
                <li class="na">Add Family Mamber (2)</li>
                <li class="na">Consultation</li>
                <li class="na">Access AHMS Doctors Allover The Globe</li>
                <li class="na">VIP Emegency Service</li>
                <li>NHIS Registration</li>
                <li>First Aid Kit</li>
                <li class="na">Diamond Card</li>
              </ul>
              <?php if(isset($_SESSION['user-id'])) {
                $user_id = $_SESSION['user-id'];
                $sql = "SELECT * FROM users WHERE id = $user_id";
                $sqlconn = mysqli_query($connection, $sql);
                $row = mysqli_fetch_assoc($sqlconn);
              ?>

              <div class="btn-wrap">
                <a href="price.php?id=<?= $row['id'] ?>" class="btn-buy">Buy Now</a>
              </div>
              <?php } else {?>
              <div class="btn-wrap">
                <a href="<?=ROOT_URL?>signin.php" class="btn-buy">Buy Now</a>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <h3>Gold</h3>
              <h4><sup>$</sup>229<span> / 1Year</span></h4>
              <h4><span>(NGN 750,000.00)</span></h4>
              <ul>
                <li>Events</li>
                <li>User privileges</li>
                <li>Registration</li>
                <li>Nursing Care</li>
                <li>lab test</li>
                <li>Appointment</li>
                <li class="na">Treatment Allover Chaha Hospitals</li>
                <li class="na">Add Family Member (2)</li>
                <li>Consultation</li>
                <li class="na">Access AHMS Doctors Allover The Globe</li>
                <li>Emegency Service</li>
                <li>NHIS Registration</li>
                <li>First Aid Kit</li>
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
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <span class="advanced">Advanced</span>
              <h3>Diamond</h3>
              <h4><sup>$</sup>3,849<span> / 1Year</span></h4>
              <h4><span>(NGN 1,000,000.00)</span></h4>
              <ul>
                <li>Events</li>
                <li>User privileges</li>
                <li>Registration</li>
                <li>Nursing Care</li>
                <li>lab test</li>
                <li>Appointment</li>
                <li>Treatment Allover Chaha Hospitals</li>
                <li>Add Family Mamber (2)</li>
                <li>Consultation</li>
                <li>Access AHMS Doctors Allover The Globe</li>
                <li>VIP Emegency Service</li>
                <li>NHIS Registration</li>
                <li>First Aid Kit</li>
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
          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->
    <!-- Appointment End -->
  <?php include 'partials/footer.php'; ?>