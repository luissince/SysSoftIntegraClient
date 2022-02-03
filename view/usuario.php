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
                            <div class="tile">
                                <div class="overlay p-5" id="divOverlayUsuario">
                                    <div class="m-loader mr-4">
                                        <svg class="m-circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                        </svg>
                                    </div>
                                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayUsuario">Cargando información...</h4>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Nombre <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtNombre" class="form-control" type="text" placeholder="Ingrese el nombre de la moneda" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Abreviatura <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtAbreviatura" class="form-control" type="text" placeholder="Ingrese la abreviatura" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Simbolo <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtSimbolo" class="form-control" type="text" placeholder="Ingrese el simbolo" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Tipo de cambio <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtTipoCambio" class="form-control" type="text" placeholder="Ingrese el tipo de cambio" />
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
                                    <button class="btn btn-success" type="button" id="btnSaveMoneda"><i class="fa fa-save"></i> Guardar</button>
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

            let idEmpleado = 0;

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

                loadInitUsuario();
            });

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
                    console.log(result);

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
                                <td class="text-center"><button class="btn btn-warning"><i class="fa fa-edit"></i></button></td>
                                <td class="text-center"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
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

            function agregarUsuario() {
                $("#lblTitleCrud").html('<i class="fa fa-money"></i> Registrar Usuario');
                $("#modalCrudUsuario").modal("show");
                $("#divOverlayUsuario").addClass("d-none");
            }
        </script>
    </body>

    </html>

<?php

}
