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
            <div class="modal fade" id="modalCrudMoneda" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="lblTitleCrud">
                                <i class="fa fa-money"></i> Registrar Moneda
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="tile">
                                <div class="overlay p-5" id="divOverlayMoneda">
                                    <div class="m-loader mr-4">
                                        <svg class="m-circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                        </svg>
                                    </div>
                                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayMoneda">Cargando información...</h4>
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
                                            <label>Abreviatura</label>
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
                                            <label>Tipo de cambio</label>
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
                                    <button class="btn btn-success" type="button" id="btnSaveBanco"><i class="fa fa-save"></i> Guardar</button>
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
                        <label>Buscar por el nombre de la moneda:</label>
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
                                        <th style="width:15%">Moneda</th>
                                        <th style="width:15%">Tipo de Cambio</th>
                                        <th style="width:10%">Abr</th>
                                        <th style="width:10%">Moneda Nacional</th>
                                        <th style="width:5%">Predet.</th>
                                        <th style="width:5%">Editar</th>
                                        <th style="width:5%">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="7" class="text-center">!Aún no has registrado ninguna moneda¡</td>
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

                $("#btnAgregar").click(function() {
                    $("#modalCrudMoneda").modal("show");
                });

                tools.keyEnter($("#btnAgregar"), function() {

                });

                $("#btnReload").click(function() {

                });

                tools.keyEnter($("#btnReload"), function() {

                });


                modalComponents();

                loadInitMoneda();
            });

            function modalComponents() {
                $("#modalCrudMoneda").on("shown.bs.modal", function() {
                    $("#txtNombre").focus();
                });

                $("#modalCrudMoneda").on("hide.bs.modal", function() {

                });

                tools.keyNumberFloat($("#txtTipoCambio"));
            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillTableMoneda();
                        break;
                }
            }

            function loadInitMoneda() {
                if (!state) {
                    paginacion = 1;
                    fillTableMoneda();
                    opcion = 0;
                }
            }

            async function fillTableMoneda() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/MonedaController.php", {
                        "type": "all"
                    }, function() {
                        tools.loadTable(tbody, 8);
                        totalPaginacion = 0;
                        state = true;
                    });

                    tbody.empty();

                    if (result.data.length == 0) {
                        tools.loadTableMessage(tbody, "No hay datos para mostrar.", 8);
                        totalPaginacion = 0;
                        state = false;
                    } else {
                        for (let value of result.data) {
                            let predeterminado = value.Predeterminado == 1 ? './images/bandera.png' : './images/unchecked.png';

                            tbody.append(`<tr>
                                <td class="text-center">${value.Id}</td>
                                <td>${value.Simbolo+" - "+value.Nombre}</td>
                                <td>${value.TipoCambio}</td>
                                <td>${value.Abreviado}</td>
                                <td class="text-center"><img width="32" height="32" src="${predeterminado}" alt="${value.Nombre}"/></td>
                                <td class="text-center"><button class="btn btn-info" onclick=""><i class="fa fa-check-square-o"></i></button></td>
                                <td class="text-center"><button class="btn btn-warning" onclick=""><i class="fa fa-edit"></i></button></td>
                                <td class="text-center"><button class="btn btn-danger" onclick=""><i class="fa fa-trash"></i></button></td>
                            </tr>`);
                        }

                        state = false;
                    }
                } catch (error) {
                    tbody.empty();
                    tools.loadTableMessage(tbody, tools.messageError(error), 8);
                    state = false;
                }
            }
        </script>
    </body>

    </html>

<?php

}
