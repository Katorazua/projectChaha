<?php
require 'config/database.php';

//fetch current user from database
if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $user_result =  mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($user_result);  
    
}
  
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
    <title>Chaha Eye Hospitals</title>
    <meta content="Chaha Hospitals" name="keywords">
    <meta content="Chaha Eye Hospital" name="description">
  
    <!-- Favicons -->
    <link href="img/about.jpg" rel="icon">

     <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> 

    <!-- Vendor CSS Files -->
    <link href="<?=ROOT_URL?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=ROOT_URL?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=ROOT_URL?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?=ROOT_URL?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?=ROOT_URL?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?=ROOT_URL?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=ROOT_URL?>assets/css/style.css" rel="stylesheet">

    <!-- alpha custom stylesheet  // Author: Dr. Kay -->
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/css/modifile.css">
    <link rel="stylesheet" href="<?=ROOT_URL?>alpha.css/header.css">

</head>

<body>
        <!-- preloader Start -->
    <div id="preloader" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="preloader-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="preloader-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="preloader-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> 
        <!-- preloader End -->
    <!-- Topbar Start -->
    <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small class="py-2"><i class="far fa-clock text-primary me-2"></i>Opening Hours: Mon - Fri : 6.00 am - 7 .00 pm, Sunday Closed </small>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="bi bi-envelope-fill me-2"></i>Chaha@info.com</p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="bi bi-phone me-2"></i>+012 345 6789</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div style="display: none;">
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
            <a href="<?=ROOT_URL?>index.php" class="navbar-brand p-0">
                <h1 class="m-0 text-primary"><i class="bi bi-eye-fill me-2"></i>Chaha Eye Hospital</h1>
            </a>
            <div class="navbar-nav ms-auto py-0">
                <button id="show_nav"><i class="bx bx-menu"></i></button>           
                <button id="hide_nav"><i class="bx bx-x"></i></button> 
                <ul class="nav_items">
                    <div class="navbar-nav ms-auto py-0">
                        <li><a href="<?=ROOT_URL?>index.php" class=" nav-link active">Home</a></li>
                        <li><a href="<?=ROOT_URL?>about.php" class=" nav-link">About</a></li>
                        <li><a href="<?=ROOT_URL?>service.php" class=" nav-link">Service</a></li>
                        <li><a href="<?=ROOT_URL?>contact.php" class=" nav-link">Contact</a></li>
                        <li><a href="<?=ROOT_URL?>joinus/index.php" target="_blank" class=" nav-link">Join Us</a></li>
                        <?php if(isset($_SESSION['user-id'])) : ?>
                            <li class="nav_profile">
                                <div class="avater">
                                    <a href="<?=ROOT_URL?>profile-logic.php">
                                        <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>"  style=" width: 3.5rem; aspect-ratio: 1/1; border-radius: 50%; border: 0.3rem solid rgb(0, 128, 85) ">
                                    </a>
                                </div>                            
                            </li> 
                        <?php else : ?>       
                            <li><a href="<?=ROOT_URL?>signin.php" target="_blank" class=" nav-link">Signin</a></li>       
                        <?php endif ?>            
                    </div>
                </ul>  
            <!-- <i class="bi bi-list mobile-nav-toggle"></i> -->

            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="<?=ROOT_URL?>index.php">Chaha Eye Hospital<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="<?=ROOT_URL?>index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="<?=ROOT_URL?>about.php">About</a></li>
          <li><a class="nav-link scrollto" href="<?=ROOT_URL?>service.php">Services</a></li>
          <li><a class="nav-link scrollto " href="<?=ROOT_URL?>pricing.php">Pricing</a></li>
          <!-- <li><a class="nav-link scrollto active" href="AHMS/index.php" target="_blank">AHMS</a></li>           -->
          <li><a class="nav-link scrollto" href="<?=ROOT_URL?>contact.php">Contact</a></li>
            <?php if(isset($_SESSION['user-id'])) : ?>
                <li class="nav_profile">
                    <div class="avater">
                        <a href="<?=ROOT_URL?>profile-logic.php">
                            <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>"  style=" width: 3.5rem; aspect-ratio: 1/1; border-radius: 50%; border: 0.3rem solid rgb(0, 128, 85) ">
                        </a>
                    </div>                            
                </li> 
            <?php else : ?>       
                <li><a href="<?=ROOT_URL?>signin.php" target="_blank" class=" nav-link">Signin</a></li>       
            <?php endif ?> 
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

    <script>
        (function() {
        "use strict";

        /**
         * Easy selector helper function
         */
        const select = (el, all = false) => {
            el = el.trim()
            if (all) {
            return [...document.querySelectorAll(el)]
            } else {
            return document.querySelector(el)
            }
        }

        /**
         * Easy event listener function
         */
        const on = (type, el, listener, all = false) => {
            let selectEl = select(el, all)
            if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener))
            } else {
                selectEl.addEventListener(type, listener)
            }
            }
        }

        /**
         * Easy on scroll event listener 
         */
        const onscroll = (el, listener) => {
            el.addEventListener('scroll', listener)
        }

        /**
         * Navbar links active state on scroll
         */
        let navbarlinks = select('#navbar .scrollto', true)
        const navbarlinksActive = () => {
            let position = window.scrollY + 200
            navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
            })
        }
        window.addEventListener('load', navbarlinksActive)
        onscroll(document, navbarlinksActive)

        /**
         * Scrolls to an element with header offset
         */
        const scrollto = (el) => {
            let header = select('#header')
            let offset = header.offsetHeight

            if (!header.classList.contains('header-scrolled')) {
            offset -= 16
            }

            let elementPos = select(el).offsetTop
            window.scrollTo({
            top: elementPos - offset,
            behavior: 'smooth'
            })
        }

        /**
         * Header fixed top on scroll
         */
        let selectHeader = select('#header')
        if (selectHeader) {
            let headerOffset = selectHeader.offsetTop
            let nextElement = selectHeader.nextElementSibling
            const headerFixed = () => {
            if ((headerOffset - window.scrollY) <= 0) {
                selectHeader.classList.add('fixed-top')
                nextElement.classList.add('scrolled-offset')
            } else {
                selectHeader.classList.remove('fixed-top')
                nextElement.classList.remove('scrolled-offset')
            }
            }
            window.addEventListener('load', headerFixed)
            onscroll(document, headerFixed)
        }

        /**
         * Back to top button
         */
        let backtotop = select('.back-to-top')
        if (backtotop) {
            const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
            }
            window.addEventListener('load', toggleBacktotop)
            onscroll(document, toggleBacktotop)
        }

        /**
         * Mobile nav toggle
         */
        on('click', '.mobile-nav-toggle', function(e) {
            select('#navbar').classList.toggle('navbar-mobile')
            this.classList.toggle('bi-list')
            this.classList.toggle('bi-x')
        })

        /**
         * Mobile nav dropdowns activate
         */
        on('click', '.navbar .dropdown > a', function(e) {
            if (select('#navbar').classList.contains('navbar-mobile')) {
            e.preventDefault()
            this.nextElementSibling.classList.toggle('dropdown-active')
            }
        }, true)

        /**
         * Scrool with ofset on links with a class name .scrollto
         */
        on('click', '.scrollto', function(e) {
            if (select(this.hash)) {
            e.preventDefault()

            let navbar = select('#navbar')
            if (navbar.classList.contains('navbar-mobile')) {
                navbar.classList.remove('navbar-mobile')
                let navbarToggle = select('.mobile-nav-toggle')
                navbarToggle.classList.toggle('bi-list')
                navbarToggle.classList.toggle('bi-x')
            }
            scrollto(this.hash)
            }
        }, true)

        /**
         * Scroll with ofset on page load with hash links in the url
         */
        window.addEventListener('load', () => {
            if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash)
            }
            }
        });

        /**
        * Preloader
        */
        let preloader = select('#preloader');
        if (preloader) {
            window.addEventListener('load', () => {
            preloader.remove()
            });
        }

        /**
        * Initiate glightbox
        */
        const glightbox = GLightbox({
            selector: '.glightbox'
        });

        /**
        * Skills animation
        */
        let skilsContent = select('.skills-content');
        if (skilsContent) {
            new Waypoint({
            element: skilsContent,
            offset: '80%',
            handler: function(direction) {
                let progress = select('.progress .progress-bar', true);
                progress.forEach((el) => {
                el.style.width = el.getAttribute('aria-valuenow') + '%'
                });
            }
            })
        }

        /**
        * Testimonials slider
        */
        new Swiper('.testimonials-slider', {
            speed: 600,
            loop: true,
            autoplay: {
            delay: 5000,
            disableOnInteraction: false
            },
            slidesPerView: 'auto',
            pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
            }
        });

        /**
        * Porfolio isotope and filter
        */
        window.addEventListener('load', () => {
            let portfolioContainer = select('.portfolio-container');
            if (portfolioContainer) {
            let portfolioIsotope = new Isotope(portfolioContainer, {
                itemSelector: '.portfolio-item'
            });

            let portfolioFilters = select('#portfolio-flters li', true);

            on('click', '#portfolio-flters li', function(e) {
                e.preventDefault();
                portfolioFilters.forEach(function(el) {
                el.classList.remove('filter-active');
                });
                this.classList.add('filter-active');

                portfolioIsotope.arrange({
                filter: this.getAttribute('data-filter')
                });
                portfolioIsotope.on('arrangeComplete', function() {
                AOS.refresh()
                });
            }, true);
            }

        });

        /**
        * Initiate portfolio lightbox 
        */
        const portfolioLightbox = GLightbox({
            selector: '.portfolio-lightbox'
        });

        /**
        * Portfolio details slider
        */
        new Swiper('.portfolio-details-slider', {
            speed: 400,
            loop: true,
            autoplay: {
            delay: 5000,
            disableOnInteraction: false
            },
            pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
            }
        });

        /**
        * Animation on scroll
        */
        window.addEventListener('load', () => {
            AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
            })
        });

        /**
        * Initiate Pure Counter 
        */
        new PureCounter();

        })()
    </script>

