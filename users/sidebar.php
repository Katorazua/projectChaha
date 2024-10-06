
 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">       
        <li>
          <a href="add-testimonials.php">
            <i class="bi bi-circle"></i><span>Add Your Testimonial</span>
          </a>
        </li>        
        <li>
          <a href="manage-testimonials.php">
            <i class="bi bi-circle"></i><span>Manage Testimonials</span>
          </a>
        </li>              
      </ul>
    </li><!-- End Components Nav -->

    <?php if(isset($_SESSION['user_is_diamond'])) :?>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#appointment-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-arrow-in-right"></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="appointment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="make-appointment.php">
            <i class="bi bi-circle"></i><span>Make Appointment</span>
          </a>
        </li>
        <li>
          <a href="view-appointment.php">
            <i class="bi bi-circle"></i><span>View Appointment</span>
          </a>
        </li>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Appointment Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#membership-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-arrow-in-right"></i><span>Membership</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="membership-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-Member.php">
            <i class="bi bi-circle"></i><span>Add Member</span>
          </a>
        </li>
        <li>
          <a href="manage-Members.php">
            <i class="bi bi-circle"></i><span>Manage Members</span>
          </a>
        </li>
        <li>
          <a href="Membership-card.php">
            <i class="bi bi-circle"></i><span>Membership Card</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Membership Nav -->
    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Registration</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="patient-form.php">
            <i class="bi bi-circle"></i><span>Register Here</span>
          </a>
        </li>
        <li>
          <a href="manage-patients.php">
            <i class="bi bi-circle"></i><span>View Form</span>
          </a>
        </li>
        <li>
          <a href="NHIS.php">
            <i class="bi bi-circle"></i><span>NHIS Registration</span>
          </a>
        </li>
      </ul>
    </li><!-- End patients Nav -->
    <?php endif ?>

    <?php if(isset($_SESSION['user_is_gold'])) :?>
      <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#appointment-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-arrow-in-right"></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="appointment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="make-appointment.php">
            <i class="bi bi-circle"></i><span>Make Appointment</span>
          </a>
        </li>
        <li>
          <a href="view-appointment.php">
            <i class="bi bi-circle"></i><span>View Appointment</span>
          </a>
        </li>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Appointment Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#membership-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-arrow-in-right"></i><span>Membership</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="membership-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="Membership-card.php">
            <i class="bi bi-circle"></i><span>Membership Card</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Membership Nav -->
    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Registration</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="patient-form.php">
            <i class="bi bi-circle"></i><span>Register Here</span>
          </a>
        </li>
        <li>
          <a href="manage-patients.php">
            <i class="bi bi-circle"></i><span>View Form</span>
          </a>
        </li>
        <li>
          <a href="NHIS.php">
            <i class="bi bi-circle"></i><span>NHIS Registration</span>
          </a>
        </li>
      </ul>
    </li><!-- End patients Nav -->
    <?php endif ?>

    <?php if(isset($_SESSION['user_is_silver'])) :?>
      <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#appointment-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-arrow-in-right"></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="appointment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="make-appointment.php">
            <i class="bi bi-circle"></i><span>Make Appointment</span>
          </a>
        </li>
        <li>
          <a href="view-appointment.php">
            <i class="bi bi-circle"></i><span>View Appointment</span>
          </a>
        </li>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Appointment Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#membership-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-arrow-in-right"></i><span>Membership</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="membership-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="Membership-card.php">
            <i class="bi bi-circle"></i><span>Membership Card</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Membership Nav -->
    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Registration</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="patient-form.php">
            <i class="bi bi-circle"></i><span>Register Here</span>
          </a>
        </li>
        <li>
          <a href="manage-patients.php">
            <i class="bi bi-circle"></i><span>View Form</span>
          </a>
        </li>
        <li>
          <a href="NHIS.php">
            <i class="bi bi-circle"></i><span>NHIS Registration</span>
          </a>
        </li>
      </ul>
    </li><!-- End patients Nav -->
    <?php endif ?>
    
    <?php if(isset($_SESSION['user_is_bronze'])) :?>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#appointment-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-arrow-in-right"></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="appointment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?=ROOT_URL?>appointment.php">
            <i class="bi bi-circle"></i><span>Make Appointment</span>
          </a>
        </li>
        <li>
          <a href="view-appointment.php">
            <i class="bi bi-circle"></i><span>View Appointment</span>
          </a>
        </li>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Appointment Nav -->
    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Registration</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="patient-registration.php">
            <i class="bi bi-circle"></i><span>Register Here</span>
          </a>
        </li>
        <li>
          <a href="manage-patients.php">
            <i class="bi bi-circle"></i><span>Manage Form</span>
          </a>
        </li>
        <li>
          <a href="NHIS.php">
            <i class="bi bi-circle"></i><span>NHIS Registration</span>
          </a>
        </li>
      </ul>
    </li><!-- End patients Nav -->
    <?php endif ?>
    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#store-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-cart"></i><span>Our Products</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="store-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="manage-products.php">
            <i class="bi bi-circle"></i><span>View Products</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End store Nav -->
    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#pharmacy-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-earmark-medical"></i><span>Pharmacy</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="pharmacy-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="manage-pharmaceuticals.php">
            <i class="bi bi-circle"></i><span>View Pharmaceuticals</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Pharmacy Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT_URL?>privacy-policy.php">
        <i class="bi bi-people"></i>
        <span>Privacy Policy</span>
      </a>
    </li><!-- End Team Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT_URL?>services.php">
        <i class="bi bi-layers"></i>
        <span>Our Services</span>
      </a>
    </li><!-- End Services Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT_URL?>pricing.php">
        <i class="bi bi-cash-coin"></i>
        <span>Pricing</span>
      </a>
    </li><!-- End pricing Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-faq.php">
        <i class="bi bi-question-circle"></i>
        <span>Help</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-contact.php">
        <i class="bi bi-envelope"></i>
        <span>Feedback</span>
      </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="#">
        <i class="bi bi-arrow-counterclockwise"></i>
        <span>Visit NHIS</span>
      </a>
    </li><!-- End History Page Nav -->

  </ul>

</aside><!-- End Sidebar-->
