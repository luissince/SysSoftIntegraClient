function ModalProductos() {

    let arrayProductos = [];
    let stateProductos = false;
    let paginacionProductos = 0;
    let opcionProductos = 0;
    let totalPaginacionProductos = 0;
    let filasPorPaginaProductos = 10;
    let tbListProductos = $("#tbListProductos");
    let ulPaginationProductos = $("#ulPaginationProductos");

    this.init = function () {

        $("#btnProductos").click(function () {
            $("#modalProductos").modal("show");
        });

        $("#btnProductos").keypress(function (event) {
            if (event.keyCode == 13) {
                $("#modalProductos").modal("show");
                event.preventDefault();
            }
        });

        $('#modalProductos').on('shown.bs.modal', function () {
            $('#txtSearchProducto').trigger('focus');
            loadInitVentas();
        });

        $('#modalProductos').on('hide.bs.modal', function () {
            $("#tbListProductos").empty();
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

    this.openModalInit = function () {
        $("#modalProductos").modal("show");
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

    async function fillProductosTable(tipo, value) {
        try {
            let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                "type": "modalproductos",
                "tipo": tipo,
                "value": value,
                "posicionPagina": ((paginacionProductos - 1) * filasPorPaginaProductos),
                "filasPorPagina": filasPorPaginaProductos
            }, function () {
                tbListProductos.empty();
                tbListProductos.append('<tr><td class="text-center" colspan="7"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                stateProductos = true;
                totalPaginacionProductos = 0;
                arrayProductos = [];
            });

            let object = result;
            tbListProductos.empty();
            arrayProductos = object.data;
            if (arrayProductos.length === 0) {
                tbListProductos.append('<tr><td class="text-center" colspan="7"><p>No hay datos para mostrar</p></td></tr>');
                ulPaginationProductos.html(`
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-angle-double-left"></i>
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-angle-left"></i>
                </button>
                <span class="btn btn-outline-secondary disabled">0 - 0</span>
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-angle-right"></i>
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-angle-double-right"></i>
                </button>`);
                stateProductos = false;
            } else {
                for (let producto of arrayProductos) {                    
                    tbListProductos.append(`<tr>
                        <td class="text-center">${producto.Id}</td>
                        <td>${producto.Clave + '</br>' + producto.NombreMarca}</td>
                        <td>${producto.Categoria + '<br>' + producto.Marca}</td>
                        <td class="${(parseFloat(producto.Cantidad) > 0 ? "text-black" : "text-danger")}">${tools.formatMoney(parseFloat(producto.Cantidad)) + '<br>' + producto.UnidadCompra}</td>
                        <td>${producto.ImpuestoNombre}</td>
                        <td>${tools.formatMoney(parseFloat(producto.PrecioVentaGeneral))}</td>
                        <td><button class="btn btn-danger" onclick="onSelectProducto('${producto.IdSuministro}')"><image src="./images/accept.png" width="22" height="22" /></button></td>' +
                        </tr>`);
                }
                totalPaginacionProductos = parseInt(Math.ceil((parseFloat(object.total) / filasPorPaginaProductos)));

                let i = 1;
                let range = [];
                while (i <= totalPaginacionProductos) {
                    range.push(i);
                    i++;
                }

                let min = Math.min.apply(null, range);
                let max = Math.max.apply(null, range);

                let paginacionHtml = `
                    <button class="btn btn-outline-secondary" onclick="onEventPaginacionInicioPr(${min})">
                        <i class="fa fa-angle-double-left"></i>
                    </button>
                    <button class="btn btn-outline-secondary" onclick="onEventAnteriorPaginacionPr()">
                        <i class="fa fa-angle-left"></i>
                    </button>
                    <span class="btn btn-outline-secondary disabled">${paginacionProductos} - ${totalPaginacionProductos}</span>
                    <button class="btn btn-outline-secondary" onclick="onEventSiguientePaginacionPr()">
                        <i class="fa fa-angle-right"></i>
                    </button>
                    <button class="btn btn-outline-secondary" onclick="onEventPaginacionFinalPr(${max})">
                        <i class="fa fa-angle-double-right"></i>
                    </button>`;

                ulPaginationProductos.html(paginacionHtml);

                stateProductos = false;
            }
        } catch (error) {
            tbListProductos.empty();
            tbListProductos.append('<tr><td class="text-center" colspan="7"><p>Error en obtener los datos nuevamentes</p></td></tr>');
            ulPaginationProductos.html(`
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-angle-double-left"></i>
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-angle-left"></i>
                </button>
                <span class="btn btn-outline-secondary disabled">0 - 0</span>
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-angle-right"></i>
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-angle-double-right"></i>
                </button>`);
            stateProductos = false;
        }
    }

    onSelectProducto = function (idSuministro) {
        for (let i = 0; i < arrayProductos.length; i++) {
            if (arrayProductos[i].IdSuministro == idSuministro) {
                if (!validateDatelleVenta(idSuministro)) {                    
                    let suministro = arrayProductos[i];
                    let cantidad = 1;

                    let valor_sin_impuesto = parseFloat(suministro.PrecioVentaGeneral) / ((parseFloat(suministro.Valor) / 100.00) + 1);
                    let descuento = 0;
                    let porcentajeRestante = valor_sin_impuesto * (descuento / 100.00);
                    let preciocalculado = valor_sin_impuesto - porcentajeRestante;

                    let impuesto = tools.calculateTax(parseFloat(suministro.Valor), preciocalculado);

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
                        "impuestoValor": parseFloat(suministro.Valor),

                        "impuestoSumado": cantidad * impuesto,
                        "precioVentaGeneral": preciocalculado + impuesto,
                        "precioVentaGeneralAuxiliar": preciocalculado + impuesto,

                        "importeBruto": cantidad * valor_sin_impuesto,
                        "subImporteNeto": cantidad * preciocalculado,
                        "importeNeto": cantidad * (preciocalculado + impuesto),

                        "unidadCompraId": suministro.IdUnidadCompra,
                        "unidadCompra": suministro.UnidadCompra
                    });
                    break;
                } else {
                    for (let i = 0; i < listaProductos.length; i++) {
                        if (listaProductos[i].idSuministro == idSuministro) {
                            let currenteObject = listaProductos[i];

                            currenteObject.cantidad = parseFloat(currenteObject.cantidad) + 1;

                            let porcentajeRestante = parseFloat(currenteObject.precioVentaGeneralUnico) * (parseFloat(currenteObject.descuento) / 100.00);
                            currenteObject.descuentoSumado = porcentajeRestante * currenteObject.cantidad;
                            currenteObject.impuestoSumado = currenteObject.cantidad * (parseFloat(currenteObject.precioVentaGeneralReal) * (parseFloat(currenteObject.impuestoValor) / 100.00));

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

    onEventPaginacionInicioPr = function (value) {
        if (!stateProductos) {
            if (value !== paginacionProductos) {
                paginacionProductos = value;
                onEventPaginacion();
            }
        }
    }

    onEventPaginacionFinalPr = function (value) {
        if (!stateProductos) {
            if (value !== paginacionProductos) {
                paginacionProductos = value;
                onEventPaginacion();
            }
        }
    }

    onEventAnteriorPaginacionPr = function () {
        if (!stateProductos) {
            if (paginacionProductos > 1) {
                paginacionProductos--;
                onEventPaginacion();
            }
        }
    }

    onEventSiguientePaginacionPr = function () {
        if (!stateProductos) {
            if (paginacionProductos < totalPaginacionProductos) {
                paginacionProductos++;
                onEventPaginacion();
            }
        }
    }

}