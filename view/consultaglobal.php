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

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Consulta Masiva de Comprobantes de Pago</h1>
            </div>

            <div class="tile">

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <h4> Resumen de documentos emitidos</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha de Inicio:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaInicial" />
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha de Fin:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaFinal" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width:5%;">#</th>
                                        <th style="width:10%;">RUC</th>
                                        <th style="width:5%;">Tipo <br> Comprobante</th>
                                        <th style="width:5%;">Serie</th>
                                        <th style="width:5%;">Nro <br>Comprobante</th>
                                        <th style="width:10%;">Fecha <br>Emisión</th>
                                        <th style="width:10%;">Importe <br> Total</th>
                                        <th style="width:10%;">Estado <br> Codigo</th>
                                        <th style="width:20%;">Estado <br> Comprobante</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td class="text-center" colspan="9">
                                            <p>Tabla sin datos para mostrar.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let state = false;
            let tbody = $("#tbList");
            let arrayVentas = [];

            $(document).ready(function() {
                $("#txtFechaInicial").val(tools.getCurrentDate());
                $("#txtFechaFinal").val(tools.getCurrentDate());

                $("#txtFechaInicial").change(function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    if (!state) {
                        paginacion = 1;
                        loadInitComprobantes(fechaInicial, fechaFinal);
                        opcion = 0;
                    }
                });

                $("#txtFechaFinal").change(function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    if (!state) {
                        paginacion = 1;
                        loadInitComprobantes(fechaInicial, fechaFinal);
                        opcion = 0;
                    }
                });
            });

            function loadInitComprobantes(fechaInicial, fechaFinal) {
                tools.promiseFetchGet("../app/examples/pages/cdrStatusGlobal.php", {
                    "fechaInicial": fechaInicial,
                    "fechaFinal": fechaFinal,
                }, function() {
                    tbody.empty();
                    tbody.append('<tr><td class="text-center" colspan="9"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                    state = true;
                    arrayVentas = [];
                }).then(result => {
                    let object = result;
                    if (object.estado === 1) {
                        arrayVentas = object.data;
                        renderTableComprobantes();
                    } else {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="9"> <p>' + result.message + '</p></td></tr>');
                        state = false;
                    }
                }).catch(error => {
                    tbody.empty();
                    tbody.append('<tr><td class="text-center" colspan="9"> <p>' + error.responseText + '</p></td></tr>');
                    state = false;
                });
            }

            function renderTableComprobantes() {
                tbody.empty();
                if (arrayVentas.length == 0) {
                    tbody.append('<tr><td class="text-center" colspan="9"> <p>No hay comprobantes para mostrar.</p></td></tr>');
                    state = false;
                } else {

                    for (let venta of arrayVentas) {
                        let datetime = tools.getDateForma(venta.Fecha) + "<br>" + tools.getTimeForma24(venta.Hora, true);
                        let total = tools.formatMoney(venta.Total);

                        if (venta.Estado == "0001") {
                            estado = '<div class="badge badge-success">ACEPTADO</div>';
                        } else if (venta.Estado == "0002") {
                            estado = '<div class="badge badge-warning">RECHAZADO</div>';
                        } else if (venta.Estado == "0003") {
                            estado = '<div class="badge badge-danger">ANULADO</div>';
                        } else {
                            estado = '<div class="">-</div>';
                        }

                        tbody.append('<tr>' +
                            '<td class="text-center">' + venta.id + '</td>' +
                            '<td class="text-center">' + venta.NumeroDocumento + '</td>' +
                            '<td class="text-center">' + venta.TipoComprobante + '</td >' +
                            '<td class="text-center">' + venta.Serie + '</td >' +
                            '<td class="text-center">' + venta.Numeracion + '</td>' +
                            '<td class="text-center">' + datetime + '</td>' +
                            '<td class="text-center">' + total + '</td>' +
                            '<td class="text-center">' + estado + '</td>' +
                            '<td class="text-left">' + venta.Mensaje + '</td>' +
                            '</tr>');
                    }
                    state = false;
                }
            }
        </script>
    </body>

    </html>

<?php

}
