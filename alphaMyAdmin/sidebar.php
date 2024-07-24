
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
      <a class="nav-link collapsed" data-bs-target="#appointment-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-arrow-in-right"></i><span>Appointments</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="appointment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">       
        <li>
          <a href="set-appointment.php">
            <i class="bi bi-circle"></i><span>Assign Doctor</span>
          </a>
        </li>        
        <li>
          <a href="manage-appointments.php">
            <i class="bi bi-circle"></i><span>Manage Appointments</span>
          </a>
        </li>        
        <li>
          <a href="view-appointments.php">
            <i class="bi bi-circle"></i><span>View Appointments</span>
          </a>
        </li>        
      </ul>
    </li><!-- End Appointment Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="manage-categories.php">
            <i class="bi bi-circle"></i><span>Event Categories</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-events.php">
            <i class="bi bi-circle"></i><span>Manage Events</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-services.php">
            <i class="bi bi-circle"></i><span>Manage Services</span>
          </a>
        </li>       
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-sessions.php">
            <i class="bi bi-circle"></i><span>Manage Sessions</span>
          </a>
        </li>        
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-testimonials.php">
            <i class="bi bi-circle"></i><span>Manage testimonials</span>
          </a>
        </li>        
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-departments.php">
            <i class="bi bi-circle"></i><span>Manage departments</span>
          </a>
        </li>        
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="<?=ROOT_URL?>alphaMyAdmin/#">
        <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/add-user.php">
            <i class="bi bi-circle"></i><span>Add user</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-users.php">
            <i class="bi bi-circle"></i><span>Manage users</span>
          </a>
        </li>
      </ul>
    </li><!-- End patients Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="<?=ROOT_URL?>alphaMyAdmin/#">
        <i class="bi bi-journal-text"></i><span>Patients</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/add-patient.php">
            <i class="bi bi-circle"></i><span>Register Patients</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-patients.php">
            <i class="bi bi-circle"></i><span>Manage Patients</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/patient-transfer.php">
            <i class="bi bi-circle"></i><span>Patient Transfers</i>
          </a>
        </li>
      </ul>
    </li><!-- End patients Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#doctor-nav" data-bs-toggle="collapse" href="<?=ROOT_URL?>alphaMyAdmin/#">
        <i class="bi bi-person-check"></i><span>Doctors</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="doctor-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/add-doctor.php">
            <i class="bi bi-circle"></i><span>Add Doctor</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-doctors.php">
            <i class="bi bi-circle"></i><span>Manage Doctor</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/assign-patient.php">
            <i class="bi bi-circle"></i><span>Assign Patient</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/assign-department.php">
            <i class="bi bi-circle"></i><span>Assign department</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/doctor-transfer.php">
            <i class="bi bi-circle"></i><span>Transfers Doctor</i>
          </a>
        </li>
      </ul>
    </li><!-- End doctor Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="<?=ROOT_URL?>alphaMyAdmin/#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Admins</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/add-admin.php">
            <i class="bi bi-circle"></i><span>Add Admin</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-admins.php">
            <i class="bi bi-circle"></i><span>Manage Admin</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Admins Nav -->

    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#store-nav" data-bs-toggle="collapse" href="<?=ROOT_URL?>alphaMyAdmin/#">
        <i class="bi bi-cart"></i><span>Store/Shop</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="store-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/add-product.php">
            <i class="bi bi-circle"></i><span>Add Product</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-products.php">
            <i class="bi bi-circle"></i><span>Manage Products</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-pro-cat.php">
            <i class="bi bi-circle"></i><span>Manage Products Category</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End store Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#vendors-nav" data-bs-toggle="collapse" href="<?=ROOT_URL?>alphaMyAdmin/#">
        <i class="bi bi-tags"></i><span>Vendors</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="vendors-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/add-vendor.php">
            <i class="bi bi-circle"></i><span>Add Vendor</span>
          </a>
        </li>
        <li>
          <a href="<?=ROOT_URL?>alphaMyAdmin/manage-vendor.php">
            <i class="bi bi-circle"></i><span>Manage Vendor</span>
          </a>
        </li>
          </a>
        </li>
      </ul>
    </li>
    <!-- End vendors Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT_URL?>alphaMyAdmin/users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT_URL?>alphaMyAdmin/pages-contact.php">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT_URL?>alphaMyAdmin/history.php">
        <i class="bi bi-arrow-counterclockwise"></i>
        <span>History</span>
      </a>
    </li><!-- End History Page Nav -->

  </ul>

</aside><!-- End Sidebar-->
