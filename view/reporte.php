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
        <!--  -->
        <?php include "./layout/reporte/modalVentaPos.php"; ?>
        <!--  -->

        <!-- modal generar excel ventas-->
        <div class="row">
            <div class="modal fade" id="mdAlertVentas" data-backdrop="static">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-file-excel">
                                </i> Generar Excel Ventas Sunat
                            </h4>
                            <button type="button" class="close" id="btnCloseVentas">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Fecha de Inicio:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="date" id="txtFechaInicialVenta" />
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Fecha de Fin:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="date" id="txtFechaFinalVenta" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <span>¿Generar el excel con todos los comprobante generados o solo los facturados?</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btnTodos">
                                <i class="fa fa-check"></i> Todos</button>
                            <button type="button" class="btn btn-success" id="btnFacturados">
                                <i class="fa fa-check"></i> Facturados</button>
                            <button type="button" class="btn btn-secondary" id="btnTxtVentas">
                                <i class="fa fa-check"></i> Txt</button>
                            <button type="button" class="btn btn-danger" id="btnCancelarVentas">
                                <i class="fa fa-remove"></i> Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal generar excel ventas-->

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
                            <button class="btn btn-link" id="">
                                <h5 class="card-title">Ingresos/Egresos</h5>
                                <div class="card-body">
                                    <img src="./images/movimiento.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card mb-3 card-default">
                            <button class="btn btn-link" id="">
                                <h5 class="card-title">Compras</h5>
                                <div class="card-body">
                                    <img src="./images/purchases.png" alt="Vender" width="54">
                                </div>
                                <div class="card-footer border-0">Documento</div>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">

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
                </div>

                <div class="row">
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
                </div>

                <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <button class="btn btn-link" id="btnExcelVentas">
                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                <div class="card-body text-center">
                                    <img src="./images/reportglobal.png" alt="Vender" width="87">
                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                        Ventas Libre
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
        <script src="js/reporte/modalVentaLibre.js?v=<?php echo (rand()); ?>"></script>
        <script src="js/reporte/ModalVentaPos.js?v=<?php echo (rand()); ?>"></script>
        <script>
            let tools = new Tools();
            let modalVentaLibre = new ModalVentaLibre();
            let modalVentaPos = new ModalVentaPos();

            $(document).ready(function() {

                // $("#txtFechaInicialVenta").val(tools.getCurrentDate());
                // $("#txtFechaFinalVenta").val(tools.getCurrentDate());

                // $("#txtFechaInicialNotaCredito").val(tools.getCurrentDate());
                // $("#txtFechaFinalNotaCredito").val(tools.getCurrentDate());

                // $("#btnExcelVentas").click(function() {
                //     openExcelVentas();
                // });

                // $("#btnExcelVentas").keypress(function(event) {
                //     if (event.keyCode === 13) {
                //         openExcelVentas();
                //     }
                //     event.preventDefault();
                // });

                // // 

                // $("#btnExcelNotaCredito").click(function() {
                //     openExcelNotaCredito();
                // });

                // $("#btnExcelNotaCredito").keypress(function(event) {
                //     if (event.keyCode === 13) {
                //         openExcelNotaCredito();
                //     }
                //     event.preventDefault();
                // });

                modalVentaLibre.init();
                modalVentaPos.init();
            });



            function openExcelVentas() {
                $("#mdAlertVentas").modal("show");
                $("#btnTodos").unbind();
                $("#btnTodos").bind("click", function() {
                    let fechaInicial = $("#txtFechaInicialVenta").val();
                    let fechaFinal = $("#txtFechaFinalVenta").val();
                    if (fechaInicial !== "" && fechaInicial !== undefined && fechaFinal !== "" && fechaFinal !== undefined) {
                        window.open("../app/sunat/excelventa.php?txtFechaInicial=" + fechaInicial + "&txtFechaFinal=" + fechaFinal + "&facturado=0", "_blank");
                        $("#mdAlertVentas").modal("hide");
                    }
                });

                $("#btnFacturados").unbind();
                $("#btnFacturados").bind("click", function() {
                    let fechaInicial = $("#txtFechaInicialVenta").val();
                    let fechaFinal = $("#txtFechaFinalVenta").val();
                    if (fechaInicial !== "" && fechaInicial !== undefined && fechaFinal !== "" && fechaFinal !== undefined) {
                        window.open("../app/sunat/excelventa.php?txtFechaInicial=" + fechaInicial + "&txtFechaFinal=" + fechaFinal + "&facturado=1", "_blank");
                        $("#mdAlertVentas").modal("hide");
                    }
                });

                $("#btnTxtVentas").unbind();
                $("#btnTxtVentas").bind("click", function() {
                    openTextVentas();
                });

                $("#btnCancelarVentas").unbind();
                $("#btnCancelarVentas").bind("click", function() {
                    $("#mdAlertVentas").modal("hide");
                });

                $("#btnCloseVentas").unbind();
                $("#btnCloseVentas").bind("click", function() {
                    $("#mdAlertVentas").modal("hide");
                });
            }

            function openTextVentas() {
                let fechaInicial = $("#txtFechaInicialVenta").val();
                let fechaFinal = $("#txtFechaFinalVenta").val();
                if (fechaInicial !== "" && fechaInicial !== undefined && fechaFinal !== "" && fechaFinal !== undefined) {
                    window.open("../app/sunat/txtventas.php?txtFechaInicial=" + fechaInicial + "&txtFechaFinal=" + fechaFinal + "&facturado=1", "_blank");
                }
            }

            function openExcelNotaCredito() {
                $("#mdAlertNotaCredito").modal("show");

                $("#btnNotaCredito").unbind();
                $("#btnNotaCredito").bind("click", function() {
                    let fechaInicial = $("#txtFechaInicialNotaCredito").val();
                    let fechaFinal = $("#txtFechaFinalNotaCredito").val();
                    if (fechaInicial !== "" && fechaInicial !== undefined && fechaFinal !== "" && fechaFinal !== undefined) {
                        window.open("../app/sunat/excelnotacredito.php?txtFechaInicial=" + fechaInicial + "&txtFechaFinal=" + fechaFinal + "&facturado=1", "_blank");
                        $("#mdAlertNotaCredito").modal("hide");
                    }
                });

                $("#btnTxtNotaCredito").unbind();
                $("#btnTxtNotaCredito").bind("click", function() {
                    openTextNotaCredito();
                });

                $("#btnCancelarNotaCredito").unbind();
                $("#btnCancelarNotaCredito").bind("click", function() {
                    $("#mdAlertNotaCredito").modal("hide");
                });

                $("#btnCloseNotaCredito").unbind();
                $("#btnCloseNotaCredito").bind("click", function() {
                    $("#mdAlertNotaCredito").modal("hide");
                });
            }

            function openTextNotaCredito() {
                let fechaInicial = $("#txtFechaInicialNotaCredito").val();
                let fechaFinal = $("#txtFechaFinalNotaCredito").val();
                if (fechaInicial !== "" && fechaInicial !== undefined && fechaFinal !== "" && fechaFinal !== undefined) {
                    window.open("../app/sunat/txtnotacredito.php?txtFechaInicial=" + fechaInicial + "&txtFechaFinal=" + fechaFinal + "&facturado=1", "_blank");
                }
            }
        </script>
    </body>

    </html>

<?php

}
