<?php
$lasturl ="q1w2e3r4t5y6u7i8o9";
$uri = $_SERVER["REQUEST_URI"];
$rest = substr($uri, -1);
if ($rest == "/") $uri = substr ($uri, 0, strlen($uri) - 1);
$spliturl = explode("/", $uri);
$lasturl = array_pop($spliturl);
?>
<aside class="main-sidebar">
  <?php $user = $this->session->userdata('logged_in');?>
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= base_url('resources/images/system/Logo.png') ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= $user['nombres'] ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
          </div>
        </div>

      <ul class="sidebar-menu">
        <li class="header">MENÚ DE NAVEGACIÓN</li>


        <li class="treeview">
          <a href="<?=site_url('dashboard/dashboard')?>">
            <i class="fa fa-dashboard"></i> <span>Panel de control</span>
          </a>
        </li>


        <!-- ESTE INF QUE ESTA DENTRO DE LA CLASE PRINCIPAL LI , DEJA ABIERTO EL LI AL CUAL PERTENECE LA VISTA, PARA INTEGRARLO EN OTROS DEBEN COPIAR TODA LA ETIQUETA PHP Y DENTRO SOLO EDITAR LAS VISTAS QUE CONTIENE ESE LI -->
        <li  class="treeview
        <?php if (strpos(",ingreso,iPanol,entregamanual,recepcion,baja,entregadigital,codigos", $lasturl)): ?> active <?php endif ?>">
          <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>Gestión</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=site_url('gestion/entregadigital')?>"><i class="fa fa-bolt"></i>Gestion Digital</a></li>
            <li><a href="<?=site_url('gestion/entregamanual')?>"><i class="fa fa-handshake-o"></i>Gestion Manual</a></li>
            <li><a href="<?=site_url('gestion/ingreso')?>"><i class="fa fa-arrow-up"></i>Ingreso Stock</a></li>
            <li><a href="<?=site_url('gestion/baja')?>"><i class="fa fa-arrow-down"></i>Dar baja</a></li>
            <li><a href="<?=site_url('gestion/recepcion')?>"><i class="fa fa-sign-in"></i>Recepcionar</a></li>
            <li><a href="<?=site_url('gestion/codigos')?>"><i class="fa fa-barcode"></i>Códigos de barra</a></li>
          </ul>
        </li>


        <li class="treeview <?php if (strpos(",usuarios,productos,categorias,asignaturas,motivos,proveedores,inventario", $lasturl)): ?> active <?php endif ?>">
          <a href="#">
            <i class="fa fa-industry"></i>
            <span>Mantenedores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=site_url('mantencion/usuarios')?>"><i class="fa fa-users"></i></i>Usuarios</a></li>
            <li><a href="<?=site_url('mantencion/productos')?>"><i class="fa fa-tag"></i></i>Productos</a></li>
            <li><a href="<?=site_url('mantencion/categorias')?>"><i class="fa fa-tags"></i>Categorías</a></li>
            <li><a href="<?=site_url('mantencion/asignaturas')?>"><i class="fa fa-file-text"></i></i>Asignatura</a></li>
            <li><a href="<?=site_url('mantencion/motivos')?>"><i class="fa fa-tasks"></i></i>Motivos</a></li>
            <li><a href="<?=site_url('mantencion/proveedores')?>"><i class="fa fa-address-card"></i></i>Proveedores</a></li>
            <li><a href="<?=site_url('mantencion/inventario')?>"><i class="fa fa-server"></i></i>Inventario</a></li>

          </ul>
        </li>


      <li class="treeview <?php if (strpos(",stockcritico,stockactual,motivosbaja,vidautil", $lasturl)): ?> active <?php endif ?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?=site_url('Reportes/Vistastockcritico')?>"><i class="fa fa-circle-o"></i> Stock critico</a></li>
           <li><a href="<?=site_url('Reportes/Vistastockactual')?>"><i class="fa fa-circle-o"></i> Stock actual</a></li>
           <li><a href="<?=site_url('Reportes/Vistamotivosbaja')?>"><i class="fa fa-circle-o"></i> Motivos de baja a los productos</a>
           </li>
           <li><a href="<?=site_url('Reportes/Vistavidautil')?>"><i class="fa fa-circle-o"></i> Vida util de los productos</a></li>
          </ul>
        </li>

      </ul>
    </section>
  </aside>


  <!-- MENSAJES DE OPERACIONES -->
    <div class="col-md-6 pull-right">
      <br>
      <div class="messages">
        <?php if (isset($_SESSION['Deshabilitar'])): ?>
          <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i><?= $user['nombres'] ?></h4>
              <?= $_SESSION['Deshabilitar'];?>
          </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['Habilitar'])): ?>
          <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i><?= $user['nombres'] ?></h4>
              <?= $_SESSION['Habilitar'];?>
          </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['Observacion'])): ?>
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i><?= $user['nombres'] ?></h4>
              <?= $_SESSION['Observacion'];?>
          </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['Baja'])): ?>
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i><?= $user['nombres'] ?></h4>
              <?= $_SESSION['Baja'];?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <!-- FIN DE MENSAJES DE OPERACIONES -->
