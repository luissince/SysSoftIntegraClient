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

        <!-- Modal del detalle de la compra -->
        <div class="row">
            <div class="modal fade" id="modalCompraDetalle" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-indent">
                                </i> Detalle de la compra</h4>
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
                                                    <th class="text-left border-0 p-1" id="thEstado">--</th>
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
        <!-- Modal del detalle de la cmmpra -->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Compras <small>Lista</small></h1>
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
                            <a href="compraproceso.php" class=" btn btn-primary">
                                <i class="fa fa-plus"></i> Nueva Compra
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
                        <label><img src="./images/recibo.png" width="22" height="22"> Comprobantes:</label>
                        <div class="form-group">
                            <select id="cbComprobante" class="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
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
                        <label><img src="./images/search.png" width="22" height="22"> Buscar por Proveedor o Serie/Numeración:</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtBuscar">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="btnBuscar">Buscar</button>
                                </div>
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
                                        <th style="width:15%;">Proveedor</th>
                                        <th style="width:15%;">Comprobante</th>
                                        <th style="width:10%;">Tipo</th>
                                        <th style="width:10%;">Estado</th>
                                        <th style="width:10%;">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="10" class="text-center">!Aún no has registrado ninguna compra</td>
                                    </tr>
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
            let ulPagination = $("#ulPagination");

            $(document).ready(function() {

                    $("#btnReload").click(function() {
                        loadInitCompra();
                    });

                    tools.keyEnter($("#btnReload"), function() {
                        loadInitCompra();
                    });

                    $("#txtFechaInicial").val(tools.getCurrentDate());
                    $("#txtFechaFinal").val(tools.getCurrentDate());

                    $("#txtFechaInicial").on("change", function() {
                        let fechaInicial = $("#txtFechaInicial").val();
                        let fechaFinal = $("#txtFechaFinal").val();
                        if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                            if (!state) {
                                paginacion = 1;
                                fillTableCompra(2, "", fechaInicial, fechaFinal, $("#cbComprobante").val(), $("#cbEstado").val());
                                opcion = 2;
                            }
                        }
                    });

                    $("#txtFechaFinal").on("change", function() {
                        let fechaInicial = $("#txtFechaInicial").val();
                        let fechaFinal = $("#txtFechaFinal").val();
                        if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                            if (!state) {
                                paginacion = 1;
                                fillTableCompra(2, "", fechaInicial, fechaFinal, $("#cbComprobante").val(), $("#cbEstado").val());
                                opcion = 2;
                            }
                        }
                    });

                    $("#cbComprobante").on("change", function() {
                        let fechaInicial = $("#txtFechaInicial").val();
                        let fechaFinal = $("#txtFechaFinal").val();
                        if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                            if (!state) {
                                paginacion = 1;
                                fillTableCompra(2, "", fechaInicial, fechaFinal, $("#cbComprobante").val(), $("#cbEstado").val());
                                opcion = 2;
                            }
                        }
                    });

                    $("#cbEstado").on("change", function() {
                        let fechaInicial = $("#txtFechaInicial").val();
                        let fechaFinal = $("#txtFechaFinal").val();
                        if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                            if (!state) {
                                paginacion = 1;
                                fillTableCompra(2, "", fechaInicial, fechaFinal, $("#cbComprobante").val(), $("#cbEstado").val());
                                opcion = 2;
                            }
                        }
                    });

                    $("#txtBuscar").on("keyup", function(event) {
                        let value = $("#txtBuscar").val();
                        if (event.keyCode !== 9 && event.keyCode !== 18) {
                            if (value.trim().length != 0) {
                                if (!state) {
                                    paginacion = 1;
                                    fillTableCompra(1, value.trim(), "", "", 0, 0);
                                    opcion = 1;
                                }
                            }
                        }
                    });

                    $("#btnBuscar").click(function() {
                        let value = $("#txtBuscar").val();
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillTableCompra(1, value.trim(), "", "", 0, 0);
                                opcion = 1;
                            }
                        }
                    });

                    tools.keyEnter($("#btnBuscar"), function() {
                        let value = $("#txtBuscar").val();
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillTableCompra(1, value.trim(), "", "", 0, 0);
                                opcion = 1;
                            }
                        }
                    });

                    loadDataInit();
            });

            async function loadDataInit() {
                try {
                    $("#cbComprobante").empty();
                    $("#cbEstado").empty();

                    let comprobante = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailname",
                        "value1": "2",
                        "value2": "0015",
                        "value3": "",
                    });

                    $("#cbComprobante").append('<option value="0">TODOS</option>');
                    for (let value of comprobante) {
                        $("#cbComprobante").append(`<option value="${value.IdDetalle}">${value.Nombre}</option>`);
                    }

                    $("#cbEstado").append('<option value="0">TODOS</option>');
                    $("#cbEstado").append('<option value="1">PAGADO</option>');
                    $("#cbEstado").append('<option value="2">POR PAGAR</option>');
                    $("#cbEstado").append('<option value="3">ANULADO</option>');
                    $("#cbEstado").val("0");

                    $("#divOverlayVentas").addClass("d-none");
                    loadInitCompra();
                } catch (error) {
                    $("#lblTextOverlayVentas").html(tools.messageError(error));
                }
            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillTableCompra(0, "", "", "", 0, 0);
                        break;
                    case 1:
                        fillTableCompra(1, $("#txtBuscar").val().trim(), "", "", 0, 0);
                        break;
                    case 2:
                        fillTableCompra(2, "",
                            $("#txtFechaInicial").val(),
                            $("#txtFechaFinal").val(),
                            $("#cbComprobante").val(),
                            $("#cbEstado").val());
                        break;
                }
            }

            function loadInitCompra() {
                if (!state) {
                    paginacion = 1;
                    fillTableCompra(0, "", "", "", 0, 0);
                    opcion = 0;
                }
            }

            async function fillTableCompra(opcion, buscar, fechaInicial, fechaFinal, comprobante, estado) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/ComprasController.php", {
                        "type": "all",
                        "opcion": opcion,
                        "buscar": buscar,
                        "fechaInicio": fechaInicial,
                        "fechaFinal": fechaFinal,
                        "comprobante": comprobante,
                        "estado": estado,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tools.loadTable(tbody, 10);
                        totalPaginacion = 0;
                        state = true;
                    });

                    if (result.data.length == 0) {
                        tools.loadTableMessage(tbody, "No hay datos para mostrar.", 10, true);
                        tools.paginationEmpty(ulPagination);
                        totalPaginacion = 0;
                        state = false;
                    } else {
                        tbody.empty();
                        for (let value of result.data) {
                            let anular = '<button class="btn btn-danger" onclick="anularCompra(\'' + value.IdCompra + '\')"><i class="fa fa-ban"></i></button>';
                            let pdf = '<button class="btn btn-secondary btn-sm"  onclick="openPdf(\'' + value.IdCompra + '\')"><img src="./images/pdf.svg" width="26" /> </button>';
                            let ver = '<button class="btn btn-secondary btn-sm" onclick="opeModalDetalleCompra(\'' + value.IdCompra + '\')"><img src="./images/file.svg" width="26" /></button>';

                            let datetime = tools.getDateForma(value.FechaCompra) + "<br>" + tools.getTimeForma24(value.HoraCompra, true);

                            let estado = "";
                            if (value.EstadoCompra == 3) {
                                estado = '<div class="badge badge-danger">ANULADO</div>';
                            } else if (value.EstadoCompra == 2) {
                                estado = '<div class="badge badge-warning">POR PAGAR</div>';
                            } else {
                                estado = '<div class="badge badge-success">PAGADO</div>';
                            }

                            tbody.append(`<tr>
                                <td class="text-center">${value.Id}</td>
                                <td class="text-center">${anular}</td>
                                <td class="text-center">${pdf}</td>
                                <td class="text-center">${ver}</td>
                                <td class="text-left">${datetime}</td>
                                <td class="text-left">${value.NumeroDocumento+"<br>"+value.RazonSocial}</td>
                                <td class="text-left">${value.Comprobante+"<br>"+value.Serie+"-"+value.Numeracion}</td>
                                <td class="text-center">${value.Tipo}</td>
                                <td class="text-center">${estado}</td>
                                <td class="text-right">${value.Simbolo+" "+tools.formatMoney(value.Total)}</td>
                            </tr>`);
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
                    tools.loadTableMessage(tbody, tools.messageError(error), 10, true);
                    tools.paginationEmpty(ulPagination);
                    state = false;
                }
            }

            function anularCompra(idCompra) {

            }

            function openPdf(idCompra) {

            }

            function opeModalDetalleCompra(idCompra) {
                $("#modalCompraDetalle").modal("show");
            }
        </script>
    </body>

    </html>

<?php

}
