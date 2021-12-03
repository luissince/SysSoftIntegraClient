<?php
session_start();
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
if (!isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "login.php";</script>';
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include './layout/head.php'; ?>
    </head>

    <body class="app sidebar-mini">
        <!-- Navbar-->
        <?php include "./layout/header.php"; ?>
        <!-- Sidebar menu-->
        <?php include "./layout/menu.php"; ?>

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-desktop"></i> Tienda Virtual <small>Configurar</small></h1>
            </div>

            <div class="tile">

                <div class="row">
                    <div class="col-lg-6">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">URL</label>
                                <input class="form-control" type="text" name="url" value="<?= $uri ?>" placeholder="<?= $uri ?>">
                                <small class="form-text text-muted" id="emailHelp">Dirección web donde se va poder vizualizar su pagina</small>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="tile-footer">
                    <a href="<?= $uri ?>" target="_blank" class="btn btn-primary">Abrir</a>
                </div>
            </div>

        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
    </body>

    </html>

<?php

}
