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
                    // window.location.href = "registrarproducto.php";
                });

                $("#btnAgregar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        // window.location.href = "registrarproducto.php";
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
                                    '<td class="text-center"><button class="btn btn-warning"><i class="fa fa-edit"></i><button</td>' +
                                    '<td class="text-center"><button class="btn btn-danger"><i class="fa fa-trash"></i><button</td>' +
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
        </script>
    </body>

    </html>

<?php

}
