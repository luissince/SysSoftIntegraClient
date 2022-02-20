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

        <!-- modal proceso almacen -->
        <div class="row">
            <div class="modal fade" id="modalCrudAlmacen" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-cubes"></i> Nuevo/Editar almacen
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Nombre <i class="fa fa-info-circle text-danger"></i></label>
                                        <input id="txtNombreAlmacen" type="text" class="form-control" placeholder="Ingrese el nombre del almacen">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Ubigeo <i class="fa fa-info-circle text-danger"></i></label>
                                        <select id="cbxUbigeoAlmacen" class="form-control">
                                            <option value="">--selected--</option>
                                            <option value="1">OPCIÓN 1</option>
                                            <option value="2">OPCIÓN 2</option>
                                            <option value="3">OPCIÓN 3</option>
                                        </select>
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
                                    <button class="btn btn-success" type="button" id="btnSaveAlmacen"><i class="fa fa-save"></i> Guardar</button>
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
                <h1><i class="fa fa-porcent"></i> Impuestos <small>Lista</small></h1>
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
                        <label>Buscar por el nombre del almacen:</label>
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
                                        <th style="width:10%">Fecha</th>
                                        <th style="width:15%">Nombre</th>
                                        <th style="width:20%">Ubigeo</th>
                                        <th style="width:20%">Dirección</th>
                                        <th style="width:5%">Editar</th>
                                        <th style="width:5%">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="7" class="text-center">!Aún no has registrado ningún almacen¡</td>
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
            let tools = new Tools()
            let state = false;
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let filasPorPagina = 10;
            let tbody = $("#tbList");
            let ulPagination = $("#ulPagination");

            let idAlmacen = 0;
            let idUsuario = "<?= $_SESSION['IdEmpleado'] ?>";
            $(document).ready(function() {

                $("#btnAgregar").click(function() {
                    crudAlmacen();
                });

                tools.keyEnter($("#btnAgregar"), function() {
                    crudAlmacen();
                });

                $("#btnReload").click(function() {
                    loadInitAlmacen();
                });

                tools.keyEnter($("#btnReload"), function() {
                    loadInitAlmacen();
                });

                modalComponents();
                loadInitAlmacen();
            });

            function modalComponents() {
                $('#modalCrudAlmacen').on('shown.bs.modal', function() {
                    $("#txtNombre").focus();
                });

                $('#modalCrudAlmacen').on('hide.bs.modal', function() {
                    clearComponents();
                });

                $("#btnSaveAlmacen").click(function() {
                    modalCrudBanco();
                });

                tools.keyEnter($("#btnSaveAlmacen"), function() {
                    modalCrudBanco();
                });

                tools.keyNumberFloat($("#txtSaldo"));
            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillTableAlmacen("");
                        break;
                }
            }

            function loadInitAlmacen() {
                if (!state) {
                    paginacion = 1;
                    fillTableAlmacen("");
                    opcion = 0;
                }
            }

            async function fillTableAlmacen(buscar) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/AlmacenController.php", {
                        "type": "all",
                        "buscar": buscar,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tools.loadTable(tbody, 7);
                        totalPaginacion = 0;
                        state = true;
                    });

                    console.log(result)

                    if (result.data.length == 0) {
                        tools.loadTableMessage(tbody, "No hay datos para mostrar.", 7, true);
                        tools.paginationEmpty(ulPagination);
                        state = false;
                    } else {
                        tbody.empty();

                        for (let value of result.data) {
                            tbody.append(`<tr>
                                <td class="text-center">${value.Id}</td>
                                <td class="text-left">${tools.getDateForma(value.Fecha)}</td>
                                <td class="text-left">${value.Nombre}</td>
                                <td class="text-left">${value.Departamento+"-"+value.Provincia+"-"+value.Distrito+"("+value.Ubigeo+")"}</td>
                                <td class="text-left">${value.Direccion}</td>
                                <td class="text-center"><button class="btn btn-warning" onclick="editarAlmacen('${value.IdAlmacen}')"><i class="fa fa-edit"></i></button></td>
                                <td class="text-center"><button class="btn btn-danger" onclick="removerAlmacen('${value.IdAlmacen}')"><i class="fa fa-trash"></i></button></td>
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
                    tools.loadTableMessage(tbody, tools.messageError(error), 7, true);
                    tools.paginationEmpty(ulPagination);
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

            function crudAlmacen() {
                $("#modalCrudAlmacen").modal("show");
            }

            function agegarAlmacen() {

            }

            function editarAlmacen() {

            }

            function removerAlmacen() {

            }

            function clearComponents() {

            }
        </script>
    </body>

    </html>

<?php

}
