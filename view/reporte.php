<?php
session_start();
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
        <!--  -->
        <?php include "./layout/reporte/modalVentaLibre.php"; ?>
        <!--  -->
        <?php include "./layout/reporte/modalVentaPos.php"; ?>
        <!--  -->
        <?php include "./layout/reporte/modalFacturados.php"; ?>
        <!--  -->
        <!--  -->
        <?php include "./layout/reporte/modalngresoEgreso.php"; ?>
        <!--  -->
        <!-- modal generar excel nota credito-->
        <div class="row">
            <div class="modal fade" id="mdAlertNotaCredito" data-backdrop="static">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-file-excel">
                                </i> Generar Excel Nota de Crédito
                            </h4>
                            <button type="button" class="close" id="btnCloseNotaCredito">
                                <i class="fa fa-close"></i>
                            </button>

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Fecha de Inicio:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="date" id="txtFechaInicialNotaCredito" />
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Fecha de Fin:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="date" id="txtFechaFinalNotaCredito" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>¿Generar el excel?</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btnNotaCredito">
                                <i class="fa fa-check"></i> Generar</button>
                            <button type="button" class="btn btn-secondary" id="btnTxtNotaCredito">
                                <i class="fa fa-check"></i> Txt</button>
                            <button type="button" class="btn btn-danger" id="btnCancelarNotaCredito">
                                <i class="fa fa-remove"></i> Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal generar excel nota credito-->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Reporte <small>Opciones</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="btnFacturados">
                                <h5 class="card-title">Comprobantes</h5>
                                <div class="card-body">
                                    <img src="./images/sunat_logo.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Facturación SUNAT</div>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="btnVentaLibre">
                                <h5 class="card-title">Ope. Venta/Libre</h5>
                                <div class="card-body">
                                    <img src="./images/sales.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="btnVentaPos">
                                <h5 class="card-title">Ope. Venta/Pos</h5>
                                <div class="card-body">
                                    <img src="./images/caja_registradora.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="btnIngresosEgresos">
                                <h5 class="card-title">Ingresos/Egresos</h5>
                                <div class="card-body">
                                    <img src="./images/movimiento.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>

                    <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="">
                                <h5 class="card-title">Compras</h5>
                                <div class="card-body">
                                    <img src="./images/purchases.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div> -->
                </div>

                <!-- <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="">
                                <h5 class="card-title">Nota Credito</h5>
                                <div class="card-body">
                                    <img src="./images/note.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="">
                                <h5 class="card-title">Utilidades</h5>
                                <div class="card-body">
                                    <img src="./images/utilidad.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="">
                                <h5 class="card-title">Inventario</h5>
                                <div class="card-body">
                                    <img src="./images/almacen.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="">
                                <h5 class="card-title">Producción</h5>
                                <div class="card-body">
                                    <img src="./images/produccion.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="">
                                <h5 class="card-title">Resumen General</h5>
                                <div class="card-body">
                                    <img src="./images/sitio-web.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>
                </div> -->

                <!-- 

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <button class="btn btn-link" id="btnExcelVentas">
                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                <div class="card-body text-center">
                                    <img src="./images/reportglobal.png" alt="Vender" width="87">
                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                        Ventas Pos
                                    </p>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <button class="btn btn-link" id="btnExcelVentas">
                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                <div class="card-body text-center">
                                    <img src="./images/reportglobal.png" alt="Vender" width="87">
                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                        Utilidad
                                    </p>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <button class="btn btn-link" id="btnExcelNotaCredito">
                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                <div class="card-body text-center">
                                    <img src="./images/reportglobal.png" alt="Vender" width="87">
                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                        Nota Crédito
                                    </p>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <button class="btn btn-link" id="btnExcelVentas">
                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                <div class="card-body text-center">
                                    <img src="./images/reportglobal.png" alt="Vender" width="87">
                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                        Facturación
                                    </p>
                                </div>
                            </div>
                        </button>
                    </div> -->



            </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="js/notificaciones.js"></script>
        <script src="js/reporte/modalFacturados.js"></script>
        <script src="js/reporte/modalVentaLibre.js"></script>
        <script src="js/reporte/modalVentaPos.js"></script>
        <script src="js/reporte/modalngresoEgreso.js"></script>
        <script>
            let tools = new Tools();
            let modalFacturados = new ModalFacturados();
            let modalVentaLibre = new ModalVentaLibre();
            let modalVentaPos = new ModalVentaPos();
            let modalIngresoEgreso = new ModalngresoEgreso();

            $(document).ready(function() {

                // $("#txtFechaInicialNotaCredito").val(tools.getCurrentDate());
                // $("#txtFechaFinalNotaCredito").val(tools.getCurrentDate());

                // $("#btnExcelNotaCredito").click(function() {
                //     openExcelNotaCredito();
                // });

                // $("#btnExcelNotaCredito").keypress(function(event) {
                //     if (event.keyCode === 13) {
                //         openExcelNotaCredito();
                //     }
                //     event.preventDefault();
                // });

                modalFacturados.init();
                modalVentaLibre.init();
                modalVentaPos.init();
                modalIngresoEgreso.init();
            });
        </script>
    </body>

    </html>

<?php

}
