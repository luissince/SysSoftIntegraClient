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
                <h1><i class="fa fa-folder"></i> Inventario <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i> Recargar
                            </button>
                            <button class="btn btn-danger" id="btnPdf">
                                <i class="fa fa-file-pdf-o"></i> Pdf
                            </button>
                            <button class="btn btn-success" id="btnExcel">
                                <i class="fa fa-file-excel-o"></i> Excel
                            </button>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <label>Buscar por clave:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ingrese la clave o clave alterna" id="txtClaveProducto">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Buscar por descripción:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ingrese la descripción del producto" id="txtDescripcionProducto">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Opciones de cantidades:</label>
                        <div class="form-group">
                            <select class="form-control" id="cbCantidades">
                                <option value="0">Todas las Cantidades</option>
                                <option value="1">Cantidades negativas</option>
                                <option value="2">Cantidades intermedias</option>
                                <option value="3">Cantidades necesaria</option>
                                <option value="4">Cantidades excedentes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead style="background-color: #0766cc;color: white;">
                                    <tr>
                                        <th style="width: 5%;">N°</th>
                                        <th style="width: 25%;">Descripción</th>
                                        <th style="width: 10%;">Categoría</th>
                                        <th style="width: 10%;">Marca</th>
                                        <th style="width: 15%;">Cantidad</th>
                                        <th style="width: 15%;">Inv.Min / Inv.Max</th>
                                        <th style="width: 10%;">Inventario</th>
                                        <th style="width: 5%;">Estado</th>
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

            let tbody = $("#tbList");
            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            $(document).ready(function() {

                loadInitInventario();

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

                $("#btnReload").click(function(event) {
                    loadInitInventario();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadInitInventario();
                    }
                    event.preventDefault();
                });

                $("#btnPdf").click(function() {

                });

                $("#btnPdf").keypress(function(event) {
                    if (event.keyCode == 13) {

                    }
                    event.preventDefault();
                });

                $("#btnPdf").click(function() {

                });

                $("#btnPdf").keypress(function(event) {
                    if (event.keyCode == 13) {

                    }
                    event.preventDefault();
                });

                $("#txtClaveProducto").on("keyup", function() {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if ($("#txtClaveProducto").val().trim() !== "") {
                            if (!state) {
                                paginacion = 1;
                                fillInventarioTable(1, $("#txtClaveProducto").val(), "", 0);
                                opcion = 1;
                            }
                        }
                    }

                });

                $("#txtDescripcionProducto").on("keyup", function() {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if ($("#txtDescripcionProducto").val().trim() !== "") {
                            if (!state) {
                                paginacion = 1;
                                fillInventarioTable(2, "", $("#txtDescripcionProducto").val(), 0);
                                opcion = 2;
                            }
                        }
                    }
                });

                $("#cbCantidades").change(function() {
                    if (!state) {
                        paginacion = 1;
                        fillInventarioTable(3, "", "", $("#cbCantidades").val());
                        opcion = 3;
                    }
                });


            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillInventarioTable(0, "", "", 0);
                        break;
                    case 1:
                        fillInventarioTable(1, $("#txtClaveProducto").val(), "", 0);
                        break;
                    case 2:
                        fillInventarioTable(2, "", $("#txtDescripcionProducto").val(), 0);
                        break;
                    case 3:
                        fillInventarioTable(3, "", "", $("#cbCantidades").val());
                        break;
                }
            }

            function loadInitInventario() {
                if (!state) {
                    paginacion = 1;
                    fillInventarioTable(0, "", "", 0);
                    opcion = 0;
                }
            }

            function fillInventarioTable(opcion, clave, nombre, existencia) {
                $.ajax({
                    url: "../app/controller/suministros/ListarInventario.php",
                    method: "GET",
                    data: {
                        "producto": clave,
                        "existencia": existencia,
                        "nombre": nombre,
                        "opcion": opcion,
                        "categoria": 0,
                        "marca": 0,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    },
                    beforeSend: function() {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="8"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                    },
                    success: function(result) {
                        let object = result;
                        if (object.estado === 1) {
                            let suministros = object.data;
                            if (suministros.length == 0) {
                                tbody.empty();
                                tbody.append('<tr><td class="text-center" colspan="8"><p>No hay datos para mostrar</p></td></tr>');
                                lblPaginaActual.html(0);
                                lblPaginaSiguiente.html(0);
                                state = false;
                            } else {
                                tbody.empty();
                                for (let suministro of suministros) {
                                    tbody.append('<tr>' +
                                        '<td class="td-center">' + suministro.count + '</td>' +
                                        '<td class="td-left">' + suministro.Clave + (suministro.ClaveAlterna === "" ? "" : "-" + suministro.ClaveAlterna) + "</br>" + suministro.NombreMarca + '</td>' +
                                        '<td class="td-left">' + suministro.Categoria + '</td>' +
                                        '<td class="td-left">' + suministro.Marca + '</td>' +
                                        '<td class="' + (suministro.Cantidad <= 0 ? "td-right  text-danger " : " td-right text-success") + '">' + tools.formatMoney(suministro.Cantidad) + " " + suministro.UnidadCompra + '</td>' +
                                        //                                            '<td data-label="Costo General" class="td-right">' + formatMoney(suministro.PrecioCompra) + '</td>' +
                                        //                                            '<td data-label="Precio General" class="td-right">' + formatMoney(suministro.PrecioVentaGeneral) + '</td>' +
                                        '<td class="td-right">' + (tools.formatMoney(suministro.StockMinimo) + " - " + tools.formatMoney(suministro.StockMaximo)) + '</td>' +
                                        '<td class="' + (suministro.Inventario === "1" ? "td-center text-success" : "td-center text-danger") + '">' + (suministro.Inventario === "1" ? "Si" : "No") + '</td>' +
                                        '<td class="td-center">' + (suministro.Estado === "1" ? "Activo" : "Inactivo") + '</td>' +
                                        '</tr>');
                                }
                                totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                                lblPaginaActual.html(paginacion);
                                lblPaginaSiguiente.html(totalPaginacion);
                                state = false;
                            }
                        } else {
                            tbody.empty();
                            tbody.append('<tr><td class="text-center" colspan="8"><p>' + object.mensaje + '</p></td></tr>');
                            lblPaginaActual.html(0);
                            lblPaginaSiguiente.html(0);
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="8"><p>Error en: ' + error.responseText + '</p></td></tr>');
                        lblPaginaActual.html(0);
                        lblPaginaSiguiente.html(0);
                        state = false;
                    }
                });
            }
        </script>
    </body>

    </html>

<?php

}
