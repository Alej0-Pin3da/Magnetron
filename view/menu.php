<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../public/dist/img/MagnetronLogo.png" alt="Magnetron Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MAGNETRON</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../public/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">John Doe</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="../view" class="nav-link" id="link-inicio">
              <i class="nav-icon fa-solid fa-house"></i>
              <p>Inicio</p>
            </a>
          </li>
          <!-- Menu Productos -->
          <li class="nav-item" id="menu-productos">
            <a href="#" class="nav-link" id="link-productos">
              <i class="nav-icon fas fa-duotone fa-toolbox"></i>
              <p>Productos<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" id="submenu-list">
              <li class="nav-item">
                <a href="../view/producto.php" class="nav-link" id="link-administrar-productos">
                  <i class="nav-icon fa-solid fa-gears"></i>
                  <p>Administrar Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../view/productoCantidad.php" class="nav-link" id="link-cantidad-facturada">
                  <i class="nav-icon fa-solid fa-chart-simple"></i>
                  <p>Cantidad Facturada</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../view/productoUtilidad.php" class="nav-link" id="link-utilidad">
                  <i class="nav-icon fa-solid fa-dollar-sign"></i>
                  <p>Utilidad Generada</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../view/productoGanancia.php" class="nav-link" id="link-margen-ganancia">
                  <i class="nav-icon fa-solid fa-percent"></i>
                  <p>Margen de Ganancia</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Menu Personas -->
          <li class="nav-item" id="menu-personas">
            <a href="#" class="nav-link" id="link-personas">
              <i class="nav-icon fa-solid fa-users"></i>
              <p>Personas<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../view/persona.php" class="nav-link" id="link-administrar-personas">
                  <i class="nav-icon fa-solid fa-user-gear"></i>
                  <p>Administrar Personas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link" id="link-total-facturado">
                  <i class="nav-icon fa-solid fa-arrows-up-to-line"></i>
                  <p>Total facturado</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link" id="link-producto-mas-caro">
                  <i class="nav-icon fa-brands fa-web-awesome"></i>
                  <p>Producto Mas Caro</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
