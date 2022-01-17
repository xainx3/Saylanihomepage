<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li> 
       <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <ul class="navbar-nav ml-auto">



      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="images/favicon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8">
      <span class="brand-text font-weight-light">CNCD | LIMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php  echo $_SESSION['dp'];  ?>" class="img-circle elevation-1" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php  echo $_SESSION['name'];  ?></a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php if ($thispage == 'serum' || $thispage == 'dashboard' || $thispage == 'patd' || $thispage=='report' || $thispage=='sampled' || $thispage=='urine'   ) {echo  "active"; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
        
          </li>

          <!-- <li class="nav-item">
            <a href="sample.php" class="nav-link <?php if ($thispage == 'sample') {echo  "active"; } ?>">
              <i class=" nav-icon fas fa-vial"></i>
              <p>
               Sample Registration
              </p>
            </a>
          </li> -->


                <li class="nav-item">
            <a href="Participants.php" class="nav-link <?php if ($thispage == 'parti') {echo  "active"; } ?>">
              <i class=" nav-icon fas fa-vial"></i>
              <p>
              Participant's Registration
              </p>
            </a>
          </li>
    <?php      if($_SESSION['role']!="DE"){

?>
         <!-- <li class="nav-item  <?php if ($thispage == 'departs' || $thispage == 'haema' || $thispage == 'mole' || $thispage == 'bio' ) {echo  "menu-is-opening menu-open"; } ?>">
            <a href="#" class="nav-link <?php if ($thispage == 'departs' || $thispage == 'haema' || $thispage == 'mole' || $thispage == 'bio' ) {echo  "active"; } ?>">
            <i class="nav-icon far fa-building"></i></i>
              <p>
                Departments
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: <?php if ($thispage == 'departs' || $thispage == 'haema' || $thispage == 'mole' || $thispage == 'bio' ) {echo  "block"; } else{ echo "none";} ?>;">
              <li class="nav-item">
                <a href="haematology.php" class="nav-link <?php if ($thispage == 'haema') {echo  "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Haematology</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="molecular.php" class="nav-link <?php if ($thispage == 'mole') {echo  "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Molecular</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="biochemistry.php" class="nav-link <?php if ($thispage == 'bio') {echo  "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bio-Chemistry</p>
                </a>
              </li>
            </ul>
          </li> -->

          <li class="nav-item">
            <a href="storage.php" class="nav-link <?php if ($thispage == 'storage' ) {echo  "active"; } ?>">
            <i class="nav-icon far fa-snowflake"></i>
              <p>
                Manage Storage
              </p>
            </a>        
          </li>

          <?php
    }

    ?>



          <li class="nav-item <?php if ($thispage == 'profile' || $thispage == 'updatep' || $thispage == 'cpass') {echo  "menu-is-opening menu-open"; } ?>">
            <a href="" class="nav-link <?php if ($thispage == 'profile' || $thispage == 'updatep' || $thispage == 'cpass') {echo  "active"; } ?>">
            <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="<?php if ($thispage == 'profile' || $thispage == 'updatep' || $thispage == 'cpass') {echo  "block"; } else{ echo "none";} ?>">
              <li class="nav-item">
                <a href="updatep.php" class="nav-link <?php if ($thispage == 'updatep') {echo  "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cpassword.php" class="nav-link <?php if ($thispage == 'cpass') {echo  "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            
            </ul>

          </li>

          <li class="nav-item">
            <a href="logout.php" class="nav-link ">
            <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
        
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
