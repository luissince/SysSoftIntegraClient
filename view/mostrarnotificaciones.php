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
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <label>Paginación</label>
                        <div class="form-group" id="ulPagination">
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>
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

            let ulPagination = $("#ulPagination");

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
                        tools.loadTableMessage($("#divLineaTiempo"), "No hay datos para mostrar.", 4, true);
                        tools.paginationEmpty(ulPagination);
                    });

                    if (result.data.length == 0) {
                        tools.loadTableMessage($("#divLineaTiempo"), "No hay datos para mostrar.", 4, true);
                        tools.paginationEmpty(ulPagination);
                    } else {
                        $("#divLineaTiempo").empty();
                        let count = 0;
                        for (let value of result.data) {
                            count++;
                            $("#divLineaTiempo").append('<tr>' +
                                '<td class="text-center">' + (count + (((paginacion - 1) * filasPorPagina))) + '</td>' +
                                '<td class=""><h5 class="text-primary p-0">' + value.Nombre + ' ' + value.Serie + '-' + value.Numeracion + '</h5></td>' +
                                '<td class=""><h5 class="text-primary p-0"><h5>' + value.Estado + '</h5></td>' +
                                '<td class="text-center"><h5>' + tools.getDateForma(value.Fecha) + '</h5></td>' +
                                '</tr>');
                        }

                        totalPaginacion = parseInt(Math.ceil((parseFloat(result.total) / filasPorPagina)));

                        let i = 1;
                        let range = [];
                        while (i <= totalPaginacion) {
                            range.push(i);
                            i++;
                        }

                        let min = Math.min.apply(null, range);
                        let max = Math.max.apply(null, range);

                        let paginacionHtml = `
                        <button class="btn btn-outline-secondary" onclick="onEventPaginacionInicio(${min})">
                            <i class="fa fa-angle-double-left"></i>
                        </button>
                        <button class="btn btn-outline-secondary" onclick="onEventAnteriorPaginacion()">
                            <i class="fa fa-angle-left"></i>
                        </button>
                        <span class="btn btn-outline-secondary disabled" id="lblPaginacion">${paginacion} - ${totalPaginacion}</span>
                        <button class="btn btn-outline-secondary" onclick="onEventSiguientePaginacion()">
                            <i class="fa fa-angle-right"></i>
                        </button>
                        <button class="btn btn-outline-secondary" onclick="onEventPaginacionFinal(${max})">
                            <i class="fa fa-angle-double-right"></i>
                        </button>`;

                        ulPagination.html(paginacionHtml);
                    }
                } catch (error) {
                    tools.loadTableMessage($("#divLineaTiempo"), tools.messageError(error), 4);
                    tools.paginationEmpty(ulPagination);
                }
            }
        </script>
    </body>

    </html>

<?php

}
