<?php
session_start();
$title_page = "Dashboard";
if (!isset($_SESSION['IdEmpleado'])) {
  echo '<script>location.href = "./login.php";</script>';
} else {
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php include './layout/head.php'; ?>
  </head>

  <body class="app sidebar-mini">
    <!-- Navbar-->
    <?php include("./layout/header.php"); ?>
    <!-- Sidebar menu-->
    <?php include("./layout/menu.php"); ?>
    <main class="app-content">

      <div class="app-title">
        <div>
          <h1><i class="fa fa-smile-o"></i> Bienvenido a SysSoft Integra</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
      </div>

      <div class="tile mb-4 pt-xl-3 pb-xl-3 pl-xl-5">
        <div class="row">
          <div class="col-lg-12">
            <label for="f-inicio">Bienvenido al Sistema de SysSoft Integra, donde podrá realizar operaciones de venta, compras, cartera de cliente, gastos entre otras funcionalidades para llevar a cabo una mejor administración de su negocio.</label>
          </div>
        </div>

      </div>

    </main>
    <!-- Essential javascripts for application to work-->
    <?php include "./layout/footer.php"; ?>
    <script src="./js/notificaciones.js"></script>
  </body>

  </html>

<?php
}
