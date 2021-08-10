    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
      <span class="brand-text font-weight-light"><?=__site_title?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $obj->base_url(); ?>assets/theme_assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block"><?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?></a>
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
          <li class="nav-item">
            <a href="<?php echo $obj->base_url('dashboard'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $obj->base_url('course-management'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                 Course Management &nbsp;
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $obj->base_url('manage-subject'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                 Subject Management &nbsp;
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>