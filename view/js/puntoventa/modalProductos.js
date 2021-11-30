function ModalProductos() {

    let arrayProductos = [];
    let stateProductos = false;
    let paginacionProductos = 0;
    let opcionProductos = 0;
    let totalPaginacionProductos = 0;
    let filasPorPaginaProductos = 10;
    let tbListProductos = $("#tbListProductos");
    let lblPaginaActualProducto = $("#lblPaginaActualProducto");
    let lblPaginaSiguienteProducto = $("#lblPaginaSiguienteProducto");

    this.init = function () {

        $("#btnProductos").click(function () {
            loadInitVentas();
        });

        $('#modalProductos').on('shown.bs.modal', function () {
            $('#txtSearchProducto').trigger('focus');
        });

        $('#modalProductos').on('hide.bs.modal', function () {
            clearModalProductos();
        });

        $("#txtSearchProducto").keyup(function () {
            if (!stateProductos) {
                if ($("#txtSearchProducto").val().trim().length != 0) {
                    paginacionProductos = 1;
                    fillProductosTable(1, $("#txtSearchProducto").val().trim());
                    opcionProductos = 1;
                }
            }
        });

        $("#btnAnteriorProducto").click(function () {
            if (!stateProductos) {
                if (paginacionProductos > 1) {
                    paginacionProductos--;
                    onEventPaginacion();
                }
            }
        });

        $("#btnSiguienteProducto").click(function () {
            if (!stateProductos) {
                if (paginacionProductos < totalPaginacionProductos) {
                    paginacionProductos++;
                    onEventPaginacion();
                }
            }
        });

        $("#btnReloadProducto").click(function () {
            loadInitVentas();
        });
    }

    this.openModalInitVentas = function () {
        loadInitVentas();
    }

    function onEventPaginacion() {
        switch (opcionProductos) {
            case 0:
                fillProductosTable(0, "");
                break;
            case 1:
                fillProductosTable(1, $("#txtSearchProducto").val().trim());
                break;
        }
    }

    function loadInitVentas() {
        if (!stateProductos) {
            paginacionProductos = 1;
            fillProductosTable(0, "");
            opcionProductos = 0;
        }
    }

    function fillProductosTable(tipo, value) {
        $("#modalProductos").modal("show");
        $.ajax({
            url: "../app/controller/SuministroController.php",
            method: "GET",
            data: {
                "type": "modalproductos",
                "tipo": tipo,
                "value": value,
                "libre": 0,
                "venta": 1,
                "insumo": 0,
                "posicionPagina": ((paginacionProductos - 1) * filasPorPaginaProductos),
                "filasPorPagina": filasPorPaginaProductos
            },
            beforeSend: function () {
                tbListProductos.empty();
                tbListProductos.append('<tr><td class="text-center" colspan="6"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                stateProductos = true;
                totalPaginacionProductos = 0;
                arrayProductos = [];
            },
            success: function (result) {
                let object = result;
                if (object.estado === 1) {
                    tbListProductos.empty();
                    arrayProductos = object.data;
                    if (arrayProductos.length === 0) {
                        tbListProductos.append('<tr><td class="text-center" colspan="6"><p>No hay datos para mostrar</p></td></tr>');
                        totalPaginacionProductos = 0;
                        lblPaginaActualProducto.html(0);
                        lblPaginaSiguienteProducto.html(0);
                        stateProductos = false;
                    } else {
                        for (let producto of arrayProductos) {
                            tbListProductos.append('<tr ondblclick="onSelectProducto(\'' + producto.IdSuministro + '\')">' +
                                '<td class="text-center">' + producto.Id + '</td>' +
                                '<td>' + producto.Clave + '</br>' + producto.NombreMarca + '</td>' +
                                '<td>' + producto.Categoria + '<br>' + producto.Marca + '</td>' +
                                '<td class="' + (parseFloat(producto.Cantidad) > 0 ? "text-black" : "text-danger") + '">' + tools.formatMoney(parseFloat(producto.Cantidad)) + ' ' + producto.UnidadCompra + '</td>' +
                                '<td>' + producto.ImpuestoNombre + '</td>' +
                                '<td>' + tools.formatMoney(parseFloat(producto.PrecioVentaGeneral)) + '</td>' +
                                '</tr>');
                        }
                        totalPaginacionProductos = parseInt(Math.ceil((parseFloat(object.total) / filasPorPaginaProductos)));
                        lblPaginaActualProducto.html(paginacionProductos);
                        lblPaginaSiguienteProducto.html(totalPaginacionProductos);
                        stateProductos = false;
                    }
                } else {
                    tbListProductos.empty();
                    tbListProductos.append('<tr><td class="text-center" colspan="6"><p>' + object.message + '</p></td></tr>');
                    stateProductos = false;
                }
            },
            error: function (error) {
                tbListProductos.empty();
                tbListProductos.append('<tr><td class="text-center" colspan="6"><p>Error en obtener los datos nuevamentes</p></td></tr>');
                stateProductos = false;
            }
        });
    }

    onSelectProducto = function (idSuministro) {
        for (let i = 0; i < arrayProductos.length; i++) {
            if (arrayProductos[i].IdSuministro == idSuministro) {
                if (!validateDatelleVenta(idSuministro)) {
                    let suministro = arrayProductos[i];
                    let cantidad = 1;

                    let valor_sin_impuesto = suministro.PrecioVentaGeneral / ((suministro.Valor / 100.00) + 1);
                    let descuento = 0;
                    let porcentajeRestante = valor_sin_impuesto * (descuento / 100.00);
                    let preciocalculado = valor_sin_impuesto - porcentajeRestante;

                    let impuesto = tools.calculateTax(suministro.Valor, preciocalculado);

                    listaProductos.push({
                        "idSuministro": suministro.IdSuministro,
                        "clave": suministro.Clave,
                        "nombreMarca": suministro.NombreMarca,
                        "cantidad": cantidad,
                        "costoCompra": suministro.PrecioCompra,
                        "bonificacion": 0,
                        "descuento": 0,
                        "descuentoCalculado": 0,
                        "descuentoSumado": 0,

                        "precioVentaGeneralUnico": valor_sin_impuesto,
                        "precioVentaGeneralReal": preciocalculado,

                        "impuestoOperacion": suministro.Operacion,
                        "impuestoId": suministro.Impuesto,
                        "impuestoNombre": suministro.ImpuestoNombre,
                        "impuestoValor": suministro.Valor,

                        "impuestoSumado": cantidad * impuesto,
                        "precioVentaGeneral": preciocalculado + impuesto,
                        "precioVentaGeneralAuxiliar": preciocalculado + impuesto,

                        "importeBruto": cantidad * valor_sin_impuesto,
                        "subImporteNeto": cantidad * preciocalculado,
                        "importeNeto": cantidad * (preciocalculado + impuesto),

                        "inventario": suministro.Inventario,
                        "unidadVenta": suministro.UnidadVenta,
                        "valorInventario": suministro.ValorInventario
                    });
                    break;
                } else {
                    for (let i = 0; i < listaProductos.length; i++) {
                        if (listaProductos[i].idSuministro == idSuministro) {
                            let currenteObject = listaProductos[i];

                            currenteObject.cantidad = parseFloat(currenteObject.cantidad) + 1;

                            let porcentajeRestante = currenteObject.precioVentaGeneralUnico * (currenteObject.descuento / 100.00);
                            currenteObject.descuentoSumado = porcentajeRestante * currenteObject.cantidad;
                            currenteObject.impuestoSumado = currenteObject.cantidad * (currenteObject.precioVentaGeneralReal * (currenteObject.impuestoValor / 100.00));

                            currenteObject.importeBruto = currenteObject.cantidad * currenteObject.precioVentaGeneralUnico;
                            currenteObject.subImporteNeto = currenteObject.cantidad * currenteObject.precioVentaGeneralReal;
                            currenteObject.importeNeto = currenteObject.cantidad * currenteObject.precioVentaGeneral;
                            break;
                        }
                    }
                }
            }
        }
        renderTableProductos();
        $("#txtSearchProducto").focus();
    }

    function clearModalProductos() {
        $("#tbListProductos").empty();
    }

}