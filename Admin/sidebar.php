
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
          <a href="manage-events.php">
            <i class="bi bi-circle"></i><span>Manage Events</span>
          </a>
        </li>
        <li>
          <a href="manage-services.php">
            <i class="bi bi-circle"></i><span>Manage Services</span>
          </a>
        </li>        
        <li>
          <a href="manage-testimonials.php">
            <i class="bi bi-circle"></i><span>Manage testimonials</span>
          </a>
        </li>        
        <li>
          <a href="manage-departments.php">
            <i class="bi bi-circle"></i><span>Manage departments</span>
          </a>
        </li>        
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="add-user.php">
            <i class="bi bi-circle"></i><span>Add user</span>
          </a>
        </li>
        <li>
          <a href="manage-users.php">
            <i class="bi bi-circle"></i><span>Manage users</span>
          </a>
        </li>
      </ul>
    </li><!-- End patients Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Patients</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="add-patient.php">
            <i class="bi bi-circle"></i><span>Register Patients</span>
          </a>
        </li>
        <li>
          <a href="manage-patients.php">
            <i class="bi bi-circle"></i><span>Manage Patients</span>
          </a>
        </li>
        <li>
          <a href="assign-patient.php">
            <i class="bi bi-circle"></i><span>Assign Patient</span>
          </a>
        </li>
        <!-- <li>
          <a href="discharge-patient.php">
            <i class="bi bi-circle"></i><span>Discharge Patient</span>
          </a>
        </li>
        <li>
          <a href="patient-transfer.php">
            <i class="bi bi-circle"></i><span>Patient Transfers</i>
          </a>
        </li> -->
      </ul>
    </li><!-- End patients Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#doctor-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person-check"></i><span>Doctors</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="doctor-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">         
        <li>
          <a href="add-doctor.php">
            <i class="bi bi-circle"></i><span>Add Doctor</span>
          </a>
        </li>
        <li>
          <a href="manage-doctors.php">
            <i class="bi bi-circle"></i><span>Manage Doctor</span>
          </a>
        </li>
        <li>
          <a href="assign-patient.php">
            <i class="bi bi-circle"></i><span>Assign Patient</span>
          </a>
        </li>
        <li>
          <a href="assign-department.php">
            <i class="bi bi-circle"></i><span>Assign department</span>
          </a>
        </li>
        <li>
          <a href="doctor-transfer.php">
            <i class="bi bi-circle"></i><span>Transfers Doctor</i>
          </a>
        </li>
      </ul>
    </li> -->
    <!-- End doctor Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Employees</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-employee.php">
            <i class="bi bi-circle"></i><span>Add Employee</span>
          </a>
        </li>
        <li>
          <a href="manage-employee.php">
            <i class="bi bi-circle"></i><span>Manage Employee</span>
          </a>
        </li>
        <li>
          <a href="transfer-employee.php">
            <i class="bi bi-circle"></i><span>Transfer Employee</span>
          </a>
        </li>
      </ul>
    </li> -->
    <!-- End Employees Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#pharmacy-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-earmark-medical"></i><span>Pharmacy</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="pharmacy-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-pharm-category.php">
            <i class="bi bi-circle"></i><span>Add Pharm Category</span>
          </a>
        </li>
        <li>
          <a href="manage-pharm-category.php">
            <i class="bi bi-circle"></i><span>Manage Pharm Category</span>
          </a>
        </li>
        <div style="margin-top: 1rem;"></div>
        <li>
          <a href="add-pharmaceuticals.php">
            <i class="bi bi-circle"></i><span>Add Pharmaceuticals</span>
          </a>
        </li>
        <li>
          <a href="manage-pharmaceuticals.php">
            <i class="bi bi-circle"></i><span>Manage Pharmaceuticals</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Pharmacy Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#accounting-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-credit-card"></i><span>Accounting</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="accounting-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-acc-payable.php">
            <i class="bi bi-circle"></i><span>Add Acc Payable</span>
          </a>
        </li>
        <li>
          <a href="manage-acc-payable.php">
            <i class="bi bi-circle"></i><span>Manage Acc Payable</span>
          </a>
        </li>
        <div style="margin-top: 1rem;"></div>
        <li>
          <a href="add-acc-receivable.php">
            <i class="bi bi-circle"></i><span>Add Acc Receivable</span>
          </a>
        </li>
        <li>
          <a href="manage-acc-receivable.php">
            <i class="bi bi-circle"></i><span>Manage Acc Receivable</span>
          </a>
        </li>
      </ul>
    </li>
     ================================== UNCOMMENT FOR FUTURE UPGRADE ==========================================-->
    <!-- End Accounting Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#medicals-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-save"></i><span>Medical Records</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="medicals-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-medical-record.php">
            <i class="bi bi-circle"></i><span>Add Medical Record</span>
          </a>
        </li>
        <li>
          <a href="manage-medical-record.php">
            <i class="bi bi-circle"></i><span>Manage Medical Record</span>
          </a>
        </li>
      </ul>
    </li> -->
    <!-- End Medicals Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#lab-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-thermometer-half"></i><span>Laboratory</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="lab-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <!-- <li>
          <a href="patient-lab-test.php">
            <i class="bi bi-circle"></i><span>Patient Lab Tests</span>
          </a>
        </li>
        <li>
          <a href="patient-lab-result.php">
            <i class="bi bi-circle"></i><span>Patient Lab Results</span>
          </a>
        </li>
        <li>
          <a href="lab-report.php">
            <i class="bi bi-circle"></i><span>Lab Report</span>
          </a>
        </li> -->
        <li>
          <a href="add-lab-equipment.php">
            <i class="bi bi-circle"></i><span>Add Lab Equipment</span>
          </a>
        </li>
        <li>
          <a href="manage-lab-equipments.php">
            <i class="bi bi-circle"></i><span>Manage Lab Equipment</span>
          </a>
        </li>
        <li>
          <a href="lab-report.php">
            <i class="bi bi-circle"></i><span>Lab Report</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End lab Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#surgical-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-compass"></i><span>Surgical/Theatre</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="surgical-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-lab-equipment.php">
            <i class="bi bi-circle"></i><span>Add Equipment</span>
          </a>
        </li>
        <li>
          <a href="manage-lab-equipments.php">
            <i class="bi bi-circle"></i><span>Manage Equipments</span>
          </a>
        </li>
        <!-- <div style="margin-top: 1rem;"></div>
        <li>
          <a href="add-pat-surgery.php">
            <i class="bi bi-circle"></i><span>Add Patient</span>
          </a>
        </li>
        <li>
          <a href="manage-pat-surgery.php">
            <i class="bi bi-circle"></i><span>Manage Patients</span>
          </a>
        </li>
        <li>
          <a href="surgery-record.php">
            <i class="bi bi-circle"></i><span>Surgery Records</span>
          </a>
        </li> -->
      </ul>
    </li>
    <!-- End surgical Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#payrolls-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layers"></i><span>Payrolls</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="payrolls-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-payroll.php">
            <i class="bi bi-circle"></i><span>Add Payroll</span>
          </a>
        </li>
        <li>
          <a href="manage-payroll.php">
            <i class="bi bi-circle"></i><span>Manage Payrolls</span>
          </a>
        </li>
      </ul>
    </li> -->
    <!-- End payrolls Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#store-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-cart"></i><span>Store/Shop</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="store-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-product.php">
            <i class="bi bi-circle"></i><span>Add Product</span>
          </a>
        </li>
        <li>
          <a href="manage-products.php">
            <i class="bi bi-circle"></i><span>Manage Products</span>
          </a>
        </li>
        <li>
          <a href="manage-pro-cat.php">
            <i class="bi bi-circle"></i><span>Manage Products Category</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End store Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#vendors-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-tags"></i><span>Vendors</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="vendors-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="add-vendor.php">
            <i class="bi bi-circle"></i><span>Add Vendor</span>
          </a>
        </li>
        <li>
          <a href="manage-vendor.php">
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
      <a class="nav-link collapsed" href="users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-faq.php">
        <i class="bi bi-question-circle"></i>
        <span>Help</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-contact.php">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="history.php">
        <i class="bi bi-arrow-counterclockwise"></i>
        <span>History</span>
      </a>
    </li><!-- End History Page Nav -->

  </ul>

</aside><!-- End Sidebar-->
