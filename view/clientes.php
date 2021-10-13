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
                <h1><i class="fa fa-folder"></i> Clientes <small>Lista</small></h1>
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
                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Buscar por n° de documento o datos de persona(Enter para completar):</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="..." class="input-primary" id="txtBuscar">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="btnBuscar">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Paginación:</label>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnAnterior">
                                <i class="fa fa-arrow-circle-left"></i>
                            </button>
                            <span class="m-2" id="lblPaginaActual">0</span>
                            <span class="m-2">de</span>
                            <span class="m-2" id="lblPaginaSiguiente">0</span>
                            <button class="btn btn-primary" id="btnSiguiente">
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
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
                                        <th style="width:20%">Datos Personales</th>
                                        <th style="width:10%">Teléfono/Celular</th>
                                        <th style="width:25%">Dirección</th>
                                        <th style="width:10%">Representante</th>
                                        <th style="width:5%">Predeterminado</th>
                                        <th style="width:5%">Editar</th>
                                        <th style="width:5%">Eliminar</th>
                                        <th style="width:5%">Predeterminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">

                                </tbody>
                            </table>
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
            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");


            $(document).ready(function() {

                $("#btnAnterior").click(function() {
                    if (!state) {
                        if (paginacion > 1) {
                            paginacion--;
                            onEventPaginacion();
                        }
                    }
                });

                $("#btnSiguiente").click(function() {
                    if (!state) {
                        if (paginacion < totalPaginacion) {
                            paginacion++;
                            onEventPaginacion();
                        }
                    }
                });

                $("#txtBuscar").keyup(function(event) {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (event.keyCode === 13) {
                            if ($("#txtBuscar").val().trim() != "") {
                                if (!state) {
                                    paginacion = 1;
                                    loadListaClientes($("#txtBuscar").val().trim());
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
                            loadListaClientes($("#txtBuscar").val().trim());
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
                    loadInitClientes();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadInitClientes();
                    }
                    event.preventDefault();
                });

                loadInitClientes();
            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        loadListaClientes("");
                        break;
                }
            }

            function loadInitClientes() {
                if (!state) {
                    paginacion = 1;
                    loadListaClientes("");
                    opcion = 0;
                }
            }

            async function loadListaClientes(nombre) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/ClienteController.php", {
                        "type": "allcliente",
                        "nombre": nombre,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="10"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                        totalPaginacion = 0;
                    });

                    let object = result;
                    if (object.estado === 1) {
                        tbList.empty();

                        if (object.data.length == 0) {
                            tbList.append('<tr><td class="text-center" colspan="10"><p>No hay datos para mostrar.</p></td></tr>');
                            lblPaginaActual.html(0);
                            lblPaginaSiguiente.html(0);
                            state = false;
                        } else {

                            for (let cliente of object.data) {
                                let predeterminado = cliente.Predeterminado == 1 ? './images/checked.png' : './images/unchecked.png';

                                tbList.append('<tr>' +
                                    '<td class="text-center">' + cliente.Id + '</td>' +
                                    '<td class="text-left">' + cliente.NumeroDocumento + '</td>' +
                                    '<td class="text-left">' + cliente.Informacion + '</td>' +
                                    '<td class="text-left">' + cliente.Telefono + '<br>' + cliente.Celular + '</td>' +
                                    '<td class="text-left">' + cliente.Direccion + '</td>' +
                                    '<td class="text-left">' + cliente.Representante + '</td>' +
                                    '<td class="text-center"><img width="32" height="32" src="' + predeterminado + '" alt="Producto"/></td>' +
                                    '<td class="text-center"><button class="btn btn-warning"><i class="fa fa-edit"></i><button</td>' +
                                    '<td class="text-center"><button class="btn btn-danger"><i class="fa fa-trash"></i><button</td>' +
                                    '<td class="text-center"><button class="btn btn-info"><i class="fa fa-check-square-o"></i><button</td>' +
                                    '</tr>');
                            }
                            totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                            lblPaginaActual.html(paginacion);
                            lblPaginaSiguiente.html(totalPaginacion);
                            state = false;
                        }
                    } else {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="10"><p>' + object.message + '</p></td></tr>');
                        lblPaginaActual.html("0");
                        lblPaginaSiguiente.html("0");
                        state = false;
                    }
                } catch (error) {
                    tbList.empty();
                    tbList.append('<tr><td class="text-center" colspan="10"><p>' + error.responseText + '</p></td></tr>');
                    lblPaginaActual.html("0");
                    lblPaginaSiguiente.html("0");
                    state = false;
                }
            }
        </script>
    </body>

    </html>

<?php

}
