    <header class="main-header">
      <?php $user = $this->session->userdata('logged_in');?>
      <!-- Logo -->
      <a href="<?= site_url('dashboard/dashboard'); ?>" class="logo">
        <span class="logo-mini"><b>S</b>PI</span>
        <span class="logo-lg"><b>Sistema</b>PAÑOL</span>
      </a>
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('resources/images/system/Logo.png') ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $user['nombres'] ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?= base_url('resources/images/system/Logo.png') ?>" class="img-circle" alt="User Image">
                  <p>
                    <?= $user['carrera'] ?>
                    <small><?= $user['correo'] ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?= site_url('/Login/logout'); ?>" class="btn btn-danger btn-flat">Cerrar sesión</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
