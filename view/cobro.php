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
            <div class="modal fade" id="modalPago" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus">
                                </i> Nueva Salida</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="tile">
                                <div class="overlay p-5" id="divOverlayEgreso">
                                    <div class="m-loader mr-4">
                                        <svg class="m-circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                        </svg>
                                    </div>
                                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayEgreso">Cargando información...</h4>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <div class="input-group">
                                                <select id="cbProveedor" class="form-control">
                                                    <option value="">- Seleccione -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Observación</label>
                                            <div class="input-group">
                                                <input id="txtObservacion" class="form-control" type="text" placeholder="Ingrese alguna descripción">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Monto</label>
                                            <div class="input-group">
                                                <input id="txtMonto" class="form-control" type="text" placeholder="0.00">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Forma de Pago</label>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbEfectivo" name="rbForma" checked="">
                                                    <label for="rbEfectivo">
                                                        Efectivo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbTarjeta" name="rbForma">
                                                    <label for="rbTarjeta" class="radio-custom-label">
                                                        Tarjeta
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbDeposito" name="rbForma">
                                                    <label for="rbDeposito" class="radio-custom-label">
                                                        Deposito
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <button class="btn btn-success" type="button" id="btnSaveModal"><i class="fa fa-save"></i> Guardar</button>
                                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
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
                <h1><i class="fa fa-folder"></i> Pagos echos <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="row">
                    <div class="col-md 12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnNuevo">
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

                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/search.png" width="22" height="22"> Filtrar por proveedor o procedencia:</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtSearch">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>

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
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width:5%;">#</th>
                                        <th style="width:5%;">Pdf</th>
                                        <th style="width:10%;">Fecha</th>
                                        <th style="width:15%;">Proveedor</th>
                                        <th style="width:15%;">Detalle</th>
                                        <th style="width:15%;">Procedencia</th>
                                        <th style="width:15%;">Forma Cobro</th>
                                        <th style="width:10%;">Monto</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="8" class="text-center">!Aún no has registrado salidas</td>
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

            let idUsuario = "<?= $_SESSION['IdEmpleado'] ?>";

            $(document).ready(function() {

                $("#txtFechaInicial").val(tools.getCurrentDate());
                $("#txtFechaFinal").val(tools.getCurrentDate());

                $("#txtMonto").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtMonto").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#btnNuevo").click(function() {
                    $("#modalPago").modal("show");
                });

                $("#btnNuevo").keypress(function(event) {
                    if (event.keyCode == 13) {
                        $("#modalPago").modal("show");
                        event.preventDefault();
                    }
                });

                $("#btnRecargar").click(function(event) {
                    loadInitEgreso();
                });

                $("#btnRecargar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        loadInitEgreso();
                        event.preventDefault();
                    }
                });

                $("#txtSearch").keyup(function(event) {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (event.keyCode === 13) {
                            if ($("#txtSearch").val().trim() != "") {
                                if (!state) {
                                    paginacion = 1;
                                    fillEgreso(1, $("#txtSearch").val().trim(), "", "");
                                    opcion = 1;
                                }
                            }
                            event.preventDefault();
                        }
                    }
                });

                $("#btnBuscar").click(function(event) {
                    if ($("#txtSearch").val().trim() != "") {
                        if (!state) {
                            paginacion = 1;
                            fillEgreso(1, $("#txtSearch").val().trim(), "", "");
                            opcion = 1;
                        }
                    }
                });

                $("#btnBuscar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        if ($("#txtSearch").val().trim() != "") {
                            if (!state) {
                                paginacion = 1;
                                fillEgreso(1, $("#txtSearch").val().trim(), "", "");
                                opcion = 1;
                            }
                        }
                        event.preventDefault();
                    }
                });

                $("#txtFechaInicial").change(function() {
                    if (!state) {
                        paginacion = 1;
                        fillEgreso(0, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val());
                        opcion = 0;
                    }
                });

                $("#txtFechaFinal").change(function() {
                    if (!state) {
                        paginacion = 1;
                        fillEgreso(0, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val());
                        opcion = 0;
                    }
                });


                loadInitEgreso();

                modalIngreso();
            });

            function modalIngreso() {
                $("#modalPago").on('shown.bs.modal', function() {
                    NuevoPago();
                });

                $("#modalPago").on("hide.bs.modal", function() {
                    LimpiarModal();
                });

                $("#btnSaveModal").click(function() {
                    CrudPago();
                });

                $("#btnSaveModal").keypress(function(event) {
                    if (event.keyCode == 13) {
                        CrudPago();
                        event.preventDefault();
                    }
                });
            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillEgreso(0, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val());
                        break;
                    case 1:
                        fillEgreso(1, $("#txtSearch").val().trim(), "", "");
                        break;
                }
            }

            function loadInitEgreso() {
                if (!state) {
                    paginacion = 1;
                    fillEgreso(0, "", $("#txtFechaInicial").val(), $("#txtFechaFinal").val());
                    opcion = 0;
                }
            }

            async function fillEgreso(opcion, buscar, fechaInicio, fechaFin) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/IngresoController.php", {
                        "type": "listaSalidas",
                        "opcion": opcion,
                        "buscar": buscar,
                        "fechaInicio": fechaInicio,
                        "fechaFin": fechaFin,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="8"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        totalPaginacion = 0;
                        state = true;
                    });

                    tbody.empty();
                    if (result.data.length == 0) {
                        tbody.append('<tr><td class="text-center" colspan="8"><p>No hay salidas para mostrar.</p></td></tr>');
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
                        for (let value of result.data) {
                            tbody.append(`<tr>
                                <td class="text-center">${value.Id}</td>
                                <td><button class="btn btn-secondary btn-sm"><img src="./images/pdf.svg" width="26"></button></td>
                                <td>${tools.getDateForma(value.Fecha)}<br>${tools.getTimeForma24(value.Hora)}</td>
                                <td>${value.NumeroDocumento}<br>${value.Informacion}</td>
                                <td>${value.Detalle}</td>
                                <td>${value.Procedencia}</td>
                                <td>${value.Forma}</td>
                                <td class="text-center">${tools.formatMoney(value.Monto)}</td>
                                </tr>                                
                                `);
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
                    tbody.append('<tr><td class="text-center" colspan="8"><p>' + error.responseText + '</p></td></tr>');
                    state = false;
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

            async function NuevoPago() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/IngresoController.php", {
                        "type": "listaProveedor"
                    }, function() {
                        $("#cbProveedor").empty();
                    });

                    $("#cbProveedor").append('<option value="">- Seleccione -</option>');
                    for (let value of result) {
                        $("#cbProveedor").append('<option value="' + value.IdCliente + '">' + value.NumeroDocumento + ' - ' + value.Informacion + '</option>');
                    }

                    $("#divOverlayEgreso").addClass("d-none");
                } catch (error) {
                    $("#cbProveedor").append('<option value="">- Seleccione -</option>');
                    $("#divOverlayEgreso").addClass("d-none");
                }
            }

            function LimpiarModal() {
                $("#cbProveedor").val('');
                $("#txtObservacion").val('');
                $("#txtMonto").val('');
                $("#rbEfectivo").prop("checked", true);
            }

            function CrudPago() {
                if ($("#cbProveedor").val() == '') {
                    tools.AlertWarning("", "Seleccione un cliente.");
                    $("#cbProveedor").focus();
                } else if (!tools.isNumeric($("#txtMonto").val())) {
                    tools.AlertWarning("", "Ingrese el monto.");
                    $("#txtMonto").focus();
                } else {
                    tools.ModalDialog("Pago", '¿Está seguro de continuar?', async function(value) {
                        if (value == true) {
                            try {

                                let result = await tools.promiseFetchPost("../app/controller/IngresoController.php", {
                                    "type": "insert",
                                    "idProcedencia": "",
                                    "idCliente": $("#cbProveedor").val(),
                                    "detalle": $("#txtObservacion").val().toUpperCase(),
                                    "monto": $("#txtMonto").val(),
                                    "procedencia": 4,
                                    "forma": $("#rbEfectivo").is(":checked") ? 1 : $("#rbTarjeta").is(":checked") ? 2 : 3,
                                    "fecha": tools.getCurrentDate(),
                                    "hora": tools.getCurrentTime(),
                                    "idUsuario": idUsuario
                                }, function() {
                                    $("#modalPago").modal("hide");
                                    LimpiarModal();
                                    tools.ModalAlertInfo("Pago", "Se está procesando la información.");
                                });

                                tools.ModalAlertSuccess("Pago", result);

                            } catch (error) {
                                tools.ModalAlertError("Pago", error.responseText == null || error.responseText == "" ? "Se produjo un error interno intente nuevamente." : error.responseText);
                            }
                        }
                    });
                }
            }
        </script>
    </body>

    </html>

<?php

}
