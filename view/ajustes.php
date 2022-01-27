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
        <!-- Modal del detalle de ingreso -->
        <div class="row">
            <div class="modal fade" id="id-modal-productos" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-indent">
                                </i> Detalle del Ajuste
                            </h4>
                            <button type="button" class="close" id="btnCloseModal">
                                <i class="fa fa-close"></i>
                            </button>

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md 12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table border-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Tipo de Ajustes:</th>
                                                    <th class="text-left border-0 p-1" id="lblTipoMovimiento">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Codigo Verificación:</th>
                                                    <th class="text-left border-0 p-1" id="lblCodigoVerificacion">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Fecha y Hora:</th>
                                                    <th class="text-left border-0 p-1" id="lblFechaHora">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Estado:</th>
                                                    <th class="text-left border-0 p-1"><span id="lblEstadoMovimiento">--</span></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Observación:</th>
                                                    <th class="text-left border-0 p-1" id="lblObservacion">--</th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md 12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                            <thead style="background-color: #0766cc;color: white;">
                                                <tr>
                                                    <th class="th-porcent-5">N°</th>
                                                    <th class="th-porcent-35">Descripción</th>
                                                    <th class="th-porcent-15">Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbMovimientos">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Ajuste de Inventario <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="overlay p-5" id="divOverlayAjuste">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text text-center p-10 text-white" id="lblTextOverlayAjuste">Cargando información...</h4>
                </div>

                <div class="row">
                    <div class="col-md 12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <a href="ajusteproceso.php" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Realizar Ajuste
                            </a>
                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i>
                                Recargar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <label><img src="./images/igual.png" width="22" height="22"> Moviminento:</label>
                        <div class="form-group">
                            <select class="form-control" id="cbTipoMovimiento">
                                <option value="0">--TODOS--</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha Inicio:</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="txtFechaInicio">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha Termino:</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="txtFechaTermino">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-header-background">
                                    <tr>
                                        <th scope="col" class="th-porcent-5">N°</th>
                                        <th scope="col" class="th-porcent-15">Tipo Ajuste</th>
                                        <th scope="col" class="th-porcent-10">Fecha y Hora</th>
                                        <th scope="col" class="th-porcent-25">Observación</th>
                                        <th scope="col" class="th-porcent-20">Información</th>
                                        <th scope="col" class="th-porcent-10">Estado</th>
                                        <th scope="col" class="th-porcent-7">Detalle</th>
                                        <th scope="col" class="th-porcent-7">Excel</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 text-center">
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
            let filasPorPagina = 20;
            let tbody = $("#tbList");

            let ulPagination = $("#ulPagination");

            let cbTipoMovimiento = $("#cbTipoMovimiento");
            let txtFechaInicio = $("#txtFechaInicio");
            let txtFechaTermino = $("#txtFechaTermino");

            let lblTipoMovimiento = $("#lblTipoMovimiento");
            let lblFechaHora = $("#lblFechaHora");
            let lblObservacion = $("#lblObservacion");
            let lblEstadoMovimiento = $("#lblEstadoMovimiento");
            let lblCodigoVerificacion = $("#lblCodigoVerificacion");
            let tbMovimientos = $("#tbMovimientos");

            $(document).ready(function() {

                $("#txtFechaInicio").val(tools.getCurrentDate());
                $("#txtFechaTermino").val(tools.getCurrentDate());

                $("#btnReload").click(function() {
                    if (!state) {
                        loadComponents();
                    }
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        if (!state) {
                            loadComponents();
                        }
                    }
                    event.preventDefault();
                });

                txtFechaInicio.on("change", function() {
                    if (txtFechaInicio.val() !== "" && txtFechaTermino.val() !== "") {
                        if (!state) {
                            paginacion = 1;
                            fillInventarioTable(1, cbTipoMovimiento.val(), txtFechaInicio.val(), txtFechaTermino.val());
                            opcion = 1;
                        }
                    }
                });

                txtFechaTermino.on("change", function() {
                    if (txtFechaInicio.val() !== "" && txtFechaTermino.val() !== "") {
                        if (!state) {
                            paginacion = 1;
                            fillInventarioTable(1, cbTipoMovimiento.val(), txtFechaInicio.val(), txtFechaTermino.val());
                            opcion = 1;
                        }
                    }
                });

                cbTipoMovimiento.on("change", function() {
                    if (txtFechaInicio.val() !== "" && txtFechaTermino.val() !== "") {
                        if (!state) {
                            paginacion = 1;
                            fillInventarioTable(1, $(this).children("option:selected").val(), txtFechaInicio.val(), txtFechaTermino.val());
                            opcion = 1;
                        }
                    }
                });

                $("#btnCloseModal").on("click", function(event) {
                    $("#id-modal-productos").modal("hide");
                });

                $("#btnCloseModal").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").css({
                            "display": "none"
                        });
                    }
                    event.preventDefault();
                });

                loadComponents();
            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillInventarioTable(0, 0, "", "");
                        break;
                    case 1:
                        fillInventarioTable(1, cbTipoMovimiento.val(), txtFechaInicio.val(), txtFechaTermino.val());
                        break;
                }
            }

            async function loadComponents() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/MovimientoController.php", {
                        "type": "listipomovimiento",
                        "ajuste": true,
                        "all": "true"
                    });

                    $("#cbTipoMovimiento").empty();
                    $("#cbTipoMovimiento").append('<option value="0">--TODOS--</option>');
                    for (let tipos of result) {
                        $("#cbTipoMovimiento").append('<option value="' + tipos.IdTipoMovimiento + '">' + tipos.Nombre + '</option>');
                    }
                    loadInitTable();

                    $("#divOverlayAjuste").addClass('d-none');
                } catch (error) {
                    $("#lblTextOverlayAjuste").html(tools.messageError(error));
                }
            }

            function loadInitTable() {
                if (!state) {
                    paginacion = 1;
                    fillInventarioTable(1, 0, txtFechaInicio.val(), txtFechaTermino.val());
                    opcion = 1;
                }
            }

            async function fillInventarioTable(opcion, movimiento, fechaInicial, fechaFinal) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/MovimientoController.php", {
                        "type": "listmovimiento",
                        "opcion": opcion,
                        "movimiento": movimiento,
                        "fechaInicial": fechaInicial,
                        "fechaFinal": fechaFinal,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tools.loadTable(tbody, 8);
                        state = true;
                    });

                    let object = result;
                    let movimientos = object.data;
                    if (movimientos.length == 0) {
                        tools.loadTableMessage(tbody, 'No hay datos para mostrar', 8, true);
                        tools.paginationEmpty(ulPagination);
                        state = false;
                    } else {
                        tbody.empty();
                        for (let moviminento of movimientos) {
                            let estadoStyle = moviminento.Estado === "CANCELADO" ? "text-danger" : moviminento.Estado === "EN PROCESO" ? "text-warning" : "text-success";
                            tbody.append('<tr>' +
                                '<td>' + moviminento.count + '</td>' +
                                '<td>' + (moviminento.TipoAjuste == 0 ? 'DECREMENTO <i class="fa fa-arrow-down text-danger"></i>' : 'INCREMENTO <i class="fa fa-arrow-up text-success"></i>') + '<br>' + moviminento.TipoMovimiento + '</td>' +
                                '<td>' + tools.getDateForma(moviminento.Fecha) + "</br>" + tools.getTimeForma24(moviminento.Hora) + '</td>' +
                                '<td>' + moviminento.Observacion + '</td>' +
                                '<td>' + moviminento.Informacion + '</td>' +
                                '<td>' + '<div class="' + estadoStyle + '">' + moviminento.Estado + '</div>' + '</td>' +
                                '<td class="text-center"><button class="btn btn-warning btn-sm" onclick="loadDetalleMovimiento(\'' + moviminento.IdMovimientoInventario + '\')"><i class="fa fa-search fa-lg"></i><span></span></button></td>' +
                                '<td class="text-center"><button class="btn btn-success btn-sm" onclick="generarExcel(\'' + moviminento.IdMovimientoInventario + '\')"><i class="fa fa-file-excel-o fa-lg"></i><span></span></button></td>' +
                                '</tr>');
                        }
                        totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));

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
                        state = false;
                    }

                } catch (error) {
                    tools.loadTableMessage(tbody, tools.messageError(error), 8, true);
                    tools.paginationEmpty(ulPagination);
                    state = false;
                }
            }

            async function loadDetalleMovimiento(idMovimiento) {
                try {
                    $("#id-modal-productos").modal("show");
                    let result = await tools.promiseFetchGet("../app/controller/MovimientoController.php", {
                        "type": "listforidmovimiento",
                        "idMovimiento": idMovimiento
                    }, function() {
                        tools.loadTable(tbMovimientos, 3);
                    });
                    tbMovimientos.empty();

                    let movimiento = result.movimiento;
                    let movimientoDetalle = result.detalle;

                    lblTipoMovimiento.html(movimiento.TipoMovimiento);
                    lblFechaHora.html(tools.getDateForma(movimiento.Fecha) + " " + tools.getTimeForma24(movimiento.Hora));
                    lblObservacion.html(movimiento.Observacion);
                    //lblEstadoMovimiento.removeClass("block-detail-right");
                    lblEstadoMovimiento.addClass("label-asignacion");
                    lblEstadoMovimiento.html(movimiento.Estado);
                    lblCodigoVerificacion.html(movimiento.CodigoVerificacion);

                    for (let md of movimientoDetalle) {
                        tbMovimientos.append(`<tr>
                            <td class="td-center">${md.Id} </td>
                            <td class="td-left">${ md.Clave  +'</br>' + md.NombreMarca }</td>
                            <td class="td-right">${ tools.formatMoney(md.Cantidad) }</td>
                            </tr>`);
                    }

                } catch (error) {
                    tools.loadTableMessage(tbMovimientos, tools.messageError(error), 3, true);
                }
            }

            function onEventPaginacionInicio(value) {
                if (!state) {
                    if (value !== paginacion) {
                        paginacion = value;
                        onEventPaginacion();
                    }
                }
            }

            function onEventPaginacionFinal(value) {
                if (!state) {
                    if (value !== paginacion) {
                        paginacion = value;
                        onEventPaginacion();
                    }
                }
            }

            function onEventAnteriorPaginacion() {
                if (!state) {
                    if (paginacion > 1) {
                        paginacion--;
                        onEventPaginacion();
                    }
                }
            }

            function onEventSiguientePaginacion() {
                if (!state) {
                    if (paginacion < totalPaginacion) {
                        paginacion++;
                        onEventPaginacion();
                    }
                }
            }

            function generarExcel(idMovimiento) {
                window.open("../app/sunat/exceldetalleajuste.php?idMovimiento=" + idMovimiento, "_blank");
            }
        </script>
    </body>

    </html>

<?php

}
