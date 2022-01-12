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
                                <i class="fa fa-close"></i>
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
                <h1><i class="fa fa-folder"></i> Ajuste de Inventario <small>Lista</small></h1>
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
                            <button class="btn btn-danger" id="btnProductosNegativos">
                                <i class="fa fa-long-arrow-down"></i> Lista Producto Negativos
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
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label>Tipo de ajuste:</label>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="radio" id="rbIncremento" name="tbTipoAjuste" checked />
                                    <label for="rbIncremento">
                                        &nbsp; Incremento
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="radio" id="rbDecremento" name="tbTipoAjuste" />
                                    <label for="rbDecremento">
                                        &nbsp; Decremento
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label>Estado del ajuste:</label>
                        <div class="form-group">
                            <input type="checkbox" id="cbEstadoMivimiento" checked>
                            <label for="cbEstadoMivimiento" id="lblEstadoMovimiento"> &nbsp;Validado</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label>Metodo de ajuste:</label>
                        <div class="form-group">
                            <select class="form-control" id="cbTipoMovimiento">
                                <option value="0">--TODOS--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label>Código de Verificación:</label>
                        <div class="form-group">
                            <input type="text" id="txtCodigoVerificacion" class="form-control" placeholder="Ingrese el código de verificación" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>Observación:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="N/D" id="txtObservacion" />
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-header-background">
                                    <tr>
                                        <th>Acción</th>
                                        <th>Clave/Nombre</th>
                                        <th>Marca</th>
                                        <th>Nueva Existencia</th>
                                        <th>Existencia Actual</th>
                                        <th>Diferencia</th>
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
            let rbIncremento = $("#rbIncremento")
            let rbDecremento = $("#rbDecremento");

            let arrayProductos = [];
            let cbTipoMovimiento = $("#cbTipoMovimiento");

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

                rbIncremento.click(function() {
                    loadTipoMovimiento($("#rbIncremento")[0].checked);
                });

                rbDecremento.click(function() {
                    loadTipoMovimiento($("#rbIncremento")[0].checked);
                });

                $("#cbEstadoMivimiento").click(function() {
                    $("#lblEstadoMovimiento").html($("#cbEstadoMivimiento")[0].checked ? "Validado" : "Por Validar");
                });

                $("#txtCodigoVerificacion").val(loadCodeRandom());

                loadComponentsModal();
                loadTipoMovimiento($("#rbIncremento")[0].checked);
            });

            function validateIngreso() {
                let count = 0;
                $("#tbList tr").each(function(row, tr) {
                    for (let producto of arrayProductos) {
                        if ($(tr)[0].id === producto.IdSuministro) {
                            if (!tools.isNumeric($(tr).find("td:eq(3)").find("input").val())) {
                                count++;
                            }
                            break;
                        }
                    }
                });

                if (cbTipoMovimiento.val() === "0" || cbTipoMovimiento.val() === undefined) {
                    tools.AlertWarning("Movimiento", "Seleccione un tipo de movimiento.");
                } else if (arrayProductos.length === 0) {
                    tools.AlertWarning("Movimiento", "No hay productos en la lista para continuar.");
                } else if (count > 0) {
                    tools.AlertWarning("Movimiento", "Hay valores que no son numéricos o menores que 1 en la columna nueva existencia.");
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

                $("#btnProductosNegativos").click(function() {
                    listarProductosNegativos();
                });

                $("#btnProductosNegativos").keypress(function(event) {
                    if (event.keyCode === 13) {
                        listarProductosNegativos();
                    }
                    event.preventDefault();
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
                    });

                    console.log(result)

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

            async function loadTipoMovimiento(ajuste) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/MovimientoController.php", {
                        "type": "listipomovimiento",
                        "ajuste": ajuste,
                        "all": "false"
                    });

                    cbTipoMovimiento.empty();
                    cbTipoMovimiento.append('<option value="0">--TODOS--</option>');
                    for (let tipos of result) {
                        cbTipoMovimiento.append('<option value="' + tipos.IdTipoMovimiento + '">' + tipos.Nombre + '</option>');
                    }
                } catch (error) {

                }
            }

            async function onSelectProducto(idSuministro) {
                $("#id-modal-productos").modal("hide");
                if (!validateDuplicate(idSuministro)) {
                    try {
                        let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                            "type": "getsuministroformovimiento",
                            "idSuministro": idSuministro
                        }, function() {
                            tools.AlertInfo("Movimiento", "Agregando producto.");
                            if (arrayProductos.length === 0) {
                                tbList.empty();
                            }
                        });

                        let suministro = result;
                        arrayProductos.push(suministro);
                        tbList.append('<tr id="' + suministro.IdSuministro + '">' +
                            '<td><button class="btn btn-default" onclick="removeTableTr(\'' + suministro.IdSuministro + '\')"><img src="./images/remove.png" width="24" /></button></td>' +
                            '<td>' + suministro.Clave + '</br>' + suministro.NombreMarca + '</td>' +
                            '<td>' + suministro.MarcaNombre + '</td>' +
                            '<td><input type="number" class="form-control" placeholder="0.00" /></td>' +
                            '<td>' + suministro.Cantidad + " " + suministro.UnidadCompraNombre + '</td>' +
                            '<td>0.00</td>' +
                            '</tr>');

                        tools.AlertSuccess("Movimiento", "Se agregó correctamente a la lista.");

                    } catch (error) {
                        tools.AlertError("Movimiento", "Error al agregar el producto, comuníquese con su proveedor.");
                    }
                } else {
                    tools.AlertWarning("Movimiento", "Hay producto con las mismas características.");
                }
            }

            async function listarProductosNegativos() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                        "type": "listallnegativo"
                    }, function() {
                        tbList.empty();
                        arrayProductos = [];
                        tools.AlertInfo("Movimiento", "Agregando lista de productos.");
                    });

                    for (let suministro of result) {
                        arrayProductos.push(suministro);
                        tbList.append('<tr id="' + suministro.IdSuministro + '">' +
                            '<td><button class="btn btn-default" onclick="removeTableTr(\'' + suministro.IdSuministro + '\')"><img src="./images/remove.png" width="24" /></button></td>' +
                            '<td>' + suministro.Clave + '</br>' + suministro.NombreMarca + '</td>' +
                            '<td>' + suministro.MarcaNombre + '</td>' +
                            '<td><input type="number" class="form-control" placeholder="0.00" /></td>' +
                            '<td>' + suministro.Cantidad + " " + suministro.UnidadCompraNombre + '</td>' +
                            '<td>0.00</td>' +
                            '</tr>');
                    }
                    tools.AlertSuccess("Movimiento", "Se agregó correctamente a la lista.");
                } catch (error) {
                    tools.AlertError("Movimiento", "Error al agregar el producto, comuníquese con su proveedor.");
                }
            }

            async function listarTodosLosProductos() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                        "type": "listallsuministro"
                    }, function() {
                        tbList.empty();
                        arrayProductos = [];
                        tools.AlertInfo("Movimiento", "Agregando lista de productos.");
                    });

                    for (let suministro of result) {
                        arrayProductos.push(suministro);
                        tbList.append('<tr id="' + suministro.IdSuministro + '">' +
                            '<td><button class="btn btn-default" onclick="removeTableTr(\'' + suministro.IdSuministro + '\')"><img src="./images/remove.png" width="24" /></button></td>' +
                            '<td>' + suministro.Clave + '</br>' + suministro.NombreMarca + '</td>' +
                            '<td>' + suministro.MarcaNombre + '</td>' +
                            '<td><input type="number" class="form-control" placeholder="0.00" /></td>' +
                            '<td>' + suministro.Cantidad + " " + suministro.UnidadCompraNombre + '</td>' +
                            '<td>0.00</td>' +
                            '</tr>');
                    }
                    tools.AlertSuccess("Movimiento", "Se agregó correctamente a la lista.");
                } catch (error) {
                    tools.AlertError("Movimiento", "Error al agregar el producto, comuníquese con su proveedor.");
                }
            }

            function registrarMovimiento(newArrayProductos) {
                tools.ModalDialog("Movimiento", '¿Está seguro de continuar?', async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/MovimientoController.php", {
                                "type": "insertmovimiento",
                                "fecha": tools.getCurrentDate(),
                                "hora": tools.getCurrentTime(),
                                "tipoAjuste": rbIncremento[0].checked,
                                "tipoMovimiento": cbTipoMovimiento.val(),
                                "observacion": $("#txtObservacion").val(),
                                "suministro": 1,
                                "estado": $("#cbEstadoMivimiento")[0].checked,
                                "codigoVerificacion": $("#txtCodigoVerificacion").val().trim(),
                                "lista": newArrayProductos
                            }, function() {
                                tools.ModalAlertInfo("Movimiento", "Se está procesando la información.");
                            });

                            tools.ModalAlertSuccess("Movimiento", "Se completo correctamente el movimiento de inventario.");

                            arrayProductos.splice(0, arrayProductos.length);
                            tbList.empty();
                            $("#rbIncremento")[0].checked = true;
                            loadTipoMovimiento($("#rbIncremento")[0].checked);
                            $("#txtObservacion").val("N/D");
                            $("#cbEstadoMivimiento")[0].checked = true;
                        } catch (error) {
                            if (error.responseText == '' || error.responseText == null) {
                                tools.ModalAlertError("Producto", "Se produjo un interno intente nuevamente, por favor.");
                            } else {
                                tools.ModalAlertWarning("Producto", error.responseText);
                            }
                        }
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

            function loadCodeRandom() {
                let d = new Date();
                let rn = Math.floor(Math.random() * (1000 - 100) + 1000);
                return "M" + rn + "" + d.getHours();
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
