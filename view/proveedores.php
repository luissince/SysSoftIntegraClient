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

        <div class="row">
            <div class="modal fade" id="modalCrudProveedor" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="lblTitleCrudProveedor">
                                <i class="fa fa-user"></i> Registrar Proveedor
                            </h4>
                            <button type="button" class="close" id="btnCloseCrudProveedor">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="tile">
                                <div class="overlay p-5" id="divOverlayCrudProveedor">
                                    <div class="m-loader mr-4">
                                        <svg class="m-circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                        </svg>
                                    </div>
                                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayCrudProveedor">Cargando información...</h4>
                                </div>

                                <div class="bs-component">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabPrimero" id="navTabPrimero">Datos básicos</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabSegundo" id="navTabSegundo">Datos de contacto</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show p-2" id="tabPrimero">

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Tipo documento</label>
                                                        <div class="input-group">
                                                            <select class="form-control" id="cbDocumentType">
                                                                <option value="">- Seleccione -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>N° Documento</label>
                                                        <div class="input-group">
                                                            <input id="txtDocumentNumber" type="text" class="form-control" placeholder="00000000" title="Ingrese su n° de documento">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-secondary" type="button" title="Reniec" id="btmReniec">
                                                                    <img src="./images/sunat_logo.png" width="18" height="18">
                                                                </button>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-secondary" type="button" title="Sunat" id="btnSunat">
                                                                    <img src="./images/reniec.png" width="18" height="18">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Razón social/Datos de la persona</label>
                                                        <div class="input-group">
                                                            <input id="txtInformacion" class="form-control" type="text" placeholder="Ingrese Razón social/Datos de la persona" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Teléfono</label>
                                                        <div class="input-group">
                                                            <input id="txtTelefono" class="form-control" type="text" placeholder="Ingrese su Teléfono" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Celular</label>
                                                        <div class="input-group">
                                                            <input id="txtCelular" class="form-control" type="text" placeholder="Ingrese n° de Celular" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <div class="input-group">
                                                            <input id="txtEmail" class="form-control" type="text" placeholder="Ingrese su Email" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Página Web</label>
                                                        <div class="input-group">
                                                            <input id="txtPage" class="form-control" type="text" placeholder="Ingrese su Página Web" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Dirección</label>
                                                        <div class="input-group">
                                                            <input id="txtDireccion" class="form-control" type="text" placeholder="Ingrese su Dirección" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade p-2" id="tabSegundo">

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Representante</label>
                                                        <div class="input-group">
                                                            <input id="txtRepresentante" class="form-control" type="text" placeholder="Ingrese su Representante" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label>Estado </label>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input type="radio" id="rbActivo" name="rbEstado" checked>
                                                                <label for="rbActivo">
                                                                    Activo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input type="radio" id="rbInactivo" name="rbEstado">
                                                                <label for="rbInactivo" class="radio-custom-label">
                                                                    Inactivo
                                                                </label>
                                                            </div>
                                                        </div>
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
                                        <button class="btn btn-success" type="button" id="btnSaveCrudProveedor"><i class="fa fa-save"></i> Guardar</button>
                                        <button class="btn btn-danger" type="button" id="btnCancelCrudProveedor"><i class="fa fa-close"></i> Cancelar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Proveedores <small>Lista</small></h1>
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
                        <label>Buscar por datos de persona o n° de documento(Enter para completar):</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="..." class="input-primary" id="txtBuscar">
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
                                        <th style="width:10%">Documento</th>
                                        <th style="width:20%">Razón social</th>
                                        <th style="width:10%">Teléfono/Celular</th>
                                        <th style="width:25%">Dirección</th>
                                        <th style="width:10%">Representante</th>
                                        <th style="width:5%">Editar</th>
                                        <th style="width:5%">Eliminar</th>
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
            let tbList = $("#tbList");

            let ulPagination = $("#ulPagination");

            let idProveedor = "";
            let idEmpleado = "<?= $_SESSION['IdEmpleado']; ?>";

            $(document).ready(function() {


                $("#txtBuscar").keyup(function(event) {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (event.keyCode === 13) {
                            if ($("#txtBuscar").val().trim() != "") {
                                if (!state) {
                                    paginacion = 1;
                                    loadListaProveedores($("#txtBuscar").val().trim());
                                    opcion = 0;
                                }
                            }
                            event.preventDefault();
                        }
                    }
                });

                $("#btnBuscar").click(function() {
                    if ($("#txtBuscar").val().trim() != "") {
                        if (!state) {
                            paginacion = 1;
                            loadListaProveedores($("#txtBuscar").val().trim());
                            opcion = 0;
                        }
                    }
                });

                $("#btnAgregar").click(function() {
                    AgregarProveedor();
                });

                $("#btnAgregar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        AgregarProveedor();
                    }
                    event.preventDefault();
                });

                $("#btnReload").click(function() {
                    loadInitProveedores();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadInitProveedores();
                    }
                    event.preventDefault();
                });

                loadInitProveedores();

                //-----------------------------------------------------------
                $("#btnSaveCrudProveedor").click(function(event) {
                    CrudProveedor();
                });

                $("#btnSaveCrudProveedor").click(function(event) {
                    if (event.keyCode === 13) {
                        CrudProveedor();
                        event.preventDefault();
                    }
                });

                $("#btnCloseCrudProveedor").click(function(event) {
                    LimpiarModalProveedor();
                });

                $("#btnCloseCrudProveedor").click(function(event) {
                    if (event.keyCode === 13) {
                        LimpiarModalProveedor();
                        event.preventDefault();
                    }
                });

                $("#btnCancelCrudProveedor").click(function(event) {
                    LimpiarModalProveedor();
                });

                $("#btnCancelCrudProveedor").keypress(function(event) {
                    if (event.keyCode === 13) {
                        LimpiarModalProveedor();
                        event.preventDefault();
                    }
                });
            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        loadListaProveedores("");
                        break;
                }
            }

            function loadInitProveedores() {
                if (!state) {
                    paginacion = 1;
                    loadListaProveedores("");
                    opcion = 0;
                }
            }

            async function loadListaProveedores(nombre) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/ProveedorController.php", {
                        "type": "allproveedores",
                        "nombre": nombre,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="8"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                        totalPaginacion = 0;
                    });

                    let object = result;
                    if (object.estado === 1) {
                        tbList.empty();

                        if (object.data.length == 0) {
                            tbList.append('<tr><td class="text-center" colspan="8"><p>No hay datos para mostrar.</p></td></tr>');
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

                            for (let proveedor of object.data) {

                                tbList.append('<tr>' +
                                    '<td class="text-center">' + proveedor.Id + '</td>' +
                                    '<td class="text-left">' + proveedor.Documento + '<br>' + proveedor.NumeroDocumento + '</td>' +
                                    '<td class="text-left">' + proveedor.RazonSocial + '</td>' +
                                    '<td class="text-left">' + proveedor.Telefono + '<br>' + proveedor.Celular + '</td>' +
                                    '<td class="text-left">' + proveedor.Direccion + '</td>' +
                                    '<td class="text-left">' + proveedor.Representante + '</td>' +
                                    '<td class="text-center"><button class="btn btn-warning" onclick="EditarProveedor(\'' + proveedor.IdProveedor + '\')"><i class="fa fa-edit"></i><button</td>' +
                                    '<td class="text-center"><button class="btn btn-danger" onclick="DeleteProveedor(\'' + proveedor.IdProveedor + '\')"><i class="fa fa-trash"></i><button</td>' +
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
                    } else {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="8"><p>' + object.message + '</p></td></tr>');
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
                } catch (error) {
                    tbList.empty();
                    tbList.append('<tr><td class="text-center" colspan="8"><p>' + error.responseText + '</p></td></tr>');
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

            async function AgregarProveedor() {
                $("#lblTitleCrudProveedor").html('<i class="fa fa-user"></i> Registrar Proveedor');
                $("#modalCrudProveedor").modal("show");
                $('#modalCrudProveedor').on('shown.bs.modal', function(e) {
                    $("#cbDocumentType").focus();
                });
                $("#cbDocumentType").empty();
                $("#lblTextOverlayCrudProveedor").html("Cargando información...");
                try {
                    let result = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0003"
                    });

                    if (result.estado == 1) {
                        $("#cbDocumentType").append('<option value="">- Seleccione -</option>');
                        for (let value of result.data) {
                            $("#cbDocumentType").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                        }
                        $("#divOverlayCrudProveedor").addClass('d-none');
                    } else {
                        $("#cbDocumentType").append('<option value="">- Seleccione -</option>');
                        $("#lblTextOverlayCrudProveedor").html(result.message);
                    }
                } catch (error) {
                    $("#cbDocumentType").append('<option value="">- Seleccione -</option>');
                    $("#lblTextOverlayCrudProveedor").html("Se produjo un error interno intente nuevamente por favor.");
                }
            }

            async function EditarProveedor(id) {
                $("#lblTitleCrudProveedor").html('<i class="fa fa-user"></i> Editar Proveedor');
                $("#modalCrudProveedor").modal("show");
                $('#modalCrudProveedor').on('shown.bs.modal', function(e) {
                    $("#cbDocumentType").focus();
                });
                $("#cbDocumentType").empty();
                $("#lblTextOverlayCrudProveedor").html("Cargando información...");
                try {

                    let result = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0003"
                    });

                    if (result.estado == 1) {
                        $("#cbDocumentType").append('<option value="">- Seleccione -</option>');
                        for (let value of result.data) {
                            $("#cbDocumentType").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                        }

                        let proveedor = await tools.promiseFetchGet("../app/controller/ProveedorController.php", {
                            "type": "GetByIdProveedor",
                            "idProveedor": id
                        });

                        if (proveedor.estado == 1) {
                            idProveedor = proveedor.data.IdProveedor;
                            $("#cbDocumentType").val(proveedor.data.TipoDocumento);
                            $("#txtDocumentNumber").val(proveedor.data.NumeroDocumento);
                            $("#txtInformacion").val(proveedor.data.RazonSocial);
                            $("#txtTelefono").val(proveedor.data.Telefono);
                            $("#txtCelular").val(proveedor.data.Celular);
                            $("#txtEmail").val(proveedor.data.Email);
                            $("#txtPage").val(proveedor.data.PaginaWeb);
                            $("#txtDireccion").val(proveedor.data.Direccion);
                            $("#txtRepresentante").val(proveedor.data.Representante);
                            if (proveedor.data.Estado == "1") {
                                $("#rbActivo").prop("checked", true);
                            } else {
                                $("#rbInactivo").prop("checked", true);
                            }
                            $("#divOverlayCrudProveedor").addClass('d-none');
                        } else {
                            $("#lblTextOverlayCrudProveedor").html(result.message);
                        }
                    } else {
                        $("#cbDocumentType").append('<option value="">- Seleccione -</option>');
                        $("#lblTextOverlayCrudProveedor").html(result.message);
                    }
                } catch (error) {
                    $("#cbDocumentType").append('<option value="">- Seleccione -</option>');
                    $("#lblTextOverlayCrudProveedor").html("Se produjo un error interno intente nuevamente por favor.");
                }

            }


            function LimpiarModalProveedor() {
                $("#modalCrudProveedor").modal("hide");
                $('#modalCrudProveedor').on('hidden.bs.modal', function(e) {
                    $("#cbDocumentType").val('');
                    $("#txtDocumentNumber").val('');
                    $("#txtInformacion").val('');
                    $("#txtTelefono").val('');
                    $("#txtCelular").val('');
                    $("#txtEmail").val('');
                    $("#txtPage").val('');
                    $("#txtDireccion").val('');
                    $("#txtRepresentante").val('');
                    $("#rbActivo").prop("checked", true);
                    $("#navTabPrimero").addClass('active');
                    $("#navTabSegundo").removeClass('active');
                    $("#tabPrimero").addClass('active');
                    $("#tabPrimero").addClass('show');
                    $("#tabSegundo").removeClass('active');
                    $("#tabSegundo").removeClass('show');
                    $("#divOverlayCrudProveedor").removeClass('d-none');
                    $("#lblTextOverlayCrudProveedor").html("Cargando información...");
                    idProveedor = "";
                });
            }

            function CrudProveedor() {
                if ($("#cbDocumentType").val() == "") {
                    tools.AlertWarning("", "Seleccione el Tipo de Documento.");
                    $("#cbDocumentType").focus();
                } else if ($("#txtDocumentNumber").val() == "") {
                    tools.AlertWarning("", "Ingrese el Número de Documento.");
                    $("#txtDocumentNumber").focus();
                } else if ($("#txtInformacion").val() == "") {
                    tools.AlertWarning("", "Ingrese la Informacion del Proveedor.");
                    $("#txtInformacion").focus();
                } else {
                    tools.ModalDialog("Proveedor", "¿Está seguro de continuar?", async function(value) {
                        if (value == true) {
                            try {
                                let result = await tools.promiseFetchPost("../app/controller/ProveedorController.php", {
                                        "type": "crudProveedor",
                                        "IdProveedor": idProveedor,
                                        "TipoDocumento": $("#cbDocumentType").val(),
                                        "NumeroDocumento": $("#txtDocumentNumber").val(),
                                        "RazonSocial": $("#txtInformacion").val(),
                                        "NombreComercial": "",
                                        "Ambito": 0,
                                        "Estado": $("#rbActivo").is(":checked") ? 1 : 0,
                                        "Telefono": $("#txtTelefono").val(),
                                        "Celular": $("#txtCelular").val(),
                                        "Email": $("#txtEmail").val(),
                                        "PaginaWeb": $("#txtPage").val(),
                                        "Direccion": $("#txtDireccion").val(),
                                        "UsuarioRegistro": idEmpleado,
                                        "Representante": $("#txtRepresentante").val()
                                    },
                                    function() {
                                        LimpiarModalProveedor();
                                        tools.ModalAlertInfo("Proveedor", "Se está procesando la información.");
                                    });

                                if (result.estado == 1) {
                                    tools.ModalAlertSuccess("Proveedor", result.message);
                                    loadInitProveedores();
                                } else {
                                    tools.ModalAlertWarning("Proveedor", result.message);
                                }
                            } catch (error) {
                                tools.ModalAlertError("Proveedor", "Se produjo un error interno intente nuevamente.");
                            }
                        }
                    });
                }
            }

            function DeleteProveedor(id) {
                tools.ModalDialog("Proveedor", "¿Está seguro de eliminar el proveedor?", async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/ProveedorController.php", {
                                    "type": "deleteProveedor",
                                    "IdProveedor": id,
                                },
                                function() {
                                    tools.ModalAlertInfo("Proveedor", "Se está procesando la información.");
                                });

                            if (result.estado == 1) {
                                tools.ModalAlertSuccess("Proveedor", result.message);
                                loadInitProveedores();
                            } else {
                                tools.ModalAlertWarning("Proveedor", result.message);
                            }
                        } catch (error) {
                            tools.ModalAlertError("Proveedor", "Se produjo un error interno intente nuevamente.");
                        }
                    }
                });
            }
        </script>
    </body>

    </html>

<?php

}
