<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo BASE_URL ?>assets/images/OPG Farm Logo2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">OPG Farm</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo BASE_URL ?>assets/images/3607444.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['u_name']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="<?php echo BASE_URL ?>dashboard/index.php" class="nav-link <?php if($_SESSION['active'] == 'home'){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL ?>user/index.php" class="nav-link <?php if($_SESSION['active'] == 'user'){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL ?>projects/index.php" class="nav-link <?php if($_SESSION['active'] == 'project'){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-tractor"></i>
              <p>
                Farm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL ?>scope/index.php" class="nav-link <?php if($_SESSION['active'] == 'scope'){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Scoping
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL ?>expenditure/index.php" class="nav-link <?php if($_SESSION['active'] == 'expenditure'){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-dollar"></i>
              <p>
                Expenditure
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL ?>reports/index.php" class="nav-link <?php if($_SESSION['active'] == 'reports'){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL ?>logout.php" class="nav-link <?php if($_SESSION['active'] == 'logout'){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-right-from-bracket"></i>
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