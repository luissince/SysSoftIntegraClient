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
            <div class="modal fade" id="idModalCotizacion" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-indent">
                                </i> Detalle de la cotización</h4>
                            <button type="button" class="close" id="btnCloseModal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table border-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Comprobante</th>
                                                    <th class="text-left border-0 p-1" id="thComprobante">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Cliente</th>
                                                    <th class="text-left border-0 p-1" id="thCliente">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Fecha y Hora:</th>
                                                    <th class="text-left border-0 p-1" id="thFechaHora">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Estado:</th>
                                                    <th id="thEstado">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Total:</th>
                                                    <th class="text-left border-0 p-1" id="thTotal">0.00</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                            <thead style="background-color: #0766cc;color: white;">
                                                <tr>
                                                    <th style="width:5%;">N°</th>
                                                    <th style="width:30%;">Descripción</th>
                                                    <th style="width:15%;">Cantidad</th>
                                                    <th style="width:15%;">Impuesto</th>
                                                    <th style="width:15%;">Precio</th>
                                                    <th style="width:15%;">Descuento</th>
                                                    <th style="width:15%;">Importe</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbIngresosDetalle">

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
        <!-- Modal del detalle de ingreso -->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Cotización <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="row">
                    <div class="col-md 12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button href="#" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Nuevo
                            </button>
                            <button class="btn btn-secondary" id="btnRecargar">
                                <i class="fa fa-refresh"></i>
                                Recargar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label><img src="./images/search.png" width="22" height="22"> Buscar por N° de Cotización o Cliente:</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" id="txtBuscar" placeholder="Ingrese su cliente o serie y numeración" />
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="btnBuscar">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha de Inicio:</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="txtFechaInicial">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha Final:</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="txtFechaFinal">
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
                                        <th scope="col" class="th-porcent-15">Vendedor</th>
                                        <th scope="col" class="th-porcent-10">Cotización</th>
                                        <th scope="col" class="th-porcent-15">Fecha</th>
                                        <th scope="col" class="th-porcent-25">Cliente</th>
                                        <th scope="col" class="th-porcent-10">Total</th>
                                        <th scope="col" class="th-porcent-5">Detalle</th>
                                        <th scope="col" class="th-porcent-5">Editar</th>
                                        <th scope="col" class="th-porcent-5">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td class="text-center" colspan="9">No hay datos para mostrar</td>
                                    </tr>
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
            let tbody = $("#tbList");

            let ulPagination = $("#ulPagination");

            $(document).ready(function() {
                $("#txtFechaInicial").val(tools.getCurrentDate());
                $("#txtFechaFinal").val(tools.getCurrentDate());

                $("#txtBuscar").keyup(function(event) {
                    let value = $("#txtBuscar").val();
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (value.trim().length != 0) {
                            if (event.keyCode === 13) {
                                if (!state) {
                                    paginacion = 1;
                                    fillTableCotizacion(1, value.trim(), "", "");
                                    opcion = 1;
                                }
                            }
                        }
                    }
                });

                $("#btnBuscar").click(function(event) {
                    let value = $("#txtBuscar").val();
                    if (value.trim().length != 0) {
                        if (!state) {
                            paginacion = 1;
                            fillTableCotizacion(1, value.trim(), "", "");
                            opcion = 1;
                        }
                    }
                });

                $("#btnBuscar").keypress(function(event) {
                    let value = $("#txtBuscar").val();
                    if (event.keyCode == 13) {
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillTableCotizacion(1, value.trim(), "", "");
                                opcion = 1;
                            }
                        }
                        event.preventDefault();
                    }
                });

                $("#txtFechaInicial").change(function() {
                    if (!state) {
                        if (tools.validateDate($("#txtFechaInicial").val()) && tools.validateDate($("#txtFechaFinal").val())) {
                            paginacion = 1;
                            fillTableCotizacion(0, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val());
                            opcion = 0;
                        }
                    }
                });

                $("#txtFechaFinal").change(function() {
                    if (!state) {
                        if (tools.validateDate($("#txtFechaInicial").val()) && tools.validateDate($("#txtFechaFinal").val())) {
                            paginacion = 1;
                            fillTableCotizacion(0, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val());
                            opcion = 0;
                        }
                    }
                });

                $("#btnRecargar").click(function() {
                    loadInitCotizacion();
                });

                $("#btnRecargar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        loadInitCotizacion();
                        event.preventDefault();
                    }
                });

                loadInitCotizacion();
            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillTableCotizacion(0, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val());
                        break;
                    case 1:
                        fillTableCotizacion(1, $("#btnBuscar").val(), "", "");
                        break;
                }
            }

            function loadInitCotizacion() {
                if (tools.validateDate($("#txtFechaInicial").val()) && tools.validateDate($("#txtFechaFinal").val())) {
                    if (!state) {
                        paginacion = 1;
                        fillTableCotizacion(0, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val());
                        opcion = 0;
                    }
                }
            }

            function fillTableCotizacion(opcion, buscar, fechaInicial, fechaFinal) {
                tools.promiseFetchGet(
                    "../app/controller/CotizacionController.php", {
                        "type": "all",
                        "opcion": opcion,
                        "buscar": buscar,
                        "fechaInicial": fechaInicial,
                        "fechaFinal": fechaFinal,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    },
                    function() {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="9"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                        totalPaginacion = 0;
                        arrayVentas = [];
                    }
                ).then(result => {
                    let object = result;

                    tbody.empty();
                    if (object.data.length == 0) {
                        tbody.append('<tr><td class="text-center" colspan="9"><p>No hay datos para mostrar.</p></td></tr>');
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

                        for (let cotizacion of object.data) {

                            tbody.append('<tr>' +
                                ' <td class="text-center">' + cotizacion.Id + '</td >' +
                                ' <td class="text-left">' + cotizacion.Apellidos + ", " + cotizacion.Nombres + '</td>' +
                                ' <td class="text-left">' + "COTIZACIÓN N° " + cotizacion.IdCotizacion + '</td>' +
                                ' <td class="text-left">' + tools.getDateForma(cotizacion.FechaCotizacion) + '</td>' +
                                ' <td class="text-left">' + cotizacion.Informacion + '</td>' +
                                ' <td class="text-right">' + cotizacion.SimboloMoneda + " " + tools.formatMoney(cotizacion.Total) + '</td>' +
                                ' <td class="text-center"><button type="button" class="btn btn-info"><i class="fa fa-eye"></i></button></td >' +
                                ' <td class="text-center"><button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button></td >' +
                                ' <td class="text-center"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td >' +
                                '</tr >');
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

                }).catch(error => {
                    tbody.empty();
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
                    tbody.append('<tr><td class="text-center" colspan="9"><p>' + error.responseText + '</p></td></tr>');
                    state = false;
                });
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
        </script>
    </body>

    </html>

<?php

}
