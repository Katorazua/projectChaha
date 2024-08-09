<?php include '../partials/usersheader.php'; ?>


  <!-- ======= Sidebar ======= -->
  <?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Chaha Eye Hospital</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT_URL?>index.php">Home</a></li>
          <li class="breadcrumb-item active">User's Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">Today</a></li>
                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">This Month</a></li>
                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Silver <span>| Users</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-check-lg"></i>
                    </div>
                    <div class="ps-3">
                    <h6>**** **** ****</h6>
                      <span class="text-success small pt-1 fw-bold">100%</span> <span class="text-muted small pt-2 ps-1">Available</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
            
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">Today</a></li>
                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">This Month</a></li>
                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Diamond <span>| Users</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-diamond-half"></i>
                    </div>
                    <div class="ps-3">
                      <h6>**** **** ****</h6>
                      <span class="text-success small pt-1 fw-bold">100%</span> <span class="text-muted small pt-2 ps-1">Available</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">Today</a></li>
                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">This Month</a></li>
                    <li><a class="dropdown-item" href="<?=ROOT_URL?>pricing.php">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Gold <span>| Users</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-circle-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>**** **** ****</h6>
                      <span class="text-success small pt-1 fw-bold">100%</span> <span class="text-muted small pt-2 ps-1">Available</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

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
  
  <!-- ======= Footer ======= -->
<?php include '../partials/dashboardfooter.php'; ?>