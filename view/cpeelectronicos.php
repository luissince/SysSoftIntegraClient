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
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-indent">
                                </i> Detalle del Comprobante</h4>
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
        <!--   Modal del detalle de ingreso -->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Comprobante de Pago Electrónico <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="overlay p-5" id="divOverlayVentas">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayVentas">Cargando información...</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <h4> Resumen de Boletas/Facturas/Nota Crédito/Nota Débito</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/sunat_logo.png" width="28" height="28" />
                            <span class="small">Estados SUNAT:</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/accept.svg" width="28" height="28" />
                            <span class="small">Aceptado</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/unable.svg" width="28" height="28" />
                            <span class="small"> Rechazado</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/reuse.svg" width="28" height="28" />
                            <span class="small"> Pendiente de Envío</span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/error.svg" width="28" height="28" />
                            <span class="small">Comunicación de Baja (Anulado)</span>
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
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/igual.png" width="22" height="22"> Comprobantes:</label>
                        <div class="form-group">
                            <select id="cbComprobante" class="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/information.png" width="22" height="22"> Estado:</label>
                        <div class="form-group">
                            <select id="cbEstado" class="form-control">
                                <option value="0">TODOS</option>
                                <option value="1">DECLARAR</option>
                                <option value="3">ANULAR</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
                        <label>Buscar:</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtSearch">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="btnBuscar">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Opción:</label>
                        <div class="form-group">
                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i> Recargar
                            </button>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Procesar:</label>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnEnvioMasivo">
                                <i class="fa fa-arrow-circle-up"></i> Envío masivo
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width:5%;">#</th>
                                        <th style="width:5%;">Anular</th>
                                        <th style="width:5%;">PDF</th>
                                        <th style="width:5%;">Detalle</th>
                                        <th style="width:10%;">Fecha</th>
                                        <th style="width:15%;">Comprobante</th>
                                        <th style="width:15%;">Cliente</th>
                                        <th style="width:10%;">Estado</th>
                                        <th style="width:10%;">Total</th>
                                        <th style="width:10%;">Estado <br>SUNAT</th>
                                        <th style="width:25%;">Observación <br> SUNAT</th>
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
            let filasPorPagina = 10;
            let tbody = $("#tbList");
            let arrayVentas = [];

            let ulPagination = $("#ulPagination");

            $(document).ready(function() {

                $("#txtFechaInicial").val(tools.getCurrentDate());
                $("#txtFechaFinal").val(tools.getCurrentDate());

                $("#txtFechaInicial").on("change", function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    let comprobante = $("#cbComprobante").val();
                    let estado = $("#cbEstado").val();
                    if (fechaInicial <= fechaFinal) {
                        if (!state) {
                            paginacion = 1;
                            fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estado);
                            opcion = 1;
                        }
                    }
                });

                $("#txtFechaFinal").on("change", function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    let comprobante = $("#cbComprobante").val();
                    let estado = $("#cbEstado").val();
                    if (fechaInicial <= fechaFinal) {
                        if (!state) {
                            paginacion = 1;
                            fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estado);
                            opcion = 1;
                        }
                    }
                });

                $("#cbComprobante").change(function(event) {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    let comprobante = $("#cbComprobante").val();
                    let estado = $("#cbEstado").val();
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estado);
                        opcion = 1;
                    }
                });

                $("#cbEstado").change(function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    let comprobante = $("#cbComprobante").val();
                    let estado = $("#cbEstado").val();
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estado);
                        opcion = 1;
                    }
                });

                $("#txtSearch").on("keyup", function(event) {
                    let value = $("#txtSearch").val();
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillVentasTable(2, value.trim(), "", "", 0, 0);
                                opcion = 2;
                            }
                        }
                    }
                });

                $("#btnBuscar").click(function() {
                    let value = $("#txtSearch").val();
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillVentasTable(2, value.trim(), "", "", 0, 0);
                                opcion = 2;
                            }
                        }
                    }
                });

                $("#btnBuscar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        let value = $("#txtSearch").val();
                        if (event.keyCode !== 9 && event.keyCode !== 18) {
                            if (value.trim().length != 0) {
                                if (!state) {
                                    paginacion = 1;
                                    fillVentasTable(2, value.trim(), "", "", 0, 0);
                                    opcion = 2;
                                }
                            }
                        }
                        event.preventDefault();
                    }
                });

                $("#btnReload").click(function() {
                    loadInitVentas();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadInitVentas();
                    }
                    event.preventDefault();
                });

                $("#btnEnvioMasivo").click(function() {
                    onEventEnvioMasivo();
                });

                $("#btnEnvioMasivo").keypress(function(event) {
                    if (event.keyCode == 13) {
                        onEventEnvioMasivo();
                        event.preventDefault();
                    }
                });

                loadEstadoVentas();
            });

            async function loadEstadoVentas() {
                try {
                    $("#cbComprobante").empty();

                    let promiseFetchComprobante = tools.promiseFetchGet(
                        "../app/controller/TipoDocumentoController.php", {
                            "type": "getdocumentofacturados"
                        }
                    );

                    let promise = await Promise.all([promiseFetchComprobante]);
                    let result = await promise;


                    let comprobante = result[0];

                    $("#cbComprobante").append('<option value="0">TODOS</option>');
                    for (let value of comprobante) {
                        $("#cbComprobante").append('<option value="' + value.IdTipoDocumento + '">' + value.Nombre + ' </option>');
                    }


                    $("#divOverlayVentas").addClass("d-none");
                    loadInitVentas();
                } catch (error) {
                    $("#lblTextOverlayVentas").html(error.message);
                }
            }

            function onEventPaginacion() {
                let comprobante = $('#cbComprobante').children('option').length > 0 && $("#cbComprobante").val() != "" ? $("#cbComprobante").val() : 0;
                let estadoVenta = $('#cbEstado').children('option').length > 0 && $("#cbEstado").val() != "" ? $("#cbEstado").val() : 0;
                switch (opcion) {
                    case 0:
                        fillVentasTable(0, "", "", "", 0, 0);
                        break;
                    case 1:
                        fillVentasTable(1, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val(), comprobante, estadoVenta);
                        break;
                    case 2:
                        fillVentasTable(2, $("#txtSearch").val(), "", "", 0, 0);
                        break;
                }
            }

            function loadInitVentas() {
                if (!state) {
                    paginacion = 1;
                    fillVentasTable(0, "", "", "", 0, 0);
                    opcion = 0;
                }
            }

            async function fillVentasTable(opcion, busqueda, fechaInicial, fechaFinal, comprobante, estado) {
                try {
                    let result = await tools.promiseFetchGet(
                        "../app/controller/VentaController.php", {
                            "type": "listComprobantes",
                            "opcion": opcion,
                            "busqueda": busqueda,
                            "fechaInicial": fechaInicial,
                            "fechaFinal": fechaFinal,
                            "comprobante": comprobante,
                            "estado": estado,
                            "posicionPagina": ((paginacion - 1) * filasPorPagina),
                            "filasPorPagina": filasPorPagina
                        },
                        function() {
                            tbody.empty();
                            tbody.append('<tr><td class="text-center" colspan="11"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                            state = true;
                            totalPaginacion = 0;
                            arrayVentas = [];
                        }
                    );

                    arrayVentas = result.data;

                    tbody.empty();
                    if (arrayVentas.length == 0) {
                        tbody.append('<tr><td class="text-center" colspan="11"><p>No hay datos para mostrar.</p></td></tr>');
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
                        let count = 0;
                        for (let venta of arrayVentas) {
                            count++;

                            let pdf = '<button class="btn btn-secondary btn-sm"  onclick="openPdf(\'' + venta.Tipo + '\',\'' + venta.IdComprobante + '\')"><img src="./images/pdf.svg" width="26" /> </button>';
                            let ver = '<button class="btn btn-secondary btn-sm" onclick="opeModalDetalle(\'' + venta.Tipo + '\',\'' + venta.IdComprobante + '\')"><img src="./images/file.svg" width="26" /></button>';
                            let resumen = '<button class="btn btn-secondary btn-sm" onclick="resumenDiarioXml(\'' + venta.IdComprobante + '\',\'' + venta.Serie + "-" + venta.Numeracion + '\',\'' + tools.getDateYYMMDD(venta.Fecha) + '\')"><img src="./images/documentoanular.svg" width="26" /></button>';
                            let comunicacion = '<button class="btn btn-secondary btn-sm" onclick="comunicacionBajaXml(\'' + venta.IdComprobante + '\',\'' + venta.Serie + "-" + venta.Numeracion + '\')"><img src="./images/documentoanular.svg" width="26" /></button>';
                            let anular = venta.Tipo == "nc" ? "-" : venta.Tipo == "gui" ? "-" : venta.Serie.toUpperCase().includes("B") ? resumen : comunicacion;

                            let datetime = tools.getDateForma(venta.Fecha) + "<br>" + tools.getTimeForma24(venta.Hora, true);

                            let imagen = "sales.png";
                            if (venta.Tipo == "gui") {
                                imagen = "guia_remision.png";
                            } else if (venta.Tipo == "nc") {
                                imagen = "note.png";
                            }

                            let comprobante = venta.Nombre + " <br/>" + `<img width="22" src="./images/${imagen}"> ` + (venta.Serie + "-" + venta.Numeracion) + "</span>";
                            let cliente = venta.Documento + " - " + venta.NumeroDocumento + "<br>" + venta.Informacion;
                            let estado = "";

                            if (venta.Estado == 3) {
                                estado = '<div class="badge badge-danger">ANULAR</div>';
                            } else {
                                estado = '<div class="badge badge-success">DECLARAR</div>';
                            }

                            let total = venta.Tipo == "gui" ? "" : venta.Simbolo + " " + tools.formatMoney(venta.Total);

                            let estadosunat = venta.Estado == 3 ?
                                ('<button class="btn btn-secondary btn-sm" onclick="firmarXml(\'' + venta.Tipo + '\',\'' + venta.IdComprobante + '\')"><img src="./images/error.svg" width="26" /></button>') :
                                (venta.Xmlsunat === "" ?
                                    '<button class="btn btn-secondary btn-sm" onclick="firmarXml(\'' + venta.Tipo + '\',\'' + venta.IdComprobante + '\')"><img src="./images/reuse.svg" width="26"/></button>' :
                                    venta.Xmlsunat === "0" ?
                                    '<button class="btn btn-secondary btn-sm"><img src="./images/accept.svg" width="26" /></button>' :
                                    '<button class="btn btn-secondary btn-sm" onclick="firmarXml(\'' + venta.Tipo + '\',\'' + venta.IdComprobante + '\')"><img src="./images/unable.svg" width="26" /></button>'
                                );

                            let descripcion = '<p class="recortar-texto">' + (venta.Xmldescripcion === "" ? "Por Generar Xml" : limitar_cadena(venta.Xmldescripcion, 90, '...')) + '</p>';

                            tbody.append('<tr>' +
                                ' <td class="text-center">' + (count + ((paginacion - 1) * filasPorPagina)) + '</td >' +
                                ' <td class="text-center">' + anular + '</td>' +
                                ' <td class="text-center">' + pdf + '</td>' +
                                ' <td class="text-centerr">' + ver + '</td>' +
                                ' <td class="text-left">' + datetime + '</td>' +
                                ' <td class="text-left">' + comprobante + '</td>' +
                                ' <td class="text-left">' + cliente + '</td>' +
                                ' <td class="text-center">' + estado + '</td>' +
                                ' <td class="text-right">' + total + '</td>' +
                                ' <td class="text-center">' + estadosunat + '</td>' +
                                ' <td class="text-left">' + descripcion + '</td>' +
                                '</tr >');
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
                        state = false;
                    }
                } catch (error) {
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
                    tbody.append('<tr><td class="text-center" colspan="11"><p>' + error.responseText + '</p></td></tr>');
                    state = false;
                }
            }

            async function opeModalDetalle(tipo, idComprobante) {
                $("#id-modal-productos").modal("show");
                $("#btnCloseModal").unbind();
                $("#btnCloseModal").bind("click", function(event) {
                    $("#id-modal-productos").modal("hide");
                });

                $("#btnCloseModal").bind("keypress", function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").modal("hide");
                        event.preventDefault();
                    }
                });

                let thComprobante = $("#thComprobante");
                let thCliente = $("#thCliente");
                let thFechaHora = $("#thFechaHora");
                let thEstado = $("#thEstado");
                let thTotal = $("#thTotal");
                let tbIngresosDetalle = $("#tbIngresosDetalle");

                let url = "../app/controller/VentaController.php";
                let type = tipo == "v" ? {
                    "type": "ventadetalle",
                    "idVenta": idComprobante
                } : {
                    "type": "notacreditotalle",
                    "idNotaCredito": idComprobante
                };
                try {
                    let result = await tools.promiseFetchGet(url, type, function() {
                        tbIngresosDetalle.empty();
                        tbIngresosDetalle.append('<tr><td class="text-center" colspan="7"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                    });

                    if (tipo == "v") {
                        let venta = result.venta;
                        let detalle = result.ventadetalle;

                        thComprobante.html(venta.Comprobante + "<br> " + venta.Serie + "-" + venta.Numeracion);
                        thCliente.html(venta.NumeroDocumento + "<br>" + venta.Informacion);
                        thFechaHora.html(tools.getDateForma(venta.FechaVenta) + " - " + tools.getTimeForma24(venta.HoraVenta));


                        let total = 0;
                        tbIngresosDetalle.empty();
                        for (let value of detalle) {
                            let num = value.id;
                            let descripcion = value.Clave + "<br>" + value.NombreMarca;
                            let cantidad = value.Cantidad;
                            let impuesto = value.NombreImpuesto;
                            let precio = value.PrecioVenta;
                            let descuento = value.Descuento;
                            let importe = cantidad * (precio - descuento);
                            tbIngresosDetalle.append('<tr>' +
                                '<td>' + num + '</td>' +
                                '<td class="td-left">' + descripcion + '</td>' +
                                '<td>' + tools.formatMoney(cantidad) + "<br>" + value.UnidadCompra + '</td>' +
                                '<td>' + impuesto + '</td>' +
                                '<td>' + tools.formatMoney(precio) + '</td>' +
                                '<td>' + tools.formatMoney(descuento) + '</td>' +
                                '<td>' + tools.formatMoney(importe) + '</td>' +
                                '</tr>');
                            total += parseFloat(importe);
                        }

                        thTotal.html(venta.Simbolo + " " + tools.formatMoney(total));

                    } else {
                        let nota = result.nota;
                        let detalle = result.notadetalle;

                        thComprobante.html(nota.NotaCreditoComprobante + "<br> " + nota.SerieNotaCredito + "-" + nota.NumeracioNotaCredito);
                        thCliente.html(nota.NumeroDocumento + "<br>" + nota.Informacion);
                        thFechaHora.html(tools.getDateForma(nota.FechaRegistro) + " - " + tools.getTimeForma24(nota.HoraRegistro));

                        let total = 0;
                        tbIngresosDetalle.empty();
                        for (let value of detalle) {
                            let num = value.id;
                            let descripcion = value.Clave + "<br>" + value.NombreMarca;
                            let cantidad = value.Cantidad;
                            let impuesto = value.NombreImpuesto;
                            let precio = value.Precio;
                            let descuento = value.Descuento;
                            let importe = cantidad * (precio - descuento);

                            tbIngresosDetalle.append('<tr>' +
                                '<td>' + num + '</td>' +
                                '<td class="td-left">' + descripcion + '</td>' +
                                '<td>' + tools.formatMoney(cantidad) + "<br>" + value.Unidad + '</td>' +
                                '<td>' + impuesto + '</td>' +
                                '<td>' + tools.formatMoney(precio) + '</td>' +
                                '<td>' + tools.formatMoney(descuento) + '</td>' +
                                '<td>' + tools.formatMoney(importe) + '</td>' +
                                '</tr>');
                            total += parseFloat(importe);
                        }

                        thTotal.html(nota.Simbolo + " " + tools.formatMoney(total));
                    }
                } catch (error) {
                    tbIngresosDetalle.empty();
                    tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><p>' + error.responseText + '</p></td></tr>');
                }

            }

            function firmarXml(tipo, idComprobante) {
                if (tipo == "v") {
                    firmarXmlBoleta(idComprobante);
                } else if (tipo == "nc") {
                    firmarXmlNotaCredito(idComprobante);
                } else {
                    firmarXmlGuiaRemision(idComprobante);
                }
            }

            function firmarXmlBoleta(idventa) {
                tools.ModalDialog("Factura/Boleta", "¿Está seguro de enviar la boleta/factura?", async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchGet("../app/examples/boleta.php", {
                                "idventa": idventa
                            }, function() {
                                tools.ModalAlertInfo("Factura/Boleta", "Firmando xml y enviando a la sunat.");
                            });

                            let object = result;
                            if (object.state === true) {
                                if (object.accept === true) {
                                    tools.ModalAlertSuccess("Factura/Boleta", "Código " + object.code + " " + object.description);
                                    onEventPaginacion();
                                } else {
                                    tools.ModalAlertWarning("Factura/Boleta", "Código " + object.code + " " + object.description);
                                }
                            } else {
                                tools.ModalAlertWarning("Factura/Boleta", "Código " + object.code + " " + object.description);
                            }
                        } catch (error) {
                            let message = error.responseJSON != undefined ? error.responseJSON["message"] : "Se produjo un error interno, intente nuevamente por favor.";
                            tools.ModalAlertWarning("Factura/Boleta", message);
                        }
                    }
                });
            }

            function firmarXmlNotaCredito(idNotaCredito) {
                tools.ModalDialog("Nota de Crédito", "¿Está seguro de enviar la nota de crédito?", async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchGet("../app/examples/notacredito.php", {
                                "idNotaCredito": idNotaCredito
                            }, function() {
                                tools.ModalAlertInfo("Nota de Crédito", "Firmando xml y enviando a la sunat.");
                            });

                            let object = result;
                            if (object.state === true) {
                                if (object.accept === true) {
                                    tools.ModalAlertSuccess("Nota de Crédito", "Código " + object.code + " " + object.description);
                                    onEventPaginacion();
                                } else {
                                    tools.ModalAlertWarning("Nota de Crédito", "Código " + object.code + " " + object.description);
                                }
                            } else {
                                tools.ModalAlertWarning("Nota de Crédito", "Código " + object.code + " " + object.description);
                            }
                        } catch (error) {
                            let message = error.responseJSON != undefined ? error.responseJSON["message"] : "Se produjo un error interno, intente nuevamente por favor.";
                            tools.ModalAlertWarning("Nota de Crédito", message);
                        }
                    }
                });
            }

            function firmarXmlGuiaRemision(IdGuiaRemision) {
                tools.ModalDialog("Guía remisión", "¿Está seguro de enviar la guía de remisión?", async function(value) {
                    if (value == true) {
                        try {
                            const result = await tools.promiseFetchGet("../app/examples/guiaremision.php", {
                                "idGuiaRemision": IdGuiaRemision
                            }, function() {
                                tools.ModalAlertInfo("Guía remisión", "Firmando xml y enviando a la sunat.");
                            });

                            const object = result;
                            if (object.state === true) {
                                if (object.accept === true) {
                                    tools.ModalAlertSuccess("Guía remisión", "Código " + object.code + " " + object.description);
                                    onEventPaginacion();
                                } else {
                                    tools.ModalAlertWarning("Guía remisión", "Código " + object.code + " " + object.description);
                                }
                            } else {
                                tools.ModalAlertWarning("Guía remisión", "Código " + object.code + " " + object.description);
                            }
                        } catch (error) {
                            let message = error.responseJSON != undefined ? error.responseJSON["message"] : "Se produjo un error interno, intente nuevamente por favor.";
                            tools.ModalAlertWarning("Guía remisión", message);
                        }
                    }
                });
            }

            function resumenDiarioXml(idventa, comprobante, resumen) {
                tools.ModalDialog("Resumen díario", "¿Se anulará el documento: " + comprobante + ", y se creará el siguiente resumen individual: RC-" + resumen + "-1, estás seguro de anular el documento? los cambios no se podrán revertir!", async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchGet("../app/examples/resumen.php", {
                                "idventa": idventa
                            }, function() {
                                tools.ModalAlertInfo("Resumen díario", "Firmando xml y enviando a la sunat.");
                            });

                            let object = result;
                            if (object.state === true) {
                                if (object.accept === true) {
                                    tools.ModalAlertSuccess("Resumen díario", "Código " + object.code + " " + object.description);
                                    onEventPaginacion();
                                } else {
                                    tools.ModalAlertWarning("Resumen díario", "Código " + object.code + " " + object.description);
                                }
                            } else {
                                tools.ModalAlertWarning("Resumen díario", "Código " + object.code + " " + object.description);
                            }
                        } catch (error) {
                            let message = error.responseJSON != undefined ? error.responseJSON["message"] : "Se produjo un error interno, intente nuevamente por favor.";
                            tools.ModalAlertWarning("Resumen díario", message);
                        }
                    }
                });
            }

            function comunicacionBajaXml(idventa, comprobante) {
                tools.ModalDialog("Comunicación de baja", "¿Se anulará el documento " + comprobante + "?", async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchGet("../app/examples/comunicacionbaja.php", {
                                "idventa": idventa
                            }, function() {
                                tools.ModalAlertInfo("Comunicación de baja", "Firmando xml y enviando a la sunat.");
                            });

                            let object = result;
                            if (object.state === true) {
                                if (object.accept === true) {
                                    tools.ModalAlertSuccess("Comunicación de baja", "Código " + object.code + " " + object.description);
                                    onEventPaginacion();
                                } else {
                                    tools.ModalAlertWarning("Comunicación de baja", "Código " + object.code + " " + object.description);
                                }
                            } else {
                                tools.ModalAlertWarning("Comunicación de baja", "Código " + object.code + " " + object.description);
                            }
                        } catch (error) {
                            let message = error.responseJSON != undefined ? error.responseJSON["message"] : "Se produjo un error interno, intente nuevamente por favor.";
                            tools.ModalAlertWarning("Comunicación de baja", message);
                        }
                    }
                });
            }

            async function onEventEnvioMasivo() {
                tools.ModalDialog("Comprobantes", "¿Está seguro de continuar con el envío?", async function(value) {
                    if (value == true) {
                        tools.ModalAlertInfo("Comprobantes", "Firmando xml y enviando a la sunat.");
                        for (let value of arrayVentas) {
                            if (value.Tipo == "v") {
                                if (value.Xmlsunat !== "0") {
                                    try {
                                        await tools.promiseFetchGet("../app/examples/boleta.php", {
                                            "idventa": value.IdComprobante
                                        });
                                    } catch (error) {

                                    }
                                } else {
                                    if (value.Estado == "3") {
                                        if (value.Xmlsunat == "1032") {
                                            if (value.Serie.toUpperCase().includes("B")) {
                                                try {
                                                    await tools.promiseFetchGet("../app/examples/resumen.php", {
                                                        "idventa": value.IdComprobante
                                                    });
                                                } catch (error) {}
                                            } else if (value.Serie.toUpperCase().includes("F")) {
                                                try {
                                                    await tools.promiseFetchGet("../app/examples/comunicacionbaja.php", {
                                                        "idventa": value.IdComprobante
                                                    });
                                                } catch (error) {

                                                }
                                            }
                                        }
                                    }
                                }
                            } else if (value.Tipo == "nc") {
                                if (value.Xmlsunat !== "0") {
                                    try {
                                        await tools.promiseFetchGet("../app/examples/notacredito.php", {
                                            "idNotaCredito": value.IdComprobante
                                        });
                                    } catch (error) {

                                    }
                                }
                            } else {
                                if (value.Xmlsunat !== "0") {
                                    try {
                                        await tools.promiseFetchGet("../app/examples/guiaremision.php", {
                                            "idGuiaRemision": value.IdGuiaRemision
                                        });
                                    } catch (error) {

                                    }
                                }
                            }
                        }
                        tools.ModalAlertSuccess("Ingreso", "Se completo el envío de comprobantes, revise para verificar el envió.");
                        onEventPaginacion();
                    }
                });
            }

            function openPdf(tipo, idComprobante) {
                if (tipo == "v") {
                    window.open("../app/sunat/pdfventaA4.php?idVenta=" + idComprobante, "_blank");

                } else if (tipo == "nc") {
                    window.open("../app/sunat/pdfnotacreditoA4.php?idNotaCredito=" + idComprobante, "_blank");
                } else {

                }
            }

            function limitar_cadena(cadena, limite, sufijo) {
                if (cadena.length > limite) {
                    return cadena.substr(0, limite) + sufijo;
                }
                return cadena;
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
