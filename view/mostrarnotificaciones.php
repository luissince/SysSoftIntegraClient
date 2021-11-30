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
                <h1><i class="fa fa-folder"></i> Notificaciones <small>Lista</small></h1>
            </div>

            <div class="tile">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover">
                                    <thead class="table-header-background">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">COMPROBANTE</th>
                                            <th class="text-left">DETALLE</th>
                                            <th>FECHA</th>
                                        </tr>
                                    </thead>
                                    <tbody id="divLineaTiempo">

                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <span class="text-muted mr-2" id="lblPaginacion">Mostrando 0 - 0 de 0</span>
                                <div class="btn-group">
                                    <button id="btnAnterior" class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-left"></i></button>
                                    <button id="btnSiguiente" class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-right"></i></button>
                                </div>
                            </div>
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
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let filasPorPagina = 10;

            $(document).ready(function() {
                $("#btnAnterior").click(function() {
                    if (!state) {
                        if (paginacion > 1) {
                            paginacion--;
                            onEventPaginacion();
                        }
                    }
                });

                $("#btnAnterior").keydown(function(event) {
                    if (event.which == 13) {
                        if (!state) {
                            if (paginacion > 1) {
                                paginacion--;
                                onEventPaginacion();
                            }
                        }
                        event.preventDefault();
                    }
                });

                $("#btnSiguiente").click(function() {
                    if (!state) {
                        if (paginacion < totalPaginacion) {
                            paginacion++;
                            onEventPaginacion();
                        }
                    }
                });

                $("#btnSiguiente").keydown(function(event) {
                    if (event.which == 13) {
                        if (!state) {
                            if (paginacion < totalPaginacion) {
                                paginacion++;
                                onEventPaginacion();
                            }
                        }
                        event.preventDefault();
                    }
                });

                loadInit();
            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillNotificacionesTable();
                        break;
                }
            }

            function loadInit() {
                if (!state) {
                    paginacion = 1;
                    fillNotificacionesTable();
                    opcion = 0;
                }
            }

            async function fillNotificacionesTable() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/VentaController.php", {
                        "type": "listarDetalleNotificaciones",
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        $("#divLineaTiempo").empty();
                        $("#lblPaginacion").html("Mostrando 0 - 0 de 0");
                    });

                    if (result.data.length == 0) {
                        $("#lblPaginacion").html("Mostrando 0 - 0 de 0");
                    } else {
                        let count = 0;
                        for (let value of result.data) {
                            count++;
                            $("#divLineaTiempo").append('<tr>' +
                                '<td class="text-center">' + (count + (((paginacion - 1) * filasPorPagina))) + '</td>' +
                                '<td class=""><h5 class="text-primary p-0">' + value.Nombre + ' ' + value.Serie + '-' + value.Numeracion + '</h5></td>' +
                                '<td class=""><h5 class="text-primary p-0"><h6>' + value.Estado + '</h6></td>' +
                                '<td class="text-center"><h6>' + tools.getDateForma(value.Fecha) + '</h6></td>' +
                                '</tr>');
                        }
                        totalPaginacion = parseInt(Math.ceil((parseFloat(result.total) / filasPorPagina)));
                        $("#lblPaginacion").html("Mostrando " + paginacion + " - " + totalPaginacion + " de " + filasPorPagina);
                    }
                } catch (error) {
                    $("#lblPaginacion").html("Mostrando 0 - 0 de 0");
                    $("#divLineaTiempo").append('<tr><td class="mail-subject">' + error.responseText + '</td></tr>');
                }
            }
        </script>
    </body>

    </html>

<?php

}
