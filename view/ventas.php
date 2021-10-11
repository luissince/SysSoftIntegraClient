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
                            <h4 class="modal-title"><i class="fa fa-indent">
                                </i> Detalle de la venta</h4>
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
        <!--   Modal del detalle de ingreso -->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Comprobantes <small>Lista</small></h1>
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
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <h4> Resumen de documentos emitidos</h4>
                        </div>
                    </div>
                    <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group text-primary">
                            <h4 id="lblTotalVenta">Total de venta por Fecha:&nbsp; S/ 0.00</h4>
                        </div>
                    </div> -->
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
                        <label>Fecha de Inicio:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaInicial" />
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Fecha de Fin:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaFinal" />
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Comprobantes:</label>
                        <div class="form-group">
                            <select id="cbComprobante" class="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <label>Estado:</label>
                        <div class="form-group">
                            <select id="cbEstado" class="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
                        <label>Buscar:</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger" id="btnReload"><i class="fa fa-refresh"></i> Recargar</button>
                                </div>
                                <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtSearch">
                            </div>
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

                    <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label>Paginación:</label>
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
            // let lblTotalVenta = $("#lblTotalVenta");

            $(document).ready(function() {

                $("#txtFechaInicial").val(tools.getCurrentDate());
                $("#txtFechaFinal").val(tools.getCurrentDate());

                $("#txtFechaInicial").on("change", function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    let comprobante = $("#cbComprobante").val();
                    let estadoVenta = $("#cbEstado").val();
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estadoVenta);
                        opcion = 1;
                    }
                });

                $("#txtFechaFinal").on("change", function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    let comprobante = $("#cbComprobante").val();
                    let estadoVenta = $("#cbEstado").val();
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estadoVenta);
                        opcion = 1;
                    }
                });

                $("#cbComprobante").change(function(event) {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    let comprobante = $("#cbComprobante").val();
                    let estadoVenta = $("#cbEstado").val();
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estadoVenta);
                        opcion = 1;
                    }
                });

                $("#cbEstado").change(function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    let comprobante = $("#cbComprobante").val();
                    let estadoVenta = $("#cbEstado").val();
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estadoVenta);
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
                    $("#cbEstado").empty();
                    $("#cbComprobante").empty();

                    let promiseFetchComprobante = tools.promiseFetchGet(
                        "../app/controller/TipoDocumentoController.php", {
                            "type": "getdocumentocomboboxventas"
                        }
                    );

                    let promiseFetchEstado = tools.promiseFetchGet(
                        "../app/controller/DetalleController.php", {
                            "type": "detailname",
                            "value1": "2",
                            "value2": "0009",
                            "value3": "",
                        }
                    );

                    let promise = await Promise.all([promiseFetchComprobante, promiseFetchEstado]);
                    let result = await promise;

                    let comprobante = result[0];
                    if (comprobante.estado === 1) {
                        $("#cbComprobante").append('<option value="0">TODOS</option>');
                        for (let value of comprobante.data) {
                            $("#cbComprobante").append('<option value="' + value.IdTipoDocumento + '">' + value.Nombre + ' </option>');
                        }
                    } else {
                        $("#cbComprobante").append('<option value="0">TODOS</option>');
                    }

                    let estado = result[1];
                    if (estado.estado === 1) {
                        $("#cbEstado").append('<option value="0">TODOS</option>');
                        for (let value of estado.data) {
                            $("#cbEstado").append('<option value="' + value.IdDetalle + '">' + value.Nombre + ' </option>');
                        }
                    } else {
                        $("#cbEstado").append('<option value="0">TODOS</option>');
                    }

                    $("#divOverlayVentas").addClass("d-none");
                    loadInitVentas();
                } catch (error) {
                    $("#lblTextOverlayVentas").html(error.message);
                }
            }

            function onEventPaginacion() {
                let fechaInicial = $("#txtFechaInicial").val();
                let fechaFinal = $("#txtFechaFinal").val();
                let value = $("#txtSearch").val();
                let comprobante = $('#cbComprobante').children('option').length > 0 && $("#cbComprobante").val() != "" ? $("#cbComprobante").val() : 0;
                let estadoVenta = $('#cbEstado').children('option').length > 0 && $("#cbEstado").val() != "" ? $("#cbEstado").val() : 0;
                switch (opcion) {
                    case 0:
                        fillVentasTable(0, "", "", "", 0, 0);
                        break;
                    case 1:
                        fillVentasTable(1, "", fechaInicial, fechaFinal, comprobante, estadoVenta);
                        break;
                    case 2:
                        fillVentasTable(2, value.trim(), "", "", 0, 0);
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

            function fillVentasTable(opcion, busqueda, fechaInicial, fechaFinal, comprobante, estado) {
                tools.promiseFetchGet(
                    "../app/controller/VentaController.php", {
                        "type": "venta",
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
                ).then(result => {
                    let object = result;
                    if (object.estado === 1) {
                        arrayVentas = object.data;
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
                            // lblTotalVenta.html("Total de venta por Fecha:&nbsp; S/ " + tools.formatMoney(parseFloat(object.suma)));
                            state = false;
                        } else {
                            for (let venta of arrayVentas) {
                                let pdf = '<button class="btn btn-secondary btn-sm"  onclick="openPdf(\'' + venta.IdVenta + '\')"><img src="./images/pdf.svg" width="26" /> </button>';
                                let ver = '<button class="btn btn-secondary btn-sm" onclick="opeModalDetalleIngreso(\'' + venta.IdVenta + '\')"><img src="./images/file.svg" width="26" /></button>';
                                let resumen = '<button class="btn btn-secondary btn-sm" onclick="resumenDiarioXml(\'' + venta.IdVenta + '\',\'' + venta.Serie + "-" + venta.Numeracion + '\',\'' + tools.getDateYYMMDD(venta.FechaVenta) + '\')"><img src="./images/documentoanular.svg" width="26" /></button>';
                                let comunicacion = '<button class="btn btn-secondary btn-sm" onclick="comunicacionBajaXml(\'' + venta.IdVenta + '\',\'' + venta.Serie + "-" + venta.Numeracion + '\')"><img src="./images/documentoanular.svg" width="26" /></button>';
                                let anular = venta.Serie.toUpperCase().includes("B") ? resumen : comunicacion;

                                let datetime = tools.getDateForma(venta.FechaVenta) + "<br>" + tools.getTimeForma24(venta.HoraVenta, true);
                                let comprobante = venta.Comprobante + " <br/>" + (venta.Serie + "-" + venta.Numeracion) + (venta.IdNotaCredito == 1 ? " <span class='text-danger'>" + "Modificado(" + venta.SerieNotaCredito + "-" + venta.NumeracionNotaCredito + ")</span>" : "");
                                let cliente = venta.DocumentoCliente + "<br>" + venta.Cliente;
                                let estado = "";

                                if (venta.Estado == 3) {
                                    estado = '<div class="badge badge-danger">ANULADO</div>';
                                } else if (venta.Tipo == 2 && venta.Estado == 2) {
                                    estado = '<div class="badge badge-warning">POR COBRAR</div>';
                                } else if (venta.Tipo == 1 && venta.Estado == 4) {
                                    estado = '<div class="badge badge-primary">POR LLEVAR</div>';
                                } else {
                                    estado = '<div class="badge badge-success">COBRADO</div>';
                                }

                                let total = venta.Simbolo + " " + tools.formatMoney(venta.Total);

                                let estadosunat = venta.Estado == 3 ?
                                    ('<button class="btn btn-secondary btn-sm" onclick="firmarXml(\'' + venta.IdVenta + '\')"><img src="./images/error.svg" width="26" /></button>') :
                                    (venta.Xmlsunat === "" ?
                                        '<button class="btn btn-secondary btn-sm" onclick="firmarXml(\'' + venta.IdVenta + '\')"><img src="./images/reuse.svg" width="26"/></button>' :
                                        venta.Xmlsunat === "0" ?
                                        '<button class="btn btn-secondary btn-sm"><img src="./images/accept.svg" width="26" /></button>' :
                                        '<button class="btn btn-secondary btn-sm" onclick="firmarXml(\'' + venta.IdVenta + '\')"><img src="./images/unable.svg" width="26" /></button>'
                                    );

                                let descripcion = '<p class="recortar-texto">' + (venta.Xmldescripcion === "" ? "Por Generar Xml" : venta.Xmldescripcion) + '</p>';

                                tbody.append('<tr>' +
                                    ' <td class="text-center">' + venta.id + '</td >' +
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

                            totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));

                            let i = 1;
                            let range = [];
                            while (i <= totalPaginacion) {
                                range.push(i);
                                i++;
                            }

                            let min = Math.min.apply(null, range);
                            let max = Math.max.apply(null, range);

                            // lblTotalVenta.html("Total de venta por Fecha:&nbsp; S/ " + tools.formatMoney(parseFloat(object.suma)));

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
                            // range.forEach(e => {
                            //     if (e === min || e === max) {
                            //         if (e === min) {
                            //             paginacionHtml += `                                         
                            //                 <li class="page-item">
                            //                     <button class="page-link" onclick="onEventAnteriorPaginacion()"><i class="fa fa-angle-double-left "></i></button>
                            //                 </li> 
                            //                 <li class="page-item ${e == paginacion?"active":""}">
                            //                         <button class="page-link" onclick="onEventPaginacionInicio(${e})">${e}</button>
                            //                 </li>
                            //                 `;
                            //         } else {
                            //             paginacionHtml += `                                            
                            //                 <li class="page-item ${e == paginacion?"active":""} ">
                            //                         <button class="page-link" onclick="onEventPaginacionFinal(${e})">${e}</button>
                            //                 </li>      
                            //                 <li class="page-item">
                            //                     <button class="page-link" onclick="onEventSiguientePaginacion()"><i class="fa fa-angle-double-right "></i></button>
                            //                 </li>                                  
                            //                 `;
                            //         }
                            //     } else {
                            //         paginacionHtml += `
                            //                 <li class="page-item ${e == paginacion?"active":""}">
                            //                     <button class="page-link">${e}</button>
                            //                 </li>`;
                            //     }
                            // });

                            ulPagination.html(paginacionHtml);
                            state = false;
                        }
                    } else {
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
                        tbody.append('<tr><td class="text-center" colspan="11"><p>' + object.message + '</p></td></tr>');
                        // lblTotalVenta.html("S/ " + tools.formatMoney(parseFloat(0)));
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
                    tbody.append('<tr><td class="text-center" colspan="11"><p>' + error.responseText + '</p></td></tr>');
                    // lblTotalVenta.html("S/ " + tools.formatMoney(parseFloat(0)));
                    state = false;
                });
            }

            function opeModalDetalleIngreso(idVenta) {
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
                $.ajax({
                    url: "../app/controller/VentaController.php",
                    method: "GET",
                    data: {
                        "type": "allventa",
                        idVenta: idVenta
                    },
                    beforeSend: function() {
                        tbIngresosDetalle.empty();
                        tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                    },
                    success: function(result) {
                        let object = result;
                        if (object.estado == 1) {
                            tbIngresosDetalle.empty();
                            let venta = object.venta;
                            thComprobante.html(venta.Serie + "-" + venta.Numeracion);
                            thCliente.html(venta.NumeroDocumento + " - " + venta.Informacion);
                            thFechaHora.html(tools.getDateForma(venta.FechaVenta) + " - " + tools.getTimeForma24(venta.HoraVenta));
                            thEstado.html(venta.Estado == 3 ? "ANULADO" : venta.Estado == 2 ? "POR COBRAR" : "COBRADO");
                            thEstado.removeClass();
                            thEstado.addClass(venta.Estado == 3 ? "text-left text-danger border-0 p-1" : "text-left text-success border-0 p-1");
                            let detalleventa = object.ventadetalle;
                            let total = 0;
                            for (let venta of detalleventa) {
                                let num = venta.id;
                                let descripcion = venta.Clave + "<br>" + venta.NombreMarca;
                                let cantidad = venta.Cantidad;
                                let impuesto = venta.NombreImpuesto;
                                let precio = venta.PrecioVenta;
                                let descuento = venta.Descuento;
                                let importe = cantidad * precio;
                                tbIngresosDetalle.append('<tr>' +
                                    '<td>' + num + '</td>' +
                                    '<td class="td-left">' + descripcion + '</td>' +
                                    '<td>' + tools.formatMoney(cantidad) + "<br>" + venta.UnidadCompra + '</td>' +
                                    '<td>' + impuesto + '</td>' +
                                    '<td>' + tools.formatMoney(precio) + '</td>' +
                                    '<td>' + tools.formatMoney(descuento) + '</td>' +
                                    '<td>' + tools.formatMoney(importe) + '</td>' +
                                    '</tr>');
                                total += parseFloat(importe);
                            }
                            thTotal.html(venta.Simbolo + " " + tools.formatMoney(total));
                        } else {
                            tbIngresosDetalle.empty();
                            tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><p>' + object.message + '</p></td></tr>');
                        }
                    },
                    error: function(error) {
                        tbIngresosDetalle.empty();
                        tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><p>' + error.responseText + '</p></td></tr>');
                    }
                });
            }

            function firmarXml(idventa) {
                tools.ModalDialog("Ventas", "¿Está seguro de enviar el documento?", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/examples/boleta.php",
                            method: "GET",
                            data: {
                                idventa: idventa
                            },
                            beforeSend: function() {
                                tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                            },
                            success: function(result) {
                                let object = result;
                                if (object.state === true) {
                                    if (object.accept === true) {
                                        tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                        onEventPaginacion();
                                    } else {
                                        tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                    }
                                } else {
                                    tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                }
                            },
                            error: function(error) {
                                // console.log(error);
                                tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                            }
                        });
                    }
                });
            }

            function resumenDiarioXml(idventa, comprobante, resumen) {
                tools.ModalDialog("Emitir resumen díario", "¿Se anulará el documento: " + comprobante + ", y se creará el siguiente resumen individual: RC-" + resumen + "-1, estás seguro de anular el documento? los cambios no se podrán revertir!", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/examples/resumen.php",
                            method: "GET",
                            data: {
                                idventa: idventa
                            },
                            beforeSend: function() {
                                tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                            },
                            success: function(result) {
                                // console.log(result)
                                let object = result;
                                if (object.state === true) {
                                    if (object.accept === true) {
                                        tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                        onEventPaginacion();
                                    } else {
                                        tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                    }
                                } else {
                                    tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                            }
                        });
                    }
                });
            }

            function comunicacionBajaXml(idventa, comprobante) {
                tools.ModalDialog("Emitir comunicación de baja", "¿Se anulará el documento " + comprobante + "?", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/examples/comunicacionbaja.php",
                            method: "GET",
                            data: {
                                idventa: idventa
                            },
                            beforeSend: function() {
                                tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                            },
                            success: function(result) {
                                let object = result;
                                if (object.state === true) {
                                    if (object.accept === true) {
                                        tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                        onEventPaginacion();
                                    } else {
                                        tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                    }
                                } else {
                                    tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                            }
                        });
                    }
                });
            }

            function firmarMasivaXml(idventa) {
                $.ajax({
                    url: "../app/examples/boleta.php",
                    method: "GET",
                    data: {
                        idventa: idventa
                    },
                    beforeSend: function() {
                        tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                    },
                    success: function(result) {
                        let object = result;
                        if (object.state === true) {
                            if (object.accept === true) {
                                tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                            } else {
                                tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                            }
                        } else {
                            tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                        }
                    },
                    error: function(error) {
                        tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                    }
                });
            }

            function resumenDiarioMasivoXml(idventa) {
                $.ajax({
                    url: "../app/examples/resumen.php",
                    method: "GET",
                    data: {
                        idventa: idventa
                    },
                    beforeSend: function() {
                        tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                    },
                    success: function(result) {
                        let object = result;
                        if (object.state === true) {
                            if (object.accept === true) {
                                tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                            } else {
                                tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                            }
                        } else {
                            tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                        }
                    },
                    error: function(error) {
                        tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                    }
                });
            }

            function comunicacionBajaMasivoXml(idventa) {
                $.ajax({
                    url: "../app/examples/comunicacionbaja.php",
                    method: "GET",
                    data: {
                        idventa: idventa
                    },
                    beforeSend: function() {
                        tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                    },
                    success: function(result) {
                        let object = result;
                        if (object.state === true) {
                            if (object.accept === true) {
                                tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                            } else {
                                tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                            }
                        } else {
                            tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                        }
                    },
                    error: function(error) {
                        tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                    }
                });
            }

            function onEventEnvioMasivo() {
                tools.ModalDialog("Ventas", "¿Está seguro de continuar con el envío?", function(value) {
                    if (value == true) {
                        for (let venta of arrayVentas) {
                            if (venta.Estado !== "3") {
                                if (venta.Xmlsunat !== "0") {
                                    firmarMasivaXml(venta.IdVenta);
                                }
                            } else {
                                if (venta.Serie.toUpperCase().includes("B")) {
                                    resumenDiarioMasivoXml(venta.IdVenta);
                                } else if (venta.Serie.toUpperCase().includes("F")) {
                                    comunicacionBajaMasivoXml(venta.IdVenta);
                                }
                            }
                        }
                    }
                });
            }

            function openPdf(idVenta) {
                window.open("../app/sunat/pdfventas.php?idVenta=" + idVenta, "_blank");
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
