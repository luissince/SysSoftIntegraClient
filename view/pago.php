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
                                </i> Nuevo Ingreso</h4>
                            <button type="button" class="close" id="btnCloseModal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="tile">
                                <div class="overlay p-5" id="divOverlayIngreso">
                                    <div class="m-loader mr-4">
                                        <svg class="m-circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                        </svg>
                                    </div>
                                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayIngreso">Cargando información...</h4>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <div class="input-group">
                                                <select id="cbCliente" class="form-control">
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
                                    <button class="btn btn-danger" type="button" id="btnCancelModal"><i class="fa fa-close"></i> Cancelar</button>
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
                <h1><i class="fa fa-folder"></i> Pagos recibidos <small>Lista</small></h1>
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
                        <label>Buscar:</label>
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
                                        <th style="width:15%;">Cliente</th>
                                        <th style="width:15%;">Detalle</th>
                                        <th style="width:15%;">Procedencia</th>
                                        <th style="width:15%;">Forma Cobro</th>
                                        <th style="width:10%;">Monto</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="8" class="text-center">!Aún no has registrado ingresos¡</td>
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
                    NuevoPago();
                });

                $("#btnNuevo").keypress(function(event) {
                    if (event.keyCode == 13) {
                        NuevoPago();
                        event.preventDefault();
                    }
                });
                loadInitIngreso();

                //---------------------------------------------------------
                $("#btnSaveModal").click(function() {
                    CrudPago();
                });

                $("#btnSaveModal").keypress(function(event) {
                    if (event.keyCode == 13) {
                        CrudPago();
                        event.preventDefault();
                    }
                });

                $("#btnCloseModal").click(function(event) {
                    LimpiarModal();
                });

                $("#btnCloseModal").keypress(function(event) {
                    if (event.keyCode == 13) {
                        LimpiarModal();
                        event.preventDefault();
                    }
                });

                $("#btnCancelModal").click(function(event) {
                    LimpiarModal();
                });

                $("#btnCancelModal").keypress(function(event) {
                    if (event.keyCode == 13) {
                        LimpiarModal();
                        event.preventDefault();
                    }
                });

            });

            function onEventPaginacion() {

            }

            function loadInitIngreso() {
                if (!state) {
                    paginacion = 1;
                    fillIngreso();
                    opcion = 0;
                }
            }

            function fillIngreso() {
                tools.promiseFetchGet("../app/controller/IngresoController.php", {
                    "type": "lista",
                    "posicionPagina": ((paginacion - 1) * filasPorPagina),
                    "filasPorPagina": filasPorPagina
                }, function() {
                    tbody.empty();
                    tbody.append('<tr><td class="text-center" colspan="8"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                    totalPaginacion = 0;
                    state = true;

                }).then(function(result) {
                    if (result.estado == 1) {
                        tbody.empty();
                        if (result.data.length == 0) {
                            tbody.append('<tr><td class="text-center" colspan="8"><p>No hay ingresos para mostrar.</p></td></tr>');
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
                        tbody.append('<tr><td class="text-center" colspan="8"><p>' + result.message + '</p></td></tr>');
                        state = false;
                    }
                }).catch(function(error) {
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
                });
            }

            async function NuevoPago() {
                $("#modalPago").modal("show");
                $("#cbCliente").empty();
                try {
                    let result = await tools.promiseFetchGet("../app/controller/IngresoController.php", {
                        "type": "listaCliente"
                    });

                    if (result.estado == 1) {
                        $("#cbCliente").append('<option value="">- Seleccione -</option>');
                        for (let value of result.data) {
                            $("#cbCliente").append('<option value="' + value.IdCliente + '">' + value.Informacion + '</option>');
                        }
                    } else {
                        $("#cbCliente").append('<option value="">- Seleccione -</option>');
                    }
                    $("#divOverlayIngreso").addClass("d-none");
                } catch (error) {
                    $("#cbCliente").append('<option value="">- Seleccione -</option>');
                    $("#divOverlayIngreso").addClass("d-none");
                }
            }

            function LimpiarModal() {
                $("#modalPago").modal("hide");
                $("#cbCliente").val('');
                $("#txtObservacion").val('');
                $("#txtMonto").val('');
                $("#rbEfectivo").prop("checked", true);
            }

            function CrudPago() {
                if ($("#cbCliente").val() == '') {
                    tools.AlertWarning("", "Seleccione un cliente.");
                    $("#cbCliente").focus();
                } else if (!tools.isNumeric($("#txtMonto").val())) {
                    tools.AlertWarning("", "Ingrese el monto.");
                    $("#txtMonto").focus();
                } else {
                    tools.ModalDialog("Pago", '¿Está seguro de continuar?', function(value) {
                        if (value == true) {
                            tools.promiseFetchPost("../app/controller/IngresoController.php", {
                                "type": "insert",
                                "idProcedencia": "",
                                "idCliente": $("#cbCliente").val(),
                                "detalle": $("#txtObservacion").val(),
                                "monto": $("#txtMonto").val(),
                                "procedencia": 3,
                                "forma": $("#rbEfectivo").is(":checked") ? 1 : $("#rbTarjeta").is(":checked") ? 2 : 3,
                                "fecha": tools.getCurrentDate(),
                                "hora": tools.getCurrentTime(),
                                "idUsuario": idUsuario
                            }, function() {
                                LimpiarModal();
                                tools.ModalAlertInfo("Pago", "Se está procesando la información.");
                            }).then(function(result) {
                                if (result.estado == 1) {
                                    tools.ModalAlertSuccess("Pago", result.message);
                                } else {
                                    tools.ModalAlertWarning("Pago", result.message);
                                }
                            }).catch(function(error) {
                                tools.ModalAlertError("Pago", "Se produjo un error interno intente nuevamente.");
                            });


                        }
                    });
                }
            }
        </script>
    </body>

    </html>

<?php

}
