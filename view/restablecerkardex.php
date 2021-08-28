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
                                <i class="fa fa-indent">
                                </i> Lista de Productos
                            </h4>
                            <button type="button" class="close" id="btnCloseModal">
                                <i class="fa fa-window-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <label>Buscar:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Buscar producto..." id="txtBuscarProducto" />
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <label>Opción:</label>
                                    <div class="form-group">
                                        <button class="btn btn-secondary" id="btnRecargarProductos">
                                            <img src="./images/reload.png" width="18" /> Recargar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                            <thead style="background-color: #0766cc;color: white;">
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
                <h1><i class="fa fa-folder"></i> Restablecer Kardex <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-success" id="btnGuardar">
                                <img src="./images/save.png" width="18" />Realizar proceso
                            </button>
                            <button class="btn btn-secondary" id="btnProductos">
                                <img src="./images/search.png" width="18" />Buscar productos
                            </button>
                            <button class="btn btn-danger" id="btnTodosProductos">
                                <i class="fa fa-exchange"></i> Lista Todos los Productos
                            </button>
                        </div>
                        <!-- <button class="btn button-secondary margin-10">
                                <img src="./image/reports.png" width="18" />Generar reporte
                            </button> -->
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead style="background-color: #0766cc;color: white;">
                                    <tr>
                                        <th>Acción</th>
                                        <th>Clave/Nombre</th>
                                        <th>Marca</th>
                                        <th>Nueva Existencia</th>
                                        <th>Existencia Actual</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td class="text-center" colspan="6">Tabla sin contenido</td>
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

            let txtBuscarProducto = $("#txtBuscarProducto");
            let tbProductos = $("#tbProductos");
            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            let tbList = $("#tbList");

            let arrayProductos = [];

            $(document).ready(function() {

                $("#btnGuardar").on("click", function(event) {
                    validateIngreso();
                });

                $("#btnGuardar").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        validateIngreso();
                        event.preventDefault();
                    }
                });

                $("#btnProductos").on("click", function(event) {
                    $("#id-modal-productos").modal("show");
                    loadInitProductos();
                });

                $("#btnProductos").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").modal("show");
                        loadInitProductos();
                    }
                    event.preventDefault();
                });

                loadComponentsModal();
            });

            function loadComponentsModal() {
                txtBuscarProducto.on("keyup", function(event) {
                    if (txtBuscarProducto.val().trim().length != 0) {
                        if (!state) {
                            paginacion = 1;
                            ListarProductos(1, txtBuscarProducto.val().trim());
                            opcion = 1;
                        }
                    }
                    event.preventDefault();
                });

                $("#btnCloseModal").on("click", function(event) {
                    $("#id-modal-productos").modal("hide");
                });

                $("#btnCloseModal").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").modal("hide");
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

                $('#id-modal-productos').on('shown.bs.modal', function(e) {
                    txtBuscarProducto.focus();
                });

                $("#btnTodosProductos").click(function() {
                    listarTodosLosProductos();
                });

                $("#btnTodosProductos").keypress(function(event) {
                    if (event.keyCode === 13) {
                        listarTodosLosProductos();
                    }
                    event.preventDefault();
                });

            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        ListarProductos(0, "");
                        break;
                    case 1:
                        ListarProductos(1, txtBuscarProducto.val().trim());
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

            function ListarProductos(tipo, value) {
                $.ajax({
                    url: "../app/controller/SuministroController.php",
                    method: "GET",
                    data: {
                        "type": "modalproductos",
                        "tipo": tipo,
                        "value": value,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    },
                    beforeSend: function() {
                        tbProductos.empty();
                        tbProductos.append('<tr><td class="text-center" colspan="6"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                    },
                    success: function(result) {
                        let object = result;
                        if (object.estado === 1) {
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
                                    tbProductos.append('<tr ondblclick=onSelectProducto(\'' + producto.IdSuministro + '\')>' +
                                        '<td>' + producto.Id + '</td>' +
                                        '<td>' + producto.Clave + '</br>' + producto.NombreMarca + '</td>' +
                                        '<td>' + producto.Categoria + '<br>' + producto.Marca + '</td>' +
                                        '<td>' + tools.formatMoney(parseFloat(producto.Cantidad)) + '</td>' +
                                        '<td>' + producto.ImpuestoNombre + '</td>' +
                                        '<td>' + tools.formatMoney(parseFloat(producto.PrecioVentaGeneral)) + '</td>' +
                                        '</tr>');
                                }
                                totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                                lblPaginaActual.html(paginacion);
                                lblPaginaSiguiente.html(totalPaginacion);
                                state = false;
                            }
                        } else {
                            tbProductos.empty();
                            tbProductos.append('<tr><td class="text-center" colspan="6"><p>' + object.message + '</p></td></tr>');
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbProductos.empty();
                        tbProductos.append('<tr><td class="text-center" colspan="6"><p>' + error.responseText + '</p></td></tr>');
                        state = false;
                    }
                });
            }

            function onSelectProducto(idSuministro) {
                $("#id-modal-productos").modal("hide");
                if (!validateDuplicate(idSuministro)) {
                    $.ajax({
                        url: "../app/controller/SuministroController.php",
                        method: "GET",
                        data: {
                            "type": "getsuministroformovimiento",
                            "idSuministro": idSuministro
                        },
                        beforeSend: function() {
                            tools.AlertInfo("Kardex", "Agregando producto.");
                            if (arrayProductos.length === 0) {
                                tbList.empty();
                            }
                        },
                        success: function(result) {
                            if (result.estado === 1) {
                                let suministro = result.data;
                                arrayProductos.push(suministro);
                                tbList.append('<tr id="' + suministro.IdSuministro + '">' +
                                    '<td><button class="btn btn-secondary" onclick="removeTableTr(\'' + suministro.IdSuministro + '\')"><img src="./images/remove.png" width="24" /></button></td>' +
                                    '<td>' + suministro.Clave + '</br>' + suministro.NombreMarca + '</td>' +
                                    '<td>' + suministro.MarcaNombre + '</td>' +
                                    '<td><input type="number" class="form-control" placeholder="0.00" /></td>' +
                                    '<td>' + suministro.Cantidad + " " + suministro.UnidadCompraNombre + '</td>' +
                                    '</tr>');
                                tools.AlertSuccess("Kardex", "Se agregó correctamente a la lista.");
                            } else {
                                tools.AlertWarning("Kardex", "Problemas en agregar el producto, intente nuevamente.");
                            }
                        },
                        error: function(error) {
                            tools.AlertError("Kardex", "Error al agregar el producto, comuníquese con su proveedor.");
                        }
                    });
                } else {
                    tools.AlertWarning("Kardex", "Hay producto con las mismas características.");
                }
            }

            function listarTodosLosProductos() {
                $.ajax({
                    url: "../app/controller/SuministroController.php",
                    method: "GET",
                    data: {
                        "type": "listallsuministro"
                    },
                    beforeSend: function() {
                        tbList.empty();
                        arrayProductos = [];
                        tools.AlertInfo("Kardex", "Agregando lista de productos.");
                    },
                    success: function(result) {
                        if (result.estado === 1) {
                            for (let suministro of result.suministros) {
                                arrayProductos.push(suministro);
                                tbList.append('<tr id="' + suministro.IdSuministro + '">' +
                                    '<td><button class="btn btn-secondary" onclick="removeTableTr(\'' + suministro.IdSuministro + '\')"><img src="./images/remove.png" width="24" /></button></td>' +
                                    '<td>' + suministro.Clave + '</br>' + suministro.NombreMarca + '</td>' +
                                    '<td>' + suministro.MarcaNombre + '</td>' +
                                    '<td><input type="number" class="form-control" placeholder="0.00" /></td>' +
                                    '<td>' + suministro.Cantidad + " " + suministro.UnidadCompraNombre + '</td>' +
                                    '</tr>');
                            }
                            tools.AlertSuccess("Kardex", "Se agregó correctamente a la lista.");
                        } else {
                            tools.AlertWarning("Kardex", "Problemas en agregar el producto, intente nuevamente.");
                        }
                    },
                    error: function(error) {
                        tools.AlertError("Kardex", "Error al agregar el producto, comuníquese con su proveedor.");
                    }
                });
            }

            function validateIngreso() {
                let count = 0;
                $("#tbList tr").each(function(row, tr) {
                    for (let producto of arrayProductos) {
                        if ($(tr)[0].id === producto.IdSuministro) {
                            if (!tools.isNumeric($(tr).find("td:eq(3)").find("input").val())) {
                                count++;
                            } else if (parseFloat($(tr).find("td:eq(3)").find("input").val()) < 0) {
                                count++;
                            }
                            break;
                        }
                    }
                });

                if (arrayProductos.length === 0) {
                    tools.AlertWarning("Kardex", "No hay productos en la lista para continuar.");
                } else if (count > 0) {
                    tools.AlertWarning("Kardex", "Hay valores que no son numéricos o menores que 0 en lista.");
                } else {
                    let newArrayProductos = [];
                    $("#tbList tr").each(function(row, tr) {
                        for (let producto of arrayProductos) {
                            if ($(tr)[0].id === producto.IdSuministro) {
                                let newProducto = producto;
                                newProducto.Movimiento = parseFloat($(tr).find("td:eq(3)").find("input").val());
                                newArrayProductos.push(newProducto);
                                break;
                            }
                        }
                    });
                    registrarMovimiento(newArrayProductos);
                }
            }

            function registrarMovimiento(newArrayProductos) {
                tools.ModalDialog("Movimiento", '¿Está seguro de continuar?', function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/controller/MovimientoController.php",
                            method: "POST",
                            accepts: "application/json",
                            contentType: "application/json",
                            data: JSON.stringify({
                                "type": "restarkardex",
                                "fecha": tools.getCurrentDate(),
                                "hora": tools.getCurrentTime(),
                                "tipoAjuste": 1,
                                "tipoMovimiento": 4,
                                "observacion": "RESTABLECER KARDEX",
                                "lista": newArrayProductos
                            }),
                            beforeSend: function() {
                                tools.ModalAlertInfo("Kardex", "Se está procesando la petición.");
                            },
                            success: function(result) {
                                if (result.estado === 1) {
                                    tools.ModalAlertSuccess("Movimiento", result.mensaje);
                                    arrayProductos.splice(0, arrayProductos.length);
                                    tbList.empty();
                                } else {
                                    tools.ModalAlertWarning("Kardex", result.mensaje);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Kardex", "Se produjo un error: " + error.responseText);
                            }
                        });
                    }
                });
            }

            function removeTableTr(idSuministro) {
                $("#" + idSuministro).remove();
                for (let i = 0; i < arrayProductos.length; i++) {
                    if (arrayProductos[i].IdSuministro === idSuministro) {
                        arrayProductos.splice(i, 1);
                        break;
                    }
                }
            }

            function validateDuplicate(IdSuministro) {
                let ret = false;
                for (let i = 0; i < arrayProductos.length; i++) {
                    if (arrayProductos[i].IdSuministro === IdSuministro) {
                        ret = true;
                        break;
                    }
                }
                return ret;
            }
        </script>
    </body>

    </html>

<?php

}
