<?php
include 'partials/header.php';
// fetch services fro database
$query = "SELECT * FROM services ORDER BY date_time DESC";
$posts = mysqli_query($connection, $query); 
?>
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Services</h1>
                <a href="<?=ROOT_URL?>index.php" class="h4">Home</a>
                <span class="h4 text-white">/</span>               
                <a href="" class="h4 text-white">We Offer Fair price</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


        <!-- Service Start -->

        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-5 wow zoomIn" data-wow-delay="0.3s" style="min-height: 400px;">
                    <div class="twentytwenty-container position-relative h-100 rounded overflow-hidden">
                        <img class="position-absolute w-100 h-100" src="./img/ceh.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title mb-5">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase">Our Services</h5>
                        <h1 class="display-5 mb-0">We Offer The Best Quality Health Services</h1>
                    </div>
                    <div class="col-lg-12 service-item wow zoomIn" data-wow-delay="0.9s">
                    <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-4">
                        <h3 class="text-white mb-3">Make Appointment</h3>
                        <p class="text-white mb-3">Clita ipsum magna kasd rebum at ipsum amet dolor justo dolor est magna stet eirmod</p>
                        <?php if(isset($_SESSION['user-id'])) :?>
                            <a href="tel:09047948009"><h2 class="text-white mb-0">+012 345 6789</h2></a>
                        <?php else :?>
                            <a href="<?=ROOT_URL?>signin.php"><h2 class="text-white mb-0">+012 345 6789</h2></a>
                        <?php endif ?>
                    </div>
                </div>
                </div>
            </div>            
        </div>
    </div>

        <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                <div class="twentytwenty-container position-relative h-100 rounded overflow-hidden">
                        <img class="position-absolute w-100 h-100" src="./img/surgery.jpg" style="object-fit: cover;">
                    </div>                  
                </div>                
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?> 
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="./images/<?= $post['thumbnail']?>" alt="">
                          
                        </div>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2"><?= $post['title']?></h4>
                            <p class="text-primary mb-0">NGN_<?= $post['prices']?></p>
                        </div>
                    </div>
                </div>
                 <?php endwhile?>
            </div>
        </div>
    </div>
   
    <!-- service End -->
    
<?php include 'partials/footer.php';?>