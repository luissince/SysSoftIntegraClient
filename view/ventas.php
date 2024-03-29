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
                <div class="modal-dialog modal-lg">
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
                                                    <th style="width:15%;">Bonificación</th>
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
                <h1><i class="fa fa-folder"></i> Ventas <small>Lista</small></h1>
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
                            <a href="puntoventa.php" class=" btn btn-primary">
                                <i class="fa fa-plus"></i> Nueva venta
                            </a>

                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i> Recargar
                            </button>
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
                        <label><img src="./images/information.svg" width="22" height="22"> Estado:</label>
                        <div class="form-group">
                            <select id="cbEstado" class="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/search.png" width="22" height="22"> Buscar:</label>
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
                        <label><img src="./images/cantidad.png" width="22" height="22"> Total de Ventas:</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">S/</span></div>
                                <div class="input-group-append"><span class="input-group-text" id="lblTotalVenta">0.00</span></div>
                            </div>
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
                                        <th style="width:10%;">Tipo</th>
                                        <th style="width:10%;">Metodo</th>
                                        <th style="width:10%;">Estado</th>
                                        <th style="width:10%;">Total</th>
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
            let lblTotalVenta = $("#lblTotalVenta");

            let empleado = "<?= $_SESSION["Apellidos"] . " " . $_SESSION["Nombres"]; ?>";

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

                $("#btnBuscar").click(function() {
                    let value = $("#txtSearch").val();
                    if (value.trim().length != 0) {
                        if (!state) {
                            paginacion = 1;
                            fillVentasTable(2, value.trim(), "", "", 0, 0);
                            opcion = 2;
                        }
                    }
                });

                tools.keyEnter($("#btnBuscar"), function() {
                    let value = $("#txtSearch").val();
                    if (value.trim().length != 0) {
                        if (!state) {
                            paginacion = 1;
                            fillVentasTable(2, value.trim(), "", "", 0, 0);
                            opcion = 2;
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

                loadDataInit();
            });

            async function loadDataInit() {
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
                    $("#cbComprobante").append('<option value="0">TODOS</option>');
                    for (let value of comprobante) {
                        $("#cbComprobante").append('<option value="' + value.IdTipoDocumento + '">' + value.Nombre + ' </option>');
                    }

                    let estado = result[1];
                    $("#cbEstado").append('<option value="0">TODOS</option>');
                    for (let value of estado) {
                        $("#cbEstado").append('<option value="' + value.IdDetalle + '">' + value.Nombre + ' </option>');
                    }

                    $("#divOverlayVentas").addClass("d-none");
                    loadInitVentas();
                } catch (error) {
                    $("#lblTextOverlayVentas").html(tools.messageError(error));
                }
            }

            function onEventPaginacion() {
                let fechaInicial = $("#txtFechaInicial").val();
                let fechaFinal = $("#txtFechaFinal").val();
                let value = $("#txtSearch").val();
                let comprobante = $('#cbComprobante').children('option').length > 0 && $("#cbComprobante").val() != "" ? $("#cbComprobante").val() : 0;
                let estadoVenta = $('#cbEstado').children('option').length > 0 && $("#cbEstado").val() != "" ? $("#cbEstado").val() : 0;
                switch (opcion) {
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
                    fillVentasTable(1, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val(), 0, 0);
                    opcion = 1;
                }
            }

            async function fillVentasTable(opcion, busqueda, fechaInicial, fechaFinal, comprobante, estado) {
                try {
                    let result = await tools.promiseFetchGet(
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
                            tools.loadTable(tbody, 11);
                            state = true;
                            totalPaginacion = 0;
                            arrayVentas = [];
                        }
                    );

                    let object = result;

                    arrayVentas = object.data;
                    tbody.empty();
                    if (arrayVentas.length == 0) {
                        tools.loadTableMessage(tbody, "No hay datos para mostrar.", 11);
                        tools.paginationEmpty(ulPagination);
                        lblTotalVenta.html(tools.formatMoney(parseFloat(object.suma)));
                        state = false;
                    } else {

                        for (let venta of arrayVentas) {
                            let anular = '<button class="btn btn-danger" onclick="anularVenta(\'' + venta.IdVenta + '\')"><i class="fa fa-ban"></i></button>';
                            let pdf = '<button class="btn btn-secondary btn-sm"  onclick="openPdf(\'' + venta.IdVenta + '\')"><img src="./images/pdf.svg" width="26" /> </button>';
                            let ver = '<button class="btn btn-secondary btn-sm" onclick="opeModalDetalleVenta(\'' + venta.IdVenta + '\')"><img src="./images/file.svg" width="26" /></button>';

                            let datetime = tools.getDateForma(venta.FechaVenta) + "<br>" + tools.getTimeForma24(venta.HoraVenta, true);
                            let comprobante = venta.Comprobante + " <br/>" + (venta.Serie + "-" + venta.Numeracion) + (venta.IdNotaCredito == 1 ? "<br> <span class='text-danger'>" + "Modificado(" + venta.SerieNotaCredito + "-" + venta.NumeracionNotaCredito + ")</span>" : "");
                            let cliente = venta.DocumentoCliente + "<br>" + venta.Cliente;
                            let estado = "";

                            if (venta.IdNotaCredito == 1) {
                                estado = '<div class="badge badge-danger">MODIFICADO</div>';
                            } else {
                                if (venta.Estado == 3) {
                                    estado = '<div class="badge badge-danger">ANULADO</div>';
                                } else if (venta.Tipo == 2 && venta.Estado == 2) {
                                    estado = '<div class="badge badge-warning">POR COBRAR</div>';
                                } else if (venta.Tipo == 1 && venta.Estado == 4) {
                                    estado = '<div class="badge badge-primary">POR LLEVAR</div>';
                                } else {
                                    estado = '<div class="badge badge-success">COBRADO</div>';
                                }
                            }

                            let tipo = venta.Tipo == "1" ? "CONTADO" : "CRÉDITO";

                            let total = venta.Simbolo + " " + tools.formatMoney(venta.Total);


                            tbody.append('<tr>' +
                                ' <td class="text-center">' + venta.id + '</td >' +
                                ' <td class="text-center">' + anular + '</td>' +
                                ' <td class="text-center">' + pdf + '</td>' +
                                ' <td class="text-centerr">' + ver + '</td>' +
                                ' <td class="text-left">' + datetime + '</td>' +
                                ' <td class="text-left">' + comprobante + '</td>' +
                                ' <td class="text-left">' + cliente + '</td>' +
                                ' <td class="text-center">' + tipo + '</td>' +
                                ' <td class="text-center">' + venta.FormaName + '</td>' +
                                ' <td class="text-center">' + estado + '</td>' +
                                ' <td class="text-right">' + total + '</td>' +
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

                        lblTotalVenta.html(tools.formatMoney(parseFloat(object.suma)));

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
                    tools.loadTableMessage(tbody, tools.messageError(error), 11, true);
                    tools.paginationEmpty(ulPagination);
                    lblTotalVenta.html(tools.formatMoney(parseFloat(0)));
                    state = false;
                }
            }

            function anularVenta(idVenta) {
                tools.ModalDialogInputText("Venta", '¿Está seguro de anular venta?', async function(value) {
                    if (value.dismiss == "cancel") {

                    } else if (value.value.length == 0) {
                        tools.ModalAlertWarning("Ingreso", "No ingreso ningún motivo :(");
                    } else {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/VentaController.php", {
                                "type": "anularventa",
                                "idVenta": idVenta,
                                "motivo": value.value.trim().toUpperCase(),
                                "empleado": empleado
                            }, function() {
                                tools.ModalAlertInfo("Venta", "Se está procesando la información.");
                            });

                            tools.ModalAlertSuccess("Venta", result, function() {
                                loadInitVentas();
                            });
                        } catch (error) {
                            tools.ErrorMessageServer("Venta", error);
                        }
                    }
                });
            }

            async function opeModalDetalleVenta(idVenta) {
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

                try {
                    let result = await tools.promiseFetchGet("../app/controller/VentaController.php", {
                        "type": "ventadetalle",
                        "idVenta": idVenta
                    }, function() {
                        tools.loadTable(tbIngresosDetalle, 7);
                    });

                    let object = result;

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
                        tbIngresosDetalle.append(`<tr>
                            <td>${ num }</td>
                            <td class="td-left">${ descripcion }</td>
                            <td>${ tools.formatMoney(cantidad) + "<br>" + venta.UnidadCompra }</td>
                            <td>${ tools.formatMoney(venta.Bonificacion) }</td>
                            <td>${ impuesto }</td>
                            <td>${ tools.formatMoney(precio) }</td>
                            <td>${ tools.formatMoney(descuento) }</td>
                            <td>${ tools.formatMoney(importe) }</td>
                            </tr>`);
                        total += parseFloat(importe);
                    }
                    thTotal.html(venta.Simbolo + " " + tools.formatMoney(total));

                } catch (error) {
                    tools.loadTableMessage(tbIngresosDetalle, tools.messageError(error), 7, true);
                }
            }

            function openPdf(idVenta) {
                window.open("../app/sunat/pdfventaA4.php?idVenta=" + idVenta, "_blank");
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
