<?php
include 'partials/header.php';
// fertch posts from testimonials with users
$query = "SELECT * FROM testimonials ORDER BY date_time DESC";
$posts = mysqli_query($connection, $query);


?>  

    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/ceh.jpg" alt="" style="width: 100%; height: fit-content;  margin: 0 auto;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Keep Your Future Healthy</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Get The Best Quality  Treatment</h1>
                            <a href="<?=ROOT_URL?>event-field.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Events</a>
                            <a href="<?=ROOT_URL?>pricing.php" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Get Started</a>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Banner Start -->
    <div class="container-fluid banner mb-5">
        <div class="container">
            <div class="row gx-0">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary d-flex flex-column p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Opening Hours</h3>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <h6 class="text-white mb-0">Mon - Fri</h6>
                            <p class="mb-0"> 8:00am - 9:00pm</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <h6 class="text-white mb-0">Saturday</h6>
                            <p class="mb-0"> 8:00am - 7:00pm</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <h6 class="text-white mb-0">Sunday</h6>
                            <p class="mb-0"> 8:00am - 5:00pm</p>
                        </div>
                        <?php if (isset($_SESSION['user-id'])) :?>
                          <a class="btn btn-light" href="<?=ROOT_URL?>appointment.php">Make Appointment</a>
                        <?php else :?>
                          <a class="btn btn-light" href="<?=ROOT_URL?>signin.php">Make Appointment</a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">                  
                  <div class="bg-dark d-flex flex-column p-5" style="height: 300px;">
                    <h3 class="text-white mb-3">Do You Know?</h3>
                    <p class="text-white">Save 30% On Your First health Checkup. Chat with Our Certified & Experienced Doctors, have you treated home and abroad, meet new people. Signup now. Your Health Care For Life! </p>
                    <!-- <a class="btn btn-light" target="_blank" href=""></a> -->
                  </div>                
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-secondary d-flex flex-column p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Emegency Only</h3>
                        <p class="text-white">Ipsum erat ipsum dolor clita rebum no rebum dolores labore, ipsum magna at eos et eos amet.</p>
                        <?php if(isset($_SESSION['user-id'])) :?>
                          <h2 class="text-white mb-0"><a href="tel:09047978009">+012 345 6789</a></h2>
                        <?php else :?>
                          <h2 class="text-white mb-0"><a href="<?=ROOT_URL?>signin.php">+012 345 6789</a></h2>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Start -->


    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title mb-4">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase">Emegency</h5>
                        <h1 class="display-5 mb-0">The World's Best eye Clinic That You Can Trust</h1>
                    </div>
                    <h4 class="text-body fst-italic mb-4">Diam dolor diam ipsum sit. Clita erat ipsum et lorem stet no lorem sit clita duo justo magna dolore</h4>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet</p>
                    <div class="row g-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.3s">
                            <h5 class="mb-3"><i class="bi bi-check-circle-fill text-primary me-3"></i>Award Winning</h5>
                            <h5 class="mb-3"><i class="bi bi-check-circle-fill text-primary me-3"></i>Professional Staff</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.6s">
                            <h5 class="mb-3"><i class="bi bi-check-circle-fill text-primary me-3"></i>24/7 Opened</h5>
                            <h5 class="mb-3"><i class="bi bi-check-circle-fill text-primary me-3"></i>Fair Prices</h5>
                        </div>
                    </div>
                    <?php if(isset($_SESSION['user-id'])) :?>
                     <a href="<?=ROOT_URL?>appointment.php" class="btn btn-primary py-3 px-5 mt-4 wow zoomIn" data-wow-delay="0.6s">Make Appointment</a>
                    <?php else :?>
                      <a href="<?=ROOT_URL?>signin.php" class="btn btn-primary py-3 px-5 mt-4 wow zoomIn" data-wow-delay="0.6s">Make Appointment</a>
                    <?php endif ?>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="./img/treatment-1.JPG" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

<!--  introduction area start section  -->
    <?php
      // fertch ads from events with users
      $query = "SELECT * FROM introduction ORDER BY date_time DESC LIMIT 1";
      $result = mysqli_query($connection, $query);
      $intro = mysqli_fetch_assoc($result);

    ?>
    <div class="container-fluid bg-primary bg-appointment my-5 wow fadeInUp" data-wow-delay="0.1s" style="background-image: url('./img/hero.jpg'); background-position: center;">
      <div class="container text-center">
        <video class="container-fluid" autoplay muted controls>
          <source src="./videos/<?= $intro['video']?>" type="video/mp4">
        </video>
        <h3 class="text-white"><?= $intro['title']?></h3>
      </div>
    </div>    
    <!-- introduction area end section  -->

    <?php
      //get back form data if there was a registration error
      $name = $_SESSION['add-user-data']['name'] ?? null;
      $email = $_SESSION['add-user-data']['email'] ?? null;
      $comment = $_SESSION['add-user-data']['comment'] ?? null;

      // delete session data
      unset($_SESSION['add-user-data']);
    ?>
    <!-- sponsorship area start section  -->
    <div class="container-fluid bg-primary bg-appointment my-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
        <div data-wow-delay="0.1s">
          <div class="row gx-5">
            <div class="col-lg-6 py-5">
              <div class="py-5">
                  <h1 class="display-5  mb-4">We Are A Certified and Award Winning Eye Clinic You Can Trust</h1>
                  <p class=" text-white mb-0">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div id="support" class="appointment-form h-100 d-flex flex-column justify-content-center p-4 wow zoomIn" data-wow-delay="0.6s">
                <h1 class="text-white mb-4">We Offer Fair Prices for Treatment</h1>
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
                <form action="<?=ROOT_URL?>support.php" method="post" enctype="multipart/form-data">
                  <div class="row g-3">               
                    <div class="col-12 col-sm-6">
                        <input type="text" name="name" class="form-control bg-light border-0" placeholder="Your Name (In Full)" style="height: 55px;">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="email" name="email" class="form-control bg-light border-0" placeholder="Your Email" style="height: 55px;">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="tel" name="phone" class="form-control bg-light border-0" placeholder="Your Phone Number" style="height: 55px;">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="text" name="amount" class="form-control bg-light border-0" placeholder="Amount of choise" style="height: 55px;">
                    </div>
                    <div class="col-12 col-sm-6" style="display: none;">
                    <?php 
                      $length = 7;    
                      $ref_pin =  substr(str_shuffle('0123456789'),1,$length);
                    ?>
                     <input type="text" name="ref_pin" class="form-control bg-light border-0" value="<?=$ref_pin?>" placeholder="Transaction reference" style="height: 55px;">
                    </div>
                    <div class="col-12">
                    <textarea name="comment" class="w-100 py-3" style="background: #fff; color: #333; outline: none; border: none; padding: 15px;" placeholder="Write your comment here, how you can help us improve..." rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-dark w-100 py-3" name="submit">Support</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- sponsorship area end section  -->


    <!-- Team Start -->
    <?php
    //fetch doctors from doctors database
    $query = "SELECT * FROM doctors ORDER BY RAND() LIMIT 5 ";
    $result = mysqli_query($connection, $query);
    ?>
  <div class="container-fluid py-5">
      <div class="container">
          <div class="row g-5">
              <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                  <div class="section-title bg-light rounded h-100 p-5">
                      <h5 class="position-relative d-inline-block text-primary text-uppercase">Top 5</h5>
                      <h1 class="display-6 mb-4">Meet Our Certified & Experienced Doctors</h1>
                        <a href="<?=ROOT_URL?>joinus/index.php" target="_blank" class="btn btn-primary py-3 px-5">Join Us</a>
                  </div>
              </div>                
          <?php while ($user = mysqli_fetch_assoc($result)) : ?> 
              <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                  <div class="team-item">
                      <div class="position-relative rounded-top" style="z-index: 1;">
                          <img class="img-fluid rounded-top w-100" src="./images/<?= $user['avatar']?>" alt="">
                          <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                              <a class="btn btn-primary btn-square m-1" target="_blank" href="<?=$user['twitter'] ?>"><i class="bi bi-twitter fw-normal"></i></a>
                              <a class="btn btn-primary btn-square m-1" target="_blank" href="<?=$user['facebook'] ?>"><i class="bi bi-facebook fw-normal"></i></a>
                              <a class="btn btn-primary btn-square m-1" target="_blank" href="<?=$user['linkedin'] ?>"><i class="bi bi-linkedin fw-normal"></i></a>
                              <a class="btn btn-primary btn-square m-1" target="_blank" href="<?=$user['instagram'] ?>"><i class="bi bi-instagram fw-normal"></i></a>
                          </div>
                      </div>
                      <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                          <h4 class="mb-2">Dr.&nbsp;<?= "{$user['firstname']} {$user['lastname']}"?></h4>
                          <p class="text-primary mb-0"><?= $user['job']?></p>
                      </div>
                  </div>
              </div>
                <?php endwhile?>
          </div>
      </div>
  </div>   
    <!-- Team End -->

         <!-- ======= Testimonials Section ======= -->
     <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Testimonials</h2>
          <p>Voluptatem quibusdam ut ullam perferendis repellat non ut consequuntur est eveniet deleniti fignissimos eos quam</p>
        </div>

        <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
          <?php while ($post = mysqli_fetch_assoc($posts)) : ?> 
            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <div class="d-flex align-items-center">
                    <img src="./images/<?= $post['avatar']?>" class="testimonial-img flex-shrink-0" alt="photo" style="width: 4rem; height: 4rem; border-radius: 50%; overflow: hidden;">
                    <div>
                      <h3><?= "{$post['firstname']} {$post['lastname']}"?></h3>
                      <h4><?= $post['occupation']?></h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                      <div class="stars">
                    <?= date("M D, Y - H:i", strtotime($post['date_time'])) ?>
                    </div>
                    </div>
                  </div>
                
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                      <?= substr($post['body'], 0, 250)?>...
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->
            <?php endwhile ?>    
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->
    
    <!-- ======= Frequently Asked Questions Section ======= -->
  <section id="faq" class="faq">
    <div class="container" data-aos="fade-up">            
    <div class="section-title bg-light rounded h-100 p-5">
        <div>
          <h5 class="position-relative d-inline-block text-primary text-uppercase">Posible Solutions</h5>
        </div>
        <div class="row gy-4">                    
        <div class="col-lg-4">
          <div class="content px-xl-5">
            <h3>Frequently Asked <strong>Questions</strong></h3>
            <p style="font-size: 20px;">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
            </p>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                  <span class="num">1.</span>
                  Non consectetur a erat nam at lectus urna duis?
                </button>
              </h3>
              <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </div>
              </div>
            </div><!-- # Faq item-->

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                  <span class="num">2.</span>
                  Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?
                </button>
              </h3>
              <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </div>
              </div>
            </div><!-- # Faq item-->

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                  <span class="num">3.</span>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?
                </button>
              </h3>
              <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </div>
              </div>
            </div><!-- # Faq item-->

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                  <span class="num">4.</span>
                  Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                </button>
              </h3>
              <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </div>
              </div>
            </div><!-- # Faq item-->

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                  <span class="num">5.</span>
                  Tempus quam pellentesque nec nam aliquam sem et tortor consequat?
                </button>
              </h3>
              <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                </div>
              </div>
            </div><!-- # Faq item-->

          </div>

        </div>
      </div>                               
    </div>
  </section><!-- End Frequently Asked Questions Section -->
 
<?php include 'partials/footer.php'; ?>