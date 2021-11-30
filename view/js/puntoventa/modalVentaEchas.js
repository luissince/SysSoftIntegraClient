function ModalVentaEchas() {

    let stateVentasEchas = false;
    let paginacionVentasEchas = 0;
    let opcionVentasEchas = 0;
    let totalPaginacionVentasEchas = 0;
    let filasPorPaginaVentasEchas = 5;
    let tbListVentasEchas = $("#tbListVentasEchas");
    let ulPaginationVentasEchas = $("#ulPaginationVentasEchas");

    this.init = function () {

        $("#btnVentas").click(function () {
            $("#modalVentasEchas").modal("show");
        });

        $("#btnVentas").keypress(function (event) {
            if (event.keyCode == 13) {
                $("#modalVentasEchas").modal("show");
                event.preventDefault();
            }
        });

        $("#modalVentasEchas").on('shown.bs.modal', function () {
            $("#txtSearchVentasEchas").focus();
        });

        $("#modalVentasEchas").on("hide.bs.modal", function () {
            tbListVentasEchas.empty();
            tbListVentasEchas.append('<tr><td class="text-center" colspan="8"><p>Iniciar la busqueda para cargar los datos.</p></td></tr>');
        });

        $("#txtSearchVentasEchas").on("keyup", function (event) {
            let value = $("#txtSearchVentasEchas").val();
            if (event.keyCode !== 9 && event.keyCode !== 18) {
                if (value.trim().length != 0) {
                    if (!stateVentasEchas) {
                        paginacionVentasEchas = 1;
                        fillTableVentasEchas(0, value.trim());
                        opcionVentasEchas = 0;
                    }
                }
            }
        });

        $("#btnUltimasVentas").click(function () {
            if (!stateVentasEchas) {
                paginacionVentasEchas = 1;
                fillTableVentasEchas(1, "");
                opcionVentasEchas = 1;
            }
        });

        $("#btnUltimasVentas").keypress(function (event) {
            if (event.keyCode === 13) {
                if (!stateVentasEchas) {
                    paginacionVentasEchas = 1;
                    fillTableVentasEchas(1, "");
                    opcionVentasEchas = 1;
                }
                event.preventDefault();
            }
        });

    }
    function onEventPaginacion() {
        switch (opcionVentasEchas) {
            case 0:
                fillTableVentasEchas(0, $("#txtSearchVentasEchas").val());
                break;
            case 1:
                fillTableVentasEchas(1, "");
                break;
        }
    }

    function loadInitVentasEchas() {
        if (!stateVentasEchas) {
            paginacionVentasEchas = 1;
            fillTableVentasEchas(0, "");
            opcionVentasEchas = 0;
        }
    }

    async function fillTableVentasEchas(opcion, buscar) {
        try {
            let result = await tools.promiseFetchGet("../app/controller/VentaController.php", {
                "type": "ventasEchas",
                "opcion": opcion,
                "buscar": buscar,
                "posicionPagina": ((paginacionVentasEchas - 1) * filasPorPaginaVentasEchas),
                "filasPorPagina": filasPorPaginaVentasEchas
            }, function () {
                tbListVentasEchas.empty();
                tbListVentasEchas.append('<tr><td class="text-center" colspan="8"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                stateVentasEchas = true;
                totalPaginacionVentasEchas = 0;
                arrayVentasEchas = [];
            });

            tbListVentasEchas.empty();
            if (result.data.length == 0) {
                tbListVentasEchas.append('<tr><td class="text-center" colspan="8"><p>!No hay datos para mostrar¡</p></td></tr>');
                ulPaginationVentasEchas.html(`
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
                stateVentasEchas = false;
            } else {
                for (let value of result.data) {
                    tbListVentasEchas.append(`<tr>
                    <td>${value.Id}</td>
                    <td>${value.Cliente}</td>
                    <td>${value.Serie + '-' + value.Numeracion}</td>
                    <td>${tools.getDateForma(value.FechaVenta)}<br>${tools.getTimeForma24(value.HoraVenta)}</td>
                    <td>${value.Simbolo + ' ' + tools.formatMoney(value.Total)}</td>
                    <td class="text-center"><button class="btn btn-danger"><image src="./images/print.png" width="22" height="22" /></button></td>
                    <td class="text-center"><button class="btn btn-danger" onclick="loadAddVenta('${value.IdVenta}')"><image src="./images/accept.png" width="22" height="22" /></button></td>
                    <td class="text-center"><button class="btn btn-danger"><image src="./images/plus.png" width="22" height="22" /></button></td>
                    </tr>
                    `);
                }
                totalPaginacionVentasEchas = parseInt(Math.ceil((parseFloat(result.total) / filasPorPaginaVentasEchas)));

                let i = 1;
                let range = [];
                while (i <= totalPaginacionVentasEchas) {
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
                    <span class="btn btn-outline-secondary disabled" id="lblPaginacion">${paginacionVentasEchas} - ${totalPaginacionVentasEchas}</span>
                    <button class="btn btn-outline-secondary" onclick="onEventSiguientePaginacion()">
                        <i class="fa fa-angle-right"></i>
                    </button>
                    <button class="btn btn-outline-secondary" onclick="onEventPaginacionFinal(${max})">
                        <i class="fa fa-angle-double-right"></i>
                    </button>`;

                ulPaginationVentasEchas.html(paginacionHtml);
                stateVentasEchas = false;
            }
        } catch (error) {
            tbListVentasEchas.empty();
            tbListVentasEchas.append('<tr><td class="text-center" colspan="8"><p>' + error.responseText + '</p></td></tr>');
            stateVentasEchas = false;
        }
    }

    loadAddVenta = async function (idVenta) {
        try {
            let result = await tools.promiseFetchGet("../app/controller/VentaController.php", {
                "type": "ventaAgregar",
                "idVenta": idVenta
            }, function () {
                listaProductos = [];
                $("#modalVentasEchas").modal("hide");
            });

            let venta = result[0];
            $("#cbComprobante").val(venta.IdComprobante);
            $("#cbTipoDocumento").val(venta.TipoDocumento);
            $("#cbMoneda").val(venta.IdMoneda);
            $("#txtNumero").val(venta.NumeroDocumento);
            $("#txtCliente").val(venta.Informacion);
            $("#txtCelular").val(venta.Celular);
            $("#txtEmail").val(venta.Email);
            $("#txtDireccion").val(venta.Direccion);

            let detalle = result[1];
            for (let value of detalle) {
                let cantidad = parseFloat(value.Cantidad);

                let valor_sin_impuesto = parseFloat(value.PrecioVenta) / ((parseFloat(value.ValorImpuesto) / 100.00) + 1);
                let descuento = 0;
                let porcentajeRestante = valor_sin_impuesto * (descuento / 100.00);
                let preciocalculado = valor_sin_impuesto - porcentajeRestante;

                let impuesto = tools.calculateTax(value.ValorImpuesto, preciocalculado);

                listaProductos.push({
                    "idSuministro": value.IdSuministro,
                    "clave": value.Clave,
                    "nombreMarca": value.NombreMarca,
                    "cantidad": cantidad,
                    "costoCompra": value.CostoVenta,
                    "bonificacion": 0,
                    "descuento": 0,
                    "descuentoCalculado": 0,
                    "descuentoSumado": 0,

                    "precioVentaGeneralUnico": valor_sin_impuesto,
                    "precioVentaGeneralReal": preciocalculado,

                    "impuestoOperacion": value.Operacion,
                    "impuestoId": value.IdImpuesto,
                    "impuestoNombre": value.NombreImpuesto,
                    "impuestoValor": value.ValorImpuesto,

                    "impuestoSumado": cantidad * impuesto,
                    "precioVentaGeneral": preciocalculado + impuesto,
                    "precioVentaGeneralAuxiliar": preciocalculado + impuesto,

                    "importeBruto": cantidad * valor_sin_impuesto,
                    "subImporteNeto": cantidad * preciocalculado,
                    "importeNeto": cantidad * (preciocalculado + impuesto),

                    "inventario": value.Inventario,
                    "unidadVenta": value.UnidadVenta,
                    "valorInventario": value.ValorInventario
                });

                renderTableProductos();
            }

        } catch (error) {
            console.log(error)
        }
    }

    onEventPaginacionInicio = function (value) {
        if (!stateVentasEchas) {
            if (value !== paginacionVentasEchas) {
                paginacionVentasEchas = value;
                onEventPaginacion();
            }
        }
    }

    onEventPaginacionFinal = function (value) {
        if (!stateVentasEchas) {
            if (value !== paginacionVentasEchas) {
                paginacionVentasEchas = value;
                onEventPaginacion();
            }
        }
    }

    onEventAnteriorPaginacion = function () {
        if (!stateVentasEchas) {
            if (paginacionVentasEchas > 1) {
                paginacionVentasEchas--;
                onEventPaginacion();
            }
        }
    }

    onEventSiguientePaginacion = function () {
        if (!stateVentasEchas) {
            if (paginacionVentasEchas < totalPaginacionVentasEchas) {
                paginacionVentasEchas++;
                onEventPaginacion();
            }
        }
    }

}