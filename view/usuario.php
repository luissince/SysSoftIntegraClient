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
            <div class="modal fade" id="modalCrudUsuario" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="lblTitleCrud">
                                <i class="fa fa-money"></i> Registrar Usuario
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="tile border-0 p-0">
                                <div class="overlay p-5" id="divOverlayUsuario">
                                    <div class="m-loader mr-4">
                                        <svg class="m-circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                        </svg>
                                    </div>
                                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayUsuario">Cargando información...</h4>
                                </div>

                                <div class="bs-component">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabPrimero" id="navTabPrimero">Datos básicos</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabSegundo" id="navTabSegundo">Datos de contacto</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabTercero" id="navTabTercero">Acceso al sistema</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show p-2" id="tabPrimero">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Tipo documento:</label>
                                                        <div class="input-group">
                                                            <select class="form-control" id="cbTipoDocumento">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>N° Documento:</label>
                                                        <div class="input-group">
                                                            <input id="txtNumDocumento" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Apellidos: </label>
                                                        <div class="input-group">
                                                            <input id="txtApellidos" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Nombres:</label>
                                                        <div class="input-group">
                                                            <input id="txtNombres" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Sexo:</label>
                                                        <div class="input-group">
                                                            <select class="form-control" id="cbSexo">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Fecha nacimiento:</label>
                                                        <div class="input-group">
                                                            <input id="txtFechaNacimiento" class="form-control" type="date" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade p-2" id="tabSegundo">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Teléfono:</label>
                                                        <div class="input-group">
                                                            <input id="txtTelefono" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Celular:</label>
                                                        <div class="input-group">
                                                            <input id="txtCelular" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Email: </label>
                                                        <div class="input-group">
                                                            <input id="txtEmail" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Dirección:</label>
                                                        <div class="input-group">
                                                            <input id="txtDireccion" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade p-2" id="tabTercero">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Usuario:</label>
                                                        <div class="input-group">
                                                            <input id="txtUsuario" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Contraseña:</label>
                                                        <div class="input-group">
                                                            <input id="txtClave" class="form-control" type="text" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Rol:</label>
                                                        <div class="input-group">
                                                            <select id="cbRol" class="form-control">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Estado:</label>
                                                        <div class="input-group">
                                                            <select id="cbEstado" class="form-control">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
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
                                    <button class="btn btn-success" type="button" id="btnSaveUsuario"><i class="fa fa-save"></i> Guardar</button>
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
                <h1><i class="fa fa-folder"></i> Usuario <small>Lista</small></h1>
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
                        <label>Buscar por el nombre del usuario:</label>
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
                                        <th style="width:15%">Empleado</th>
                                        <th style="width:10%">Teléfono/Celular</th>
                                        <th style="width:10%">Dirección</th>
                                        <th style="width:10%">Rol</th>
                                        <th style="width:10%">Estado</th>
                                        <th style="width:5%">Editar</th>
                                        <th style="width:5%">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="8" class="text-center">!Aún no has registrado ningún usuario¡</td>
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

            let idEmpleado = "";

            $(document).ready(function() {
                $("#btnAgregar").click(function() {
                    agregarUsuario();
                });

                tools.keyEnter($("#btnAgregar"), function() {
                    agregarUsuario();
                });

                $("#btnReload").click(function() {
                    loadInitUsuario();
                });

                tools.keyEnter($("#btnReload"), function() {
                    loadInitUsuario();
                });

                tools.keyEnter($("#txtBuscar"), function() {
                    if ($("#txtBuscar").val().trim() !== '') {
                        if (!state) {
                            paginacion = 1;
                            fillTableUsuario(1, $("#txtBuscar").val().trim());
                            opcion = 1;
                        }
                    }
                });

                $("#btnBuscar").click(function(event) {
                    if ($("#txtBuscar").val().trim() !== '') {
                        if (!state) {
                            paginacion = 1;
                            fillTableUsuario(1, $("#txtBuscar").val().trim());
                            opcion = 1;
                        }
                    }
                });

                tools.keyEnter($("#btnBuscar"), function() {
                    if ($("#txtBuscar").val().trim() !== '') {
                        if (!state) {
                            paginacion = 1;
                            fillTableUsuario(1, $("#txtBuscar").val().trim());
                            opcion = 1;
                        }
                    }
                });

                modalComponents();
                loadInitUsuario();
            });

            function modalComponents() {
                $("#modalCrudUsuario").on("shown.bs.modal", function() {
                    $("#txtNombre").focus();
                });

                $("#modalCrudUsuario").on("hide.bs.modal", function() {
                    clearComponents();
                });

                $("#btnSaveUsuario").click(function() {
                    crudUsuario();
                });

                tools.keyEnter($("#btnSaveUsuario"), function() {
                    crudUsuario();
                });

                tools.keyNumberInteger($("#txtNumDocumento"));
            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillTableUsuario(0, '');
                        break;
                    case 1:
                        fillTableUsuario(1, $("#txtBuscar").val().trim());
                        break;
                }
            }

            function loadInitUsuario() {
                if (!state) {
                    paginacion = 1;
                    fillTableUsuario(0, '');
                    opcion = 0;
                }
            }

            async function fillTableUsuario(opcion, buscar) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/EmpleadoController.php", {
                        "type": "all",
                        "opcion": opcion,
                        "search": buscar,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tools.loadTable(tbody, 8);
                        totalPaginacion = 0;
                        state = true;
                    });

                    if (result.data.length == 0) {
                        tools.loadTableMessage(tbody, "No hay datos para mostrar.", 8, true);
                        tools.paginationEmpty(ulPagination);
                        totalPaginacion = 0;
                        state = false;
                    } else {
                        tbody.empty();
                        for (let value of result.data) {

                            tbody.append(`<tr>
                                <td class="text-center">${value.Id}</td>
                                <td class="text-left">${value.Apellidos+', '+value.Nombres}</td>
                                <td class="text-left">${value.Telefono+'<br>'+value.Celular}</td>
                                <td class="text-left">${value.Direccion}</td>
                                <td class="text-left">${value.Rol}</td>
                                <td class="text-center">${value.Estado}</td>
                                <td class="text-center"><button class="btn btn-warning" onclick="editarUsuario('${value.IdEmpleado}')"><i class="fa fa-edit"></i></button></td>
                                <td class="text-center"><button class="btn btn-danger" onclick="eliminarUsuario('${value.IdEmpleado}')"><i class="fa fa-trash"></i></button></td>
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
                    tools.loadTableMessage(tbody, tools.messageError(error), 8, true);
                    tools.paginationEmpty(ulPagination);
                    state = false;
                }
            }

            function crudUsuario() {
                if ($("#cbTipoDocumento").val() == "") {
                    tools.AlertWarning("", "Seleccione el Tipo de Documento.");
                    $("#cbTipoDocumento").focus();
                } else if ($("#txtNumDocumento").val() == "") {
                    tools.AlertWarning("", "Ingrese el número del documento.");
                    $("#txtNumDocumento").focus();
                } else if ($("#txtApellidos").val() == "") {
                    tools.AlertWarning("", "Ingrese el apellido del usuario.");
                    $("#txtApellidos").focus();
                } else if ($("#txtNombres").val() == "") {
                    tools.AlertWarning("", "Ingrese el nombre del usuario.");
                    $("#txtNombres").focus();
                } else {
                    tools.ModalDialog("Usuario", "¿Está seguro de continuar?", async function(value) {
                        if (value == true) {
                            try {

                                let result = await tools.promiseFetchPost("../app/controller/EmpleadoController.php", {
                                        "type": "crud",
                                        "IdEmpleado": idEmpleado,
                                        "TipoDocumento": $("#cbTipoDocumento").val(),
                                        "NumeroDocumento": $("#txtNumDocumento").val().trim(),
                                        "Apellidos": $("#txtApellidos").val().trim(),
                                        "Nombres": $("#txtNombres").val().trim(),
                                        "Sexo": $("#cbSexo").val() == "" ? 0 : $("#cbSexo").val(),
                                        "FechaNacimiento": $("#txtFechaNacimiento").val().trim(),
                                        "Puesto": 0,
                                        "Rol": $("#cbRol").val() == "" ? 0 : $("#cbRol").val(),
                                        "Estado": $("#cbEstado").val() == "" ? 0 : $("#cbEstado").val(),
                                        "Telefono": $("#txtTelefono").val(),
                                        "Celular": $("#txtCelular").val(),
                                        "Email": $("#txtEmail").val(),
                                        "Direccion": $("#txtDireccion").val(),
                                        "Usuario": $("#txtUsuario").val(),
                                        "Clave": $("#txtClave").val(),
                                        "Sistema": 0,
                                        "Huella": "",
                                    },
                                    function() {
                                        clearComponents();
                                        $("#modalCrudUsuario").modal("hide");
                                        tools.ModalAlertInfo("Usuario", "Se está procesando la información.");
                                    });

                                tools.ModalAlertSuccess("Usuario", result);
                                onEventPaginacion();
                            } catch (error) {
                                tools.ErrorMessageServer("Usuario", error);
                            }
                        }
                    });
                }
            }

            async function agregarUsuario() {
                try {
                    $("#lblTitleCrud").html('<i class="fa fa-money"></i> Registrar Usuario');
                    $("#modalCrudUsuario").modal("show");

                    let documento = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0003"
                    });

                    $("#cbTipoDocumento").empty();
                    for (let value of documento) {
                        $("#cbTipoDocumento").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let sexo = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0004"
                    });

                    $("#cbSexo").empty();
                    for (let value of sexo) {
                        $("#cbSexo").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let estado = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0001"
                    });

                    $("#cbEstado").empty();
                    for (let value of estado) {
                        $("#cbEstado").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let rol = await tools.promiseFetchGet("../app/controller/RolController.php", {
                        "type": "listarol",
                    });

                    $("#cbRol").empty();
                    for (let value of rol) {
                        $("#cbRol").append('<option value="' + value.IdRol + '">' + value.Nombre + '</option>');
                    }

                    $("#divOverlayUsuario").addClass("d-none");
                } catch (error) {
                    $("#lblTextOverlayUsuario").html(tools.messageError(error));
                }
            }

            async function editarUsuario(id) {
                try {
                    $("#lblTitleCrud").html('<i class="fa fa-money"></i> Editar Usuario');
                    $("#modalCrudUsuario").modal("show");

                    let documento = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0003"
                    });

                    $("#cbTipoDocumento").empty();
                    for (let value of documento) {
                        $("#cbTipoDocumento").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let sexo = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0004"
                    });

                    $("#cbSexo").empty();
                    for (let value of sexo) {
                        $("#cbSexo").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let estado = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0001"
                    });

                    $("#cbEstado").empty();
                    for (let value of estado) {
                        $("#cbEstado").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let rol = await tools.promiseFetchGet("../app/controller/RolController.php", {
                        "type": "listarol",
                    });

                    $("#cbRol").empty();
                    for (let value of rol) {
                        $("#cbRol").append('<option value="' + value.IdRol + '">' + value.Nombre + '</option>');
                    }

                    let cliente = await tools.promiseFetchGet("../app/controller/EmpleadoController.php", {
                        "type": "getid",
                        "idEmpleado": id
                    });

                    idEmpleado = cliente.IdEmpleado;

                    $("#cbTipoDocumento").val(cliente.TipoDocumento);
                    $("#txtNumDocumento").val(cliente.NumeroDocumento);
                    $("#txtApellidos").val(cliente.Apellidos);
                    $("#txtNombres").val(cliente.Nombres);
                    $("#cbSexo").val(cliente.Sexo);
                    $("#txtFechaNacimiento").val(cliente.FechaNacimiento);

                    $("#txtTelefono").val(cliente.Telefono);
                    $("#txtCelular").val(cliente.Celular);
                    $("#txtEmail").val(cliente.Email);
                    $("#txtDireccion").val(cliente.Direccion);

                    $("#txtUsuario").val(cliente.Usuario);
                    $("#txtClave").val(cliente.Clave);
                    $("#cbRol").val(cliente.Rol);
                    $("#cbEstado").val(cliente.Estado);

                    $("#divOverlayUsuario").addClass("d-none");
                } catch (error) {
                    $("#lblTextOverlayUsuario").html(tools.messageError(error));
                }
            }

            function eliminarUsuario(id) {
                tools.ModalDialog("Usuario", "¿Está seguro de eliminar el usuario?", async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/EmpleadoController.php", {
                                "type": "delete",
                                "IdEmpleado": id,
                            }, function() {
                                tools.ModalAlertInfo("Usuario", "Procesando petición..");
                            });
                            tools.ModalAlertSuccess("Usuario", result);
                            loadInitUsuario();
                        } catch (error) {
                            tools.ErrorMessageServer("Usuario", error);
                        }
                    }
                });
            }

            function clearComponents() {
                $("#cbTipoDocumento").empty();
                $("#txtNumDocumento").val('');
                $("#txtApellidos").val('');
                $("#txtNombres").val('');
                $("#cbSexo").empty();
                $("#txtFechaNacimiento").val('');

                $("#txtTelefono").val('');
                $("#txtCelular").val('');
                $("#txtEmail").val('');
                $("#txtDireccion").val('');

                $("#txtUsuario").val('');
                $("#txtClave").val('');
                $("#cbRol").empty();
                $("#cbEstado").empty();

                idEmpleado = "";

                $(".nav-link").removeClass("active");
                $(".tab-pane").removeClass("active show");
                $(".nav-link").first().addClass("active");
                $(".tab-pane").first().addClass("active show");
                $("#divOverlayUsuario").removeClass("d-none");
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
