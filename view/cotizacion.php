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
                                </i> Detalle de la Cotización</h4>
                            <button type="button" class="close" data-dismiss="modal">
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
                                                    <th class="text-left border-0 p-1">Cotización:</th>
                                                    <th class="text-left border-0 p-1" id="thCotizacion">--</th>
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
                                            <tbody id="tbCotizacionDetalle">
                                                <tr>
                                                    <td colspan="7" class="text-center">No hay datos para mostrar</td>
                                                </tr>
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
                            <a href="./cotizacionproceso.php" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Nuevo
                            </a>
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
                                        <th scope="col" width="5%">N°</th>
                                        <th scope="col" width="5%">Pdf</th>
                                        <th scope="col" width="15%">Fecha Registro</th>
                                        <th scope="col" width="20%">Cliente</th>
                                        <th scope="col" width="10%">Cotización</th>
                                        <th scope="col" width="15%">Observación</th>
                                        <th scope="col" width="10%">Uso</th>
                                        <th scope="col" width="10%">Total</th>
                                        <th scope="col" width="5%">Detalle</th>
                                        <th scope="col" width="5%">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td class="text-center" colspan="11">No hay datos para mostrar</td>
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
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if ($(this).val().trim() !== '') {
                            if (!state) {
                                paginacion = 1;
                                fillTableCotizacion(1, $(this).val().trim(), "", "");
                                opcion = 1;
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

                $("#btnBuscar").keyup(function(event) {
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

                $("#idModalCotizacion").on("hide.bs.modal", function() {
                    $("#thCotizacion").html("");
                    $("#thCliente").html("");
                    $("#thFechaHora").html("");
                    $("#thTotal").html("0.00");
                    $("#tbCotizacionDetalle").empty();
                    $("#tbCotizacionDetalle").append(`<tr><td colspan="7" class="text-center">No hay datos para mostrar</td></tr>`);
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

            async function fillTableCotizacion(opcion, buscar, fechaInicial, fechaFinal) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/CotizacionController.php", {
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
                            tools.loadTable(tbody, 11);
                            state = true;
                            totalPaginacion = 0;
                            arrayVentas = [];
                        }
                    );

                    tbody.empty();
                    if (result.data.length == 0) {
                        tools.loadTableMessage(tbody, "No hay datos para mostrar.", 11, true);
                        tools.paginationEmpty(ulPagination);
                        state = false;
                    } else {
                        for (let cotizacion of result.data) {
                            let pdf = '<button class="btn btn-secondary btn-sm"  onclick="openPdf(\'' + cotizacion.IdCotizacion + '\')"><img src="./images/pdf.svg" width="26" /> </button>';
                            tbody.append(`<tr>
                                <td class="text-center"> ${ cotizacion.Id }</td >
                                <td class="text-center"> ${ pdf }</td >
                                <td class="text-center"> ${ tools.getDateForma(cotizacion.FechaCotizacion)+'<br>'+tools.getTimeForma24(cotizacion.HoraCotizacion) }</td>
                                <td class="text-left"> ${ cotizacion.NumeroDocumento+'<br>'+cotizacion.Informacion }</td>
                                <td class="text-left"> ${ "COTIZACIÓN <br>N° - " + tools.formatNumber(cotizacion.IdCotizacion) }</td>    
                                <td class="text-left">${cotizacion.Observaciones}</td>                                                    
                                <td class="text-left">${cotizacion.Estado ==1? "SIN USO":cotizacion.Comprobante+"<br>"+cotizacion.Serie+"-"+cotizacion.Numeracion}</td>
                                <td class="text-right">${ cotizacion.SimboloMoneda + " " + tools.formatMoney(cotizacion.Total) }</td>                                
                                <td class="text-center"><button type="button" class="btn btn-info" onclick="modalDetalle('${cotizacion.IdCotizacion}')"><i class="fa fa-eye"></i></button></td >
                                <td class="text-center"><button type="button" class="btn btn-danger" onclick="quitarCotizacion('${cotizacion.IdCotizacion}')"><i class="fa fa-trash"></i></button></td >
                                </tr >`);
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
                    tools.loadTableMessage(tbody, tools.messageError(error), 11, true);
                    tools.paginationEmpty(ulPagination);
                    state = false;
                }
            }

            function openPdf(idCotizacion) {
                window.open("../app/sunat/pdfcotizacionA4.php?idCotizacion=" + idCotizacion, "_blank");
            }

            async function modalDetalle(idCotizacion) {
                try {
                    $("#idModalCotizacion").modal("show");

                    let result = await tools.promiseFetchGet("../app/controller/CotizacionController.php", {
                        "type": "cotizaciondetalle",
                        "idCotizacion": idCotizacion
                    }, function() {
                        tools.loadTable($("#tbCotizacionDetalle"), 7);
                    });
                    $("#tbCotizacionDetalle").empty();

                    let cotizacion = result.data;

                    $("#thCotizacion").html("N°-" + cotizacion.IdCotizacion);
                    $("#thCliente").html(cotizacion.Informacion);
                    $("#thFechaHora").html(tools.getDateForma(cotizacion.FechaCotizacion));

                    let count = 0;
                    let total = 0;
                    for (let value of result.detalle) {
                        count++;
                        total += parseFloat(value.Cantidad) * parseFloat(value.Precio);
                        $("#tbCotizacionDetalle").append(`
                        <tr>
                            <td>${count}</td>
                            <td>${value.Clave+"<br>"+value.NombreMarca}</td>
                            <td>${tools.formatMoney(value.Cantidad)}</td>
                            <td>${value.ImpuestoNombre}</td>
                            <td>${tools.formatMoney(value.Precio)}</td>
                            <td>${tools.formatMoney(value. Descuento)}</td>
                            <td>${tools.formatMoney(total)}</td>
                        </tr>
                        `);
                    }

                    $("#thTotal").html(cotizacion.Simbolo + " " + tools.formatMoney(total));
                } catch (error) {
                    tools.loadTableMessage($("#tbCotizacionDetalle"), tools.messageError(error), 7);
                }
            }

            function quitarCotizacion(idCotizacion) {
                tools.ModalDialog("Cotización", "¿Está seguro de eliminar la cotización?", async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/CotizacionController.php", {
                                "type": "delete",
                                "idCotizacion": idCotizacion,
                            }, function() {
                                tools.ModalAlertInfo("Cotización", "Se está procesando la información.");
                            });

                            tools.ModalAlertSuccess("Cotización", result);
                            loadInitCotizacion();
                        } catch (error) {
                            tools.ErrorMessageServer("Cotización", error);
                        }
                    }
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
