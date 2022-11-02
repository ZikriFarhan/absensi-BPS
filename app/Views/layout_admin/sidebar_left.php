<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url() ?>/template/adminlte/img/BPSicon2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Absensi PKL</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>/template/adminlte/img/2042_crop.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
                <a href="<?php echo base_url('home/index') ?>" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('pesertamagang') ?>" class="nav-link ">
                  <i class="far fa fa-users nav-icon"></i> 
                  <p>Daftar Intern</p> 
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('bidang') ?>" class="nav-link ">
                  <i class="fas fa-building nav-icon"></i>
                  <p>Daftar Bidang</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
                <a href="<?php echo base_url('kartuabsen') ?>" class="nav-link">
                  <i class="nav-icon fas fa-qrcode"></i>
                    <p>Ambil Kode QR</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="<?php echo base_url('scan') ?>" class="nav-link">
                  <i class="nav-icon fa fa-search-plus"></i>
                    <p>Scan QR</p>
                </a>
          </li>
              <li class="nav-item">
                <a href="<?php echo base_url('presensi/index') ?>" class="nav-link">
                  <i class="far fa fa-history nav-icon"></i> 
                  <p>Histori Absensi</p> 
                </a>
              </li>
          <li class="nav-item"><b>
                <a href="#" class="nav-link text-danger">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Keluar</p>
                </a>
                </b>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
            
          <!-- v.home -->
        
