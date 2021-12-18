function ModalCotizacion() {

    let stateCotizacion = false;
    let paginacionCotizacion = 0;
    let opcionCotizacion = 0;
    let totalPaginacionCotizacion = 0;
    let filasPorPaginaCotizacion = 10;
    let tbListCotizacion = $("#tbListCotizacion");
    let ulPaginationCotizacion = $("#ulPaginationCotizacion");

    this.init = function () {
        $("#txtFechaInicialCotizacion").val(tools.getCurrentDate());
        $("#txtFechaFinalCotizacion").val(tools.getCurrentDate());

        $("#btnCotizaciones").click(function () {
            $("#modalCotizacion").modal("show");
        });

        $("#btnCotizaciones").keypress(function (event) {
            if (event.keyCode == 13) {
                $("#modalCotizacion").modal("show");
                event.preventDefault();
            }
        });

        $("#modalCotizacion").on('shown.bs.modal', function () {
            $("#txtSearchCotizacion").focus();
            loadInitCotizacion();
        });

        $("#modalCotizacion").on("hide.bs.modal", function () {
            tbListCotizacion.empty();
            tbListCotizacion.append('<tr><td class="text-center" colspan="7"><p>Iniciar la busqueda para cargar los datos.</p></td></tr>');
            $("#txtSearchCotizacion").val('');
            $("#txtFechaInicialCotizacion").val(tools.getCurrentDate());
            $("#txtFechaFinalCotizacion").val(tools.getCurrentDate());
        });

        $("#txtSearchCotizacion").on("keyup", function (event) {
            let value = $("#txtSearchCotizacion").val();
            if (event.keyCode !== 9 && event.keyCode !== 18) {
                if (value.trim().length != 0) {
                    if (!stateCotizacion) {
                        paginacionCotizacion = 1;
                        fillTableCotizacion(1, value.trim(), "", "");
                        opcionCotizacion = 1;
                    }
                }
            }
        });

        $("#btnRecargarCotizacion").click(function (event) {
            if (tools.validateDate($("#txtFechaInicialCotizacion").val()) && tools.validateDate($("#txtFechaFinalCotizacion").val())) {
                if (!stateCotizacion) {
                    paginacionCotizacion = 1;
                    fillTableCotizacion(0, "", $("#txtFechaInicialCotizacion").val(), $("#txtFechaFinalCotizacion").val());
                    opcionCotizacion = 0;
                }
            }
        });

        $("#btnRecargarCotizacion").keypress(function (event) {
            if (event.keyCode == 13) {
                if (tools.validateDate($("#txtFechaInicialCotizacion").val()) && tools.validateDate($("#txtFechaFinalCotizacion").val())) {
                    if (!stateCotizacion) {
                        paginacionCotizacion = 1;
                        fillTableCotizacion(0, "", $("#txtFechaInicialCotizacion").val(), $("#txtFechaFinalCotizacion").val());
                        opcionCotizacion = 0;
                    }
                }
                event.preventDefault();
            }
        });

        $("#txtFechaInicialCotizacion").change(function (event) {
            if (tools.validateDate($("#txtFechaInicialCotizacion").val()) && tools.validateDate($("#txtFechaFinalCotizacion").val())) {
                if (!stateCotizacion) {
                    paginacionCotizacion = 1;
                    fillTableCotizacion(0, "", $("#txtFechaInicialCotizacion").val(), $("#txtFechaFinalCotizacion").val());
                    opcionCotizacion = 0;
                }
            }
        });

        $("#txtFechaFinalCotizacion").change(function (event) {
            if (tools.validateDate($("#txtFechaInicialCotizacion").val()) && tools.validateDate($("#txtFechaFinalCotizacion").val())) {
                if (!stateCotizacion) {
                    paginacionCotizacion = 1;
                    fillTableCotizacion(0, "", $("#txtFechaInicialCotizacion").val(), $("#txtFechaFinalCotizacion").val());
                    opcionCotizacion = 0;
                }
            }
        });

    }

    this.openModalInit = function () {
        $("#modalCotizacion").modal("show");
    }

    function onEventPaginacion() {
        switch (opcionCotizacion) {
            case 0:
                fillTableCotizacion(0, "", $("#txtFechaInicialCotizacion").val(), $("#txtFechaFinalCotizacion").val());
                break;
            case 1:
                fillTableCotizacion(1, $("#txtSearchCotizacion").val(), "", "");
                break;
        }
    }

    function loadInitCotizacion() {
        if (tools.validateDate($("#txtFechaInicialCotizacion").val()) && tools.validateDate($("#txtFechaFinalCotizacion").val())) {
            if (!stateCotizacion) {
                paginacionCotizacion = 1;
                fillTableCotizacion(0, "", $("#txtFechaInicialCotizacion").val(), $("#txtFechaFinalCotizacion").val());
                opcionCotizacion = 0;
            }
        }
    }

    async function fillTableCotizacion(opcion, buscar, fechaInicial, fechaFinal) {
        try {
            let result = await tools.promiseFetchGet("../app/controller/CotizacionController.php", {
                "type": "all",
                "opcion": opcion,
                "buscar": buscar,
                "fechaInicial": fechaInicial,
                "fechaFinal": fechaFinal,
                "posicionPagina": ((paginacionCotizacion - 1) * filasPorPaginaCotizacion),
                "filasPorPagina": filasPorPaginaCotizacion
            }, function () {
                tbListCotizacion.empty();
                tbListCotizacion.append('<tr><td class="text-center" colspan="7"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                stateCotizacion = true;
                totalPaginacionCotizacion = 0;
            });

            tbListCotizacion.empty();
            if (result.data.length == 0) {
                tbListCotizacion.append('<tr><td class="text-center" colspan="7"><p>!No hay datos para mostrar¡</p></td></tr>');
                ulPaginationCotizacion.html(`
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
                stateCotizacion = false;
            } else {
                for (let value of result.data) {
                    tbListCotizacion.append(`<tr>
                    <td>${value.Id}</td>
                    <td>${value.Apellidos + '<br>' + value.Nombres}</td>
                    <td>${'COTIZACIÓN' + '<br>N° ' + value.IdCotizacion}</td>
                    <td>${tools.getDateForma(value.FechaCotizacion) + '<br>' + tools.getTimeForma24(value.HoraCotizacion)}</td>
                    <td>${value.NumeroDocumento + '<br>' + value.Informacion}</td>
                    <td>${value.SimboloMoneda + ' ' + tools.formatMoney(value.Total)}</td>
                    <td class="text-center"><button class="btn btn-danger" onclick="loadAddCotizacion('${value.IdCotizacion}')"><image src="./images/accept.png" width="22" height="22" /></button></td>
                    </tr>
                    `);
                }

                totalPaginacionCotizacion = parseInt(Math.ceil((parseFloat(result.total) / filasPorPaginaCotizacion)));

                let i = 1;
                let range = [];
                while (i <= totalPaginacionCotizacion) {
                    range.push(i);
                    i++;
                }

                let min = Math.min.apply(null, range);
                let max = Math.max.apply(null, range);

                let paginacionHtml = `
                    <button class="btn btn-outline-secondary" onclick="onEventPaginacionInicioCt(${min})">
                        <i class="fa fa-angle-double-left"></i>
                    </button>
                    <button class="btn btn-outline-secondary" onclick="onEventAnteriorPaginacionCt()">
                        <i class="fa fa-angle-left"></i>
                    </button>
                    <span class="btn btn-outline-secondary disabled">${paginacionCotizacion} - ${totalPaginacionCotizacion}</span>
                    <button class="btn btn-outline-secondary" onclick="onEventSiguientePaginacionCt()">
                        <i class="fa fa-angle-right"></i>
                    </button>
                    <button class="btn btn-outline-secondary" onclick="onEventPaginacionFinalCt(${max})">
                        <i class="fa fa-angle-double-right"></i>
                    </button>`;

                ulPaginationCotizacion.html(paginacionHtml);
                stateCotizacion = false;
            }
        } catch (error) {
            tbListCotizacion.empty();
            tbListCotizacion.append('<tr><td class="text-center" colspan="7"><p>' + error.responseText + '</p></td></tr>');

            ulPaginationCotizacion.html(`
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
            stateCotizacion = false;
        }
    }

    loadAddCotizacion = async function (id) {
        try {
            let result = await tools.promiseFetchGet("../app/controller/CotizacionController.php", {
                "type": "cotizaciondetalle",
                "idCotizacion": id
            }, function () {
                $("#modalCotizacion").modal("hide");
                $("#divOverlayPuntoVenta").removeClass("d-none");
                $('#cbCliente').empty();
                listaProductos = [];
            });

            let cotizacion = result.data;
            idCotizacion = cotizacion.IdCotizacion;

            var data = [{
                id: cotizacion.IdCliente,
                text: cotizacion.NumeroDocumento + ' - ' + cotizacion.Informacion
            }];

            $('#cbCliente').select2({
                width: '100%',
                placeholder: "Buscar Cliente",
                data: data,
                ajax: {
                    url: "../app/controller/ClienteController.php",
                    type: "GET",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            type: "fillcliente",
                            search: params.term
                        };
                    },
                    processResults: function (response) {
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

            $("#txtObservacion").val(cotizacion.Observaciones);
            $("#cbMoneda").val(cotizacion.IdMoneda);

            for (let value of result.detalle) {
                let suministro = value;
                let cantidad = parseFloat(suministro.Cantidad);

                let valor_sin_impuesto = parseFloat(suministro.Precio) / ((parseFloat(suministro.Valor) / 100.00) + 1);
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

                    "unidadCompraId": suministro.UnidadCompra,
                    "unidadCompra": suministro.Medida
                });
            }
            renderTableProductos();

            $("#btnGuardar").removeClass("btn-primary");
            $("#btnGuardar").addClass("btn-warning");
            $("#btnGuardar").html('<i class="fa fa-edit"></i> Editar');

            $("#divOverlayPuntoVenta").addClass("d-none");
        } catch (error) {
            $("#divOverlayPuntoVenta").addClass("d-none");
            select2_();
        }
    }

    onEventPaginacionInicioCt = function (value) {
        if (!stateCotizacion) {
            if (value !== paginacionCotizacion) {
                paginacionCotizacion = value;
                onEventPaginacion();
            }
        }
    }

    onEventPaginacionFinalCt = function (value) {
        if (!stateCotizacion) {
            if (value !== paginacionCotizacion) {
                paginacionCotizacion = value;
                onEventPaginacion();
            }
        }
    }

    onEventAnteriorPaginacionCt = function () {
        if (!stateCotizacion) {
            if (paginacionCotizacion > 1) {
                paginacionCotizacion--;
                onEventPaginacion();
            }
        }
    }

    onEventSiguientePaginacionCt = function () {
        if (!stateCotizacion) {
            if (paginacionCotizacion < totalPaginacionCotizacion) {
                paginacionCotizacion++;
                onEventPaginacion();
            }
        }
    }

}