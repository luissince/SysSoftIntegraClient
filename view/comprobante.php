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
        <!-- modal comprobante -->
        <div class="row">
            <div class="modal fade" id="modalCrudComprobante" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="lblTitleCrud">
                                <i class="fa fa-money"></i> Registrar Comprobante
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="tile p-0 border-0">
                                <div class="overlay p-5" id="divOverlayComprobante">
                                    <div class="m-loader mr-4">
                                        <svg class="m-circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                        </svg>
                                    </div>
                                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayComprobante">Cargando información...</h4>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Nombre del Coomprobante <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtNombre" class="form-control" type="text" placeholder="Ingrese el nombre del comprobante" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Código Alterno</label>
                                            <div class="input-group">
                                                <input id="txtCodigoAlterno" class="form-control" type="text" placeholder="Ingrese el código alterno" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Serie <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtSerie" class="form-control" type="text" placeholder="Ingrese la serie" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Numeración <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtNumeracion" class="form-control" type="text" placeholder="Ingrese la numeración" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Comprobante para Guía de Remisión </label>
                                            <div class="input-group">
                                                <input id="cbGuiaRemision" type="checkbox" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Comprobante Facturado </label>
                                            <div class="input-group">
                                                <input id="cbFacturado" type="checkbox" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Comprobante para Nota de Crédito </label>
                                            <div class="input-group">
                                                <input id="cbNotaCredito" type="checkbox" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Estado </label>
                                            <div class="input-group">
                                                <input id="cbEstado" type="checkbox" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Usa número de caracteres el comprobante </label>
                                            <div class="input-group">
                                                <input id="cbUsaCaracteres" type="checkbox" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Caracteres a usar </label>
                                            <div class="input-group">
                                                <input id="txtCaracter" class="form-control" type="text" placeholder="0" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" modal-footer">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label class="form-text text-left text-danger">Los campos marcados con * son obligatorios</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-right">
                                    <button class="btn btn-success" type="button" id="btnSaveTipoDocumento"><i class="fa fa-save"></i> Guardar</button>
                                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Comprobantes <small>Lista</small></h1>
            </div>

            <div class="tile">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnAgregar">
                                <i class="fa fa-plus"></i>
                                Agregar
                            </button>
                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i>
                                Recargar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label>Buscar por el nombre del comprobante, serie o numeración:</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Ingrese los datos requeridos" class="input-primary" id="txtBuscar">
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
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width:5%">N°</th>
                                        <th style="width:20%">Tipo de comprobante</th>
                                        <th style="width:10%">Serie</th>
                                        <th style="width:10%">Numeración</th>
                                        <th style="width:10%">Destino</th>
                                        <th style="width:10%">Codigo Alterno</th>
                                        <th style="width:10%">Estado</th>
                                        <th style="width:10%">Usa Caracteres</th>
                                        <th style="width:10%">Preted.</th>
                                        <th style="width:5%">Editar</th>
                                        <th style="width:5%">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="11" class="text-center">!Aún no has registrado ningún comprobante¡</td>
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

            let idTipoDocumento = 0;

            $(document).ready(function() {
                $("#btnAgregar").click(function() {
                    agregarComprobante();
                });

                tools.keyEnter($("#btnAgregar"), function() {
                    agregarComprobante();
                });

                $("#btnReload").click(function() {
                    loadInitTipoDocumento();
                });

                tools.keyEnter($("#btnReload"), function() {
                    loadInitTipoDocumento();
                });

                tools.keyEnter($("#txtBuscar"), function() {
                    if ($("#txtBuscar").val().trim() !== '') {
                        if (!state) {
                            paginacion = 1;
                            fillTableTipoDocumento(1, $("#txtBuscar").val().trim());
                            opcion = 1;
                        }
                    }
                });

                $("#btnBuscar").click(function(event) {
                    if ($("#txtBuscar").val().trim() !== '') {
                        if (!state) {
                            paginacion = 1;
                            fillTableTipoDocumento(1, $("#txtBuscar").val().trim());
                            opcion = 1;
                        }
                    }
                });

                tools.keyEnter($("#btnBuscar"), function() {
                    if ($("#txtBuscar").val().trim() !== '') {
                        if (!state) {
                            paginacion = 1;
                            fillTableTipoDocumento(1, $("#txtBuscar").val().trim());
                            opcion = 1;
                        }
                    }
                });

                modalComponents();
                loadInitTipoDocumento();
            });

            function modalComponents() {
                $("#modalCrudComprobante").on("shown.bs.modal", function() {
                    $("#txtNombre").focus();
                });

                $("#modalCrudComprobante").on("hide.bs.modal", function() {
                    clearComponents();
                });

                $("#cbUsaCaracteres").change(function() {
                    $("#txtCaracter").attr("disabled", !$("#cbUsaCaracteres").is(":checked"));
                    $("#txtCaracter").focus();
                });

                $("#btnSaveTipoDocumento").click(function() {
                    crudComprobante();
                });

                tools.keyEnter($("#btnSaveTipoDocumento"), function() {
                    crudComprobante();
                });

                tools.keyNumberInteger($("#txtNumeracion"));
            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillTableTipoDocumento(0, "");
                        break;
                    case 1:
                        fillTableTipoDocumento(1, $("#txtBuscar").val().trim());
                        break;
                }
            }

            function loadInitTipoDocumento() {
                if (!state) {
                    paginacion = 1;
                    fillTableTipoDocumento(0, "");
                    opcion = 0;
                }
            }

            async function fillTableTipoDocumento(opcion, buscar) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/TipoDocumentoController.php", {
                        "type": "all",
                        "opcion": opcion,
                        "search": buscar,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tools.loadTable(tbody, 11);
                        totalPaginacion = 0;
                        state = true;
                    });

                    if (result.data.length == 0) {
                        tools.loadTableMessage(tbody, "No hay datos para mostrar.", 11, true);
                        totalPaginacion = 0;
                        state = false;
                    } else {
                        tbody.empty();
                        for (let value of result.data) {
                            let destino = value.Guia == 1 ? '<img width="22" src="./images/guia_remision.png" />' : value.NotaCredito == 1 ? '<img width="22" src="./images/note.png" />' : '<img width="22" src="./images/sales.png" />';
                            let estado = value.Estado == 1 ? '<div class="badge badge-success">ACTIVO</div>' : '<div class="badge badge-danger">INACTIVO</div>';
                            let caracteres = value.Campo == 1 ? '<span class="text-success">SI</span>' : '<span class="text-warning">NO</span>';
                            let predeterminado = value.Predeterminado == 1 ? './images/checked.png' : './images/unchecked.png';

                            tbody.append(`<tr>
                                    <td class="text-center">${value.Id}</td>
                                    <td class="text-left">${value.Nombre}</td>
                                    <td class="text-left">${value.Serie}</td>
                                    <td class="text-left">${value.Numeracion}</td>
                                    <td class="text-center">${destino}</td>
                                    <td class="text-center">${value.CodigoAlterno}</td>
                                    <td class="text-center">${estado}</td>
                                    <td class="text-center">${caracteres}</td>
                                    <td class="text-left"><img width="22" src="${predeterminado}" /></td>
                                    <td class="text-center"><button class="btn btn-warning" onclick="editarComprobante('${value.IdTipoDocumento}')"><i class="fa fa-edit"></i></button></td>
                                    <td class="text-center"><button class="btn btn-danger" onclick="eliminarComprobante('${value.IdTipoDocumento}')"><i class="fa fa-trash"></i></button></td>
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
                    tools.loadTableMessage(tbody, tools.messageError(error), 11, true);
                    state = false;
                }
            }

            async function crudComprobante() {
                if ($("#txtNombre").val() == "") {
                    tools.AlertWarning("", "Ingrese el nombre de comprobante.");
                    $("#txtNombre").focus();
                } else if ($("#txtSerie").val() == "") {
                    tools.AlertWarning("", "Ingrese la serie.");
                    $("#txtSerie").focus();
                } else if ($("#txtNumeracion").val() == "") {
                    tools.AlertWarning("", "Ingrese la numeración.");
                    $("#txtNumeracion").focus();
                } else if ($("#cbUsaCaracteres").is(":checked") && $("#txtCaracter").val() == "") {
                    tools.AlertWarning("", "Ingrese el número de catacteres a usar");
                    $("#txtCaracter").focus();
                } else {
                    tools.ModalDialog("Comprobante", '¿Está seguro de continuar?', async function(value) {
                        if (value == true) {
                            try {
                                let result = await tools.promiseFetchPost("../app/controller/TipoDocumentoController.php", {
                                    "type": "crud",
                                    "IdTipoDocumento": idTipoDocumento,
                                    "Nombre": $("#txtNombre").val().trim(),
                                    "Serie": $("#txtSerie").val().trim(),
                                    "Numeracion": $("#txtNumeracion").val().trim(),
                                    "CodigoAlterno": $("#txtCodigoAlterno").val().trim(),
                                    "Guia": $("#cbGuiaRemision").is(":checked") ? 1 : 0,
                                    "Facturacion": $("#cbFacturado").is(":checked") ? 1 : 0,
                                    "NotaCredito": $("#cbNotaCredito").is(":checked") ? 1 : 0,
                                    "Estado": $("#cbEstado").is(":checked") ? 1 : 0,
                                    "Campo": $("#cbUsaCaracteres").is(":checked") ? 1 : 0,
                                    "NumeroCampo": tools.isNumeric($("#txtCaracter").val()) ? $("#txtCaracter").val() : 0,
                                }, function() {
                                    $("#modalCrudComprobante").modal('hide');
                                    clearComponents();
                                    tools.ModalAlertInfo("Comprobante", "Procesando petición..");
                                });
                                tools.ModalAlertSuccess("Comprobante", result);
                                onEventPaginacion();
                            } catch (error) {
                                tools.ErrorMessageServer("Comprobante", error);
                            }
                        }
                    });
                }
            }

            function agregarComprobante() {
                $("#lblTitleCrud").html('<i class="fa fa-money"></i> Registrar Comprobante');
                $("#modalCrudComprobante").modal("show");
                $("#divOverlayComprobante").addClass("d-none");

            }

            async function editarComprobante(id) {
                try {
                    $("#lblTitleCrud").html('<i class="fa fa-money"></i> Editar Comprobante');
                    $("#modalCrudComprobante").modal("show");

                    let result = await tools.promiseFetchGet("../app/controller/TipoDocumentoController.php", {
                        "type": "getbyid",
                        "idTipoDocumento": id,
                    });

                    idTipoDocumento = result.IdTipoDocumento;
                    $("#txtNombre").val(result.Nombre);
                    $("#txtCodigoAlterno").val(result.CodigoAlterno);
                    $("#txtSerie").val(result.Serie);
                    $("#txtNumeracion").val(result.Numeracion);
                    $("#cbGuiaRemision").prop("checked", result.Guia == 1 ? true : false);
                    $("#cbFacturado").prop("checked", result.Facturacion == 1 ? true : false);
                    $("#cbNotaCredito").prop("checked", result.NotaCredito == 1 ? true : false);
                    $("#cbEstado").prop("checked", result.Estado == 1 ? true : false);
                    $("#cbUsaCaracteres").prop("checked", result.Campo == 1 ? true : false);
                    $("#txtCaracter").val(result.NumeroCampo);
                    $("#txtCaracter").attr("disabled", result.Campo == 1 ? false : true);

                    $("#divOverlayComprobante").addClass("d-none");
                } catch (error) {
                    $("#lblTextOverlayComprobante").html(tools.messageError(error));
                }
            }

            function eliminarComprobante(id) {
                tools.ModalDialog("Comprobante", '¿Está seguro de eliminar el comprobante?', async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/TipoDocumentoController.php", {
                                "type": "remove",
                                "IdTipoDocumento": id,
                            }, function() {
                                $("#modalCrudComprobante").modal('hide');
                                clearComponents();
                                tools.ModalAlertInfo("Comprobante", "Procesando petición..");
                            });
                            tools.ModalAlertSuccess("Comprobante", result);
                            loadInitTipoDocumento();
                        } catch (error) {
                            tools.ErrorMessageServer("Comprobante", error);
                        }
                    }
                });
            }

            function clearComponents() {
                $("#txtNombre").val('');
                $("#txtCodigoAlterno").val('');
                $("#txtSerie").val('');
                $("#txtNumeracion").val('');
                $("#cbGuiaRemision").prop("checked", false);
                $("#cbFacturado").prop("checked", false);
                $("#cbNotaCredito").prop("checked", false);
                $("#cbEstado").prop("checked", true);
                $("#cbUsaCaracteres").prop("checked", false);
                $("#txtCaracter").val('');
                $("#txtCaracter").attr("disabled", true);
                idTipoDocumento = 0;
                $("#divOverlayComprobante").removeClass("d-none");
                $("#lblTextOverlayComprobante").html("Cargando información...");
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
