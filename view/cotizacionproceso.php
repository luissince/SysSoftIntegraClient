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
        <!--  -->
        <?php include "./layout/cotizacion/modalProductos.php"; ?>
        <!--  -->
        <!--  -->
        <?php include "./layout/cotizacion/modalCotizacion.php"; ?>
        <!--  -->
        <!--  -->
        <?php include "./layout/cotizacion/modalEditarProducto.php"; ?>
        <!--  -->

        <main class="app-content">

            <div class="tile mb-4">
                <div class="overlay p-5" id="divOverlayPuntoVenta">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayPuntoVenta">Cargando información...</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h4 class="mr-3"> Cotización</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-secondary" id="btnProductos"><i class="fa fa-archive"></i> Productos</button>
                            <button class="btn btn-secondary" id="btnCotizaciones"><i class="fa fa-list-alt"></i> Cotización</button>
                            <button class="btn btn-secondary" id="btnLimpiar"><i class="fa fa-refresh"></i> Limpiar</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <label><img src="./images/client.png" width="22" height="22"> Cliente:</label>
                        <div class="form-group">
                            <select class="select2-selection__rendered form-control" id="cbCliente">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha de Emisión:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaEmision" disabled>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha de Vencimiento:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaVencimiento">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-header-background">
                                    <tr role="row">
                                        <th width="5%">Quitar</th>
                                        <th width="5%">Editar</th>
                                        <th width="15%">Cantidad</th>
                                        <th width="30%">Descripción</th>
                                        <th width="15%">Impuesto</th>
                                        <th width="15%">Precio</th>
                                        <th width="15%">Medida</th>
                                        <th width="20%">Importe</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="8" class="text-center">!No hay datos para mostrar¡</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label><img src="./images/asignacion.png" width="22" height="22"> Observación:</label>
                            <input class="form-control" type="text" id="txtObservacion" placeholder="Ingrese alguna observación">
                        </div>

                        <div class="form-group">
                            <label><img src="./images/moneda.png" width="22" height="22"> Moneda:</label>
                            <select class="form-control" id="cbMoneda">
                                <option value="">- Seleccione -</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 justify-content-end">
                        <table class="table border-0">
                            <tbody>
                                <tr>
                                    <td style="border:none;padding:5px 0;">IMPORTE BRUTO:</td>
                                    <td style="border:none;padding:0;text-align:right;" id="lblImporteBruto">M 0.00</td>
                                </tr>
                                <tr>
                                    <td style="border:none;padding:5px 0;">DESCUESTO TOTAL:</td>
                                    <td style="border:none;padding:0;text-align:right;" id="lblDescuentoBruto">M 0.00</td>
                                </tr>
                                <tr>
                                    <td style="border:none;padding:5px 0;">SUB IMPORTE:</td>
                                    <td style="border:none;padding:0;text-align:right;" id="lblSubImporteNeto">M 0.00</td>
                                </tr>
                                <tr>
                                    <td style="border:none;padding:5px 0;">IMPUESTO:</td>
                                    <td style="border:none;padding:0;text-align:right;" id="lblImpuestoNeto">M 0.00</td>
                                </tr>
                                <tr>
                                    <td style="border:none;padding:5px 0;">IMPORTE NETO:</td>
                                    <td style="border:none;padding:0;text-align:right;" id="lblImporteNeto">M 0.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script src="js/cotizacion/modalProductos.js"></script>
        <script src="js/cotizacion/modalCotizacion.js"></script>
        <script>
            let tools = new Tools();
            let modalProductos = new ModalProductos();
            let modalCotizacion = new ModalCotizacion();

            let monedaSimbolo = "M";
            let importeBrutoTotal = 0;
            let descuentoBrutoTotal = 0;
            let subImporteNetoTotal = 0;
            let impuestoNetoTotal = 0;
            let importeNetoTotal = 0;

            let listaProductos = [];

            let idEmpleado = "<?= $_SESSION['IdEmpleado'] ?>";

            let idCotizacion = 0;

            $(document).ready(function() {
                modalProductos.init();
                modalCotizacion.init();
                selectCliente();

                $("#txtFechaEmision").val(tools.getCurrentDate());
                $("#txtFechaVencimiento").val(tools.getCurrentDate());


                $("#btnGuardar").click(function() {
                    GuardarCotizacion();
                });

                $("#btnGuardar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        GuardarCotizacion();
                        event.preventDefault();
                    }
                });

                $("#btnLimpiar").click(function() {
                    resetCotizacion();
                });

                $("#btnLimpiar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        resetCotizacion();
                        event.preventDefault();
                    }
                });

                tools.keyNumberFloat($("#txtCantidadEdit"));
                tools.keyNumberFloat($("#txtPrecioEdit"));

                loadInit();
            });

            async function loadInit() {
                try {
                    $("#lblTextOverlayPuntoVenta").html("Cargando información...");
                    $("#cbMoneda").empty();

                    let promiseFetchMoneda = tools.promiseFetchGet("../app/controller/MonedaController.php", {
                        "type": "getmonedacombobox"
                    });

                    let promise = await Promise.all([promiseFetchMoneda]);
                    let result = await promise;

                    let moneda = result[0];

                    $("#cbMoneda").append('<option value="">- Seleccione -</option>')
                    for (let value of moneda) {
                        $("#cbMoneda").append('<option value="' + value.IdMoneda + '">' + value.Nombre + '</option>');
                    }

                    for (let value of moneda) {
                        if (value.Predeterminado == "1") {
                            $("#cbMoneda").val(value.IdMoneda);
                            monedaSimbolo = value.Simbolo;
                            break;
                        }
                    }

                    $("#lblTotal").html(monedaSimbolo + " " + tools.formatMoney(importeNetoTotal));

                    $("#lblImporteBruto").html(monedaSimbolo + " " + tools.formatMoney(importeBrutoTotal));
                    $("#lblDescuentoBruto").html(monedaSimbolo + " " + tools.formatMoney(descuentoBrutoTotal));
                    $("#lblSubImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(subImporteNetoTotal));
                    $("#lblImpuestoNeto").html(monedaSimbolo + " " + tools.formatMoney(impuestoNetoTotal));
                    $("#lblImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(importeNetoTotal));

                    $("#divOverlayPuntoVenta").addClass("d-none");
                } catch (error) {
                    $("#lblTextOverlayPuntoVenta").html(error.message);
                }
            }

            function removeDetalleProducto(idSuministro) {
                for (let i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i].idSuministro == idSuministro) {
                        listaProductos.splice(i, 1);
                        i--;
                        break;
                    }
                }
                renderTableProductos();
            }

            function editDetalleProducto(idSuministro, cantidad, precio, idUnidadCompra, unidadCompra) {
                $("#modalEditProducto").modal("show");

                $("#modalEditProducto").on("shown.bs.modal", function() {
                    $("#txtCantidadEdit").val(cantidad);
                    $("#txtPrecioEdit").val(precio);
                    $("#txtCantidadEdit").focus();


                    var data = [{
                        id: idUnidadCompra,
                        text: unidadCompra
                    }];

                    $("#cbMedidaEdit").empty();
                    $('#cbMedidaEdit').select2({
                        width: '100%',
                        data: data,
                        placeholder: "Buscar Unidad de Medida",
                        ajax: {
                            url: "../app/controller/DetalleController.php",
                            type: "GET",
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    type: "fillunidad",
                                    search: params.term
                                };
                            },
                            processResults: function(response) {
                                let datafill = response.map((item, index) => {
                                    return {
                                        id: item.IdDetalle,
                                        text: item.Nombre
                                    };
                                });
                                return {
                                    results: datafill
                                };
                            },
                            cache: true
                        }

                    });
                });


                $("#modalEditProducto").on("hide.bs.modal", function() {
                    $("#txtCantidadEdit").val('');
                    $("#txtPrecioEdit").val('');
                });

                $("#txtCantidadEdit").unbind();
                $("#txtCantidadEdit").bind("keypress", function(event) {
                    if (event.keyCode == 13) {
                        onEventEditProducto(idSuministro, $("#txtCantidadEdit").val(), $("#txtPrecioEdit").val(), $("#cbMedidaEdit").val(), $("#cbMedidaEdit option:selected").text());
                        event.preventDefault();
                    }
                });

                $("#txtPrecioEdit").unbind();
                $("#txtPrecioEdit").bind("keypress", function(event) {
                    if (event.keyCode == 13) {
                        onEventEditProducto(idSuministro, $("#txtCantidadEdit").val(), $("#txtPrecioEdit").val(), $("#cbMedidaEdit").val(), $("#cbMedidaEdit option:selected").text());
                        event.preventDefault();
                    }
                });

                $("#btnSaveEditProducto").unbind();
                $("#btnSaveEditProducto").bind("click", function() {
                    onEventEditProducto(idSuministro, $("#txtCantidadEdit").val(), $("#txtPrecioEdit").val(), $("#cbMedidaEdit").val(), $("#cbMedidaEdit option:selected").text());
                });

                $("#btnSaveEditProducto").bind("keypress", function(event) {
                    if (event.keyCode == 13) {
                        onEventEditProducto(idSuministro, $("#txtCantidadEdit").val(), $("#txtPrecioEdit").val(), $("#cbMedidaEdit").val(), $("#cbMedidaEdit option:selected").text());
                        event.preventDefault();
                    }
                });
            }

            function onEventEditProducto(idSuministro, cantidad, precio, idMedida, medida) {
                for (let i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i].idSuministro == idSuministro) {
                        let suministro = listaProductos[i];
                        suministro.cantidad = tools.isNumeric(cantidad) ? parseFloat(cantidad) <= 0 ? 1 : parseFloat(cantidad) : 1;
                        suministro.precioVentaGeneral = tools.isNumeric(precio) ? parseFloat(precio) <= 0 ? 1 : parseFloat(precio) : 1;
                        suministro.idUnidadCompra = idMedida;
                        suministro.unidadCompra = medida;
                        break;
                    }
                }
                renderTableProductos();
                $("#modalEditProducto").modal("hide");
            }

            onKeyPressTable = function(value) {
                var key = window.Event ? event.which : event.keyCode;
                var c = String.fromCharCode(key);
                if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                    event.preventDefault();
                }
                if (c === '.' && value.value.includes(".")) {
                    event.preventDefault();
                }
            }

            onKeyDownTableCantidad = function(value, idSuministro) {
                if (event.keyCode == 13) {
                    for (let i = 0; i < listaProductos.length; i++) {
                        if (listaProductos[i].idSuministro == idSuministro) {
                            let suministro = listaProductos[i];
                            suministro.cantidad = tools.isNumeric(value.value) ? value.value <= 0 ? 1 : parseFloat(value.value) : 1;
                            break;
                        }
                    }
                    renderTableProductos();
                    event.preventDefault();
                }
            }

            onKeyDownTablePrecio = function(value, idSuministro) {
                if (event.keyCode == 13) {
                    for (let i = 0; i < listaProductos.length; i++) {
                        if (listaProductos[i].idSuministro == idSuministro) {
                            let suministro = listaProductos[i];
                            let monto = tools.isNumeric(value.value) ? value.value <= 0 ? 1 : parseFloat(value.value) : 1;
                            suministro.precioVentaGeneral = monto;

                            break;
                        }
                    }
                    renderTableProductos();
                    event.preventDefault();
                }
            }

            onFocusOutTable = function() {
                renderTableProductos();
            }

            onClickTable = function(idSuministro) {
                $("#" + idSuministro).removeAttr("readonly");
            }

            function renderTableProductos() {
                $("#tbList").empty();
                importeBrutoTotal = 0;
                descuentoBrutoTotal = 0;
                subImporteNetoTotal = 0;
                impuestoNetoTotal = 0;
                importeNetoTotal = 0;

                if (listaProductos.length == 0) {
                    $("#tbList").append(`<tr><td colspan="8" align="center"> !No hay datos para mostrar¡ </td></tr>`);
                } else {
                    for (let value of listaProductos) {
                        $("#tbList").append(`<tr role="row" class="odd">
                            <td class="text-center"><button class="btn btn-danger" onclick="removeDetalleProducto('${ value.idSuministro }')"><i class="fa fa-trash"></i></button></td>
                            <td class="text-center"><button class="btn btn-warning" onclick="editDetalleProducto('${ value.idSuministro }','${value.cantidad}','${value.precioVentaGeneral}','${value.idUnidadCompra }','${value.unidadCompra }')"><i class="fa fa-edit"></i></button></td>
                            <td><input readonly id="${'c-' + value.idSuministro }" type="text" class="form-control" placeholder="0" onkeypress="onKeyPressTable(this)" onkeydown="onKeyDownTableCantidad(this,'${ value.idSuministro }')" value="${ tools.formatMoney(value.cantidad) }" onfocusout="onFocusOutTable()" ondblclick="onClickTable('${ "c-" + value.idSuministro }')" autocomplete="off" /></td>
                            <td>${ value.clave+'<br>'+ value.nombreMarca } </td>
                            <td class="text-center">${ value.impuestoNombre }</td>
                            <td><input readonly id="${'p-' + value.idSuministro }" type="text" class="form-control" placeholder="0" onkeypress="onKeyPressTable(this)"  onkeydown="onKeyDownTablePrecio(this,'${ value.idSuministro }')" value="${ tools.formatMoney(value.precioVentaGeneral) }" onfocusout="onFocusOutTable()" ondblclick="onClickTable('${ "p-" + value.idSuministro }')" autocomplete="off" /></td>
                            <td class="text-center">${value.unidadCompra }</td>
                            <td class="text-center">${ tools.formatMoney(value.cantidad * (value.precioVentaGeneral-value.descuento)) }</td>
                            </tr>`);

                        let importeBruto = value.precioVentaGeneral * value.cantidad;
                        let descuento = value.descuento;
                        let subImporteBruto = importeBruto - descuento;
                        let subImporteNeto = tools.calculateTaxBruto(value.impuestoValor, subImporteBruto);
                        let impuesto = tools.calculateTax(value.impuestoValor, subImporteNeto);
                        let importeNeto = subImporteNeto + impuesto;

                        importeBrutoTotal += importeBruto;
                        descuentoBrutoTotal += descuento;
                        subImporteNetoTotal += subImporteNeto;
                        impuestoNetoTotal += impuesto;
                        importeNetoTotal += importeNeto;
                    }
                }

                $("#lblTotal").html(monedaSimbolo + " " + tools.formatMoney(importeNetoTotal));
                $("#lblImporteBruto").html(monedaSimbolo + " " + tools.formatMoney(importeBrutoTotal));
                $("#lblDescuentoBruto").html(monedaSimbolo + " " + tools.formatMoney(descuentoBrutoTotal));
                $("#lblSubImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(subImporteNetoTotal));
                $("#lblImpuestoNeto").html(monedaSimbolo + " " + tools.formatMoney(impuestoNetoTotal));
                $("#lblImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(importeNetoTotal));
            }

            function validateDatelleVenta(idSuministro) {
                let ret = false;
                for (let i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i].idSuministro == idSuministro) {
                        ret = true;
                        break;
                    }
                }
                return ret;
            }

            function GuardarCotizacion() {
                if (listaProductos.length == 0) {
                    tools.AlertWarning('', 'No hay productos en la lista');
                    $("#btnProductos").focus();
                } else if (tools.validateComboBox($('#cbCliente'))) {
                    tools.AlertWarning('', 'Seleccione un cliente');
                    $('#cbCliente').focus();
                } else if (tools.validateComboBox($('#cbMoneda'))) {
                    tools.AlertWarning('', 'Seleccione una moneda');
                    $('#cbMoneda').focus();
                } else {
                    tools.ModalDialog("Cotización", '¿Está seguro de continuar?', function(value) {
                        if (value == true) {
                            tools.promiseFetchPost("../app/controller/CotizacionController.php", {
                                "type": "crud",
                                "idCotizacion": idCotizacion,
                                "idCliente": $('#cbCliente').val(),
                                "idEmpleado": idEmpleado,
                                "fechaEmision": $("#txtFechaEmision").val(),
                                "fechaVencimientto": $("#txtFechaVencimiento").val(),
                                "observacion": $("#txtObservacion").val(),
                                "idMoneda": $("#cbMoneda").val(),
                                "estado": 1,
                                "detalle": listaProductos
                            }, function() {
                                resetCotizacion();
                                tools.ModalAlertInfo("Cotización", "Se está procesando la información.");
                            }).then(function(result) {
                                tools.ModalAlertSuccess("Cotización", result);
                            }).catch(function(error) {
                                tools.ErrorMessageServer("Cotización", error);
                            });
                        }
                    });
                }
            }

            function resetCotizacion() {
                $("#divOverlayPuntoVenta").removeClass("d-none");
                $("#txtFechaEmision").val(tools.getCurrentDate());
                $("#txtFechaVencimiento").val(tools.getCurrentDate());
                $("#txtObservacion").val('');

                idCotizacion = 0;
                $("#btnGuardar").removeClass("btn-warning");
                $("#btnGuardar").addClass("btn-primary");
                $("#btnGuardar").html('<i class="fa fa-save"></i> Guardar');

                importeBrutoTotal = 0;
                descuentoBrutoTotal = 0;
                subImporteNetoTotal = 0;
                impuestoNetoTotal = 0;
                importeNetoTotal = 0;
                listaProductos = [];
                renderTableProductos();
                loadInit();

                $('#cbCliente').empty();
                selectCliente();
            }

            function selectCliente() {
                $('#cbCliente').empty();
                $('#cbCliente').select2({
                    width: '100%',
                    placeholder: "Buscar Cliente",
                    ajax: {
                        url: "../app/controller/ClienteController.php",
                        type: "GET",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                type: "fillcliente",
                                search: params.term
                            };
                        },
                        processResults: function(response) {
                            let datafill = response.map((item, index) => {
                                return {
                                    id: item.IdCliente,
                                    text: item.NumeroDocumento + ' - ' + item.Informacion
                                };
                            });
                            return {
                                results: datafill
                            };
                        },
                        cache: true
                    }
                });
            }
        </script>
    </body>

    </html>

<?php

}
