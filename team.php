<?php
include 'partials/header.php';
//fetch doctors from doctors database
$query = "SELECT * FROM doctors ORDER BY RAND() ";
$result = mysqli_query($connection, $query);
?>

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Consultants</h1>
                <a href="<?=ROOT_URL?>index.php" class="h4">Home</a>
                <span class="h4 text-white">/</span>
                <a href="" class="h4 text-white">Profertionals</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Team Doctors Start -->
    <div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                <div class="section-title bg-light rounded h-100 p-5">
                    <h5 class="position-relative d-inline-block text-primary text-uppercase">Team</h5>
                    <h1 class="display-6 mb-4">Meet Our Certified & Experienced Doctors</h1>
                    <a target="_blank" href="<?=ROOT_URL?>joinus/index.php" class="btn btn-primary py-3 px-5">Join Us</a>
                </div>
            </div>                
        <?php while ($user = mysqli_fetch_assoc($result)) : ?> 
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="position-relative rounded-top" style="z-index: 1;">
                        <img class="img-fluid rounded-top w-100" src="./images/<?= $user['avatar']?>" alt="">
                        <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                            <a class="btn btn-primary btn-square m-1" target="_blank" href="<?= $user['twitter']?>"><i class="bi bi-twitter fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" target="_blank" href="<?= $user['facebook']?>"><i class="bi bi-facebook fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" target="_blank" href="<?= $user['linkedin']?>"><i class="bi bi-linkedin fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" target="_blank" href="<?= $user['instagram']?>"><i class="bi bi-instagram fw-normal"></i></a>
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
    </div><!-- Team Doctors End -->

    <?php

        //fetch staff from staff database
        $query = "SELECT * FROM employees WHERE role = 'Nurse' ORDER BY RAND()";
        $result = mysqli_query($connection, $query);
    ?>
    <!-- Team Nurses Start -->
    <div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                <div class="section-title bg-light rounded h-100 p-5">
                    <h5 class="position-relative d-inline-block text-primary text-uppercase">Team</h5>
                    <h1 class="display-6 mb-4">Meet Our Certified & Experienced Nurses</h1>
                    <?php if(isset($_SESSION['user-id'])) :?>
                        <a href="<?=ROOT_URL?>joinus.php" class="btn btn-primary py-3 px-5">Join Us</a>
                    <?php else :?>    
                        <a href="<?=ROOT_URL?>signin.php" class="btn btn-primary py-3 px-5">Join Us</a>
                    <?php endif ?>
                </div>
            </div>                
        <?php while ($user = mysqli_fetch_assoc($result)) : ?> 
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="position-relative rounded-top" style="z-index: 1;">
                        <img class="img-fluid rounded-top w-100" src="./images/<?= $user['avatar']?>" alt="">
                        <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                            <a class="btn btn-primary btn-square m-1" target="_blank" href="https://twitter.com/"><i class="bi bi-twitter fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" target="_blank" href="https://facebook.com/"><i class="bi bi-facebook fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" target="_blank" href="https://linkedin.com/"><i class="bi bi-linkedin fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" target="_blank" href="https://instagram.com/"><i class="bi bi-instagram fw-normal"></i></a>
                        </div>
                    </div>
                    <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                        <h4 class="mb-2"><?= "{$user['firstname']} {$user['lastname']}"?></h4>
                        <p class="text-primary mb-0"><?= $user['role']?></p>
                    </div>
                </div>
            </div>
                <?php endwhile?>
        </div>
    </div>
    </div><!-- Team Nurses End -->

    <?php include 'partials/footer.php'; ?>