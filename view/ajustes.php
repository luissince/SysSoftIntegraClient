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
                                        <table class="table">
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
                                    <div class="form-group">
                                        <button class="btn btn-secondary" id="btnCancelarMovimiento">
                                            <img src="./images/unable.svg" width="18" />
                                            Anular Ajuste
                                        </button>
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

                <div class="row">
                    <div class="col-md 12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <a href="ajusteproceso.php" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Realizar Ajuste
                            </a>
                            <button class="btn btn-success" id="btnReload">
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
                                        <th scope="col" class="th-porcent-15">Estado</th>
                                        <th scope="col" class="th-porcent-5">Detalle</th>
                                        <th scope="col" class="th-porcent-5">Excel</th>
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

                } catch (error) {}
            }

            function loadInitTable() {
                if (!state) {
                    paginacion = 1;
                    fillInventarioTable(0, 0, "", "");
                    opcion = 0;
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
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="8"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                    });

                    let object = result;
                    let movimientos = object.data;
                    if (movimientos.length == 0) {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="8"><p>No hay datos para mostrar</p></td></tr>');
                        ulPagination.html(`
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
                                </button>`);
                        state = false;
                    } else {
                        tbody.empty();
                        for (let moviminento of movimientos) {
                            let estadoStyle = moviminento.Estado === "CANCELADO" ? "text-danger" : moviminento.Estado === "EN PROCESO" ? "text-warning" : "text-success";
                            tbody.append('<tr>' +
                                '<td>' + moviminento.count + '</td>' +
                                '<td>' + (moviminento.TipoAjuste == 0 ? "DECREMENTO" : "INCREMENTO") + '<br>' + moviminento.TipoMovimiento + '</td>' +
                                '<td>' + tools.getDateForma(moviminento.Fecha) + "</br>" + tools.getTimeForma24(moviminento.Hora) + '</td>' +
                                '<td>' + moviminento.Observacion + '</td>' +
                                '<td>' + moviminento.Informacion + '</td>' +
                                '<td>' + '<div class="' + estadoStyle + '">' + moviminento.Estado + '</div>' + '</td>' +
                                '<td><button class="btn btn-warning btn-sm" onclick="loadDetalleMovimiento(\'' + moviminento.IdMovimientoInventario + '\')"><img src="./images/search.png" width="18" /><span> Ver</span></button></td>' +
                                '<td><button class="btn btn-success btn-sm" onclick="generarExcel(\'' + moviminento.IdMovimientoInventario + '\')"><i class="fa fa-file-excel-o"></i><span> Excel</span></button></td>' +
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
                    console.log(error)
                    tbody.empty();
                    tbody.append('<tr><td class="text-center" colspan="8"><p>Error en: ' + error.responseText + '</p></td></tr>');
                    ulPagination.html(`
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
                                </button>`);
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
                        tbMovimientos.empty();
                        tbMovimientos.append('<tr><td class="td-center" colspan="3">Cargando información...</td></tr>');

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

                    $("#btnCancelarMovimiento").unbind();

                    $("#btnCancelarMovimiento").bind("click", function() {
                        cancelarMovimiento(idMovimiento);
                    });

                    $("#btnCancelarMovimiento").bind("keydown", function(event) {
                        if (event.keyCode === 13) {
                            cancelarMovimiento(idMovimiento);
                            event.preventDefault();
                        }
                    });

                    for (let md of movimientoDetalle) {
                        tbMovimientos.append('<tr>' +
                            '<td class="td-center">' + md.Id + '</td>' +
                            '<td class="td-left">' + md.Clave + '</br>' + md.NombreMarca + '</td>' +
                            '<td class="td-right">' + tools.formatMoney(md.Cantidad) + '</td>' +
                            +'</tr>');
                    }

                } catch (error) {
                    tbMovimientos.empty();
                    tbMovimientos.append('<tr><td class="td-center" colspan="3">Error en cargar la información.</td></tr>');
                }
            }

            function cancelarMovimiento(idMovimiento) {
                tools.ModalDialog("Ajuste", "¿Está seguro de anular el Ajuste?", async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/MovimientoController.php", {
                                "type": "cancelarmovimiento",
                                "idMovimiento": idMovimiento
                            }, function() {
                                $("#id-modal-productos").modal("hide");
                                tools.ModalAlertInfo("Ajuste", "Se está procesando la información.");
                            });

                            tools.ModalAlertSuccess("Ajuste", result);
                        } catch (error) {
                            if (error.responseText == "" || error.responseText == null) {
                                tools.ModalAlertError("Ajuste", "Se produjo un error interno, intente nuevamente por favor.");
                            } else {
                                tools.ModalAlertWarning("Ajuste", error.responseJSON);
                            }
                        }
                    }
                });
            }

            function generarExcel(idMovimiento) {
                window.open("../app/sunat/exceldetalleajuste.php?idMovimiento=" + idMovimiento, "_blank");
            }
        </script>
    </body>

    </html>

<?php

}
