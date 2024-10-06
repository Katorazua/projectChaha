<?php 
include '../partials/dashboardheader.php';
?>

  <!-- ======= Sidebar ======= -->
<?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Chaha Eye Hospital</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT_URL?>index.php">Home</a></li>
          <li class="breadcrumb-item active">Admin Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- In Patients Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM patients WHERE pat_type = 'In-patient' ");
                $stmt->execute();
                $stmt->bind_result($inpatient);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">In Patients <span>| Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-down"></i>
                    <!-- person-down -->
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $inpatient;?></h6>
                    <span class="text-success small pt-1 fw-bold">80%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End In Patients section Card -->

          <!-- Out Patients Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM patients WHERE pat_type = 'Out-pateint' ");
                $stmt->execute();
                $stmt->bind_result($outpatient);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">Out Patients <span>| Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-up"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $outpatient;?></h6>
                    <span class="text-success small pt-1 fw-bold">30%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Out Patients section Card -->

          <!-- Patients Transfer Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM patient_transfer ");
                $stmt->execute();
                $stmt->bind_result($patient_transfer);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">Patients Transfer <span>| Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-bus-front"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $patient_transfer ?></h6>
                    <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Patients Transfer section Card -->

          <!-- Total Patients Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM patients ");
                $stmt->execute();
                $stmt->bind_result($patient_total);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">Total Patients <span>| Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $patient_total?></h6>
                    <span class="text-success small pt-1 fw-bold">99.9%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Total Patients section Card -->

          <!-- Appointment section Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM appointments ");
                $stmt->execute();
                $stmt->bind_result($appointments);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">Appointment <span>| This Year</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-activity"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $appointments?></h6>
                    <span class="text-success small pt-1 fw-bold">30.99%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Appointment section Card --> 

          <!-- Nurses section Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM employees WHERE role = 'Nurse' ");
                $stmt->execute();
                $stmt->bind_result($Nurses);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">Nurses <span>| This Year</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-plus"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $Nurses?></h6>
                    <span class="text-success small pt-1 fw-bold">40%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Nurses section Card --> 

          <!-- Doctors Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM doctors WHERE role = 'Medical_Doctor' ");
                $stmt->execute();
                $stmt->bind_result($doctors);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">Doctors <span>| This Year</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $doctors?></h6>
                    <span class="text-success small pt-1 fw-bold">70%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Doctors Card --> 

          <!-- Consultants Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM doctors WHERE role = 'Consultant' ");
                $stmt->execute();
                $stmt->bind_result($Consultants);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">Consultants <span>| This Year</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-text"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $Consultants?></h6>
                    <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Consultants Card --> 

          <!-- Vendors Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php
                $stmt = $connection->prepare("SELECT count(*) FROM vendor ");
                $stmt->execute();
                $stmt->bind_result($vendor);
                $stmt->fetch();
                $stmt->close();
              ?>
              <div class="card-body">
                <h5 class="card-title">Vendors <span>| This Year</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-tags"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $vendor?></h6>
                    <span class="text-success small pt-1 fw-bold">89.99%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Vendors Card --> 
        </div>

        <!-- Health Management System sections -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Health Insurans Schem <span>| Today</span></h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">Ext.</th>
                    <th scope="col">HIS</th>
                    <th scope="col">Productivity</th>
                    <th scope="col">Subjected</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><a href="#">#24/7</a></th>
                    <td>NHIS</td>
                    <td><a href="#" class="text-primary">Caring for better life, With demand skills in Tech and science</a></td>
                    <td>Fedral Support</td>
                    <td><span class="badge bg-success">Approved</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">#24/7</a></th>
                    <td>MIS</td>
                    <td><a href="#" class="text-primary">Leading the way in medical excellence</a></td>
                    <td>Hospital Management System</td>
                    <td><span class="badge bg-success">Approved</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">#24/7</a></th>
                    <td>Vendors</td>
                    <td><a href="#" class="text-primary">Business</a></td>
                    <td>Profesional</td>
                    <td><span class="badge bg-success">Approved</span></td>
                  </tr> 
                  
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Health Management System sections -->
      </div><!-- End Right side columns -->
    </section>

  </main><!-- End #main -->
<?php include '../partials/dashboardfooter.php'; ?>