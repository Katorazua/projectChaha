
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
        <i class="bi bi-box-arrow-in-right"></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="appointment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
          <a href="discharge-patient.php">
            <i class="bi bi-circle"></i><span>Discharge Patient</span>
          </a>
        </li>
        <li>
          <a href="patient-transfer.php">
            <i class="bi bi-circle"></i><span>Patient Transfers</i>
          </a>
        </li>
      </ul>
    </li><!-- End patients Nav -->

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

    <li class="nav-item">
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
    </li>
    <!-- End Medicals Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#lab-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-thermometer-half"></i><span>Laboratory</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="lab-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
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
        </li>
      </ul>
    </li>
    <!-- End surgical Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#payrolls-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layers"></i><span>Payrolls</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="payrolls-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="view-payroll.php">
            <i class="bi bi-circle"></i><span>My Payroll</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End payrolls Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#store-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-cart"></i><span>Store/Shop</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="store-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="view-products.php">
            <i class="bi bi-circle"></i><span>View Products</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End store Nav -->

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
