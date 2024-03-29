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

        <!-- modal productos -->
        <div class="row">
            <div class="modal fade" id="id-modal-productos" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-window-maximize">
                                </i> Lista de Productos
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>Buscar por Nombre del Producto o Clave/Clave Alterna:</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Buscar producto..." id="txtBuscarProducto" />
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" id="btnRecargarProductos">
                                                    <img src="./images/reload.png" width="18" /> Recargar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-header-background">
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Clave/Nombre</th>
                                                    <th>Categoría/Marca</th>
                                                    <th>Cantidad</th>
                                                    <th>Impuesto</th>
                                                    <th>Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbProductos">
                                                <tr>
                                                    <td class="text-center" colspan="6">
                                                        <p>Inicia la busqueda.</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
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

                    </div>
                </div>
            </div>
        </div>
        <!-- modal productos -->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Kardex <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnProductos">
                                <i class="fa fa-archive"></i> Productos
                            </button>
                            <a href="restablecerkardex.php" class="btn btn-secondary" id="btnRestablecer">
                                <i class="fa fa-eraser"></i>
                                Restablecer Kardex
                            </a>
                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i> Recargar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><img src="./images/barcode.png" width="22" height="22"> Buscar por clave o clave alterna:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtSearch">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><img src="./images/almacen.png" width="22" height="22"> Almacen:</label>
                            <div class="input-group">
                                <select class="form-control" id="cbAlmacen">
                                    <option value="">Cargando información...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Nombre de Producto:</label>
                        <div class="form-group">
                            <label class="text-primary text-bold text-md" id="lblProducto">Producto</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Metodo</label>
                        <div class="form-group">
                            <label class="text-primary text-bold text-md">Promedio ponderado</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Cantidad Actual</label>
                        <div class="form-group">
                            <label class="text-primary text-bold text-md" id="lblCantidadActual">0.00</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Valor Actual</label>
                        <div class="form-group">
                            <label class="text-primary text-bold text-md" id="lblValorActual">0.00</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width: 5%;" rowspan="2">N°</th>
                                        <th style="width: 10%;" rowspan="2">Fecha</th>
                                        <th style="width: 25%;" rowspan="2">Detalle</th>
                                        <th style="width: 15%;" class="text-center" colspan="3">Unidades</th>
                                        <th style="width: 15%;" class="text-center" colspan="1">Cambios</th>
                                        <th style="width: 15%;" class="text-center" colspan="3">Valores</th>
                                    </tr>
                                    <tr>

                                        <th style="width: 10%;" class="text-center">Entrada</th>
                                        <th style="width: 10%;" class="text-center">Salida</th>
                                        <th style="width: 10%;" class="text-center">Existencia</th>
                                        <th style="width: 10%;" class="text-center">Costo variable</th>
                                        <th style="width: 10%;" class="text-center">Debe</th>
                                        <th style="width: 10%;" class="text-center">Haber</th>
                                        <th style="width: 10%;" class="text-center">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td class="text-center" colspan="10">
                                            <p>Tabla sin contenido.</p>
                                        </td>
                                    </tr>
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
            let filasPorPagina = 10;

            let tbProductos = $("#tbProductos");
            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            let tbList = $("#tbList");
            let cbAlmacen = $("#cbAlmacen");

            $(document).ready(function() {

                $("#btnProductos").on("click", function(event) {
                    $("#id-modal-productos").modal("show");
                });

                $("#btnProductos").keyup(function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").modal("show");
                        event.preventDefault();
                    }
                });

                $("#txtSearch").keydown(function(event) {
                    if (event.keyCode === 13) {
                        if (!tools.validateComboBox(cbAlmacen)) {
                            GetSuministroById($("#txtSearch").val());
                        }
                        event.preventDefault();
                    }
                });

                $("#btnBuscar").click(function(event) {
                    if (!tools.validateComboBox(cbAlmacen)) {
                        GetSuministroById($("#txtSearch").val());
                    }
                });

                $("#btnBuscar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        if (!tools.validateComboBox(cbAlmacen)) {
                            GetSuministroById($("#txtSearch").val());
                        }
                        event.preventDefault();
                    }
                });

                $("#btnReload").click(function() {
                    clearElements();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        clearElements();
                    }
                    event.preventDefault();
                });
                loadAlmacen();
                loadComponentsModal();
            });

            function loadComponentsModal() {

                $('#id-modal-productos').on('shown.bs.modal', function(e) {
                    $("#txtBuscarProducto").focus();
                    loadInitProductos();
                });

                $('#id-modal-productos').on('hide.bs.modal', function(e) {
                    tbProductos.empty();
                    tbProductos.append('<tr><td class="text-center" colspan="6"><p>Inicia la busqueda.</p></td></tr>');
                });

                $("#txtBuscarProducto").keyup(function(event) {
                    if ($(this).val().trim().length != 0) {
                        if (!state) {
                            paginacion = 1;
                            ListarProductos(1, $(this).val().trim());
                            opcion = 1;
                        }
                    }
                    event.preventDefault();
                });

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

                $("#btnRecargarProductos").click(function() {
                    loadInitProductos();
                });

            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        ListarProductos(0, "");
                        break;
                    case 1:
                        ListarProductos(1, $("#txtBuscarProducto").val().trim());
                        break;
                }
            }

            function loadInitProductos() {
                if (!state) {
                    paginacion = 1;
                    ListarProductos(0, "");
                    opcion = 0;
                }
            }

            async function ListarProductos(tipo, value) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                        "type": "modalproductos",
                        "tipo": tipo,
                        "value": value,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tbProductos.empty();
                        tbProductos.append('<tr><td class="text-center" colspan="6"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                        totalPaginacionProductos = 0;
                    });

                    let object = result;
                    tbProductos.empty();

                    let productos = object.data;
                    if (productos.length === 0) {
                        tbProductos.append('<tr><td class="text-center" colspan="6"><p>No hay datos para mostrar</p></td></tr>');
                        totalPaginacion = 0;
                        lblPaginaActual.html(0);
                        lblPaginaSiguiente.html(0);
                        state = false;
                    } else {
                        for (let producto of productos) {
                            let cantidad = producto.Cantidad <= 0 ? "<span class='text-danger'>" + tools.formatMoney(parseFloat(producto.Cantidad)) + '<br>' + producto.UnidadCompraName + "</span>" : "<span class='text-success'>" + tools.formatMoney(parseFloat(producto.Cantidad)) + '<br>' + producto.UnidadCompraName + "</span>";
                            tbProductos.append('<tr ondblclick="onSelectProducto(\'' + producto.IdSuministro + '\',\'' + producto.NombreMarca + '\')">' +
                                '<td>' + producto.Id + '</td>' +
                                '<td>' + producto.Clave + '</br>' + producto.NombreMarca + '</td>' +
                                '<td>' + producto.Categoria + '<br>' + producto.Marca + '</td>' +
                                '<td>' + cantidad + '</td>' +
                                '<td>' + producto.ImpuestoNombre + '</td>' +
                                '<td>' + tools.formatMoney(parseFloat(producto.PrecioVentaGeneral)) + '</td>' +
                                '</tr>');
                        }
                        totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                        lblPaginaActual.html(paginacion);
                        lblPaginaSiguiente.html(totalPaginacion);
                        state = false;
                    }
                } catch (error) {
                    tbProductos.empty();
                    tbProductos.append('<tr><td class="text-center" colspan="6"><p>' + error.responseText + '</p></td></tr>');
                    state = false;
                }
            }

            function onSelectProducto(idSuministro, nombreMarca) {
                $("#id-modal-productos").modal("hide");
                fillKardexTable(idSuministro, nombreMarca);
            }

            async function fillKardexTable(idSuministro, nombreMarca) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                        "type": "kardexlista",
                        "idSuministro": idSuministro,
                        "idAlmacen": cbAlmacen.val() == "" ? 0 : cbAlmacen.val()
                    }, function() {
                        $("#lblProducto").html(nombreMarca);
                        $("#lblCantidadActual").html("0.00");
                        $("#lblValorActual").html("0.00");
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="10"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');

                    });

                    if (result.kardex.length == 0) {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="10"><p>No hay datos para mostrar.</p></td></tr>');
                    } else {
                        tbList.empty();
                        for (let value of result.kardex) {
                            tbList.append('<tr>' +
                                '<td class="text-left">' + value.Id + '</td>' +
                                '<td class="text-left">' + tools.getDateForma(value.Fecha) + '<br>' + tools.getTimeForma24(value.Hora) + '</td>' +
                                '<td class="text-left">' + value.Nombre + '<br>' + value.Detalle + '</td>' +
                                '<td class="text-right text-bold" style="background-color:#c6efd0;color:#297521;">' + (value.Tipo == "1" ? tools.formatMoney(value.Cantidad) : "") + '</td>' +
                                '<td class="text-right text-bold" style="background-color:#ffc6d1;color:#890d15;">' + (value.Tipo == "2" ? "-" + tools.formatMoney(value.Cantidad) : "") + '</td>' +
                                '<td class="text-right">' + tools.formatMoney(value.Existencia) + '</td>' +
                                '<td class="text-right">' + tools.formatMoney(value.Costo) + '</td>' +
                                '<td class="text-right">' + (value.Tipo == "1" ? tools.formatMoney(value.Total) : "") + '</td>' +
                                '<td class="text-right">' + (value.Tipo == "2" ? "-" + tools.formatMoney(value.Total) : "") + '</td>' +
                                '<td class="text-right">' + tools.formatMoney(value.Saldo) + '</td>' +
                                '</tr>');
                        }

                        $("#lblCantidadActual").html(tools.formatMoney(result.cantidad));
                        $("#lblValorActual").html(tools.formatMoney(result.saldo));
                    }

                } catch (error) {
                    tbList.empty();
                    tbList.append('<tr><td class="text-center" colspan="10"> <p>' + error.responseText + '</p></td></tr>');
                }
            }

            async function loadAlmacen() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/AlmacenController.php", {
                        "type": "almacencombobox"
                    }, function() {
                        cbAlmacen.empty();
                    });

                    for (let value of result) {
                        cbAlmacen.append('<option value="' + value.IdAlmacen + '">' + value.Nombre + '</option> ');
                    }
                } catch (error) {

                }
            }

            async function GetSuministroById(idSuministro) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                        "type": "getproducto",
                        "idSuministro": idSuministro
                    });
                    fillKardexTable(result.suministro.IdSuministro, result.suministro.NombreGenerico);
                } catch (error) {

                }
            }

            function clearElements() {
                tbList.empty();
                tbList.append('<tr><td class="text-center" colspan="10"><p>Tabla sin contenido.</p> </td></tr>');
                $("#lblProducto").html("Producto");
                $("#lblCantidadActual").html("0.00");
                $("#lblValorActual").html("0.00");
                $("#txtSearch").val("");
                $("#txtSearch").focus();
            }
        </script>
    </body>

    </html>

<?php

}
